<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="assets/css/userArea.css">

    <!-- IMPORTAR FUNCIONES JS -->
    <script src="assets/js/app.js"></script>

    <!-- IMPORTAR GOOGLE FONTS-->
    <link href="https://fonts.googleapis.com/css?family=Playfair+Display:400,400i,700,700i%7cWork+Sans:400,500,700" rel="stylesheet" type="text/css">

    <!-- IMPORTAR LIBRERIA DE ICONOS FONTAWESOME-->
    <script src="https://kit.fontawesome.com/4e519fa740.js" crossorigin="anonymous"></script>
</head>
<body>

<div class="container">
<?php include __DIR__."/header.php"; ?>
<div class="products-container">

<div class="info-container">

    <div class="info-text">

        <h3 class="title-info">

            <span>

                Lista de productos

            </span>

        </h3>

        <div class="button-container">
            <a href="nuevoProducto.php"><button type="button">Nuevo producto</button></a>
        </div>

    </div>
</div>
    <div class="table-container">
            <?php 

                require_once(__DIR__."/../src/Producto.php");
                require_once(__DIR__."/../src/Constantes.php");
                require_once(__DIR__."/include/conexion.php");

                use function APP\inventario\closeCon;
                use function APP\inventario\executeDMLStmt;

                use  APP\inventario\Constantes;

                try {


                    if ($_SERVER["REQUEST_METHOD"] == "POST"){
                        if(isset($_POST["id"])){
                
                            $params=[$_POST["id"]];
                
                            if(executeDMLStmt($conn,Constantes::DELETE_PRODUCTO,$params)){
                                echo "producto eliminado con exito";
                                header("Location: listarProductos.php");
                                exit();
                            }else {
                                echo "Error al eliminar el producto";
                            }
                
                
                        }
                    }
                
                 
                
                } catch (\PDOException $e) {
                    
                    echo "error al obtener los datos";
                }
                

                try {

                    $stmt=$conn->prepare(Constantes::LIST_PRODUCTOS);

                    $stmt->execute();

                    echo "<table class='table'>";
                    echo "<tr><th>ruta imagen</th><th>Nombre</th><th>Descripción</th><th>Eliminar</th><th>Editar</th></tr>";

                    while ($row= $stmt->fetch()) {
                        
                        echo "<tr><td>".$row["ruta_imagen"]."</td><td>".$row["nombre"]."</td><td>".$row["descripcion"]."</td><td><form method='post' action='listarProductos.php' onsubmit='return confirm('¿Estás seguro de que deseas eliminar este producto?');'><input type='hidden' id='id' name='id' value='".$row["id"]."' required><button type='submit' name='delete'><i class='fa fa-xmark'></i></button></form></td><td><a href='nuevoProducto.php?id=".$row["id"]."'><i class='fa fa-pencil'></i></a></td></tr>";

                    }
                    
                    echo "</table>";

                    closeCon($conn);

                } catch (\PDOException $e) {
                    
                    echo "error al obtener los datos";
                }



            ?>
    </div>

</div>

</div>


</body>
</html>

