<?php 

session_start();
if (!isset($_SESSION["usuario"])) {
    header("Location: index.php");
    exit();
}

?>

<div class="menu-mobile-container" id="menu-mobile-container">
       
       <div class="menu-mobile-content">

           <div class="menu-close-button-container">

               <button class="menu-mobile-close-button">

                   <i class="fa-solid fa-xmark" style="color:white;"></i>

               </button>

           </div>

           <ul class="menu-mobile-links">

               <li>
               
                   <a href="/">WEB</a>

               </li>

               <li>
               
                   <a href=".#info">Categorías</a>

               </li>

               <li>
               
                   <a href=".#products">Productos</a>

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

<header class="header">

<nav class="menu-pc">

    <div class="container-menu">

            <div class="menu-content">

                <a href="." class="logo-container">

                    <img src="assets/images/logodob.png" alt="" class="logo">

                </a>

                <ul class="links">

                    <li>
                    
                        <a href="index.php">WEB</a>

                    </li>

                    <li>
                    
                        <a href="listarProductos.php">Productos</a>

                    </li>

                
                    <li>
                    
                        <a href="listarCategorias.php">Categorías</a>

                    </li>

                    <li>
                    
                        <a href="listarCategorias.php">Nombre usuario</a>

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
