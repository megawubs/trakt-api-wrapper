<?php


namespace Wubs\Trakt\Console\Generators;


use League\Flysystem\Adapter\Local;
use League\Flysystem\Filesystem;

class Api
{

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
    private $requestsNamespace = "Wubs\\Trakt\\Requests\\";

    /**
     * @var string
     */
    private $template;

    /**
     * @var string
     */
    private $methodTemplate;


    public function __construct()
    {
        $localAdapter = new Local(__DIR__ . "/../..");
        $this->filesystem = new Filesystem($localAdapter);
        $this->template = $this->filesystem->read("/Console/stubs/api.stub");
        $this->methodTemplate = $this->filesystem->read("/Console/stubs/method.stub");

    }

    public function generate($className)
    {
        $className = ucfirst($className);

        $content = $this->createContent($className);

        return $this->createFile($className, $content);
    }

    /**
     * @param $className
     * @param $content
     * @return bool
     */
    private function createFile($className, $content)
    {
        $fileName = $className . '.php';
        $this->filesystem->write("/Api/" . $fileName, $content);
        return $this->ApiNamespace . $className;
    }

    private function createContent($className)
    {
        $this->template = $this->replaceInTemplate($this->template, "class_name", $className);
        $this->generateMethods($className);
        $this->deleteUnusedPlaceholders();
        return $this->template;
    }

    private function generateMethods($className)
    {
//        $methods = [];
        $method = $this->replaceInTemplate($this->methodTemplate, "method_name", "delete");
        $parameters = '$id';
        if ($className === "Comments") {
            $parameters = '$id, $token';
            $method = $this->replaceInTemplate($method, "auth_token", ', $token');
        }

        $method = $this->replaceInTemplate($method, "method_parameters", $parameters);


        $method = $this->replaceInTemplate($method, "request_class", "DeleteComment");

        $method = $this->replaceInTemplate($method, "extra_fields", '$id = ClientId::set($id);');

        $method = $this->replaceInTemplate($method, "request_parameters", '$id');
        $this->template = $this->replaceInTemplate($this->template, "methods", $method);

    }

    /**
     * @param $template
     * @param $key
     * @param $value
     * @return mixed
     */
    private function replaceInTemplate($template, $key, $value)
    {
        return str_replace("{{" . $key . "}}", $value, $template);
    }

    private function deleteUnusedPlaceholders()
    {
        $this->template = preg_replace("/{.*}/", "", $this->template);
    }
}