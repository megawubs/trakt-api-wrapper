<?php


use League\Flysystem\Adapter\Local;
use League\Flysystem\Filesystem;
use Symfony\Component\Console\Output\OutputInterface;
use Wubs\Trakt\Console\Generators\EndpointGenerator;

class ApiGeneratorTest extends PHPUnit_Framework_TestCase
{
    protected $file;

    /**
     * @var EndpointGenerator
     */
    protected $generator;

    /**
     * @var Filesystem
     */
    private $filesystem;

    private $namespace = "Wubs\\Trakt\\Api\\Comments";

    public static $content;

    public function __construct()
    {
        parent::__construct();
        $this->file = __DIR__ . "/../../../src/Wubs/Trakt/Api/Comments.php";
        $mock = $this->getMock(OutputInterface::class);
        $this->generator = new EndpointGenerator($mock);

        $this->filesystem = new Filesystem(
            new Local(
                __DIR__ . "/../../../src/Wubs/Trakt/Api/"
            )
        );
    }

    public static function tearDownAfterClass()
    {
        unlink(__DIR__ . "/../../../src/Wubs/Trakt/Api/Comments.php");
        print_r(self::$content);
        self::$content = "";
    }


    public function testGeneratesClassFile()
    {
        $this->generator->generateForEndpoint("Comments");

        $this->assertTrue($this->filesystem->has("Comments.php"));

        self::$content = $this->filesystem->read("Comments.php");

    }

    /**
     * @depends testGeneratesClassFile
     */
    public function testClassGetsClassName()
    {
        $this->assertContains("class Comments", self::$content);
    }

    /**
     * @depends testGeneratesClassFile
     */
    public function testClassHasMethodWithGivenName()
    {
        $this->assertContains("public function delete", self::$content);
    }

    /**
     * @depends testGeneratesClassFile
     */
    public function testMethodHasParameters()
    {
        $this->assertContains('public function delete($id, $token)', self::$content);
    }

    /**
     * @depends testGeneratesClassFile
     */
    public function testPlaceholdersAreDeleted()
    {
        $this->assertNotContains("{{", self::$content);
    }

    /**
     * @depends testGeneratesClassFile
     */
    public function testRequestClassIsPassed()
    {
        $this->assertContains("new DeleteComment", self::$content);
    }

    /**
     * @depends testGeneratesClassFile
     */
    public function testRequestClassHasParameters()
    {
        $this->assertContains('$id = ClientId::set($id)', self::$content);
        $this->assertContains('new DeleteComment($id)', self::$content);
    }

    public function testClassIsFormattedWithoutToken()
    {
        $this->generator->generateForEndpoint("Episodes");
        $content = $this->filesystem->read("Episodes.php");
        $this->assertNotContains('$token', $content);
        $class = new Wubs\Trakt\Api\Episodes(get_client_id());
        $this->assertInstanceOf("Wubs\\Trakt\\Api\\Episodes", $class);
        $this->filesystem->delete("Episodes.php");
    }

    /**
     * @depends testGeneratesClassFile
     */
    public function testClassCanBeInitiated()
    {
        $class = new $this->namespace(get_client_id());

        $this->assertInstanceOf($this->namespace, $class);
    }
}
