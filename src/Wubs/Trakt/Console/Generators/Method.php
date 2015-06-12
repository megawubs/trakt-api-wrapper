<?php


namespace Wubs\Trakt\Console\Generators;

use Illuminate\Support\Collection;
use League\Flysystem\Filesystem;

class Method
{
    use TemplateWriter;
    /**
     * @var Collection
     */
    private $uses = [];

    /**
     * @var \ReflectionClass
     */
    private $reflection;

    /**
     * @var Collection|\ReflectionParameter[]
     */
    private $classParameters;


    /**
     * @param \ReflectionClass $reflection
     * @param Filesystem $filesystem
     */
    public function __construct(\ReflectionClass $reflection, Filesystem $filesystem)
    {

        $this->reflection = $reflection;
        $this->template = $filesystem->read("/Console/stubs/method.stub");

        $this->classParameters = $this->getClassParameters();
        $this->uses = $this->getUsages();
        $this->parameterNames = $this->getParameters();

//            $this->setAuthToken();
//        $this->setRequestClass();
//            $this->setRequestParameters();
//            $this->setExtraFields();
    }

    public function generate()
    {
        $this->writeMethodParameters();
        $this->writeInTemplate("method_name", lcfirst($this->reflection->getShortName()));
        return $this->template;
    }

    /**
     *
     */
    private function getUsages()
    {
        $uses = new Collection();
        foreach ($this->classParameters as $parameter) {
            if ($class = $parameter->getClass()) {
                $uses->push($class);
            }
        }
        return $uses;
    }

    public function getParameters()
    {
        $parameterNames = new Collection();
        foreach ($this->classParameters as $parameter) {
            $parameterNames->push("$" . $parameter->getName());
        }

        return $parameterNames;
    }


    /**
     * @return Collection|\ReflectionParameter[]
     */
    private function getClassParameters()
    {
        $reflection = $this->reflection;
        $parameters = new Collection();
        $constructor = $reflection->getConstructor();
        if ($constructor !== null) {
            foreach ($constructor->getParameters() as $parameter) {
                $parameters->push($parameter);
            }
        }

        return $parameters;
    }

    private function writeMethodParameters()
    {
        $parameters = $this->parameterNames->implode(", ");
        $this->writeInTemplate("method_parameters", $parameters);
    }
}