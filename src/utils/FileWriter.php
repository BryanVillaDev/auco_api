<?php

namespace utils;

class FileWriter {
    private string $filePath;

    public function __construct($filePath) {
        $this->filePath = $filePath;
    }

    public function write($data) {
        file_put_contents($this->filePath, $data);
    }
}