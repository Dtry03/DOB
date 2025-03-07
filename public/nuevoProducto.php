<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="assets/css/userArea.css">

    
    <!-- IMPORTAR FUNCIONES JQUERY -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- IMPORTAR FUNCIONES JS -->
    <script src="assets/js/app.js"></script>

    <!-- IMPORTAR GOOGLE FONTS-->
    <link href="https://fonts.googleapis.com/css?family=Playfair+Display:400,400i,700,700i%7cWork+Sans:400,500,700" rel="stylesheet" type="text/css">

    <!-- IMPORTAR LIBRERIA DE ICONOS FONTAWESOME-->
    <script src="https://kit.fontawesome.com/4e519fa740.js" crossorigin="anonymous"></script>
</head>
<body>

    <div class="container">

        <?php 
            include __DIR__."/header.php";
            require_once(__DIR__."/../src/Producto.php");
            require_once(__DIR__."/../src/Constantes.php");
            require_once(__DIR__."/include/conexion.php");

            use function APP\inventario\closeCon;
            use function APP\inventario\executeDMLStmt;
            use function APP\inventario\executeSelectStmtClass;
            use  APP\inventario\Constantes;
            use APP\inventario\Producto;

            $producto= new Producto("","","","","");

            if ($_SERVER["REQUEST_METHOD"] == "POST"){
                if(isset($_POST["nombre"] ) && isset($_POST["descripcion"] )&& isset($_POST["categoria"])){

                    
                       
                            if(isset($_FILES['rutaImagen']) && $_FILES['rutaImagen']['error'] === UPLOAD_ERR_OK){

                                $directorio= __DIR__."/assets/images/galleryProducts";
                                $nombre_archivo = $_FILES['rutaImagen']['name'];
                                $nombre_temporal = $_FILES['rutaImagen']['tmp_name'];
                                $extension = strtolower(pathinfo($nombre_archivo, PATHINFO_EXTENSION));
                                $nombre_unico = uniqid() . '.' . $extension;
                                $ruta_destino = $directorio."/".$nombre_unico;

                                

                                if (move_uploaded_file($nombre_temporal , $ruta_destino)) {

                                    echo "La imagen se ha subido correctamente. Ruta: ";

                                } else {
                            
                                    echo "Error: Hubo un problema al subir la imagen.";

                                }

                                

 
            
                            }else{
                                $ruta_destino=$_POST["valorImagen"];
                            }


                         if(empty($_POST["id"])){

                            $params=[$ruta_destino,$_POST["nombre"],$_POST["descripcion"],$_POST["categoria"]];

                            if(executeDMLStmt($conn,Constantes::CREATE_PRODUCTO,$params)){
                                echo "producto insertado con exito";
                                header("Location: listarProductos.php");
                                exit();
                            }else {
                                echo "Error al crear el producto: ";
                            }

                         }else{
                            
                            $params=[$_POST["nombre"],$_POST["descripcion"],$ruta_destino,$_POST["categoria"],$_POST["id"]];

                            if(executeDMLStmt($conn,Constantes::UPDATE_PRODUCTO,$params)){
                                echo "producto modificado con exito";
                                header("Location: listarProductos.php");
                                exit();
                            }else {
                                echo "Error al crear el producto: ";
                            }
                        }
                    
                
                    



                }
            }

                            
            if ($_SERVER["REQUEST_METHOD"] == "GET"){
                if(isset($_GET["id"] )){

                  
                    $params=[$_GET["id"]];

                    $stmt=executeSelectStmtClass($conn,Constantes::GET_PRODUCTO_BY_ID,$params,APP\inventario\Producto::class,['id','rutaImagen','nombre','descripcion','stock','id_categoria']);

                    
                    foreach ($stmt as $productos) {
                        $producto= $productos;
                        
                    }

                    


                    


                }
            }

    ?>



        <div class="form-container">

        <div class="info-container">

                    <div class="info-text">

                        <h3 class="title-info">

                            <span>

                                Insertar producto

                            </span>

                        </h3>

                    </div>
                    </div>

                    <form action="nuevoProducto.php"  method="post" enctype="multipart/form-data">

                        <div class="group mobile">
                            <label>
                                <input type="file" id="rutaImagen" placeholder="ruta imagen" name="rutaImagen" accept="image/*" >
                                <span class="file-name"><?php echo $producto->getruta_imagen(); ?></span>
                                <span class="sendMessage">Seleccionar archivo</span>
                            </label>

                            <span class='form-error-message' id="name-error-rutaImagen"></span>

                            <input type="hidden" name="valorImagen" value="<?php echo $producto->getruta_imagen(); ?>">


                            <input type="text" id="name" placeholder="nombre" name="nombre" value="<?php echo $producto->getNombre(); ?>">

                            <span class='form-error-message' id="name-error-mobile"></span>


                            <input type="text" id="descripcion" placeholder="descripción" name="descripcion" value="<?php echo $producto->getDescripcion(); ?>">

                            <span class='form-error-message' id="name-error-mobile"></span>


                            <select name="categoria" id="categoria">

                            
                                <?php 

                                        try {

                                            $stmt=$conn->prepare(Constantes::LIST_CATEGORIAS);

                                            $stmt->execute();

                                            echo "<option value=''  selected disabled>Seleccione categoría</option>";

                                            while ($row= $stmt->fetch()) {
                                                
                                                if($producto->getid_categoria()==$row["id"]){
                                                    echo "<option value='".$row["id"]."' selected>".$row["nombre"]."</option>";
                                                }else{
                                                    echo "<option value='".$row["id"]."'>".$row["nombre"]."</option>";
                                                }

                                            }
                                  
                                            closeCon($conn);

                                        } catch (\PDOException $e) {
                                            
                                            echo "error al obtener los datos";
                                        }

                                
                                ?>
                            </select>

                            <input type="hidden" id="id"  name="id" value="<?php echo $producto->getId(); ?>">


                        </div>

                        <div class="group error">

                            <span class='form-error-message' id="name-error"></span>

                        </div>

                        <div class="group error">

                            <span class='form-error-message' id="coments-error"></span>

                        </div>

                        <div class="group">

                            <input id="sendMessage"  class="sendMessage" name="sendMessage" type="submit" value="Insertar">

                        </div>


                        <div class="group success">

                            <span class='form-success-message' id="coments-error"></span>

                        </div>

                    </form>
        </div>
    </div>
    <!-- IMPORTAR FUNCIONES JS -->
    <script src="assets/js/app.js"></script>
</body>
</html>