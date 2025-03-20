<?php 

header("Content-Type: application/json");

require_once(__DIR__."/../src/Producto.php");
require_once(__DIR__."/../src/Constantes.php");
require_once(__DIR__."/include/conexion.php");

use function APP\inventario\closeCon;
use function APP\inventario\executeDMLStmt;
use APP\inventario\Constantes;

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['categoria'])) {
    $params = $_POST['categoria'];
    
    // Preparar la consulta usando la constante
    $stmt = $conn->prepare(Constantes::GET_PRODUCTO_BY_CATEGORIA);

    $stmt->execute([$params]);

    $productos = [];

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        if ($row["stock"]) {
            // Agregar cada producto al array de respuesta
            $productos[] = [
                "nombre" => $row["nombre"],
                "descripcion" => $row["descripcion"],
                "ruta_imagen" => $row["ruta_imagen"]
            ];
        }
    }

    // Cerrar conexión
    closeCon($conn);

    // Devolver la respuesta en formato JSON
    echo json_encode([
        "success" => true,
        "productos" => $productos
    ]);

} else {
    echo json_encode([
        "success" => false,
        "error" => "No se recibieron los datos correctamente"
    ]);
}
?>
