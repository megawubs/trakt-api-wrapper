<?php


namespace Wubs\Trakt\Console\Generators;


use Illuminate\Support\Collection;
use League\Flysystem\Adapter\Local;
use League\Flysystem\Filesystem;
use Wubs\Trakt\Exception\ClassCanNotBeImplementedAsEndpointException;

class ClassGenerator
{

    use TemplateWriter;
    /**
     * @var Filesystem
     */
    private $filesystem;

    /**
     * @var string
     */
    private $ApiNamespace = "Wubs\\Trakt\\Api\\";

    /**
     * @var string
     */
    private $requestsNamespace = "Wubs\\Trakt\\Request\\";

    private $className;


    public function __construct()
    {
        $localAdapter = new Local(__DIR__ . "/../..");
        $this->filesystem = new Filesystem($localAdapter);
        $this->template = $this->filesystem->read("/Console/stubs/api.stub");
    }

    public function generate($className)
    {
        $this->className = ucfirst($className);

        return $this->createContent()->createFile();
    }

    /**
     * @return bool
     */
    private function createFile()
    {
        $fileName = $this->className . '.php';
        $this->filesystem->write("/Api/" . $fileName, $this->template);
        return $this->ApiNamespace . $this->className;
    }

    private function createContent()
    {
        return $this->writeInTemplate("class_name", $this->className)
            ->generateMethods()
            ->deleteUnusedPlaceholders();
    }

    private function generateMethods()
    {
        $methods = new Collection();
        foreach ($this->filesystem->listContents("/Request/" . $this->className) as $file) {
            try {
                $method = $this->generateMethod($this->className, $file);
                $methods->push($method);
            } catch (ClassCanNotBeImplementedAsEndpointException $exception) {
                continue;
            }

        };

        return $this->writeInTemplate("methods", $methods->implode("\n\n\t"));

    }

    /**
     * @param $className
     * @param $file
     * @return bool|false|string
     * @throws ClassCanNotBeImplementedAsEndpointException
     */
    private function generateMethod($className, $file)
    {
        $reflection = new \ReflectionClass($this->requestsNamespace . $className . "\\" . $file['filename']);
        if (!$reflection->isTrait() || !$reflection->isAbstract()) {
            $method = new Method($reflection, $this->filesystem);

            return $method->generate();
        }

        throw new ClassCanNotBeImplementedAsEndpointException;
    }
}