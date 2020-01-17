<?php





// Código comentado
/* if (true){
    /* Autenticación Access Tokens */
    /* if ( !array_key_exists( 'HTTP_X_TOKEN', $_SERVER ) ) {
    
        echo ('No se recibió el token');
        die;
    }
    
    $url = 'http://localhost:8001';
    
    $ch = curl_init( $url );
    curl_setopt( 
        $ch, 
        CURLOPT_HTTPHEADER, [
            "X-Token: {$_SERVER['HTTP_X_TOKEN']}"
            ]
        );
    curl_setopt( 
        $ch, 
        CURLOPT_RETURNTRANSFER, 
        true );
    
    $ret = curl_exec( $ch );
    
    if ( curl_errno($ch) != 0 ) {
        die ( curl_error($ch) );
    }
    
    if ( $ret !== 'true' ) {
        http_response_code( 403 );
        die;
    } */
    
    
    // Solicitar token:
    // curl http://localhost:8001 -X 'POST' -H 'X-Client-Id: 1' -H 'X-Secret: SuperSecreto!'
    // Solicitar libros:
    // curl http://localhost:8000/books -H 'X-Token: 5d0937455b6744.68357201'
    
    
    /* Autenticación HMAC 
     Verficar que esté la información en los encabezados*/
    /* if (
        !array_key_exists('HTTP_X_HASH', $_SERVER) ||
        !array_key_exists('HTTP_X_TIMESTAMP', $_SERVER) ||
        !array_key_exists('HTTP_X_UID', $_SERVER)
    ){
        echo ('No hay info en los encabezados').PHP_EOL;
        die;
    }
    
    //Creamos las variables, donde cada encabezado estará en una variable
    list( $hash, $uid, $timestamp) = [
        $_SERVER['HTTP_X_HASH'],
        $_SERVER['HTTP_X_UID'],
        $_SERVER['HTTP_X_TIMESTAMP'],
    ];
    
    // Clave secreta, un string
    $secret = 'Sh!! No se lo cuentes a nadie!';
    
    //Creo mi hash, usando la función de hashing SHA1
    $newHash = sha1($uid.$timestamp.$secret);
    
    // Compara el hash creado, con el recibido
    if ($newHash !== $hash){
        echo ('Los hash no son iguales').PHP_EOL;
        die;
    } */
    //generar el hash con el script creado: generate_hash.php
    
    
    
    /* Autenticación HTTP
    $user = array_key_exists( 'PHP_AUTH_USER', $_SERVER) ? $_SERVER['PHP_AUTH_USER'] : '';
    $pwd = array_key_exists( 'PHP_AUTH_PW', $_SERVER) ? $_SERVER['PHP_AUTH_PW'] : '';
    
    if( $user !== 'mauro' || $pwd !== '1234'){
        die;
    }
} */


//Definimos los recursos disponibles
$allowedResourceTypes = [
    'books',
    'authors',
    'genres',
];

// Validamos que el recurso esté disponible
$resourceType = $_GET['resource_type'];

if (!in_array($resourceType, $allowedResourceTypes)){
    http_response_code(400);
    die;
}
// Defino los recursos
$books = [
    1 => [
        'titulo' => 'Lo que el viento se llevó',
        'id_autor' => 1,
        'id_genero' => 1,
    ],
    2 => [
        'titulo' => 'La Odisea',
        'id_autor' => 2,
        'id_genero' => 2,
    ],
    3 => [
        'titulo' => 'La Iliada',
        'id_autor' => 3,
        'id_genero' => 3,
    ],
];
// Buena práctica de añadir un encabezado para avisarle al usuario que la respuesta es tipo JSON
header('Content-Type: application/json');

// Levantamos el id del recurso buscado
$resourceId = array_key_exists('resource_id', $_GET) ? $_GET['resource_id']:'';

// Generamos la respuesta asumiendo que el pedido es correcto
switch (strtoupper($_SERVER['REQUEST_METHOD'])){
    case 'GET':
        if ( empty( $resourceId ) ){    // Si el resourceId está vacío:
            echo json_encode( $books ); // devuelve todos los libros
         }else{
            if( array_key_exists( $resourceId, $books) ){ //Si el resourceId tiene una identificación
                echo json_encode( $books[ $resourceId ] ); //devuelve solamente el libro identifiado
            } else {
                http_response_code ( 404 );
            }
         }
    break;

    case 'POST':
        //Tomamos la entrada "cruda"
        $json = file_get_contents('php://input');

        //Transformamos el json recibido a un nuevo elemento del arreglo
        $books[] = json_decode( $json, true);

        //Devuelve el nuevo número identificador del libro recién añadido
        echo array_keys($books)[count($books) - 1];

        //Devuelve el arreglo de libros como si fuese GET
        echo json_encode( $books );
    break;

    case 'PUT':
        // Validamos que el recurso buscado, exista.
        if ( !empty($resourceId) && array_key_exists($resourceId, $books)){
                //Tomamos la entrada cruda
                $json = file_get_contents('php://input');

                 // Actualizamos el json recibido en el objeto de nuestro arreglo
                $books[$resourceId] = json_decode( $json, true);

                //Devolver el Id del recurso actualizado
                // Devolver la colección completa
                echo json_encode($books);
        }
    break;

    case 'DELETE':
        // Validamos que el recurso buscado, exista.
        if ( !empty($resourceId) && array_key_exists($resourceId, $books)){
            
            //Eliminamos el recurso. En un caso real se debe
            //enviar un DELETE a la base de datos
            unset($books[ $resourceId ]);

            //Retornamos la colección modificada en formato Json
            echo json_encode( $books );
        }
    break;

}
// Levantar Servidor
// php -S localhost:8000 server.php
// Consulta por cónsola:
// "http://localhost:8000?resource_type=books&resource_id=1"