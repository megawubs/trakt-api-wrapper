<?php
/**
 * Created by PhpStorm.
 * User: bwubs
 * Date: 16/03/15
 * Time: 22:42
 */

namespace Wubs\Trakt\Request;


use Wubs\Trakt\Exception\MalformedParameterException;

class UriBuilder
{
    /**
     * @var AbstractRequest
     */
    private $request;

    /**
     * @param AbstractRequest $request
     */
    private function __construct(AbstractRequest $request)
    {
        $this->request = $request;
    }

    public static function format(AbstractRequest $request)
    {
        $builder = new static($request);

        $parts = $builder->getParametersInUri();

        $values = $builder->getValuesFromUriParameters($parts);

        $uri = $builder->formatUri($values);

        return $builder->addQuery($uri);
    }

    private function getParametersInUri()
    {
        $url = $this->request->getUri();

        $parts = explode("/:", $url);

        unset($parts[0]); //remove the base uri

        return $parts;
    }

    private function getValuesFromUriParameters(array $parameters)
    {
        $values = [];
        foreach ($parameters as $parameter) {
            $parameter = $this->stripTrailingPart($parameter);
            $values[$parameter] = $this->getValueFromParameter($parameter);
        }

        return $values;
    }

    /**
     * @param $parameter
     * @return mixed
     * @throws MalformedParameterException
     */
    private function getValueFromParameter($parameter)
    {
        $getter = $this->getValueGetter($parameter);
        if (method_exists($this->request, $getter)) {
            return $this->request->{$getter}();
        }

        throw new MalformedParameterException;
    }

    /**
     * @param $parameter
     * @return mixed|string
     */
    private function toCamelCase($parameter)
    {
        $words = str_replace('_', ' ', $parameter);

        $camelCase = str_replace(' ', '', ucwords($words));

        return $camelCase;
    }

    private function getValueGetter($parameter)
    {
        return "get" . $this->toCamelCase($parameter);
    }

    private function formatUri($values)
    {
        $uri = $this->request->getUri();
        foreach ($values as $parameter => $value) {
            $uri = str_replace(":" . $parameter, $value, $uri);
        }

        return $uri;
    }

    /**
     * @param $parameter
     * @return string
     */
    private function stripTrailingPart($parameter)
    {
        if (strstr($parameter, "/")) {
            $pos = strpos($parameter, "/");
            $parameter = substr($parameter, 0, $pos);
        }

        return $parameter;
    }

    /**
     * @param string $uri
     * @return string
     */
    private function addQuery($uri)
    {
        $extended = $this->request->getExtended();
        $uri .= "?extended=" . $extended;
        dump($uri);
        return $uri;
    }


}