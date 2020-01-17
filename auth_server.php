<?php

//Servidor de Autenticación que genera el TOKEN y lo valida

$method = strtoupper( $_SERVER['REQUEST_METHOD'] );
$token = sha1('Esto es secreto!!');

if ( $method === 'POST' ) {
    if ( !array_key_exists( 'HTTP_X_CLIENT_ID', $_SERVER ) || !array_key_exists( 'HTTP_X_SECRET', $_SERVER ) ) {
        http_response_code( 400 );

        die( 'Faltan parametros' );
    }

    $clientId = $_SERVER['HTTP_X_CLIENT_ID'];
    $secret = $_SERVER['HTTP_X_SECRET'];

    if ( $clientId !== '1' || $secret !== 'SuperSecreto!' ) {
        http_response_code( 403 );

        die ( "No autorizado");
    }

    echo "$token".PHP_EOL;

// Metodo de validación del Token
} elseif ( $method === 'GET' ) {
    if ( !array_key_exists( 'HTTP_X_TOKEN', $_SERVER ) ) {
        http_response_code( 400 );

        die ( 'Faltan parametros' );
    }

    // En un caso real debe comparar contra todos los tokens de la base de datos
    if ( $_SERVER['HTTP_X_TOKEN'] == $token ) {
        echo 'true';
    } else {
        echo 'false';
    }
} else {
    echo 'false';
}