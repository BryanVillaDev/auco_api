<?php
namespace ApiAuco;

class ConnectApi
{

    private $url;
    private $private_key;
    private $public_key;
    public function __construct()
    {

        #Define your varibles in your project
        $this->url = url_auco;
        $this->private_key = private_key;
        $this->public_key = public_key;
    }

    public function upload($data)
    {
        $ch = curl_init();
        $data_string = json_encode($data);
        curl_setopt($ch, CURLOPT_URL, $this->url . '/document/');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Authorization: ' . $this->private_key,
            'Content-Type: application/json',
            'Content-Length: ' . strlen($data_string),
        ));

        $result = curl_exec($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        $data = [
            'http_code' => $http_code,
            'result_api' => json_decode($result, 1),
        ];
        return $data;
    }

    public function get($document)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->url . '/document?code=' . $document);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
        $headers = array();
        $headers[] = "Authorization: " . $this->public_key;
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $result = curl_exec($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        $data = [
            'http_code' => $http_code,
            'result_api' => json_decode($result, 1),
        ];
        return $data;
    }

    public function base64EncodeFile($filepath)
    {
        $file_content = file_get_contents($filepath);
        return base64_encode($file_content);
    }

}
