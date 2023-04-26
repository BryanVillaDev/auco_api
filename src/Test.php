<?php
require_once 'ApiAuco/ConnectApi.php';
require_once 'ApiAuco/config.php'; # this files is optional contains the defined varibles
use ApiAuco\ConnectApi;

#That code use this documentantio https://docs.auco.ai/servicios/gestion-documental

# instance this class  ConnectApi
$ApiAuco = new ConnectApi();
# define this array is the format for payload
$data = array(
    'name' => 'Documento para probar la carga',
    'email' => 'email@ejemplo.com',
    'message' => 'Hola a todos, les comparto el siguiente pdf para que lo firmen',
    'subject' => 'Documento importante',
    'remember' => 3,
    'documents' => array(

        "name" => "Documento1",
        'file' => $ApiAuco->base64EncodeFile('C:\xampp\htdocs\auco_api\src\Test.pdf'),
        'signProfile' => array(
            array(
                'type' => 'sign1',
                'name' => 'email@ejemplo.com',
                'email' => '',
            ),
        ),
        "name" => "Documento2",
        'file' => $ApiAuco->base64EncodeFile('C:\xampp\htdocs\auco_api\src\Test.pdf'),
        'signProfile' => array(
            array(
                'type' => 'sign1',
                'name' => 'email@ejemplo.com',
                'email' => '',
            ),
        ),

    ),
    'camera' => false,
    'otpCode' => false,
    'options' => array(
        'camera' => 'identification',
        'otpCode' => 'phone',
        'whatsapp' => false,
    ),
);

$resultUplaod = $ApiAuco->upload($data);
print_r($resultUplaod);
// $resultGet = $ApiAuco->get('I2N375H5W1');
// print_r($resultGet);
