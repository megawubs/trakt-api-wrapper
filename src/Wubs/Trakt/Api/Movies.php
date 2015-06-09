<?php


namespace Wubs\Trakt\Api;


use League\OAuth2\Client\Token\AccessToken;
use Wubs\Trakt\ClientId;
use Wubs\Trakt\Request\AbstractRequest;
use Wubs\Trakt\Request\Movies\Ratings;
use Wubs\Trakt\Request\Movies\Aliases;
use Wubs\Trakt\Request\Movies\Comments;
use Wubs\Trakt\Request\Movies\People;
use Wubs\Trakt\Request\Movies\Popular;
use Wubs\Trakt\Request\Movies\Related;
use Wubs\Trakt\Request\Movies\Releases;
use Wubs\Trakt\Request\Movies\Stats;
use Wubs\Trakt\Request\Movies\Summary;
use Wubs\Trakt\Request\Movies\Translations;
use Wubs\Trakt\Request\Movies\Trending;
use Wubs\Trakt\Request\Movies\Updated;
use Wubs\Trakt\Request\Movies\Watching;
use Wubs\Trakt\Request\Parameters\Country;
use Wubs\Trakt\Request\Parameters\Language;
use Wubs\Trakt\Request\Parameters\MediaId;
use Wubs\Trakt\Token\TraktAccessToken;

class Movies
{
    /**
     * @var ClientId
     */
    private $clientId;

    /**
     * @param ClientId $clientId
     */
    public function __construct(ClientId $clientId)
    {
        $this->clientId = $clientId;
    }

    public function aliases($id)
    {
        $mediaId = MediaId::set($id);
        return $this->request(new Aliases($mediaId));
    }

    public function comments($id, AccessToken $token)
    {
        $id = MediaId::set($id);
        return $this->request(new Comments($id), $token);
    }

    public function people($id)
    {
        $id = MediaId::set($id);
        return $this->request(new People($id));
    }

    public function popular()
    {
        return $this->request(new Popular());
    }

    public function ratings($id)
    {
        $id = MediaId::set($id);
        return $this->request(new Ratings($id));
    }

    public function Related($id)
    {
        $id = MediaId::set($id);
        return $this->request(new Related($id));
    }

    public function releases($id, $country)
    {
        $id = MediaId::set($id);
        $country = Country::set($country);
        return $this->request(new Releases($id, $country));
    }

    public function stats($id)
    {
        $id = MediaId::set($id);
        return $this->request(new Stats($id));
    }

    public function summary($id)
    {
        $id = MediaId::set($id);
        return $this->request(new Summary($id));
    }

    public function get($id)
    {
        return $this->summary($id);
    }

    public function translations($id, $language)
    {
        $id = MediaId::set($id);
        $language = Language::set($language);
        return $this->request(new Translations($id, $language));
    }

    public function trending(AccessToken $token)
    {
        return $this->request(new Trending(), $token);
    }

    public function watching($id)
    {
        $id = MediaId::set($id);
        return $this->request(new Watching($id));
    }

    private function request(AbstractRequest $request, AccessToken $token = null)
    {
        return $request->make($this->clientId, $token);
    }
}