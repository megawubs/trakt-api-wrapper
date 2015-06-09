<?php


use Wubs\Trakt\Api;
use Wubs\Trakt\Trakt;

class MoviesRequestTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var Api
     */
    protected $trakt;

    protected $id = "tron-legacy-2010";

    protected function setUp()
    {
        parent::setUp();
        $this->trakt = Trakt::api(getenv("CLIENT_ID"));
    }

    public function testAliases()
    {
        $aliases = $this->trakt->movies->aliases($this->id);

        $this->assertInternalType("array", $aliases);
    }

    public function testComments()
    {
        $comments = $this->trakt->movies->comments($this->id, get_token());

        $this->assertInternalType("array", $comments);
    }

    public function testPeople()
    {
        $people = $this->trakt->movies->people($this->id);

        $this->assertInternalType("object", $people);
    }

    public function testPopular()
    {
        $popular = $this->trakt->movies->popular();

        $this->assertInternalType("array", $popular);
    }

    public function testRatings()
    {
        $ratings = $this->trakt->movies->ratings($this->id);

        $this->assertInternalType("object", $ratings);
    }

    public function testReleases()
    {
        $ratings = $this->trakt->movies->releases($this->id, "NL");

        $this->assertInternalType("array", $ratings);
    }

    public function testRelated()
    {
        $res = $this->trakt->movies->related($this->id);

        $this->assertInternalType("array", $res);
    }

    public function testStats()
    {
        $stats = $this->trakt->movies->stats($this->id);

        $this->assertInternalType("object", $stats);
    }

    public function testSummary()
    {
        $res = $this->trakt->movies->summary($this->id);

        $this->assertInternalType("object", $res);
    }

    public function testTranslations()
    {
        $res = $this->trakt->movies->translations($this->id, "NL");

        $this->assertInternalType("array", $res);
    }

    public function testTrending()
    {
        $res = $this->trakt->movies->trending(get_token());

        $this->assertInternalType("array", $res);
    }

    public function testWatching()
    {
        $res = $this->trakt->movies->watching($this->id);

        $this->assertInternalType("array", $res);
    }
}
