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
     * @var null
     */
    private $name;


    /**
     * @param \ReflectionClass $reflection
     * @param Filesystem $filesystem
     * @param null $name
     */
    public function __construct(\ReflectionClass $reflection, Filesystem $filesystem, $name = null)
    {

        $this->reflection = $reflection;
        $this->template = $filesystem->read("/Console/stubs/method.stub");
        $this->name = $name;

        $this->classParameters = $this->getClassParameters();
        $this->uses = $this->getUsages();
        $this->parameterNames = $this->getParameters();
    }

    public function generate()
    {
        $this->writeMethodName()
            ->writeMethodParameters()
            ->writeRequestClass()
            ->writeRequestParameters()
            ->writeRequestParameterObjects();

        return $this->template;
    }


    /**
     * @return Collection|\ReflectionClass[]
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

    /**
     * @return $this
     */
    private function writeMethodParameters()
    {
        $parameters = $this->parameterNames->implode(", ");
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
        return $this->writeInTemplate("request_class", $this->reflection->getShortName());
    }

    /**
     * @return $this
     */
    private function writeRequestParameters()
    {
        $parameters = $this->parameterNames->implode(", ");
        return $this->writeInTemplate("request_parameters", $parameters);
    }

    /**
     * @internal $usage \ReflectionClass
     */
    private function writeRequestParameterObjects()
    {
        $parameterObjects = new Collection();

        for ($i = 0; $i < $this->uses->count(); $i++) {
            echo "hello?\n";
            /** @var \ReflectionClass $usage */
            $className = $this->uses->get($i)->getShortName();
            $parameterName = $this->parameterNames->get($i);
            $parameterObjects->push($className . '::set(' . $parameterName . ');');
        }
        $parameters = $parameterObjects->implode("\n\t");
        return $this->writeInTemplate("extra_fields", $parameters);
    }

    /**
     * @return Collection|\ReflectionClass[]
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
}