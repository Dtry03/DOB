//SELECCIONAR TEXTO DE INPUT TYPE FILE 
if(document.getElementById("rutaImagen")){
    document.getElementById("rutaImagen").addEventListener("change", function () {
    let fileName = this.files.length > 0 ? this.files[0].name : "Ningún archivo seleccionado";
    document.querySelector(".file-name").textContent = fileName;
   });
}
//-----------------------------------------------------------------

// CAMBIAR EL MENU DE COLOR AL DESLIZAR LA PÁGINA HACIA ABAJO

addEventListener('scroll', () => {

    var header= document.querySelector(".header");

    var links= document.querySelector(".links");
    
    if(window.scrollY>0){

        header.classList.add("scroll");

        links.classList.add("scroll");


    }else{

        header.classList.remove("scroll");

        links.classList.remove("scroll");
    }

})

//-----------------------------------------------------------------

// EFECTO DE ESCRITURA DE MÁQUINA

var phrases = [

    "frase ejemplo 1",
    "frase ejemplo 2",
    "frase ejemplo 3"
];

var writeSpeed= 50;

var sleepTime=1000;

function writeDelete() {

    var index=1;

    function write() {

        var i=0;
        var writeInterval = setInterval(() => {

            $(".write").append(phrases[index][i]);

            i++;

            if (i === phrases[index].length) {
                
                clearInterval(writeInterval);

                setTimeout(() => {

                   deleteText();
                    
                }, sleepTime);

            }
            
        }, writeSpeed);
        
    }
    

    function deleteText() {
        
       var i = phrases[index].length-1;

       var deleteInterval = setInterval(() => {

        var text= $(".write").text();

        $(".write").text(text.slice(0,i));

        i--;

        if (i < 0) {
            
            clearInterval(deleteInterval);

            index = (index + 1) % phrases.length;

            setTimeout(() => {

                write();
                
            }, sleepTime);

        }
        
    }, writeSpeed);
    }

    write();
}

$(document).ready(function name() {

    writeDelete();
    
});

//-----------------------------------------------------------------

// ANIMACIÓN CAROUSEL

$(document).ready(() => {

    var slideIndex=1;

    var totalSlides= $(".carousel-info").length;

    var slideWidht;

    var isDragging= false;

    var startX, endX, offSetX= 0;


    function showSlide(index) {

        var slideWidht= $("body").width();

        leftPosition= -((index-1) * slideWidht + offSetX);

        $(".carousel-info .text").css("transform", "translateX("+ leftPosition+"px)");
    }


    function updateDots(index) {

        $(".dot").removeClass("active-dot");

        $(".dot[data-index='"+ index +"']").addClass("active-dot");
        
    }

    for (var i =0; i < totalSlides; i++) {

        $("#carousel-dots").append('<div class="dot" data-index="' + i + '"></div>');
        
    }

    $(".dot:first").addClass("active-dot");

    $(".dot").on("click", function(){

        var clickedIndex= $(this).data('index');

        slideIndex= clickedIndex;

        showSlide(slideIndex);

        updateDots(slideIndex);

    });

    $(".carousel-info .list-info").on("mousedown touchstart", function (e) {
        
        isDragging=true;

        startX= e.pageX || e.originalEvent.changedTouches[0].pageX;

        $(".carousel-info .list-info").addClass('dragging');

    });


    $(".carousel-info .list-info").on("mouseup touchend", function (e) {

        if (isDragging) {

            isDragging=true;

            endX= e.pageX || e.originalEvent.changedTouches[0].pageX;

            deltaX= startX -endX;

            if (Math.abs(deltaX)>10) {

                slideIndex = (deltaX > 0 ? slideIndex + 1 : slideIndex -1 + totalSlides)  % totalSlides;
                
            } else {
                
                slideIndex = Math.round(slideIndex);

            }

            isDragging= false;

            $(".carousel-info .list-info").removeClass('dragging');

            offSetX=0;

            showSlide(slideIndex);

            updateDots(slideIndex);

        }
        
    });

    $(".carousel-info .list-info").on("mousemove touchmove", function (e) {

        if (isDragging) {

            endX= e.pageX || e.originalEvent.changedTouches[0].pageX;
           
                offSetX= startX - endX;

                showSlide(slideIndex);
            
        }
        
    });


    setInterval(() => {

        if (!isDragging) {

            slideIndex = (slideIndex+ 1) % totalSlides;

            showSlide(slideIndex);

            updateDots(slideIndex);

        }
        
    }, 5000);

});

