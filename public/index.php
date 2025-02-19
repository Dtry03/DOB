<?php 

// MANEJAR ERROR 404


function error404(){

$http_response_code = http_response_code();

if ($http_response_code === 404) {

    echo '<section class="error404" id="error404">
    
            <div class="error-container">

                    <div class="error-text">

                        <h3 class="error-info">

                            <span>

                                404

                            </span>

                        </h3>

                        <p class="content-text-error">No se ha encontrado la página</p>

                    </div>
                    
                </div>
            </section>';

    exit;
}

}

// ESTABLECER COOKIES

function setCookies($cookie){

    setcookie($cookie,1,time() +(365 * 24 * 60 * 60),'/');

}

function getCookies($cookie){

    return isset($_COOKIE[$cookie]) ? ($_COOKIE[$cookie]): false;

}

if (isset($_POST['marketing']) || isset($_POST['statistics'])) {

    $marketing = $_POST['marketing'];

    $statistics= $_POST['statistics'];

    $responseCookies = [

        'error' => false,

        'message' => ''

    ];

    
    setCookies("functional");

    $marketing == "on" ? setCookies("marketing") : "";

    $statistics == "on" ? setCookies("statistics") : "";

    $responseCookies['message'] = getCookies("marketing")." ".getCookies("statistics")." ".getCookies("functional");


    header('Content-Type: application/json');

    echo json_encode($responseCookies);

    exit;

}

//-----------------------------------------------------------------

// MOSTRAR BANNER DE COOKIES

function cookiesBanner(){

    if (getCookies("functional")==null && getCookies("marketing")==null && getCookies("statistics")==null) {
        
        echo ' <div class="cookies-container">

                    <form action="index.php" class="preferences-form" id="preferences-form" method="post">

                        <div class="cookies-text-content">

                            <h3 class="cookies-title">

                                <span>

                                    Gestionar el consentimiento de las cookies

                                </span>

                            </h3>

                            <p class="content-text-cookies">Para ofrecer las mejores experiencias, utilizamos tecnologías como las cookies para almacenar y/o acceder a la información del dispositivo. El consentimiento de estas tecnologías nos permitirá procesar datos como el comportamiento de navegación o las identificaciones únicas en este sitio. No consentir o retirar el consentimiento, puede afectar negativamente a ciertas características y funciones.</p>

                            <div class="cookies-close-button">

                                <button type="submit" class="close"><i class="fa-solid fa-xmark"></i></button>

                            </div>

                        </div>

                        <div class="cookies-preferences-content">

                            <div class="preferences-option">

                                <h3 class="preferences-title">

                                    <span>

                                        Funcional

                                    </span>

                                </h3>

                                <p class="status-preferences-text">Siempre activo</p>

                                <i class="fa-solid fa-chevron-up arrow-down"></i>

                                <div class="container-preferences-text">

                                    <p class="preferences-text">El almacenamiento o acceso técnico es estrictamente necesario para el propósito legítimo de permitir el uso de un servicio específico explícitamente solicitado por el abonado o usuario, o con el único propósito de llevar a cabo la transmisión de una comunicación a través de una red de comunicaciones electrónicas.</p>

                                </div>

                            </div>

                            <div class="preferences-option">

                                <h3 class="preferences-title">

                                    <span>

                                        Estadísticas

                                    </span>

                                </h3>

                                <div class="container-preferences-button">

                                    <label class="preferences-switch">

                                        <input type="checkbox" name="statistics" id="statistics" class="preferences-button" checked>

                                        <span class="slider-preferences"></span>
                                        
                                    </label>

                                </div>

                                <i class="fa-solid fa-chevron-up arrow-down"></i>

                                <div class="container-preferences-text">

                                    <p class="preferences-text">El almacenamiento o acceso técnico que es utilizado exclusivamente con fines estadísticos.</p>

                                </div>

                            </div>

                            <div class="preferences-option">

                                <h3 class="preferences-title">

                                    <span>

                                        Marketing

                                    </span>

                                </h3>

                                <div class="container-preferences-button">

                                    <label class="preferences-switch">

                                        <input type="checkbox" name="marketing" id="marketing" class="preferences-button" checked>

                                        <span class="slider-preferences"></span>

                                    </label>

                                </div>

                                <i class="fa-solid fa-chevron-up arrow-down"></i>

                                <div class="container-preferences-text">

                                    <p class="preferences-text">El almacenamiento o acceso técnico es necesario para crear perfiles de usuario para enviar publicidad, o para rastrear al usuario en una web o en varias web con fines de marketing similares.</p>

                                </div>

                            </div>

                        </div>


                        <div class="cookies-buttons">

                            <button type="submit" class="cookies-accept" name="cookies-accept">Aceptar</button>

                            <button type="submit" class="cookies-decline" name="cookies-decline">Denegar</button>

                            <button type="button" class="cookies-preferences" name="cookies-preferences">Ver preferencias</button>

                        </div>

                        <div class="cookies-links">

                            <a href=".#cookies-policy" class="cookies-policy">Política de cookies</a>

                            <a href=".#privacy-policy" class="privacy-policy">Política de privacidad</a>

                            <a href=".#legal-warning" class="legal-warning">Aviso legal</a>

                        </div>

                    </form>

                </div>';

    }

}


//-----------------------------------------------------------------

// VALIDAR DATOS FORMULARIO y ENVIARLOS EN CORREO

use PHPMailer\PHPMailer\PHPMailer;

use PHPMailer\PHPMailer\Exception;

require 'assets/php/PHPMailer/src/Exception.php';

require 'assets/php/PHPMailer/src/PHPMailer.php';

require 'assets/php/PHPMailer/src/SMTP.php';

if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['coments'])) {

    $name = $_POST['name'];

    $email= $_POST['email'];

    $coments = $_POST['coments'];

    $emailRegex = '/^[^\s@]+@[^\s@]+\.[^\s@]+$/';

    $response = [

        'error' => false,

        'message' => ''

    ];


    if (empty($name) || empty($email) || empty($coments) || !preg_match($emailRegex, $email)) {

        $response['error'] = true;

    }else{

        $mail = new PHPMailer(true);

        try {
    
            $mail->SMTPDebug = 0;

            $mail->isSMTP();

            $mail->Host = 'smtp.serviciodecorreo.es';

            $mail->SMTPAuth = true;

            $mail->Username = 'info@jesusrodriguezgonzalez.com';

            $mail->Password = '4Gmjo%cV!2RFr&W4';

            $mail->SMTPSecure = 'ssl';

            $mail->Port = 465;
    
            $mail->setFrom('info@jesusrodriguezgonzalez.com', 'DELICIAS DEL BIERZO');

            $mail->addAddress('xhuss03@gmail.com', 'Destinatario');

            $mail->Subject = 'CONTACTO DESDE DELICIAS DEL BIERZO';

            $mail->Body = 'Nombre: '.$name.'  Email: '.$email.' Mensaje:'.$coments;

            $mail->send();
       
        }catch (Exception $e) {

            $response['error'] = true;

            $response['message'] = 'error al enviar información, intentelo de nuevo más tarde';
        }
    


    }

    header('Content-Type: application/json');

    echo json_encode($response);

    exit;

}

//-----------------------------------------------------------------

// CERRAR CONEXIÓN CON LA BASE DE DATOS

// $conn->close();

