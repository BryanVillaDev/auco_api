<?php

namespace ApiAuco;
use ApiAuco\RequestInterface;
use Exception;

class HttpRequest implements RequestInterface
{
    private $ch;
    private array $headers = [];
    private string $body;

    public function __construct(string $method, string $url) {
        $this->ch = curl_init($url);
        curl_setopt($this->ch, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, 1);
    }

    public function headers(string $header, string $value): void {
        $this->headers[] = $header . ': ' . $value;
    }

    public function body(string $body): void {
        $this->body = $body;
    }

    public function send(): array {
        if (!empty($this->headers)) {
            curl_setopt($this->ch, CURLOPT_HTTPHEADER, $this->headers);
        }
        if (!empty($this->body)) {
            curl_setopt($this->ch, CURLOPT_POSTFIELDS, $this->body);
        }
        $response = curl_exec($this->ch);
        $error = curl_error($this->ch);
        $httpCode = curl_getinfo($this->ch, CURLINFO_HTTP_CODE);
        curl_close($this->ch);
        return [
            'statusCode' => $httpCode,
            'response' => json_decode($response, true)
        ];
    }

}