//-----------------------------------------------------------------

// ANIMACIÓN MENU GALERÍA PRODUCTOS

$(document).ready(()=> {

    $(".products-gallery-buttons button:first-child").addClass("active");

    $(".products-gallery-buttons button").click(function(){ 

        if (!$(this).hasClass("active")) {

            ProductsAnimation(this);

            $(".products-gallery-buttons button").removeClass("active");

            $(this).addClass("active");
            
        }
        
    });


  
        
    });


//-----------------------------------------------------------------

// ANIMACIÓN AL PULSAR EN BOTÓN MENÚ

function ProductsAnimation(e) {
    
    if (e.innerText=="CEBOLLAS") {

        var animation= galleryAnimationInversed().promise();
        
        animation.then(function() {

            $(".container-gallery").css("display", "none");

            $(".onion").css("display", "grid");

            galleryOtherAnimation();
    
        });

    } else if(e.innerText=="LEGUMBRES"){

        var animation= galleryAnimationInversed().promise();
        
        animation.then(function() {

            $(".container-gallery").css("display", "none");

            $(".legumes").css("display", "grid");

            galleryAnimation();

        });
        
    }else if(e.innerText=="AJOS"){

        var animation= galleryAnimationInversed().promise();
        
        animation.then(function() {

            $(".container-gallery").css("display", "none");

            $(".garlic").css("display", "grid");

            galleryOtherAnimation();

        });
        
    }
    
}

        
//-----------------------------------------------------------------

// ANIMACIÓN AL PASAR CURSOR POR ENCIMA PRODUCTOS GALERIA

$(document).ready(() => {
    
    $(".gallery-photo").hover(

        function () {
 
            $(this).css({

                '--before-bg-color': 'rgba(0, 0, 0, 0.856)'
            });

            $(this).find(".photo-content").addClass("active");

            $(this).find(".photo-content .title-products span").animate({

                bottom: 0,
                opacity:1

            },500);

            $(this).find(".photo-content .content-products").animate({

                bottom: 0,
                opacity:1

            },500);

        },

        function () {

       
            $(this).css({

                '--before-bg-color': 'rgba(0, 0, 0, 0)'

            });

            $(this).find(".photo-content").removeClass("active");

            $(this).find(".photo-content .title-products span").animate({

                bottom: "-10%",
                opacity:0

            },500);

            $(this).find(".photo-content .content-products").animate({

                bottom: "-10%",
                opacity:0

            },500);
        }
    );
});

//-----------------------------------------------------------------

// FUNCIÓN ANIMACIONES GALERÍA

function galleryAnimation() {

    var animation1 = $(".gallery-photo:nth-child(3n-2)").animate({

        opacity:1,

        left: "0"

    },250).promise();


    var animation2 = animation1.then( function() {

        return $(".gallery-photo:nth-child(3n-1)").animate({

            opacity:1,

            left: "0"

        },250).promise();

    });


    animation2.then(function() {

        $(".gallery-photo:nth-child(3n-3)").animate({

            opacity:1,

            left: "0"

        },250);

    });
    
}