//-----------------------------------------------------------------

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delicias del Bierzo</title>
    <!-- IMPORTAR HOJA DE ESTILOS -->
    <link rel="stylesheet" href="assets/css/styles.css">

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

    <?php cookiesBanner(); ?>

    <div class="menu-mobile-container" id="menu-mobile-container">
       
        <div class="menu-mobile-content">

            <div class="menu-close-button-container">

                <button class="menu-mobile-close-button">

                    <i class="fa-solid fa-xmark" style="color:white;"></i>

                </button>

            </div>

            <ul class="menu-mobile-links">

                <li>
                
                    <a href=".#home">Inicio</a>

                </li>

                <li>
                
                    <a href=".#info">Nosotros</a>

                </li>

                <li>
                
                    <a href=".#products">Productos</a>

                </li>

            
                <li>
                
                    <a href=".#contact">Contacto</a>

                </li>

            </ul>

            <div class="menu-social-links">

                    <ul>
                         <li>

                            <i class="fa-brands fa-twitter"></i>

                        </li>

                        <li>

                            <i class="fa-brands fa-instagram"></i>

                        </li>

                        <li>

                            <i class="fa-brands fa-facebook"></i>

                        </li>

                    </ul>

             </div>

            

        </div>

    </div>

    <div class="preloader" id="preloader">
       
        <div class="preloader-container">

            <div class="preloader-img-conatiner">

                <img src="assets/images/logodob.png" alt="" class="img-preloader">

            </div>

            <div class="preloader-gif">

                <img src="assets/images/loader.gif" alt="" class="loader-gif">

            </div>


        </div>

    </div>
    
    <div class="container">

        <!-- MENU SUPERIOR -->
        <header class="header">

            <nav class="menu-pc">

                <div class="container-menu">

                        <div class="menu-content">

                            <a href="." class="logo-container">

                                <img src="assets/images/logodob.png" alt="" class="logo">

                            </a>

                            <ul class="links">

                                <li>
                                
                                    <a href=".#home">Inicio</a>

                                </li>

                                <li>
                                
                                    <a href=".#info">Nosotros</a>

                                </li>

                                <li>
                                
                                    <a href=".#products">Productos</a>

                                </li>

                            
                                <li>
                                
                                    <a href=".#contact">Contacto</a>

                                </li>

                            </ul>

                        </div>

                </div>

            </nav>

            <nav class="menu-mobile">

                <div class="container-menu">

                        <div class="menu-content">

                            <a href="." class="logo-container">

                                <img src="assets/images/logodob.png" alt="" class="logo">

                            </a>


                            <div class="menu-button-container">

                                <button class="button-menu">

                                    <i class="fa-solid fa-bars" style="color:white;"></i>

                                </button>

                            </div>

                        </div>

                </div>

            </nav>

        </header>

        <?php  error404(); ?>

        <section class="home" id="home">

            <div class="home-container">

                <div class="content-container">

                    <a href="."><img src="assets/images/logodob.png" alt="" class="content-logo"></a>

                </div>

            </div>

        </section>

        <section id="info" class="info">

            <div class="info-container">

                <div class="info-text">

                    <h3 class="title-info">

                        <span>

                            Nosotros:

                        </span>

                    </h3>
            
                    <p class="content-text-info"> Praesent interdum congue mauris, et fringilla lacus pel vitae. Quisque nisl mauris, aliquam eu ultrices vel, conse vitae sapien at imperdiet risus. Quisque cursus risus id. fermentum, in auctor quam consectetur.</p>

                </div>

                <div class="carousel-container">

                    <div class="carousel-info">

                        <div class="list-info">

                            <div class="content-info">

                                <h3 class="text">

                                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Error odio nisi minus cupiditate unde adipisci, reprehenderit, nulla repellendus neque quasi deserunt soluta sapiente sed maiores veniam blanditiis? Officiis, iure! At?

                                </h3>

                            </div>

                        </div>

                    </div>
                    <div class="carousel-info">

                        <div class="list-info">

                            <div class="content-info">

                                <h3 class="text">

                                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Error odio nisi minus cupiditate unde adipisci, reprehenderit, nulla repellendus neque quasi deserunt soluta sapiente sed maiores veniam blanditiis? Officiis, iure! At?

                                </h3>

                            </div>

                        </div>

                    </div>
                    <div class="carousel-info">

                        <div class="list-info">

                            <div class="content-info">

                                <h3 class="text">

                                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Error odio nisi minus cupiditate unde adipisci, reprehenderit, nulla repellendus neque quasi deserunt soluta sapiente sed maiores veniam blanditiis? Officiis, iure! At?

                                </h3>

                            </div>

                        </div>

                    </div>


                    <div id="carousel-dots"></div>

                    <div class="mask-info"></div>

                </div>

        </section>
        
        <section id="products" class="products">

            <div class="container-products">

                <div class="products-text">

                    <h3 class="title-products">

                        <span>

                            Productos:

                        </span>

                    </h3>
            
                    <p class="content-products">Explora nuestra exquisita variedad de productos agrícolas locales de la más alta calidad. Manjares del Bierzo se compromete a proporcionar a sus clientes los mejores artículos del mercado, garantizando una experiencia culinaria inigualable.</p>

                </div>

                <div class="products-gallery">

                    <div class="products-gallery-buttons">

                     <button class="gallery-button">Legumbres</button>

                     <button class="gallery-button">Cebollas</button>

                     <button class="gallery-button">Ajos</button>

                    </div>

                    <div class="container-gallery legumes">


                        <div class="gallery-photo">

                            <div class="photo-content">

                                <h3 class="title-products">

                                    <span>

                                        Alubia redondilla

                                    </span>

                                </h3>   

                                <p class="content-products">Variedad de alubia redonda.</p>

                            </div>    

                        </div>
                        
                        <div class="gallery-photo">

                            <div class="photo-content">

                                <h3 class="title-products">

                                    <span>

                                        Garbanzo grande

                                    </span>

                                </h3>   

                                <p class="content-products">Garbanzo de tamaño grande utilizado en diversos platos.</p>

                            </div>    

                        </div>
                        
                        <div class="gallery-photo">

                            <div class="photo-content">

                                <h3 class="title-products">

                                    <span>

                                        Garbanzo pedro sillano

                                    </span>

                                </h3>   

                                <p class="content-products">Garbanzo de pequeño tamaño, de color marrón claro anaranjado.</p>

                            </div>    

                        </div>
                        
                        <div class="gallery-photo">

                            <div class="photo-content">

                                <h3 class="title-products">

                                    <span>

                                        Alubia canela

                                    </span>

                                </h3>   

                                <p class="content-products">Variedad de alubia pequeña y ovalada.</p>

                            </div>    

                        </div>
                        
                        <div class="gallery-photo">

                            <div class="photo-content">

                                <h3 class="title-products">

                                    <span>

                                        Alubia pinta

                                    </span>

                                </h3>   

                                <p class="content-products"> Alubia de color pinto, común en guisos.</p>

                            </div>    

                        </div>
                        
                        <div class="gallery-photo">

                            <div class="photo-content">

                                <h3 class="title-products">

                                    <span>

                                        alubia canellini de riñon

                                    </span>

                                </h3>   

                                <p class="content-products"> Alubia alargada con forma de riñón.</p>

                            </div>    

                        </div>
                        
                        <div class="gallery-photo">

                            <div class="photo-content">

                                <h3 class="title-products">

                                    <span>

                                        Alubia mandilín

                                    </span>

                                </h3>   

                                <p class="content-products">Alubia de color morado y blanco repartido por el grano a partes iguales.</p>

                            </div>    

                        </div>
                        
                        <div class="gallery-photo">

                            <div class="photo-content">

                                <h3 class="title-products">

                                    <span>

                                        Fabote

                                    </span>

                                </h3>   

                                <p class="content-products">Variedad de alubia grande y carnosa utilizada en guisos.</p>

                            </div>    

                        </div>
                        
                        <div class="gallery-photo">

                            <div class="photo-content">

                                <h3 class="title-products">

                                    <span>

                                        Lenteja pardina

                                    </span>

                                </h3>   

                                <p class="content-products">Pequeña lenteja de color pardo.</p>

                            </div>    

                        </div>
                        
                        <div class="gallery-photo">

                            <div class="photo-content">

                                <h3 class="title-products">

                                    <span>

                                        Alubia verdina

                                    </span>

                                </h3>   

                                <p class="content-products"> Pequeña alubia verde utilizada en guisos y ensaladas.</p>

                            </div>    

                        </div>
                        
                        <div class="gallery-photo">

                            <div class="photo-content">

                                <h3 class="title-products">

                                    <span>

                                        Fabada asturiana

                                    </span>

                                </h3>   

                                <p class="content-products">Variedad regional cultivada en Asturias.</p>

                            </div>    

                        </div>
                        
                        <div class="gallery-photo">

                            <div class="photo-content">

                                <h3 class="title-products">

                                    <span>

                                        Alubia roja

                                    </span>

                                </h3>   

                                <p class="content-products">Alubia de color rojo en forma de riñón.</p>

                            </div>    

                        </div>
                        
                    </div>

                    <div class="container-gallery onion">

                        <div class="gallery-photo">

                            <div class="photo-content">

                                <h3 class="title-products">

                                    <span>

                                        Cebolla de cocina

                                    </span>

                                </h3>   

                                <p class="content-products">Cebolla utilizada principalmente para cocinar.</p>

                            </div>    

                        </div>

                        <div class="gallery-photo">

                            <div class="photo-content">

                                <h3 class="title-products">

                                    <span>

                                        Cebolla dulce

                                    </span>

                                </h3>   

                                <p class="content-products">Variedad de cebolla de sabor suave.</p>

                            </div>    

                        </div>

                    </div>

                    <div class="container-gallery garlic">

                        <div class="gallery-photo">

                            <div class="photo-content">

                                <h3 class="title-products">

                                    <span>

                                        Ajo rojo

                                    </span>

                                </h3>   

                                <p class="content-products"> Variedad de ajo de sabor más intenso.</p>

                            </div>    

                        </div>

                        <div class="gallery-photo">

                            <div class="photo-content">

                                <h3 class="title-products">

                                    <span>

                                        Ajo blanco

                                    </span>

                                </h3>   

                                <p class="content-products">Variedad de ajo de sabor suave.</p>

                            </div>    

                        </div>


                    </div>

                </div>

            </div>

        </section>

        <section id="contact" class="contact">

            <div class="container-form">

                <div class="text-form">

                    <h3 class="title-form">

                        <span>

                            Contacto:

                        </span>

                    </h3>

                    <p class="content-form">Si tienes alguna pregunta o comentario, no dudes en ponerte en contacto con nosotros. Estamos aquí para ayudarte. Completa el formulario a continuación, y nos comunicaremos contigo lo antes posible. Tu opinión es importante para nosotros.</p>

                    <div class="about-info">

                        <p class="content-about-info"><span class="title-about-info">Address:</span>    10111 Santa Monica Boulevard, LA</p>

                        <p class="content-about-info"><span class="title-about-info">Phone:</span>    +44 987 065 908</p>

                        <p class="content-about-info"><span class="title-about-info">Email:</span>    info@Example.com</p>

                    </div>

                </div>

                <div class="content-input">

                    <form action="index.php" id="contact-form" method="post">

                        <div class="group mobile">

                            <input type="text" id="name" placeholder="nombre" name="name">

                            <span class='form-error-message' id="name-error-mobile"></span>

                            <input type="text" id="email" placeholder="Email" name="email">

                            <span class='form-error-message' id="mail-error-mobile"></span>

                        </div>

                        <div class="group error">

                            <span class='form-error-message' id="name-error"></span>

                            <span class='form-error-message' id="mail-error"></span>

                        </div>

                        <div class="group mobile">

                            <textarea  rows="15" id="coments" placeholder="Your Comment" name="coments"></textarea>

                            <span class='form-error-message' id="coments-error-mobile"></span>

                        </div>

                        <div class="group error">

                            <span class='form-error-message' id="coments-error"></span>

                        </div>

                        <div class="group">

                            <input id="sendMessage"  class="sendMessage" name="sendMessage" type="submit" value="Enviar Mensaje">

                        </div>


                        <div class="group success">

                            <span class='form-success-message' id="coments-error"></span>

                        </div>

                    </form>

                </div>

            </div>

        </section>

        <section id="cookies" class="cookies">

            <div class="info-cookies" id="legal-warning">

                <div class="container-info-cookies">

                    <div class="info-cookies-text">

                        <h3 class="title-info-cookies">

                            <span>

                            AVISO LEGAL Y CONDICIONES GENERALES DE USO:


                            </span>

                        </h3>

                        <h3 class="sub-title-info-cookies">

                            <span>

                                I. INFORMACIÓN GENERAL

                            </span>

                        </h3>

                        <p class="content-info-cookies">En cumplimiento con el deber de información dispuesto en la Ley 34/2002 de Servicios de la Sociedad de la Información y el Comercio Electrónico (LSSI-CE) de 11 de julio, se facilitan a continuación los siguientes datos de información general de este sitio web:</p>

                        <p class="content-info-cookies">La titularidad de este sitio web, \"nombre\", (en adelante, Sitio Web) la ostenta: \"nombre\", con NIF: \"nombre\", y cuyos datos de contacto son:</p>
                        
                        <p class="content-info-cookies">Dirección: \"nombre\"</p>

                        <p class="content-info-cookies">Teléfono de contacto: \"nombre\"</p>

                        <p class="content-info-cookies">Email de contacto: \"nombre\"</p>
                        
                        <h3 class="sub-title-info-cookies">

                            <span>

                                II. TÉRMINOS Y CONDICIONES GENERALES DE USO

                            </span>

                        </h3>

                        <h3 class="sub-title-info-cookies">

                            <span>

                                El objeto de las condiciones: El Sitio Web

                            </span>

                        </h3>

                        <p class="content-info-cookies">El objeto de las presentes Condiciones Generales de Uso (en adelante, Condiciones) es regular el acceso y la utilización del Sitio Web. A los efectos de las presentes Condiciones se entenderá como Sitio Web: la apariencia externa de los interfaces de pantalla, tanto de forma estática como de forma dinámica, es decir, el árbol de navegación; y todos los elementos integrados tanto en los interfaces de pantalla como en el árbol de navegación (en adelante, Contenidos) y todos aquellos servicios o recursos en línea que en su caso ofrezca a los Usuarios (en adelante, Servicios).</p>

                        <p class="content-info-cookies">\"nombre\" se reserva la facultad de modificar, en cualquier momento, y sin aviso previo, la presentación y configuración del Sitio Web y de los Contenidos y Servicios que en él pudieran estar incorporados. El Usuario reconoce y acepta que en cualquier momento \"nombre\" pueda interrumpir, desactivar y/o cancelar cualquiera de estos elementos que se integran en el Sitio Web o el acceso a los mismos.</p>

                        <p class="content-info-cookies">El acceso al Sitio Web por el Usuario tiene carácter libre y, por regla general, es gratuito sin que el Usuario tenga que proporcionar una contraprestación para poder disfrutar de ello, salvo en lo relativo al coste de conexión a través de la red de telecomunicaciones suministrada por el proveedor de acceso que hubiere contratado el Usuario.</p>

                        <p class="content-info-cookies">La utilización de alguno de los Contenidos o Servicios del Sitio Web podrá hacerse mediante la suscripción o registro previo del Usuario.</p>


                        <h3 class="sub-title-info-cookies">

                            <span>

                                El Usuario

                            </span>

                        </h3>

                        <p class="content-info-cookies">El acceso, la navegación y uso del Sitio Web, confiere la condición de Usuario, por lo que se aceptan, desde que se inicia la navegación por el Sitio Web, todas las Condiciones aquí establecidas, así como sus ulteriores modificaciones, sin perjuicio de la aplicación de la correspondiente normativa legal de obligado cumplimiento según el caso. Dada la relevancia de lo anterior, se recomienda al Usuario leerlas cada vez que visite el Sitio Web.</p>

                        <p class="content-info-cookies">El Sitio Web de \"nombre\" proporciona gran diversidad de información, servicios y datos. El Usuario asume su responsabilidad para realizar un uso correcto del Sitio Web. Esta responsabilidad se extenderá a:</p>

                        <ul>

                            <li><p class="content-info-cookies">Un uso de la información, Contenidos y/o Servicios y datos ofrecidos por \"nombre\" sin que sea contrario a lo dispuesto por las presentes Condiciones, la Ley, la moral o el orden público, o que de cualquier otro modo puedan suponer lesión de los derechos de terceros o del mismo funcionamiento del Sitio Web.</p></li>

                            <li><p class="content-info-cookies">La veracidad y licitud de las informaciones aportadas por el Usuario en los formularios extendidos por \"nombre\" para el acceso a ciertos Contenidos o Servicios ofrecidos por el Sitio Web. En todo caso, el Usuario notificará de forma inmediata a \"nombre\" acerca de cualquier hecho que permita el uso indebido de la información registrada en dichos formularios, tales como, pero no solo, el robo, extravío, o el acceso no autorizado a identificadores y/o contraseñas, con el fin de proceder a su inmediata cancelación.</p></li>

                        </ul>

                        <p class="content-info-cookies">El mero acceso a este Sitio Web no supone entablar ningún tipo de relación de carácter comercial entre\"nombre\" y el Usuario.</p>

                        <p class="content-info-cookies">Siempre en el respeto de la legislación vigente, este Sitio Web de \"nombre\" se dirige a todas las personas, sin importar su edad, que puedan acceder y/o navegar por las páginas del Sitio Web</p>

                        <p class="content-info-cookies">El Sitio Web está dirigido principalmente a Usuarios residentes en España. \"nombre\" no asegura que el Sitio Web cumpla con legislaciones de otros países, ya sea total o parcialmente. Si el Usuario reside o tiene su domiciliado en otro lugar y decide acceder y/o navegar en el Sitio Web lo hará bajo su propia responsabilidad, deberá asegurarse de que tal acceso y navegación cumple con la legislación local que le es aplicable, no asumiendo \"nombre\" responsabilidad alguna que se pueda derivar de dicho acceso.</p>
                        
                        <h3 class="sub-title-info-cookies">

                            <span>

                                III. ACCESO Y NAVEGACIÓN EN EL SITIO WEB: EXCLUSIÓN DE GARANTÍAS Y RESPONSABILIDAD

                            </span>

                        </h3>

                        <p class="content-info-cookies">\"nombre\" no garantiza la continuidad, disponibilidad y utilidad del Sitio Web, ni de los Contenidos o Servicios. \"nombre\" hará todo lo posible por el buen funcionamiento del Sitio Web, sin embargo, no se responsabiliza ni garantiza que el acceso a este Sitio Web no vaya a ser ininterrumpido o que esté libre de error.</p>

                        <p class="content-info-cookies">Tampoco se responsabiliza o garantiza que el contenido o software al que pueda accederse a través de este Sitio Web, esté libre de error o cause un daño al sistema informático (software y hardware) del Usuario. En ningún caso \"nombre\" será responsable por las pérdidas, daños o perjuicios de cualquier tipo que surjan por el acceso, navegación y el uso del Sitio Web, incluyéndose, pero no limitándose, a los ocasionados a los sistemas informáticos o los provocados por la introducción de virus.</p>

                        <p class="content-info-cookies">\"nombre\" tampoco se hace responsable de los daños que pudiesen ocasionarse a los usuarios por un uso inadecuado de este Sitio Web. En particular, no se hace responsable en modo alguno de las caídas, interrupciones, falta o defecto de las telecomunicaciones que pudieran ocurrir.</p>

                        <h3 class="sub-title-info-cookies">

                            <span>

                                IV. POLÍTICA DE ENLACES

                            </span>

                        </h3>

                        <p class="content-info-cookies">Se informa que el Sitio Web de \"nombre\" pone o puede poner a disposición de los Usuarios medios de enlace (como, entre otros, links, banners, botones), directorios y motores de búsqueda que permiten a los Usuarios acceder a sitios web pertenecientes y/o gestionados por terceros.</p>

                        <p class="content-info-cookies">La instalación de estos enlaces, directorios y motores de búsqueda en el Sitio Web tiene por objeto facilitar a los Usuarios la búsqueda de y acceso a la información disponible en Internet, sin que pueda considerarse una sugerencia, recomendación o invitación para la visita de los mismos.</p>

                        <p class="content-info-cookies">\"nombre\" no ofrece ni comercializa por sí ni por medio de terceros los productos y/o servicios disponibles en dichos sitios enlazados.</p>

                        <p class="content-info-cookies">Asimismo, tampoco garantizará la disponibilidad técnica, exactitud, veracidad, validez o legalidad de sitios ajenos a su propiedad a los que se pueda acceder por medio de los enlaces.</p>

                        <p class="content-info-cookies">\"nombre\" en ningún caso revisará o controlará el contenido de otros sitios web, así como tampoco aprueba, examina ni hace propios los productos y servicios, contenidos, archivos y cualquier otro material existente en los referidos sitios enlazados.</p>

                        <p class="content-info-cookies">\"nombre\" no asume ninguna responsabilidad por los daños y perjuicios que pudieran producirse por el acceso, uso, calidad o licitud de los contenidos, comunicaciones, opiniones, productos y servicios de los sitios web no gestionados por \"nombre\" y que sean enlazados en este Sitio Web.</p>

                        <p class="content-info-cookies">El Usuario o tercero que realice un hipervínculo desde una página web de otro, distinto, sitio web al Sitio Web de \"nombre\" deberá saber que:</p>

                        <p class="content-info-cookies">No se permite la reproducción —total o parcialmente— de ninguno de los Contenidos y/o Servicios del Sitio Web sin autorización expresa de \"nombre\"</p>

                        <p class="content-info-cookies">No se permite tampoco ninguna manifestación falsa, inexacta o incorrecta sobre el Sitio Web de \"nombre\", ni sobre los Contenidos y/o Servicios del mismo.</p>

                        <p class="content-info-cookies">A excepción del hipervínculo, el sitio web en el que se establezca dicho hiperenlace no contendrá ningún elemento, de este Sitio Web, protegido como propiedad intelectual por el ordenamiento jurídico español, salvo autorización expresa de \"nombre\".</p>

                        <p class="content-info-cookies">El establecimiento del hipervínculo no implicará la existencia de relaciones entre \"nombre\" y el titular del sitio web desde el cual se realice, ni el conocimiento y aceptación de \"nombre\" de los contenidos, servicios y/o actividades ofrecidas en dicho sitio web, y viceversa./p>

                        <h3 class="sub-title-info-cookies">

                            <span>

                                V. PROPIEDAD INTELECTUAL E INDUSTRIAL

                            </span>

                        </h3>

                        <p class="content-info-cookies">\"nombre\" por sí o como parte cesionaria, es titular de todos los derechos de propiedad intelectual e industrial del Sitio Web, así como de los elementos contenidos en el mismo (a título enunciativo y no exhaustivo, imágenes, sonido, audio, vídeo, software o textos, marcas o logotipos, combinaciones de colores, estructura y diseño, selección de materiales usados, programas de ordenador necesarios para su funcionamiento, acceso y uso, etc.). Serán, por consiguiente, obras protegidas como propiedad intelectual por el ordenamiento jurídico español, siéndoles aplicables tanto la normativa española y comunitaria en este campo, como los tratados internacionales relativos a la materia y suscritos por España.</p>

                        <p class="content-info-cookies">Todos los derechos reservados. En virtud de lo dispuesto en la Ley de Propiedad Intelectual, quedan expresamente prohibidas la reproducción, la distribución y la comunicación pública, incluida su modalidad de puesta a disposición, de la totalidad o parte de los contenidos de esta página web, con fines comerciales, en cualquier soporte y por cualquier medio técnico, sin la autorización de \"nombre\".</p>

                        <p class="content-info-cookies">El Usuario se compromete a respetar los derechos de propiedad intelectual e industrial de \"nombre\". Podrá visualizar los elementos del Sitio Web o incluso imprimirlos, copiarlos y almacenarlos en el disco duro de su ordenador o en cualquier otro soporte físico siempre y cuando sea, exclusivamente, para su uso personal. El Usuario, sin embargo, no podrá suprimir, alterar, o manipular cualquier dispositivo de protección o sistema de seguridad que estuviera instalado en el Sitio Web.</p>

                        <p class="content-info-cookies">En caso de que el Usuario o tercero considere que cualquiera de los Contenidos del Sitio Web suponga una violación de los derechos de protección de la propiedad intelectual, deberá comunicarlo inmediatamente a \"nombre\" a través de los datos de contacto del apartado de INFORMACIÓN GENERAL de este Aviso Legal y Condiciones Generales de Uso.</p>

                        <h3 class="sub-title-info-cookies">

                            <span>

                                VI. ACCIONES LEGALES, LEGISLACIÓN APLICABLE YJURISDICCIÓN

                            </span>

                        </h3>

                        <p class="content-info-cookies">\"nombre\" se reserva la facultad de presentar las acciones civiles o penales que considere necesarias por la utilización indebida del Sitio Web y Contenidos, o por el incumplimiento de las presentes Condiciones.</p>

                        <p class="content-info-cookies">La relación entre el Usuario y \"nombre\" se regirá por la normativa vigente y de aplicación en el territorio español. De surgir cualquier controversia en relación con la interpretación y/o a la aplicación de estas Condiciones las partes someterán sus conflictos a la jurisdicción ordinaria sometiéndose a los jueces y tribunales que correspondan conforme a derecho.</p>

                    </div>  

                </div>

            </div>
            
            <div class="info-cookies" id="privacy-policy">

                <div class="container-info-cookies">

                    <div class="info-cookies-text">

                        <h3 class="title-info-cookies">

                            <span>

                                POLÍTICA DE PRIVACIDAD DEL SITIO WEB:

                            </span>

                        </h3>

                        <h3 class="sub-title-info-cookies">

                            <span>

                                I. POLÍTICA DE PRIVACIDAD Y PROTECCIÓN DE DATOS

                            </span>

                        </h3>

                        <p class="content-info-cookies">Respetando lo establecido en la legislación vigente, \"nombre\" (en adelante, también Sitio Web) se compromete a adoptar las medidas técnicas y organizativas necesarias, según el nivel de seguridad adecuado al riesgo de los datos recogidos.</p>

                        
                        <h3 class="sub-title-info-cookies">

                            <span>

                                Leyes que incorpora esta política de privacidad

                            </span>

                        </h3>

                        <p class="content-info-cookies">Esta política de privacidad está adaptada a la normativa española y europea vigente en materia de protección de datos personales en internet. En concreto, la misma respeta las siguientes normas:</p>

                        <ul>

                            <li><p class="content-info-cookies">El Reglamento (UE) 2016/679 del Parlamento Europeo y del Consejo, de 27 de abril de 2016, relativo a la protección de las personas físicas en lo que respecta al tratamiento de datos personales y a la libre circulación de estos datos (RGPD).</p></li>
                
                            <li><p class="content-info-cookies">La Ley Orgánica 3/2018, de 5 de diciembre, de Protección de Datos Personales y garantía de los derechos digitales (LOPD-GDD).</p></li>

                            <li><p class="content-info-cookies">El Real Decreto 1720/2007, de 21 de diciembre, por el que se aprueba el Reglamento de desarrollo de la Ley Orgánica 15/1999, de 13 de diciembre, de Protección de Datos de Carácter Personal (RDLOPD).</p></li>

                            <li><p class="content-info-cookies">La Ley 34/2002, de 11 de julio, de Servicios de la Sociedad de la Información y de Comercio Electrónico (LSSI-CE)</p></li>

                        </ul>

                        <h3 class="sub-title-info-cookies">

                            <span>

                                Identidad del responsable del tratamiento de los datos personales

                            </span>

                        </h3>

                        <p class="content-info-cookies">El responsable del tratamiento de los datos personales recogidos en \"nombre\" es: \"nombre\", con NIF: \"nombre\" (en adelante, Responsable del tratamiento). Sus datos de contacto son los siguientes:</p>

                        <p class="content-info-cookies">Dirección: \"dirección\"</p>

                        <p class="content-info-cookies">Teléfono de contacto:</p>

                        <p class="content-info-cookies">Email de contacto: \"correo\"</p>

                        <h3 class="sub-title-info-cookies">

                            <span>

                                Registro de Datos de Carácter Personal

                            </span>

                        </h3>

                        <p class="content-info-cookies">En cumplimiento de lo establecido en el RGPD y la LOPD-GDD, le informamos que los datos personales recabados por \"nombre\", mediante los formularios extendidos en sus páginas quedarán incorporados y serán tratados en nuestro fichero con el fin de poder facilitar, agilizar y cumplir los compromisos establecidos entre \"nombre\" y el Usuario o el mantenimiento de la relación que se establezca en los formularios que este rellene, o para atender una solicitud o consulta del mismo. Asimismo, de conformidad con lo previsto en el RGPD y la LOPD-GDD, salvo que sea de aplicación la excepción prevista en el artículo 30.5 del RGPD, se mantiene un registro de actividades de tratamiento que especifica, según sus finalidades, las actividades de tratamiento llevadas a cabo y las demás circunstancias establecidas en el RGPD.</p>

                        <h3 class="sub-title-info-cookies">

                            <span>

                                Principios aplicables al tratamiento de los datos personales

                            </span>

                        </h3>

                        <p class="content-info-cookies">El tratamiento de los datos personales del Usuario se someterá a los siguientes principios recogidos en el artículo 5 del RGPD y en el artículo 4 y siguientes de la Ley Orgánica 3/2018, de 5 de diciembre, de Protección de Datos Personales y garantía de los derechos digitales:</p>

                        <ul>

                            <li><p class="content-info-cookies">Principio de licitud, lealtad y transparencia: se requerirá en todo momento el consentimiento del Usuario previa información completamente transparente de los fines para los cuales se recogen los datos personales.</p></li>
                
                            <li><p class="content-info-cookies">Principio de limitación de la finalidad: los datos personales serán recogidos con fines determinados, explícitos y legítimos</p></li>

                            <li><p class="content-info-cookies">Principio de minimización de datos: los datos personales recogidos serán únicamente los estrictamente necesarios en relación con los fines para los que son tratados.</p></li>

                            <li><p class="content-info-cookies">Principio de exactitud: los datos personales deben ser exactos y estar siempre actualizados.</p></li>

                            <li><p class="content-info-cookies">Principio de limitación del plazo de conservación: los datos personales solo serán mantenidos de forma que se permita la identificación del Usuario durante el tiempo necesario para los fines de su tratamiento.</p></li>

                            <li><p class="content-info-cookies">Principio de integridad y confidencialidad: los datos personales serán tratados de manera que se garantice su seguridad y confidencialidad</p></li>

                            <li><p class="content-info-cookies">Principio de responsabilidad proactiva: el Responsable del tratamiento será responsable de asegurar que los principios anteriores se cumplen.</p></li>

                        </ul>

                        <h3 class="sub-title-info-cookies">

                            <span>

                                Categorías de datos personales

                            </span>

                        </h3>

                        <p class="content-info-cookies">Las categorías de datos que se tratan en \"nombre\" son únicamente datos identificativos. En ningún caso, se tratan categorías especiales de datos personales en el sentido del artículo 9 del RGPD.</p>
                
                    

                        <h3 class="sub-title-info-cookies">

                            <span>

                                Base legal para el tratamiento de los datos personales

                            </span>

                        </h3>

                        <p class="content-info-cookies">La base legal para el tratamiento de los datos personales es el consentimiento. \"nombre\" se compromete a recabar el consentimiento expreso y verificable del Usuario para el tratamiento de sus datos personales para uno o varios fines específicos.</p>

                        <p class="content-info-cookies">El Usuario tendrá derecho a retirar su consentimiento en cualquier momento. Será tan fácil retirar el consentimiento como darlo. Como regla general, la retirada del consentimiento no condicionará el uso del Sitio Web</p>
                
                        <p class="content-info-cookies">En las ocasiones en las que el Usuario deba o pueda facilitar sus datos a través de formularios para realizar consultas, solicitar información o por motivos relacionados con el contenido del Sitio Web, se le informará en caso de que la cumplimentación de alguno de ellos sea obligatoria debido a que los mismos sean imprescindibles para el correcto desarrollo de la operación realizada.</p>
                    
                        <h3 class="sub-title-info-cookies">

                            <span>

                                Fines del tratamiento a que se destinan los datos personales

                            </span>

                        </h3>

                        <p class="content-info-cookies">Los datos personales son recabados y gestionados por \"nombre\" con la finalidad de poder facilitar, agilizar y cumplir los compromisos establecidos entre el Sitio Web y el Usuario o el mantenimiento de la relación que se establezca en los formularios que este último rellene o para atender una solicitud o consulta.</p>

                        <p class="content-info-cookies">Igualmente, los datos podrán ser utilizados con una finalidad comercial de personalización, operativa y estadística, y actividades propias del objeto social de \"nombre\", así como para la extracción, almacenamiento de datos y estudios de marketing para adecuar el Contenido ofertado al Usuario, así como mejorar la calidad, funcionamiento y navegación por el Sitio Web.</p>
                
                        <p class="content-info-cookies">En el momento en que se obtengan los datos personales, se informará al Usuario acerca del fin o fines específicos del tratamiento a que se destinarán los datos personales; es decir, del uso o usos que se dará a la información recopilada.</p>

                        <h3 class="sub-title-info-cookies">

                            <span>

                                Períodos de retención de los datos personales

                            </span>
                            
                        </h3>

                        <p class="content-info-cookies">Los datos personales solo serán retenidos durante el tiempo mínimo necesario para los fines de su tratamiento y, en todo caso, únicamente durante el siguiente plazo: 12 meses, o hasta que el Usuario solicite su supresión.</p>

                        <p class="content-info-cookies">En el momento en que se obtengan los datos personales, se informará al Usuario acerca del plazo durante el cual se conservarán los datos personales o, cuando eso no sea posible, los criterios utilizados para determinar este plazo.</p>
                
                        <h3 class="sub-title-info-cookies">

                            <span>

                                Destinatarios de los datos personales

                            </span>

                        </h3>

                        <p class="content-info-cookies">En caso de que el Responsable del tratamiento tenga la intención de transferir datos personales a un tercer país u organización internacional, en el momento en que se obtengan los datos personales, se informará al Usuario acerca del tercer país u organización internacional al cual se tiene la intención de transferir los datos, así como de la existencia o ausencia de una decisión de adecuación de la Comisión.</p>

                    
                        <h3 class="sub-title-info-cookies">

                            <span>

                                Datos personales de menores de edad

                            </span>

                        </h3>

                        <p class="content-info-cookies">Respetando lo establecido en los artículos 8 del RGPD y 7 de la Ley Orgánica 3/2018, de 5 de diciembre, de Protección de Datos Personales y garantía de los derechos digitales, solo los mayores de 14 años podrán otorgar su consentimiento para el tratamiento de sus datos personales de forma lícita por \"nombre\". Si se trata de un menor de 14 años, será necesario el consentimiento de los padres o tutores para el tratamiento, y este solo se considerará lícito en la medida en la que los mismos lo hayan autorizado</p>

                        <h3 class="sub-title-info-cookies">

                            <span>

                                Secreto y seguridad de los datos personales

                            </span>

                        </h3>

                        <p class="content-info-cookies">\"nombre\" se compromete a adoptar las medidas técnicas y organizativas necesarias, según el nivel de seguridad adecuado al riesgo de los datos recogidos, de forma que se garantice la seguridad de los datos de carácter personal y se evite la destrucción, pérdida o alteración accidental o ilícita de datos personales transmitidos, conservados o tratados de otra forma, o la comunicación o acceso no autorizados a dichos datos.</p>

                        <p class="content-info-cookies">El Sitio Web cuenta con un certificado SSL (Secure Socket Layer), que asegura que los datos personales se transmiten de forma segura y confidencial, al ser la transmisión de los datos entre el servidor y el Usuario, y en retroalimentación, totalmente cifrada o encriptada.</p>
                
                        <p class="content-info-cookies">Sin embargo, debido a que \"nombre\" no puede garantizar la inexpugnabilidad de internet ni la ausencia total de hackers u otros que accedan de modo fraudulento a los datos personales, el Responsable del tratamiento se compromete a comunicar al Usuario sin dilación indebida cuando ocurra una violación de la seguridad de los datos personales que sea probable que entrañe un alto riesgo para los derechos y libertades de las personas físicas. Siguiendo lo establecido en el artículo 4 del RGPD, se entiende por violación de la seguridad de los datos personales toda violación de la seguridad que ocasione la destrucción, pérdida o alteración accidental o ilícita de datos personales transmitidos, conservados o tratados de otra forma, o la comunicación o acceso no autorizados a dichos datos.</p>
                        
                        <p class="content-info-cookies">Los datos personales serán tratados como confidenciales por el Responsable del tratamiento, quien se compromete a informar de y a garantizar por medio de una obligación legal o contractual que dicha confidencialidad sea respetada por sus empleados, asociados, y toda persona a la cual le haga accesible la información.</p>

                        <h3 class="sub-title-info-cookies">

                            <span>

                                Derechos derivados del tratamiento de los datos personales

                            </span>

                        </h3>

                        <p class="content-info-cookies">El Usuario tiene sobre \"nombre\" y podrá, por tanto, ejercer frente al Responsable del tratamiento los siguientes derechos reconocidos en el RGPD y la Ley Orgánica 3/2018, de 5 de diciembre, de Protección de Datos Personales y garantía de los derechos digitales:</p>

                        <ul>

                            <li><p class="content-info-cookies">Derecho de acceso: Es el derecho del Usuario a obtener confirmación de si \"nombre\" está tratando o no sus datos personales y, en caso afirmativo, obtener información sobre sus datos concretos de carácter personal y del tratamiento que \"nombre\" haya realizado o realice, así como, entre otra, de la información disponible sobre el origen</p></li>
                
                            <li><p class="content-info-cookies">Derecho de rectificación: Es el derecho del Usuario a que se modifiquen sus datos personales que resulten ser inexactos o, teniendo en cuenta los fines del tratamiento, incompletos.</p></li>

                            <li><p class="content-info-cookies">Derecho de supresión (\"el derecho al olvido\"): Es el derecho del Usuario, siempre que la legislación vigente no establezca lo contrario, a obtener la supresión de sus datos personales cuando estos ya no sean necesarios para los fines para los cuales fueron recogidos o tratados; el Usuario haya retirado su consentimiento al tratamiento y este no cuente con otra base legal; el Usuario se oponga al tratamiento y no exista otro motivo legítimo para continuar con el mismo; los datos personales hayan sido tratados ilícitamente; los datos personales deban suprimirse en cumplimiento de una obligación legal; o los datos personales hayan sido obtenidos producto de una oferta directa de servicios de la sociedad de la información a un menor de 14 años. Además de suprimir los datos, el Responsable del tratamiento, teniendo en cuenta la tecnología disponible y el coste de su aplicación, deberá adoptar medidas razonables para informar a los responsables que estén tratando los datos personales de la solicitud del interesado de supresión de cualquier enlace a esos datos personales.</p></li>

                            <li><p class="content-info-cookies">Derecho a la limitación del tratamiento: Es el derecho del Usuario a limitar el tratamiento de sus datos personales. El Usuario tiene derecho a obtener la limitación del tratamiento cuando impugne la exactitud de sus datos personales; el tratamiento sea ilícito; el Responsable del tratamiento ya no necesite los datos personales, pero el Usuario lo necesite para hacer reclamaciones; y cuando el Usuario se haya opuesto al tratamiento.</p></li>

                            <li><p class="content-info-cookies">Derecho a la portabilidad de los datos: En caso de que el tratamiento se efectúe por medios automatizados, el Usuario tendrá derecho a recibir del Responsable del tratamiento sus datos personales en un formato estructurado, de uso común y lectura mecánica, y a transmitirlos a otro responsable del tratamiento. Siempre que sea técnicamente posible, el Responsable del tratamiento transmitirá directamente los datos a ese otro responsable.</p></li>

                            <li><p class="content-info-cookies">Derecho de oposición: Es el derecho del Usuario a que no se lleve a cabo el tratamiento de sus datos de carácter personal o se cese el tratamiento de los mismos por parte de \"nombre\".</p></li>

                            <li><p class="content-info-cookies">Derecho a no ser objeto de una decisión basada únicamente en el tratamiento automatizado, incluida la elaboración de perfiles: Es el derecho del Usuario a no ser objeto de una decisión individualizada basada únicamente en el tratamiento automatizado de sus datos personales, incluida la elaboración de perfiles, existente salvo que la legislación vigente establezca lo contrario.</p></li>

                        </ul>

                        <p class="content-info-cookies">Así pues, el Usuario podrá ejercitar sus derechos mediante comunicación escrita dirigida al Responsable del tratamiento con la referencia \"RGPD-www.web.con\", especificando:</p>

                        <ul>

                            <li><p class="content-info-cookies">Nombre, apellidos del Usuario y copia del DNI. En los casos en que se admita la representación, será también necesaria la identificación por el mismo medio de la persona que representa al Usuario, así como el documento acreditativo de la representación. La fotocopia del DNI podrá ser sustituida, por cualquier otro medio válido en derecho que acredite la identidad.</p></li>

                            <li><p class="content-info-cookies">Petición con los motivos específicos de la solicitud o información a la que se quiere acceder.</p></li>

                            <li><p class="content-info-cookies">Domicilio a efecto de notificaciones.</p></li>

                            <li><p class="content-info-cookies">Fecha y firma del solicitante</p></li>

                            <li><p class="content-info-cookies">Todo documento que acredite la petición que formula</p></li>

                        </ul>

                        <p class="content-info-cookies">Esta solicitud y todo otro documento adjunto podrá enviarse a la siguiente dirección y/o correo electrónico:</p>

                        <p class="content-info-cookies">Dirección postal: \"dirección\"</p>

                        <p class="content-info-cookies">Correo electrónico: \"correo\"</p>

                        <h3 class="sub-title-info-cookies">

                            <span>

                                Enlaces a sitios web de terceros

                            </span>

                        </h3>

                        <p class="content-info-cookies">El Sitio Web puede incluir hipervínculos o enlaces que permiten acceder a páginas web de terceros distintos de \"nombre\", y que por tanto no son operados por \"nombre\". Los titulares de dichos sitios web dispondrán de sus propias políticas de protección de datos, siendo ellos mismos, en cada caso, responsables de sus propios ficheros y de sus propias prácticas de privacidad.</p>


                        <h3 class="sub-title-info-cookies">

                            <span>

                                Reclamaciones ante la autoridad de control

                            </span>

                        </h3>

                        <p class="content-info-cookies">En caso de que el Usuario considere que existe un problema o infracción de la normativa vigente en la forma en la que se están tratando sus datos personales, tendrá derecho a la tutela judicial efectiva y a presentar una reclamación ante una autoridad de control, en particular, en el Estado en el que tenga su residencia habitual, lugar de trabajo o lugar de la supuesta infracción. En el caso de España, la autoridad de control es la Agencia Española de Protección de Datos (https://www.aepd.es/).</p>

                            <h3 class="sub-title-info-cookies">

                                <span>

                                    II. ACEPTACIÓN Y CAMBIOS EN ESTA POLÍTICA DE PRIVACIDAD

                                </span>

                            </h3>

                            <p class="content-info-cookies">Es necesario que el Usuario haya leído y esté conforme con las condiciones sobre la protección de datos de carácter personal contenidas en esta Política de Privacidad, así como que acepte el tratamiento de sus datos personales para que el Responsable del tratamiento pueda proceder al mismo en la forma, durante los plazos y para las finalidades indicadas. El uso del Sitio Web implicará la aceptación de la Política de Privacidad del mismo</p>

                            <p class="content-info-cookies">\"nombre\" se reserva el derecho a modificar su Política de Privacidad, de acuerdo a su propio criterio, o motivado por un cambio legislativo, jurisprudencial o doctrinal de la Agencia Española de Protección de Datos. Los cambios o actualizaciones de esta Política de Privacidad no serán notificados de forma explícita al Usuario. Se recomienda al Usuario consultar esta página de forma periódica para estar al tanto de los últimos cambios o actualizaciones.</p>

                            <p class="content-info-cookies">Esta Política de Privacidad fue actualizada para adaptarse al Reglamento (UE) 2016/679 del Parlamento Europeo y del Consejo, de 27 de abril de 2016, relativo a la protección de las personas físicas en lo que respecta al tratamiento de datos personales y a la libre circulación de estos datos (RGPD) y a la Ley Orgánica 3/2018, de 5 de diciembre, de Protección de Datos Personales y garantía de los derechos digitales.</p>
                    
                    </div>  
                
                </div>

            </div>

            <div class="info-cookies" id="cookies-policy">

                <div class="container-info-cookies">

                    <div class="info-cookies-text">

                        <h3 class="title-info-cookies">

                            <span>

                                POLÍTICA DE COOKIES:

                            </span>

                        </h3>

                        <p class="content-info-cookies">El acceso a este Sitio Web puede implicar la utilización de cookies. Las cookies son pequeñas cantidades de información que se almacenan en el navegador utilizado por cada Usuario —en los distintos dispositivos que pueda utilizar para navegar— para que el servidor recuerde cierta información que posteriormente y únicamente el servidor que la implementó leerá. Las cookies facilitan la navegación, la hacen más amigable, y no dañan el dispositivo de navegación.</p>

                        <p class="content-info-cookies">Las cookies son procedimientos automáticos de recogida de información relativa a las preferencias determinadas por el Usuario durante su visita al Sitio Web con el fin de reconocerlo como Usuario, y personalizar su experiencia y el uso del Sitio Web, y pueden también, por ejemplo, ayudar a identificar y resolver errores</p>

                        <p class="content-info-cookies">La información recabada a través de las cookies puede incluir la fecha y hora de visitas al Sitio Web, las páginas visionadas, el tiempo que ha estado en el Sitio Web y los sitios visitados justo antes y después del mismo. Sin embargo, ninguna cookie permite que esta misma pueda contactarse con el número de teléfono del Usuario o con cualquier otro medio de contacto personal. Ninguna cookie puede extraer información del disco duro del Usuario o robar información personal. La única manera de que la información privada del Usuario forme parte del archivo Cookie es que el usuario dé personalmente esa información al servidor.</p>

                        <p class="content-info-cookies">Las cookies que permiten identificar a una persona se consideran datos personales. Por tanto, a las mismas les será de aplicación la Política de Privacidad anteriormente descrita. En este sentido, para la utilización de las mismas será necesario el consentimiento del Usuario. Este consentimiento será comunicado, en base a una elección auténtica, ofrecido mediante una decisión afirmativa y positiva, antes del tratamiento inicial, removible y documentado.</p>

                        <h3 class="sub-title-info-cookies">

                            <span>

                                Cookies propias

                            </span>

                        </h3>

                        <p class="content-info-cookies">Son aquellas cookies que son enviadas al ordenador o dispositivo del Usuario y gestionadas exclusivamente por \"nombre\" para el mejor funcionamiento del Sitio Web. La información que se recaba se emplea para mejorar la calidad del Sitio Web y su Contenido y su experiencia como Usuario. Estas cookies permiten reconocer al Usuario como visitante recurrente del Sitio Web y adaptar el contenido para ofrecerle contenidos que se ajusten a sus preferencias.</p>

                        <h3 class="sub-title-info-cookies">

                            <span>

                                Cookies de terceros

                            </span>

                        </h3>

                        <p class="content-info-cookies">Son cookies utilizadas y gestionadas por entidades externas que proporcionan a \"nombre\" servicios solicitados por este mismo para mejorar el Sitio Web y la experiencia del usuario al navegar en el Sitio Web. Los principales objetivos para los que se utilizan cookies de terceros son la obtención de estadísticas de accesos y analizar la información de la navegación, es decir, cómo interactúa el Usuario con el Sitio Web.</p>

                        <p class="content-info-cookies">La información que se obtiene se refiere, por ejemplo, al número de páginas visitadas, el idioma, el lugar a la que la dirección IP desde el que accede el Usuario, el número de Usuarios que acceden, la frecuencia y reincidencia de las visitas, el tiempo de visita, el navegador que usan, el operador o tipo de dispositivo desde el que se realiza la visita. Esta información se utiliza para mejorar el Sitio Web, y detectar nuevas necesidades para ofrecer a los Usuarios un Contenido y/o servicio de óptima calidad. En todo caso, la información se recopila de forma anónima y se elaboran informes de tendencias del Sitio Web sin identificar a usuarios individuales.</p>

                        <p class="content-info-cookies">La(s) entidad(es) encargada(s) del suministro de cookies podrá(n) ceder esta información a terceros, siempre y cuando lo exija la ley o sea un tercero el que procese esta información para dichas entidades</p>

                        <h3 class="sub-title-info-cookies">

                            <span>

                                Deshabilitar, rechazar y eliminar cookies

                            </span>

                        </h3>

                        <p class="content-info-cookies">El Usuario puede deshabilitar, rechazar y eliminar las cookies —total o parcialmente— instaladas en su dispositivo mediante la configuración de su navegador (entre los que se encuentran, por ejemplo, Chrome, Firefox, Safari, Explorer). En este sentido, los procedimientos para rechazar y eliminar las cookies pueden diferir de un navegador de Internet a otro. En consecuencia, el Usuario debe acudir a las instrucciones facilitadas por el propio navegador de Internet que esté utilizando. En el supuesto de que rechace el uso de cookies —total o parcialmente— podrá seguir usando el Sitio Web, si bien podrá tener limitada la utilización de algunas de las prestaciones del mismo.</p>

                    </div>  

                </div>

            </div>

        </section>

        <section class="footer" id="footer">

            <div class="container-footer">

                <div class="footer-content">


                    <div class="footer-links">

                        <ul>
                            <li>

                                <i class="fa-brands fa-twitter"></i>

                            </li>

                            <li>

                                <i class="fa-brands fa-instagram"></i>

                            </li>

                            <li>

                                <i class="fa-brands fa-facebook"></i>

                            </li>

                        </ul>

                    </div>

                    <div class="footer-text">


                            <p>2023 © Diseño y código por Websing.</p>

                    </div>


                </div>

            </div>

        </section>

    </div>  

</body>

</html>

