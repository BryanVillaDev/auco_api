<?php
require_once 'ApiAuco/AucoConnectService.php';
require_once 'ApiAuco/RequestInterface.php';
require_once 'ApiAuco/HttpClientApi.php';
require_once 'ApiAuco/HttpRequest.php';
require_once 'ApiAuco/config.php';

use ApiAuco\AucoConnectService;
$ApiAuco = new AucoConnectService();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $jsonDataPost = json_encode($_POST, JSON_PRETTY_PRINT);
    $ApiAuco->webHookPost($jsonDataPost);
    // Do something with the form data
    echo "Hello";
}