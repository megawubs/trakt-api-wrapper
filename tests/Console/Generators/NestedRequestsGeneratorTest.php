<?php


use GuzzleHttp\ClientInterface;
use League\Flysystem\Adapter\Local;
use League\Flysystem\Filesystem;
use Symfony\Component\Console\Helper\QuestionHelper;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Wubs\Trakt\Console\Generators\EndpointGenerator;

class NestedRequestsGeneratorTest extends PHPUnit_Framework_TestCase
{

    private $file;

    /**
     * @var Filesystem
     */
    private $filesystem;

    private static $content;

    protected function tearDown()
    {
        Mockery::close();
//        $this->filesystem->deleteDir("Users");
    }

    protected function setUp()
    {
        parent::__construct();
        $this->file = __DIR__ . "/../../../src/Wubs/Trakt/Api/Users.php";


        $this->filesystem = new Filesystem(
            new Local(
                __DIR__ . "/../../../src/Wubs/Trakt/Api/"
            )
        );


    }

    public function testAddNestedFolderAsPublicPropertyToParentClass()
    {
        $generator = $this->getGenerator();

        $generator->generateForEndpoint("Users");

        $content = $generator->getGeneratedTemplate();

        $this->assertContains('public $followers;', $content);
    }

    /**
     * @depends testAddNestedFolderAsPublicPropertyToParentClass
     */
    public function testCreatesFolderForPublicPropertiesClass()
    {
        $check = $this->filesystem->has('Users');

        $this->assertTrue($check);
    }

    /**
     * @depends testAddNestedFolderAsPublicPropertyToParentClass
     */
    public function testCreatesFileForSubFolder()
    {
        $check = $this->filesystem->has('Users/Followers.php');

        $this->assertTrue($check);
    }

    public function testAddsNamespaceToSubClass()
    {
        $generator = $this->getGenerator();

        $generator->generateForEndpoint("Users/Followers");

        static::$content = $generator->getGeneratedTemplate();

        $check = $this->filesystem->has('Users/Followers.php');

        $this->assertTrue($check);

        $this->assertContains("Wubs\\Trakt\\Api\\Users", static::$content);
    }

    /**
     * @depends testAddsNamespaceToSubClass
     */
    public function testAddsEndpointUseStatementToSubClass()
    {
        $this->assertContains("Wubs\\Trakt\\Api\\Users", static::$content);
    }

    /**
     * @depends testAddsNamespaceToSubClass
     */
    public function testAddsClassName()
    {
        $this->assertContains("class Followers extends Endpoint", static::$content);
    }

    /**
     * @return EndpointGenerator
     */
    private function getGenerator()
    {
        $outMock = Mockery::mock(OutputInterface::class);
        $outMock->shouldReceive("writeln");
        $outMock->shouldReceive("write")->andReturn(true);

        $inMock = Mockery::mock(InputInterface::class);

        $dialog = Mockery::mock(QuestionHelper::class);
        $dialog->shouldReceive("ask")->andReturn(true);
        $generator = new EndpointGenerator($inMock, $outMock, $dialog);
        return $generator;
    }
}
