<?php
use Wubs\Trakt\Request\Calendars\Shows;
use Wubs\Trakt\Request\Movies\Comments;
use Wubs\Trakt\Request\Parameters\Days;
use Wubs\Trakt\Request\Parameters\MediaId;
use Wubs\Trakt\Request\Parameters\StartDate;
use Wubs\Trakt\Request\UriBuilder;

/**
 * Created by PhpStorm.
 * User: bwubs
 * Date: 16/03/15
 * Time: 22:43
 */
class UriBuilderTest extends PHPUnit_Framework_TestCase
{
    public function testReturnsFormattedUriFromRequestObject()
    {
        $request = new Shows(StartDate::standard(), Days::standard());

        $formattedUri = UriBuilder::format($request);

        $this->assertContains($formattedUri, $formattedUri);
        $this->assertContains((string)StartDate::standard(), $formattedUri);

    }

    public function testReturnsFormattedUriFromRequestObjectWithParameterNotAsLastParameter()
    {
        $request = new Comments(MediaId::set("guardians-of-the-galaxy-2014"));

        $formattedUri = UriBuilder::format($request);

        $this->assertContains("guardians-of-the-galaxy-2014", $formattedUri);
        $this->assertContains("/comments", $formattedUri);
    }
}
