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

        <?php 
            include __DIR__."/header.php";
            require_once(__DIR__."/../src/Categoria.php");
            require_once(__DIR__."/../src/Constantes.php");
            require_once(__DIR__."/include/conexion.php");
    
            use function APP\inventario\closeCon;
            use function APP\inventario\executeDMLStmt;
            use function APP\inventario\executeSelectStmtClass;
            use  APP\inventario\Constantes;
            use APP\inventario\Categoria;
    
                

            $categoria= new Categoria("","");

            if ($_SERVER["REQUEST_METHOD"] == "POST"){

                if(isset($_POST["nombre"])){

                    if(empty($_POST["id"])){
    
                        $params=[$_POST["nombre"]];
        
                        if(executeDMLStmt($conn,Constantes::CREATE_CATEGORIA,$params)){
                            echo "producto insertado con exito";
                            header("Location: listarCategorias.php");
                            exit();
                        }else {
                            echo "Error al crear la categoría: ";
                        }

                    }else{


                        $params=[$_POST["nombre"],$_POST["id"]];

                        if(executeDMLStmt($conn,Constantes::UPDATE_CATEGORIA,$params)){
                            echo "categoría modificada con exito";
                            header("Location: listarCategorias.php");
                            exit();
                        }else {
                            echo "Error al crear la categoría: ";
                        }

                    }
    
    
                }

            }

                            
            if ($_SERVER["REQUEST_METHOD"] == "GET"){
                if(isset($_GET["id"] )){

                  
                    $params=[$_GET["id"]];

                    $stmt=executeSelectStmtClass($conn,Constantes::GET_CATEGORIA_BY_ID,$params,APP\inventario\Categoria::class,['id','nombre']);

                    
                    foreach ($stmt as $categorias) {
                        $categoria= $categorias;
                        
                    }

                    


                    


                }
            }
        
        ?>

        <div class="info-container">

            <div class="info-text">

                <h3 class="title-info">

                    <span>

                        Insertar categoría

                    </span>

                </h3>

            </div>
        </div>

        <div class="form-container">

                    <form action="nuevaCategoria.php" id="contact-form" method="post">

                        <div class="group mobile">

                            <input type="text" id="name" placeholder="nombre" name="nombre" value="<?php echo $categoria->getNombre(); ?>">

                            <span class='form-error-message' id="name-error-mobile"></span>

                            <input type="hidden" id="id"  name="id" value="<?php echo $categoria->getId(); ?>">


                        </div>

                        <div class="group error">

                            <span class='form-error-message' id="name-error"></span>

                            <span class='form-error-message' id="mail-error"></span>

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

</body>
</html>