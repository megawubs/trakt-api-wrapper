<?php


namespace Wubs\Trakt\Console\Generators;


use League\Flysystem\FilesystemInterface;

class Property
{
    use TemplateWriter;

    /**
     * @var FilesystemInterface
     */
    private $filesystem;
    private $fullClassName;

    /**
     * @param $fullClassName
     * @param FilesystemInterface $filesystem
     */
    public function __construct($fullClassName, FilesystemInterface $filesystem)
    {
        $this->template = $filesystem->read("/Console/stubs/property.stub");
        $this->filesystem = $filesystem;
        $this->fullClassName = collect(explode("\\", $fullClassName));
    }

    public function generate()
    {
        return $this->writeInTemplate("property_type", $this->fullClassName->implode("\\"))
            ->writeInTemplate("property_name", lcfirst($this->fullClassName->last()))->template;
    }
}