function galleryAnimationInversed() {

    var deferred = $.Deferred();

    var animation1 = $(".gallery-photo:nth-child(3n-2)").animate({

        opacity:0,

        left: "-50%"

    },250).promise();


    var animation2 = animation1.then( function() {

        return $(".gallery-photo:nth-child(3n-1)").animate({

            opacity:0,

            left: "-50%"

        },250).promise();

    });


    animation2.then(function() {

        $(".gallery-photo:nth-child(3n-3)").animate({

            opacity:0,

            left: "-50%"

        },250, async function() {

            await sleep(300);
            
            deferred.resolve();

        });

        

    });

    

    return deferred.promise();
    
}


function galleryOtherAnimation() {

    $(".gallery-photo:nth-child(1)").animate({

        opacity:1,

        left: 0

    },250);


     
    $(".gallery-photo:nth-child(2)").animate({

        opacity:1,
        left: "-100%"

    },250);

  
    
}

    
function sleep(milliseconds) {
    return new Promise(resolve => setTimeout(resolve, milliseconds));
  }
//-----------------------------------------------------------------

// ANIMACIONES AL CARGAR LA PÁGINA

$(document).ready(() =>{

    const observerAnimationAbout = new IntersectionObserver(entries =>{

        entries.forEach(entry => {

            if (entry.isIntersecting) {
               
                
                var animation1 = $(".info-text  h3 span").animate({

                    opacity:1,

                    left: 0

                },600).promise();

                var animation2 = animation1.then(function() {
                   
                    return $(".info-container .content-text-info").animate({

                        opacity:1,
    
                        left: 0
    
                    },600).promise();

                });
                
                var animation3 = animation2.then(function() {

                    
                    $(".carousel-container").animate({

                        opacity:1,
    
    
                    },600);
                    
                    
            
                });

                animation3.then();

            }

        });


    });


    const observerAnimationProducts = new IntersectionObserver(entries =>{

        entries.forEach(entry => {

            if (entry.isIntersecting) {
               
                
                var animation1 = $(".products-text  h3 span").animate({

                    opacity:1,

                    left: 0

                },600).promise();

                var animation2 = animation1.then(function() {
                   
                    return $(".products-text  .content-products").animate({

                        opacity:1,
    
                        left: 0
    
                    },600).promise();

                });
                
                var animation3 = animation2.then(function() {

                    
                    $(".products-gallery-buttons").animate({

                        opacity:1,

                      
    
    
                    },600)  
            
                });

                animation3.then(function() {

                    galleryAnimation();   

                }
                );

            }

        });


    });


    const observerAnimationContact = new IntersectionObserver(entries =>{

        entries.forEach(entry => {

            if (entry.isIntersecting) {
               
                
                 $(".container-form  .text-form").animate({

                    opacity:1,

                    left: 0

                },600);

                $(".container-form .content-input").animate({

                    opacity:1,
    
                    left: "-50%"
    
                },600);
  

            }

        });


    });

    
    const elementAbout = $(".carousel-container")[0];

    observerAnimationAbout.observe(elementAbout);

    const elementProducts = $(".container-gallery")[0];

    observerAnimationProducts.observe(elementProducts);

    const elementContact = $(".title-form")[0];

    observerAnimationContact.observe(elementContact);

});

//-----------------------------------------------------------------

// ANIMACIONES AL PULSAR EN UN BOTÓN DEL MENÚ


$(document).ready(() =>{
    

    $(".menu-content .links li a").click(function(e) {
        

        $(".menu-content .links li a").removeClass("active");

        $(".info-cookies").fadeOut(500);

        $(".container section:not(#footer)").fadeIn(500);

      

        var hash= this.hash;

        $("html, body").animate({

            scrollTop: $(hash).offset().top

        });

        window.location.hash = hash;
        
        $(this).addClass("active");


    });
});


//-----------------------------------------------------------------

// ANIMACIÓN PÁGINAS COOKIES

