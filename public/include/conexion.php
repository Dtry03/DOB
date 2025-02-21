<?php

use function APP\inventario\openCon;

require_once(__DIR__."/../../src/db_lib.php");

$host="localhost";
$user="root";
$pass="";
$dbname="productos";

try {

    $conn =openCon($host,$user,$pass,$dbname);

} catch (\PDOException $e) {
    
    echo "error al establecer conexión";

}


?>