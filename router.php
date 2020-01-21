<?php

//$matches=[];
$matches = $_GET = [];

// Excepcion para las  url principal sea index.html
if (in_array( $_SERVER["REQUEST_URI"], [ '/index.html', '/', '' ] )) {
    //echo file_get_contents( '/Users/henrydsantiago/Google Drive/CURSOS/REST/index.html' );
    echo file_get_contents( 'index.html' );
    die;
}


// Para los que estan usando sub carpetas tienen que sumar uno mas al matches
//$_GET['resource_type']=$matches[2]; 
//$_GET['resource_id']=$matches[3];


if(preg_match('/\/([^\/]+)\/([^\/]+)/',$_SERVER["REQUEST_URI"],$matches))
{
    $_GET['resource_type']=$matches[1];    
    $_GET['resource_id']=$matches[2];
    error_log(print_r($matches,1));
    require 'server.php';
}elseif(preg_match('/\/([^\/]+)\/?/',$_SERVER["REQUEST_URI"],$matches))
{
    $_GET['resource_type']=$matches[1];        
    error_log(print_r($matches,1));
    require 'server.php';
}else
{
    error_log('No matches');
    http_response_code(404);
}



// Levantar Servidor
// php -S localhost:8000 router.php
// Consulta por cónsola
// $ curl http://localhost:8000/books/1


?>
