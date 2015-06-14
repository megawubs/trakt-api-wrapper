<?php


namespace Wubs\Trakt\Console\Generators;

use Illuminate\Support\Collection;
use League\Flysystem\Filesystem;
use ReflectionClass;

class Method
{
    use TemplateWriter;
    /**
     * @var Collection
     */
    private $uses = [];

    /**
     * @var ReflectionClass
     */
    private $reflection;

    /**
     * @var Collection|\ReflectionParameter[]
     */
    private $classParameters;
    /**
     * @var null
     */
    private $name;


    /**
     * @param ReflectionClass $reflection
     * @param Filesystem $filesystem
     * @param null $name
     */
    public function __construct(ReflectionClass $reflection, Filesystem $filesystem, $name = null)
    {

        $this->reflection = $reflection;
        $this->template = $filesystem->read("/Console/stubs/method.stub");
        $this->name = $name;

        $this->classParameters = $this->getClassParameters();
        $this->uses = $this->getUsages();
        $this->methodParameterNames = $this->getMethodParameters();
        $this->requestParameters = $this->getRequestParameters();
    }

    public function generate()
    {
        $this->writeMethodName()
            ->writeMethodParameters()
            ->writeRequestClass()
            ->writeRequestParameters();
//            ->writeRequestParameterObjects();

        return $this->template;
    }


    /**
     * @return Collection|ReflectionClass[]
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

    /**
     * @return Collection|string[]
     */
    public function getMethodParameters()
    {
        $methodParameters = new Collection();
        foreach ($this->classParameters as $parameter) {
            $className = null;
            if ($parameterClass = $parameter->getClass()) {
                $className = $parameterClass->getShortName();
            }
            $parameterString = ($className !== null) ? $className . " $" . $parameter->getName() : " $"
                . $parameter->getName();
            $methodParameters->push($parameterString);
        }

        return $methodParameters;
    }

    private function getRequestParameters()
    {
        $requestClassParameters = new Collection();
        foreach ($this->classParameters as $parameter) {
            $requestClassParameters->push("$" . $parameter->getName());
        }

        return $requestClassParameters;
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

    /**
     * @return $this
     */
    private function writeMethodParameters()
    {
        $parameters = $this->methodParameterNames->implode(", ");
        return $this->writeInTemplate("method_parameters", $parameters);
    }

    /**
     * @return $this
     */
    private function writeMethodName()
    {
        return $this->writeInTemplate("method_name", $this->getName());
    }

    /**
     * @return $this
     */
    private function writeRequestClass()
    {
        return $this->writeInTemplate("request_class", $this->reflection->getShortName() . "Request");
    }

    /**
     * @return $this
     */
    private function writeRequestParameters()
    {
        $parameters = $this->requestParameters->implode(", ");
        return $this->writeInTemplate("request_parameters", $parameters);
    }

    /**
     * @return Collection|ReflectionClass[]
     */
    public function getUses()
    {
        return $this->uses;
    }

    /**
     * @return null
     */
    public function getName()
    {
        return ($this->name === null) ? lcfirst($this->reflection->getShortName()) : $this->name;
    }

    public function getRequestClass()
    {
        return $this->reflection;
    }
}