<?php

namespace ApiAuco;

class AucoConnectService
{
    private $privateKey;
    private $publicKey;
    private HttpClientApi $client ;
    public function __construct()
    {
        $this->privateKey = private_key;
        $this->publicKey = public_key;
        $this->client = new HttpClientApi(url_auco);
    }
    public function base64EncodeFile($filePath)
    {
        $fileContent = file_get_contents($filePath);
        return base64_encode($fileContent);
    }
    private function encode($data){
        return json_encode($data);
    }
    private function validDataStructure(): bool{
        return true;
    }

    private function requestAucoPost($data, $url){
        $encodeData = $this->encode($data);
        $clientPost = $this->client->post($url);
        $clientPost->headers('Authorization', $this->privateKey);
        $clientPost->headers('Content-Type', 'application/json');
        $clientPost->headers('Content-Length', strlen($encodeData));
        $clientPost->body($encodeData);
        return $clientPost->send();
    }
    public function upload(array $data){
        return $this->requestAucoPost($data, '/document/upload');
    }

    protected function cleanPayload($payload){
        $newDocumentToSend = [];
        foreach ($payload['documents'] as $key => $item) {
            $newDocumentToSend[] = $item['file'];
            unset($payload['documents'][$key]['file']);
        }
        return [
            'payload' =>  $payload,
            'files' => $newDocumentToSend
        ];
    }
    public function uploadMany(array $data){
        $toSend = $this->cleanPayload($data);
        $response = $this->requestAucoPost($toSend['payload'], '/document/many');
        if ($response['statusCode'] == 200){
            $clientAws =  new HttpClientApi('');
            foreach ($response['response'] as $key => $item) {
                $clientPut = $clientAws->put($item['url']);
                $clientPut->body($toSend['files'][$key]);
                $response = $clientPut->send();
            }
        }
        return $response;
    }

    public function get($documentCode){
        $clientGet = $this->client->get('/document?code=' .$documentCode);
        $clientGet->headers('Authorization', $this->publicKey);
        return $clientGet->send();
    }
}