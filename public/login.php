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
        session_start();

        
        if (isset($_SESSION["usuario"])) {
            header("Location: listarProductos.php");
            exit();
        }

        require_once(__DIR__."/../src/Producto.php");
        require_once(__DIR__."/../src/Constantes.php");
        require_once(__DIR__."/include/conexion.php");

        use function APP\inventario\closeCon;
        use function APP\inventario\executeDMLStmt;
        use function APP\inventario\executeSelectStmtAssoc;

        use  APP\inventario\Constantes;

        try {

            if ($_SERVER["REQUEST_METHOD"] === "POST") {
                $usuario =  $_POST["usuario"];
                $password = $_POST["pass"];

                $stmt = executeSelectStmtAssoc($conn,Constantes::GET_USUARIO_BY_ID,[$usuario]);

                foreach ($stmt as $row) {
                    $pass= $row["pass"];
                }
                
                if (password_verify($password, $pass)) {
                    $_SESSION["usuario"] = $usuario;
                    header("Location: listarProductos.php"); 
                    exit();
                } else {
                    echo "Usuario o contraseña incorrectos.";
                }
            }
        }catch (\PDOException $e) {
                    
            echo "error al obtener los datos";
        }
        
    ?>

        <div class="form-container login">

        <div class="info-container">

            <div class="info-text">

                <h3 class="title-info">

                    <span>

                        Iniciar sesión

                    </span>

                </h3>

            </div>
        </div>


                    <form action="login.php" id="contact-form" method="post">

                        <div class="group mobile">

                            <input type="text" id="usuario" placeholder="usuario" name="usuario">

                            <span class='form-error-message' id="name-error-mobile"></span>

                            <input type="password" id="pass" placeholder="Contraseña" name="pass">

                            <span class='form-error-message' id="name-error-mobile"></span>



                        </div>

                        <div class="group error">

                            <span class='form-error-message' id="name-error"></span>

                            <span class='form-error-message' id="mail-error"></span>

                        </div>

                        <div class="group error">

                            <span class='form-error-message' id="coments-error"></span>

                        </div>

                        <div class="group">

                            <input id="sendMessage"  class="sendMessage" name="sendMessage" type="submit" value="Iniciar sesión">

                        </div>


                        <div class="group success">

                            <span class='form-success-message' id="coments-error"></span>

                        </div>

                    </form>
        </div>
    </div>

</body>
</html>