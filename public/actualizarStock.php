<?php 


header("Content-Type: application/json");


require_once(__DIR__."/../src/Producto.php");
require_once(__DIR__."/../src/Constantes.php");
require_once(__DIR__."/include/conexion.php");

use function APP\inventario\closeCon;
use function APP\inventario\executeDMLStmt;

use  APP\inventario\Constantes;


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['onoff']) && isset($_POST['id'])) {

    $params=[$_POST['onoff'],$_POST['id']];
    
    if(executeDMLStmt($conn,Constantes::UPDATE_PRODUCTO_STOCK,$params)){

        echo json_encode([
            "success" => true,
            "message" => "Datos actualizados correctamente",
        ]);
  
    }else {
        echo json_encode([
            "success" => true,
            "message" => "Error al actualizar datos"
        ]);
    }


} else {
    echo json_encode([
        "success" => false,
        "error" => "No se recibieron los datos correctamente"
    ]);
}


?>