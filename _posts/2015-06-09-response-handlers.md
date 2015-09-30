---
layout: page
title: "Response Handlers"
category: documentation
order: 2
date: 2015-06-09 12:12:19
---

A Response Handler is a simple object that can be used to handle the response of an executed request. You 
can make a `ResponseHandler` by creating a class that extends `Wubs\Trakt\Response\Handlers\AbstractResponseHandler`
and implements `Wubs\Trakt\Contracts\ResponseHandler`. The only method you need to implement is the handle 
method. The return value of this method is what's eventually returned from the `AbstractRequest::make()` method.

Lets say we have the class `MyResponseHandler` and let it implement the handle method like this:

```PHP

<?php

// use statements

class MyResponseHandler extends AbstractResponseHandler implements ResponseHandler{

    public function handle(ResponseInterface $response)
    {
        return $response->getStatusCode();
    }
}
    
```

This response handler can be given to a request as the last parameter.

```PHP
<?php

$response = $request->make($clientId, $client, new MyResponseHandler()); //200
```

Because we've given it a response handler that returns the status code, we get an response of 200 (or the 
status code for the request executed might be).