<?php

use GuzzleHttp\ClientInterface;
use League\Flysystem\Adapter\Local;
use League\Flysystem\Filesystem;
use Symfony\Component\Console\Helper\HelperInterface;
use Symfony\Component\Console\Helper\QuestionHelper;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\ConsoleOutput;
use Symfony\Component\Console\Output\OutputInterface;
use Wubs\Trakt\Console\Generators\EndpointGenerator;

class MethodGeneratorTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var EndpointGenerator
     */
    protected $generator;

    /**
     * @var Filesystem
     */
    private $filesystem;

    public static $content;

    private $file;

    protected function setUp()
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

    public function testClassesInGivenNameSpaceRootAreAddedAsMethods()
    {
        $out = Mockery::mock(OutputInterface::class);
        $out->shouldReceive("write");
        $out->shouldReceive("writeln")->times(12);
        $inMock = Mockery::mock(InputInterface::class);
        $dialog = Mockery::mock(QuestionHelper::class);
        $dialog->shouldReceive("ask")->andReturn(true);
        $generator = new EndpointGenerator($inMock, $out, $dialog);
        $generator->generateForEndpoint("Episodes");
        $content = $this->filesystem->read("Episodes.php");

        $this->assertContains('public function comments', $content);
        $this->assertContains('public function ratings', $content);
        $this->assertContains('public function stats', $content);
        $this->assertContains('public function summary', $content);
        $this->assertContains('public function get', $content);
        $this->assertContains('public function watching', $content);
    }
}
