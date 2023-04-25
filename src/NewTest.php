<?php
require_once 'ApiAuco/AucoConnectService.php';
require_once 'ApiAuco/RequestInterface.php';
require_once 'ApiAuco/HttpClientApi.php';
require_once 'ApiAuco/HttpRequest.php';
require_once 'ApiAuco/config.php'; # this files is optional contains the defined varibles
use ApiAuco\AucoConnectService;

#That code use this documentantio https://docs.auco.ai/servicios/gestion-documental

# instance this class  ConnectApi
$ApiAuco = new AucoConnectService();
# define this array is the format for payload
$data = array(
    'name' => 'Documento para probar la carga',
    'email' => 'email@ejemplo.com',
    'message' => 'Hola a todos, les comparto el siguiente pdf para que lo firmen',
    'subject' => 'Documento importante',
    'remember' => 3,
    'camera' => false,
    'otpCode' => false,
    'documents' => [
        [
            "name" => "Documento1",
            'file' => 'E:\Brayan Villalobos\auco_api\src\Test.pdf',
            'signProfile' => [
                [
                    "name" => "Evelyn1",
                    "email" => "villabryan12@gmail.com",
                    "phone" => "+57"
                ],
            ]
        ],
        [
            "name" => "Documento2",
            'file' => 'E:\Brayan Villalobos\auco_api\src\Test.pdf',
            'signProfile' => [
                [
                    "name" => "Evelyn2",
                    "email" => "villabryan12@gmail.com",
                    "phone" => "+57"
                ],
            ],
        ]
    ],
    'options' => [
        'camera' => 'identification',
        'otpCode' => 'phone',
        'whatsapp' => false,
    ],
);

$resultUpload = $ApiAuco->uploadMany($data);
print_r($resultUpload);
// $resultGet = $ApiAuco->get('I2N375H5W1');
// print_r($resultGet);
