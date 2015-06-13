<?php


namespace Wubs\Trakt\Console\Generators;


use Illuminate\Support\Collection;
use League\Flysystem\Adapter\Local;
use League\Flysystem\Filesystem;

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


    public function __construct()
    {
        $localAdapter = new Local(__DIR__ . "/../..");
        $this->filesystem = new Filesystem($localAdapter);
        $this->template = $this->filesystem->read("/Console/stubs/api.stub");
    }

    public function generate($className)
    {
        $className = ucfirst($className);

        $this->createContent($className);

        return $this->createFile($className);
    }

    /**
     * @param $className
     * @return bool
     */
    private function createFile($className)
    {
        $fileName = $className . '.php';
        $this->filesystem->write("/Api/" . $fileName, $this->template);
        return $this->ApiNamespace . $className;
    }

    private function createContent($className)
    {
        $this->writeInTemplate("class_name", $className);
        $this->generateMethods($className);
        $this->deleteUnusedPlaceholders();
    }

    private function generateMethods($className)
    {
        $methods = new Collection();
        foreach ($this->filesystem->listContents("/Request/" . $className) as $file) {
            $reflection = new \ReflectionClass($this->requestsNamespace . $className . "\\" . $file['filename']);
            if (!$reflection->isTrait() || !$reflection->isAbstract()) {
                $method = new Method($reflection, $this->filesystem);

                $methods->push($method->generate());
                if($method->getName() === "summary"){

                }
            }
        };
//
        $this->writeInTemplate("methods", $methods->implode("\n\n\t"));

    }
}