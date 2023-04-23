<?php

namespace ApiAuco;
use ApiAuco\HttpRequest;
class HttpClientApi
{
    private $baseUri;

    public function __construct(string $baseUri){
        $this->baseUri = $baseUri;
    }

    public function get(string $urlPath): RequestInterface{
        return new HttpRequest('GET', $this->baseUri . $urlPath);
    }
    public function post(string $urlPath): RequestInterface{
        return new HttpRequest('POST', $this->baseUri . $urlPath);
    }
    public function put(string $urlPath): RequestInterface{
        return new HttpRequest('PUT', $this->baseUri . $urlPath);
    }
    public function delete(string $urlPath): RequestInterface{
        return new HttpRequest('DELETE', $this->baseUri . $urlPath);
    }

}