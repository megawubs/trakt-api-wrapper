<?php


use GuzzleHttp\ClientInterface;
use Illuminate\Support\Collection;
use League\Flysystem\Adapter\Local;
use League\Flysystem\File;
use League\Flysystem\Filesystem;
use League\Flysystem\FilesystemInterface;
use Symfony\Component\Console\Helper\DialogHelper;
use Symfony\Component\Console\Helper\QuestionHelper;
use Symfony\Component\Console\Output\OutputInterface;
use Wubs\Trakt\Console\Generators\EndpointGenerator;

class ApiGeneratorTest extends PHPUnit_Framework_TestCase
{
    protected $file;

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
        $this->filesystem = new Filesystem(
            new Local(
                __DIR__ . "/../../../src/Wubs/Trakt/Api/"
            )
        );
    }

    protected function tearDown()
    {
        Mockery::close();
    }

    public static function tearDownAfterClass()
    {
        self::$content = "";
    }


    public function testGeneratesClassFile()
    {
        $outMock = Mockery::mock(OutputInterface::class);
        $outMock->shouldReceive("writeln");
        $outMock->shouldReceive("write")->andReturn(true);

        $dialog = Mockery::mock(QuestionHelper::class);
        $dialog->shouldReceive("askConfirmation")->andReturn(true);
        $generator = new EndpointGenerator($outMock, $dialog);

        $generator->generateForEndpoint("Comments");

        $this->assertTrue($this->filesystem->has("Comments.php"));

        self::$content = $generator->getGeneratedTemplate();

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
        $this->assertContains("public function deleteComment", self::$content);
    }

    /**
     * @depends testGeneratesClassFile
     */
    public function testMethodHasParameters()
    {
        $this->assertContains('public function deleteComment(AccessToken $token, $commentId)', self::$content);
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
        $this->assertContains('new DeleteCommentRequest($token, $commentId)', self::$content);
    }

    public function testClassIsFormattedWithoutToken()
    {
        $outMock = Mockery::mock(OutputInterface::class);
        $outMock->shouldReceive("writeln");
        $outMock->shouldReceive("write");

        $client = Mockery::mock(stdClass::class . ", " . ClientInterface::class);


        $dialog = Mockery::mock(QuestionHelper::class);
        $dialog->shouldReceive("askConfirmation")->andReturn(true);
        $generator = new EndpointGenerator($outMock, $dialog);

        $generator->generateForEndpoint("Episodes");
        $content = $generator->getGeneratedTemplate();
        $this->assertNotContains('$token', $content);
        $class = new Wubs\Trakt\Api\Episodes(get_client_id(), $client);
        $this->assertInstanceOf("Wubs\\Trakt\\Api\\Episodes", $class);
    }

    /**
     * @depends testGeneratesClassFile
     */
    public function testClassCanBeInitiated()
    {
        $client = Mockery::mock(stdClass::class . ", " . ClientInterface::class);
        $class = new $this->namespace(get_client_id(), $client);

        $this->assertInstanceOf($this->namespace, $class);
    }
}
