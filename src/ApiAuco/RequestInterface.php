<?php

namespace ApiAuco;

interface RequestInterface
{
    public function headers(string $header, string $value): void;
    public function body(string $body): void;
    public function send(): array;

}