$(document).ready(() =>{

    $(".cookies-links a").click(function(e){

        $(".menu-content .links li a").removeClass("active");

        $(".info-cookies").fadeOut(500);

        $(".container section:not(#footer,#cookies,#error404)").fadeOut(500); 


        if ($(this).hasClass("cookies-policy")) {

            $("#cookies-policy").fadeIn();

        }else if($(this).hasClass("privacy-policy")){

            $("#privacy-policy").fadeIn();

        }else{

            $("#legal-warning").fadeIn();

        }

        setTimeout(() => {
            
            var hash= this.hash;

            $(window).scrollTop(hash);

            window.location.hash = hash;
            
        }, 500);

    });

    if (window.location.href=="http://localhost/htdocs/DOB/#legal-warning"){

        $(".menu-content .links li a").removeClass("active");

        $(".info-cookies").fadeOut(500);

        $(".container section:not(#footer,#cookies,#error404)").fadeOut(500); 

        $("#legal-warning").fadeIn();

    }else if(window.location.href=="http://localhost/htdocs/DOB/#privacy-policy"){

        $(".menu-content .links li a").removeClass("active");

        $(".info-cookies").fadeOut(500);

        $(".container section:not(#footer,#cookies,#error404)").fadeOut(500); 

        $("#privacy-policy").fadeIn();

    }else if(window.location.href=="http://localhost/htdocs/DOB/#cookies-policy"){

        $(".menu-content .links li a").removeClass("active");

        $(".info-cookies").fadeOut(500);

        $(".container section:not(#footer,#cookies,#error404)").fadeOut(500); 

        $("#cookies-policy").fadeIn();

    }else{

        $(".container .error404").css("display","block"); 
    }

});


//-----------------------------------------------------------------

// FUNCIÓN PRELOADER

document.addEventListener("DOMContentLoaded", async ()=> {


    $('.preloader-container').fadeOut(600);

    setTimeout(function() {

        $('.preloader').css("display","none");

        $('.container').fadeIn(250);
        
        var hash= window.location.hash;

        $('html, body').scrollTop($(hash).offset().top);

      }, 900);
    
})

//-----------------------------------------------------------------


//-----------------------------------------------------------------

// FUNCIÓN PARA IR A SECCIÓN ANTERIOR


$(document).ready(() =>{

    var hash= window.location.hash;

    $('html, body').scrollTop($(hash).offset().top);

});


//-----------------------------------------------------------------

// FUNCIÓN PARA CARGAR LAS IMAGENES DE LA GALERÍA


$(document).ready(() =>{

    let galleryImages= [];

    for(var i=1; i <=16; i++ ){

        galleryImages[i-1]= "assets/images/galleryProducts/"+i+".jpg";

    }


    $(".container-gallery .gallery-photo").each(function(index) {

        $(this).css("background-image", "url("+galleryImages[index]+")");
        
    });


});

//-----------------------------------------------------------------

// EFECTO MENU MÓVIL

$(document).ready(() =>{

    $(".button-menu").click(function() {
        
        $(".menu-mobile-container").fadeIn(500);

    });

    $(".menu-mobile-close-button").click(function() {
        
        $(".menu-mobile-container").fadeOut(500);

    });

    $(".menu-mobile-links li").click(function() {
        
        $(".info-cookies").fadeOut(500);

        $(".container section:not(#footer)").fadeIn(500);
        
        $(".menu-mobile-container").fadeOut(500);

    });

});

//-----------------------------------------------------------------

// ANIMACIÓN APARICIÓN BANNER COOKIES

$(document).ready(() =>{

    setTimeout(function() {
        
        $(".cookies-container").fadeIn(500);

    }, 1300);

});

//-----------------------------------------------------------------


// ANIMACIÓNES BANNER COOKIES

