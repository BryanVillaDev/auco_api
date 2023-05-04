<?php

namespace utils;

class JsonEncryptor {
    private $key;

    public function __construct($key) {
        $this->key = $key;
    }

    public function encrypt($data) {
        $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));
        $encrypted_data = openssl_encrypt($data, 'aes-256-cbc', $this->key, OPENSSL_RAW_DATA, $iv);
        return base64_encode($iv . $encrypted_data);
    }

    public function decrypt($encrypted_data) {
        $encrypted_data = base64_decode($encrypted_data);
        $iv_size = openssl_cipher_iv_length('aes-256-cbc');
        $iv = substr($encrypted_data, 0, $iv_size);
        $encrypted_data = substr($encrypted_data, $iv_size);
        return openssl_decrypt($encrypted_data, 'aes-256-cbc', $this->key, OPENSSL_RAW_DATA, $iv);
    }
}
