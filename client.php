<?php
$ch = curl_init( $argv[1]);
curl_setopt(
	$ch,
	CURLOPT_RETURNTRANSFER,
	true
);

$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

switch ($httpCode){
	case 200:
		echo 'Todo bien!';
		break;
	case 400:
		echo 'Pedido incorrecto';
		break;
	case 404:
		echo 'Recurso no encontrado';
		break;
	case 500:
		echo 'El servidor fallo';
		break;
}
// Se usa el archivo client.php para realizar la consulta de libros y capturar el código de respuesta 
// php client.php http://localhost:8000/books 