$(document).ready(() =>{

    $("#preferences-form").submit(function (e) {

        e.preventDefault();
        
        $(".cookies-container").fadeOut(500);

        var marketing = $("#marketing").prop("checked");
        

        var statistics = $("#statistics").prop("checked");

        $("<input>").attr({

            type: "hidden",
            name: "marketing",
            value: marketing ? "on" : "off"

        }).appendTo(this);

        $("<input>").attr({

            type: "hidden",
            name: "statistics",
            value: statistics ? "on" : "off"

        }).appendTo(this);
        
        $formCookies=$(this).serialize();

         dataCookies($formCookies);

    });

    $(".cookies-buttons").on("click", ".cookies-preferences, .save-preferences", function () {

       if ($(this).hasClass("cookies-preferences")) {

            $(".cookies-preferences-content").fadeIn(500);

            $(this).text("Guardar preferencias");

            $(this).removeClass("cookies-preferences");

            $(this).addClass("save-preferences");      

       }else{

            $(this).attr("type", "submit");

       }

    });

    $(".preferences-option").on('click', '.arrow-down, .arrow-up', function () {

        if ($(this).hasClass('arrow-down')) {

            $(this).removeClass('arrow-down').addClass('arrow-up').next().fadeIn(500);

        } else {

            $(this).removeClass('arrow-up').addClass('arrow-down').next().fadeOut(500);
        }
    });  

});

//-----------------------------------------------------------------

// ENVIAR DATOS COOKIES

function dataCookies(data) {

    $.ajax({
        type: "post",
        url: "index.php",
        data: data,
        dataType: "json",
        success: function () {
        
            console.log("Cookies guardadas correctamente");

        }, error: function () {
            
            console.log("Error al guardar las cookies");
        }
    });
    
}


//-----------------------------------------------------------------

// COMPROBACIONES AL ENVIAR EL FORMULARIO

$(document).ready(() =>{

    $("#contact-form").submit(function(e){

        // $(".form-error-message").remove();

        e.preventDefault();

        var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

        var validation= true;

        var formData= $(this).serialize();

        if ($("#name").val()=="") {

            validation= false;

            $("#name-error").html("<i class='fa-solid fa-xmark'></i>Campo obligatorio");

            $("#name-error-mobile").html("<i class='fa-solid fa-xmark'></i>Campo obligatorio");
               
        }

        if ($("#email").val()=="") {

            validation= false;

            $("#mail-error").html("<i class='fa-solid fa-xmark'></i>Campo obligatorio");

            $("#mail-error-mobile").html("<i class='fa-solid fa-xmark'></i>Campo obligatorio");
            
        }else if(!emailRegex.test($.trim($("#email").val()))){

            validation= false;

            $("#mail-error").html("<i class='fa-solid fa-xmark'></i>Formato email erroneo");

            $("#mail-error-mobile").html("<i class='fa-solid fa-xmark'></i>Formato email erroneo");

        }

        if ($("#coments").val()=="") {

            validation= false;

            $("#coments-error").html("<i class='fa-solid fa-xmark'></i>Campo obligatorio");

            $("#coments-error-mobile").html("<i class='fa-solid fa-xmark'></i>Campo obligatorio");
            
        }


        if (validation==true) {

            

            $(".group.error span").html("");

            $(".group.mobile span").html("");

            $(".form-success-message").html("");

            $(".form-success-message").html("<i class='fa-solid fa-spinner'></i> Enviando...");

            $.ajax({
                type: "post",
                url: "index.php",
                data: formData,
                dataType: "json",
                success: function (response) {

                    if(response.error){

                      $(".form-success-message").addClass("error");

                      $(".form-success-message").html("<i class='fa-solid fa-xmark'></i> "+response.message);                    
                    

                    }else{

                        $(".form-success-message").html("<i class='fa-solid fa-check'></i> formulario enviado correctamente");

                    }

                },error: function (xhr, status, error) {

                    $(".form-success-message").addClass("error");

                    $(".form-success-message").html("<i class='fa-solid fa-xmark'></i> Ha ocurrido un error, intentalo más tarde" + status + error)

                }
                
            });



            
        }
    });

});

//-----------------------------------------------------------------


