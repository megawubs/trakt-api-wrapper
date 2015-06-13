<?php


use League\Flysystem\Adapter\Local;
use League\Flysystem\Filesystem;
use Wubs\Trakt\Console\Generators\ClassGenerator;

class MethodGeneratorTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var ClassGenerator
     */
    protected $generator;

    /**
     * @var Filesystem
     */
    private $filesystem;

    public static $content;

    public function __construct()
    {
        parent::__construct();
        $this->file = __DIR__ . "/../../../src/Wubs/Trakt/Api/Comments.php";
        $this->generator = new ClassGenerator();

        $this->filesystem = new Filesystem(
            new Local(
                __DIR__ . "/../../../src/Wubs/Trakt/Api/"
            )
        );
    }

    public function testClassesInGivenNameSpaceRootAreAddedAsMethods()
    {
        $this->generator->generate("Episodes");
        $content = $this->filesystem->read("Episodes.php");
        print_r($content);
//        $this->assertContains('public function comments', $content);
//        $this->assertContains('public function ratings', $content);
//        $this->assertContains('public function stats', $content);
//        $this->assertContains('public function summary', $content);
//        $this->assertContains('public function get', $content);
//        $this->assertContains('public function watching', $content);
//        $class = new Wubs\Trakt\Api\Episodes(get_client_id());
//        $this->assertInstanceOf("Wubs\\Trakt\\Api\\Episodes", $class);
        $this->filesystem->delete("Episodes.php");
    }
}
