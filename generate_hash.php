<?php
// Este script genera el codigo TIMESTAMP y HASH para mi autenticación
// en el servidor, debo colocar mi ID
$time = time();
echo "Time: $time".PHP_EOL."Hash: ".sha1($argv[1].$time.'Sh!! No se lo cuentes a nadie!').PHP_EOL;

//Generar:
//php generate_hash.php 1

/*
Time: 1579046321
Hash: 44cf07a5584c02262d8152bafbaef95ed7cef69f

curl http://localhost:8000/books -H 'X-HASH: 44cf07a5584c02262d8152bafbaef95ed7cef69f' -H 'X-UID: 1' -H 'X-TIMESTAMP: 1579046321'
curl http://localhost:8000/books -H 'X-HASH: 44cf07a5584c02262d8152bafbaef95ed7cef69f' -H 'X-UID: 1' -H 'X-TIMESTAMP: 1579046321'

*/