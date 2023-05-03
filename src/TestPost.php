<?php
require_once 'ApiAuco/AucoConnectService.php';
require_once 'ApiAuco/RequestInterface.php';
require_once 'ApiAuco/HttpClientApi.php';
require_once 'ApiAuco/HttpRequest.php';
require_once 'ApiAuco/config.php';
require_once 'utils/JsonEncryptor.php';
require_once 'utils/JsonFileManager.php';
use ApiAuco\AucoConnectService;
$apiAuco = new AucoConnectService();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    echo $apiAuco->webHookPost(json_encode($data));
}else{
    echo "Method not allowed";
}
