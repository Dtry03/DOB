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


                    <form action="nuevaCategoria.php" id="contact-form" method="post">

                        <div class="group mobile">

                            <input type="text" id="name" placeholder="nombre" name="nombre">

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