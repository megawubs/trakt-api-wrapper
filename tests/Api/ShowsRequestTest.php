<?php


use Wubs\Trakt\Api;
use Wubs\Trakt\Trakt;

class ShowsRequestTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var Api
     */
    protected $trakt;

    protected $id = "orphan-black";

    protected function setUp()
    {
        parent::setUp();
        $this->trakt = Trakt::api(getenv("CLIENT_ID"));
    }

    public function testAliases()
    {
        $aliases = $this->trakt->shows->aliases($this->id);

        $this->assertInternalType("array", $aliases);
    }

    public function testComments()
    {
        $comments = $this->trakt->shows->comments($this->id, get_token());

        $this->assertInternalType("array", $comments);
    }

    public function testPeople()
    {
        $people = $this->trakt->shows->people($this->id);

        $this->assertInternalType("object", $people);
    }

    public function testPopular()
    {
        $popular = $this->trakt->shows->popular();

        $this->assertInternalType("array", $popular);
    }

    public function testRatings()
    {
        $ratings = $this->trakt->shows->ratings($this->id);

        $this->assertInternalType("object", $ratings);
    }

    public function testRelated()
    {
        $res = $this->trakt->shows->related($this->id);

        $this->assertInternalType("array", $res);
    }

    public function testStats()
    {
        $stats = $this->trakt->shows->stats($this->id);

        $this->assertInternalType("object", $stats);
    }

    public function testSummary()
    {
        $res = $this->trakt->shows->summary($this->id);

        $this->assertInternalType("object", $res);
    }

    public function testTranslations()
    {
        $res = $this->trakt->shows->translations($this->id, "NL");

        $this->assertInternalType("array", $res);
    }

    public function testTrending()
    {
        $res = $this->trakt->shows->trending(get_token());

        $this->assertInternalType("array", $res);
    }

    public function testUpdates()
    {
        $res = $this->trakt->shows->updates();

        $this->assertInternalType("array", $res);
    }

    public function testWatching()
    {
        $res = $this->trakt->shows->watching($this->id);

        $this->assertInternalType("array", $res);
    }
}
