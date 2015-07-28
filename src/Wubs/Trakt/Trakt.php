<?php namespace Wubs\Trakt;


use Guzzle\Http\Exception\ClientErrorResponseException;
use Guzzle\Http\Url;
use Guzzle\Service\Client;
use GuzzleHttp\ClientInterface;
use League\OAuth2\Client\Provider\ProviderInterface;
use League\OAuth2\Client\Token\AccessToken;
use Wubs\Trakt\Api\Calendars;
use Wubs\Trakt\Api\CheckIn;
use Wubs\Trakt\Api\Comments;
use Wubs\Trakt\Api\Episodes;
use Wubs\Trakt\Api\Genres;
use Wubs\Trakt\Api\Movies;
use Wubs\Trakt\Api\People;
use Wubs\Trakt\Api\Recommendations;
use Wubs\Trakt\Api\Scrobble;
use Wubs\Trakt\Api\Search;
use Wubs\Trakt\Api\Seasons;
use Wubs\Trakt\Api\Shows;
use Wubs\Trakt\Api\Sync;
use Wubs\Trakt\Api\Users;
use Wubs\Trakt\Auth\Auth;
use Wubs\Trakt\Contracts\RequestInterface;
use Wubs\Trakt\Exception\InvalidOauthRequestException;
use Wubs\Trakt\Auth\TraktProvider;
use Wubs\Trakt\Request\AbstractRequest;

class Trakt
{
    /**
     * @var Calendars
     */
    public $calendars;

    /**
     * @var CheckIn
     */
    public $checkIn;

    /**
     * @var Comments
     */
    public $comments;

    /**
     * @var Episodes
     */
    public $episodes;

    /**
     * @var Genres
     */
    public $genres;
    /**
     * @var Movies
     */
    public $movies;

    /**
     * @var People
     */
    public $people;

    /**
     * @var Recommendations
     */
    public $recommendations;

    /**
     * @var Scrobble
     */
    public $scrobble;

    /**
     * @var Search
     */
    public $search;

    /**
     * @var Seasons
     */
    public $seasons;
    /**
     * @var Shows
     */
    public $shows;

    /**
     * @var Users
     */
    public $users;

    /**
     * @var Sync
     */
    public $sync;
    /**
     * @var ClientInterface
     */
    private $client;

    /**
     * @var TraktProvider
     */
    public $auth;

    /**
     * @param Auth $auth
     * @param ClientInterface $client
     */
    public function __construct(Auth $auth, ClientInterface $client = null)
    {
        $this->client = $client;
        if ($client == null) {
            $this->client = TraktHttpClient::make();
        }
        $this->auth = $auth;
        $this->createWrappers();
    }


    /**
     * Creates the wrappers for all public properties and sets them.
     */
    private function createWrappers()
    {
        $id = $this->auth->provider->getClientId();
        $this->calendars = new Calendars($id, $this->client);
        $this->checkIn = new CheckIn($id, $this->client);
        $this->comments = new Comments($id, $this->client);
        $this->episodes = new Episodes($id, $this->client);
        $this->genres = new Genres($id, $this->client);
        $this->movies = new Movies($id, $this->client);
        $this->people = new People($id, $this->client);
        $this->recommendations = new Recommendations($id, $this->client);
        $this->scrobble = new Scrobble($id, $this->client);
        $this->search = new Search($id, $this->client);
        $this->seasons = new Seasons($id, $this->client);
        $this->shows = new Shows($id, $this->client);
        $this->sync = new Sync($id, $this->client);
        $this->users = new Users($id, $this->client);
    }
}