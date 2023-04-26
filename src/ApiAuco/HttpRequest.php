<?php

namespace ApiAuco;
use ApiAuco\RequestInterface;
use Exception;

class HttpRequest implements RequestInterface
{
    private array $headers = [];
    private $body;
    private $url;
    private $method;

    public function __construct(string $method, string $url) {
        $this->url = $url;
        $this->method = $method;
    }

    public function headers(string $header, string $value): void {
        $this->headers[] = $header . ': ' . $value;
    }

    public function body($body): void {
        $this->body = $body;
    }

    public function send(): array {
        $ch = curl_init($this->url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $this->method);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        if (!empty($this->headers)) {
            curl_setopt($ch, CURLOPT_HTTPHEADER, $this->headers);
        }
        if (!empty($this->body)) {
            curl_setopt($ch, CURLOPT_POSTFIELDS, $this->body);
        }
        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        return [
            'statusCode' => $httpCode,
            'response' => json_decode($response, true)
        ];
    }
    public function sendBinaryFile(): array{
        $ch = curl_init();
        curl_setopt_array($ch, [
            CURLOPT_URL => $this->url,
            CURLOPT_CUSTOMREQUEST => $this->method,
            CURLOPT_HEADER => true,
            CURLOPT_POST => 1,
            CURLOPT_HTTPHEADER => $this->headers,
            CURLOPT_POSTFIELDS => $this->body,
            CURLOPT_RETURNTRANSFER => true
        ]);
        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        return [
            'statusCode' => $httpCode,
            'response' => json_decode($response, true)
        ];
    }

}