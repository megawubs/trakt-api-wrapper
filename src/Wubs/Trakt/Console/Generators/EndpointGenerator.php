<?php


namespace Wubs\Trakt\Console\Generators;


use Illuminate\Support\Collection;
use League\Flysystem\Adapter\Local;
use League\Flysystem\Filesystem;
use ReflectionClass;
use ReflectionException;
use Symfony\Component\Console\Helper\DialogHelper;
use Symfony\Component\Console\Output\OutputInterface;
use Wubs\Trakt\Exception\ClassCanNotBeImplementedAsEndpointException;
use Wubs\Trakt\Exception\RequestMalformedException;

/**
 * Class ClassGenerator
 * @package Wubs\Trakt\Console\Generators
 */
class EndpointGenerator
{

    use TemplateWriter;
    /**
     * @var Filesystem
     */
    private $filesystem;

    /**
     * @var string
     */
    private $apiNamespace = "Wubs\\Trakt\\Api\\";

    /**
     * @var string
     */
    private $requestsNamespace = "Wubs\\Trakt\\Request\\";

    /**
     * @var
     */
    private $endpoint;

    /**
     * @var Collection|ReflectionClass[]
     */
    private $uses;
    /**
     * @var OutputInterface
     */
    private $out;

    private $className;

    private $file;


    /**
     * @param OutputInterface $outputInterface
     */
    public function __construct(OutputInterface $outputInterface)
    {
        $localAdapter = new Local(__DIR__ . "/../..");
        $this->filesystem = new Filesystem($localAdapter);
        $this->out = $outputInterface;
    }

    /**
     * @param $endpoint
     * @return bool
     */
    public function generateForEndpoint($endpoint)
    {
        $this->template = $this->filesystem->read("/Console/stubs/api.stub");
        $this->endpoint = ucfirst($endpoint);

        $this->file = "/Api/" . $this->endpoint . '.php';

        $this->className = $this->apiNamespace . $this->endpoint;

        $this->uses = new Collection();

        if ($this->filesystem->has($this->file)) {
            if (!$this->userWantsToOverwrite()) {
                $this->out->writeln("Not overwriting " . $this->file);
                return $this;
            };
            $this->filesystem->delete($this->file);
        }

        return $this->createContent()->writeToFile();
    }

    /**
     * @return $this
     */
    private function createContent()
    {
        $this->out->writeln("Generating class for API endpoint: " . lcfirst($this->endpoint));
        $this->setClassName()
            ->generateMethods()
            ->addUseStatements()
            ->deleteUnusedPlaceholders();

        $this->out->writeln("Deleted unused placeholders in template");

        return $this;

    }

    /**
     * @return bool
     */
    private function writeToFile()
    {
        $this->filesystem->write($this->file, $this->template);
        $this->out->writeln(
            "Written endpoint wrapper to :" . $this->filesystem->get($this->file)->getPath
            ()
        );
        $this->out->writeln("Class " . $this->className . " is generated");
        return $this;


    }

    /**
     * @return $this
     */
    private function generateMethods()
    {
        $methods = new Collection();
        foreach ($this->getRequestFiles() as $file) {
            try {
                $method = $this->createMethod($this->endpoint, $file);
            } catch (ClassCanNotBeImplementedAsEndpointException $exception) {
                continue;
            }

            $methods->push($method->generate());
            $this->updateUsages($method);

            $this->out->writeln("Generated method for: '" . $method->getName() . "'");

            if ($method->getName() === "summary") {
                $methods->push($this->createMethod($this->endpoint, $file, 'get')->generate());
                $this->out->writeln("Generated alias method get for summary");
            }
        };
        $this->out->writeln("Adding generated methods to template");
        return $this->writeInTemplate("methods", $methods->implode("\n\n\t"));

    }

    /**
     * @param $className
     * @param $file
     * @param null $methodName
     * @return Method
     * @throws ClassCanNotBeImplementedAsEndpointException
     */
    private function createMethod($className, $file, $methodName = null)
    {
        $reflection = new ReflectionClass($this->requestsNamespace . $className . "\\" . $file['filename']);
        if (!$reflection->isTrait() || !$reflection->isAbstract()) {
            $method = new Method($reflection, $this->filesystem, $methodName);

            return $method;
        }

        throw new ClassCanNotBeImplementedAsEndpointException;
    }

    /**
     * @return $this
     */
    private function addUseStatements()
    {
        $unique = $this->uses->unique();
        $uses = $unique->implode("name", ";\nuse ");
        $this->out->writeln(
            "Added use statements to template"
        );
        return $this->writeInTemplate("use_statements", "use " . $uses . ";");
    }

    /**
     * @param $method
     */
    private function updateUsages(Method $method)
    {
        $this->uses = $this->uses->merge($method->getUses());
        $this->uses->push($method->getRequestClass());
    }

    /**
     * @return $this
     */
    private function setClassName()
    {
        return $this->writeInTemplate("class_name", $this->endpoint);
    }

    public function generateAllEndpoints()
    {
        foreach ($this->filesystem->listContents("/Request") as $content) {
            if ($content['type'] === 'dir'
                && $content['basename'] !== "Exception"
                && $content['basename'] !== "Parameters"
            ) {
                $this->generateForEndpoint($content['basename']);
            }
        }
    }

    /**
     */
    private function userWantsToOverwrite()
    {
        $dialog = new DialogHelper();
        return $dialog->askConfirmation(
            $this->out,
            "Class " . $this->className . " already exist, do you want to overwrite it? [y/n] "
        );
    }

    /**
     * @return Collection
     */
    private function getRequestFiles()
    {
        $contents = new Collection($this->filesystem->listContents("/Request/" . $this->endpoint));
        return $contents->filter(
            function ($content) {
                return $content['type'] === "file";
            }
        );
    }
}