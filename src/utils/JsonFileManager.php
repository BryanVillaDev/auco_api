<?php

namespace utils;

class JsonFileManager {
    private string $filePath;

    public function __construct($filePath) {
        $this->filePath = $filePath;
    }

    public function write($data) {
        $jsonData = json_encode($data, JSON_PRETTY_PRINT);
        file_put_contents($this->filePath, $jsonData);
    }
    public function read() {
        $jsonData = file_get_contents($this->filePath);
        return json_decode($jsonData, true);
    }
}