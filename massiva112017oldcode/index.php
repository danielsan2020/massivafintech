<!--?php 
    //instanciamos el modelo de la pagina
    include 'panel/admin/modelo/paginaWebModelo.php';
    $pagina = new pagina();
    //obtenemos las noticias
    $rspTabla = $pagina->informacionTabla();
    ///////////obtenemos las preguntas frecuentes
    //preguntas frecuentes
    $rspuno = $pagina->rspuno();
    /*///pago y impuesto
    $rspdos = $pagina->rspdos();*/
    ///rif sas
    $rsptres = $pagina->rsptres();
    //facturas y cotizaciones
    $rspcuatro = $pagina->rspcuatro();
    //declaraciones
    $rspcinco = $pagina->rspcinco();
    //plataforma
    $rspseis = $pagina->rspseis();
    //otras consultas
    $rspsiete = $pagina->rspsiete();
    /* valor para el formulario de contacto  */
    $valCon = $_GET['contacto'];
    
?-->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Massiva | Plataforma contable innovadora</title>
    <link rel="shortcut icon" type="image/x-icon" href="/images/massiva.ico" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Massiva plataforma contable innovadora.
        Te simplificamos tus obligaciones fiscales, la facturación y le dirás adiós a las declaraciones.
        Massiva realiza la contabilidad a todas las Personas Físicas y Asalariados.">
    <meta name="keywords" content="facturación, personas físicas, declaraciones y contabilidad, massiva plataforma contable, pago de impuestos">
    <meta name="author" content="massiva">
    <link rel="stylesheet" href="css/bootstrap.css" type="text/css">
    <link rel="stylesheet" href="css/animate.css" type="text/css">
    <link rel="stylesheet" href="css/owl.carousel.css" type="text/css">
    <link rel="stylesheet" href="css/magnific-popup.css" type="text/css">
    <link rel="stylesheet" href="css/style.css" type="text/css">
    <link rel="stylesheet" href="css/bg.css" type="text/css">
    <link rel="stylesheet" id="colors" href="css/colors/orange.css" type="text/css">
    <link rel="stylesheet" type="text/css" href="revolution/css/settings.css">
    <link rel="stylesheet" type="text/css" href="revolution/css/layers.css">
    <link rel="stylesheet" type="text/css" href="revolution/css/navigation.css">
    <link rel="stylesheet" href="css/rev-settings.css" type="text/css">
    <link rel="shortcut icon" type="image/x-icon" href="images/massiva.ico" />
    <link rel="stylesheet" type="text/css" href="css/per.css">

    <!-- Smartsupp Live Chat script -->
    <script type="text/javascript">
    var _smartsupp = _smartsupp || {};
    _smartsupp.key = 'ffcd83950d63ad4d2d85ed35d6727f0deb49d08b';
    window.smartsupp||(function(d) {
      var s,c,o=smartsupp=function(){ o._.push(arguments)};o._=[];
      s=d.getElementsByTagName('script')[0];c=d.createElement('script');
      c.type='text/javascript';c.charset='utf-8';c.async=true;
      c.src='https://www.smartsuppchat.com/loader.js?';s.parentNode.insertBefore(c,s);
    })(document);

    </script-->
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <style type="text/css">
 
        /* CSS para la animación y localización de los DIV de cookies */
        
        @keyframes desaparecer {  0%		{bottom: 0px;}
        80%		{bottom: 0px;}
        100%		{bottom: -50px;}
        }
        
        @-webkit-keyframes desaparecer /* Safari and Chrome */
        {
        0%		{bottom: 0px;}
        80%		{bottom: 0px;}
        100%		{bottom: -50px;}
        }
        
        @keyframes aparecer
        {
        0%		{bottom: -38px;}
        10%		{bottom: 0px;}
        90%		{bottom: 0px;}
        100%		{bottom: -38px;}
        }
        
        @-webkit-keyframes aparecer /* Safari and Chrome */
        {
        0%		{bottom: -38px;}
        10%		{bottom: 0px;}
        90%		{bottom: 0px;}
        100%		{bottom: -38px;}
        }
        #cookiesms1:target {
            display: none;
        }
        .cookiesms{	
            width:100%;
            height:43px;
            margin:0 auto;
            padding-left:1%;
            padding-top:5px;
            font-size: 9px;
            clear:both;
            font-weight: strong;
            color: #333;
            bottom:0px;
            position:fixed;
            left: 0px;
            background-color: #eac52d;
            opacity:0.7;
            filter:alpha(opacity=70); /* For IE8 and earlier */
            transition: bottom 1s;
            -webkit-transition:bottom 1s; /* Safari */
            -webkit-box-shadow: 3px -3px 1px rgba(50, 50, 50, 0.56);
            -moz-box-shadow:    3px -3px 1px rgba(50, 50, 50, 0.56);
            box-shadow:         3px -3px 1px rgba(50, 50, 50, 0.56);
            z-index:999999999;
        }
        
        .cookiesms:hover{
        bottom:0px;
        }

 
/* Fin del CSS para cookies */
 
</style>
</head>

<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.isotope.min.js"></script>
<script src="js/easing.js"></script>
<script src="js/owl.carousel.js"></script>
<script src="js/jquery.countTo.js"></script>
<script src="js/validation.js"></script>
<script src="js/wow.min.js"></script>
<script src="js/jquery.magnific-popup.min.js"></script>
<script src="js/enquire.min.js"></script>
<script src="js/jquery.stellar.min.js"></script>
<script src="js/jquery.plugin.js"></script>
<script src="js/typed.js"></script>
<script src="js/typed-custom.js"></script>
<script src="js/app.js"></script>
<script src="js/designesia.js"></script>
<script src="revolution/js/jquery.themepunch.tools.min.js?rev=5.0"></script>
<script src="revolution/js/jquery.themepunch.revolution.min.js?rev=5.0"></script>
<script src="revolution/js/extensions/revolution.extension.video.min.js"></script>
<script src="revolution/js/extensions/revolution.extension.slideanims.min.js"></script>
<script src="revolution/js/extensions/revolution.extension.layeranimation.min.js"></script>
<script src="revolution/js/extensions/revolution.extension.navigation.min.js"></script>
<script src="revolution/js/extensions/revolution.extension.actions.min.js"></script>
<script src="revolution/js/extensions/revolution.extension.kenburn.min.js"></script>
<script src="revolution/js/extensions/revolution.extension.migration.min.js"></script>
<script src="revolution/js/extensions/revolution.extension.parallax.min.js"></script>
<script src="js/typed.js"></script>
<script src="js/typed-custom.js"></script>
<script src="js/web.js"></script>
<!--imagen para el telefono de contacto

<script type="text/javascript">
if (localStorage.controlcookie>0){ 
document.getElementById('cookie1').style.bottom = '-50px';
}
</script>--> 


<!--<body id="homepage">
    <div class="position-fixed von"><a style="cursor: pointer;" data-toggle="modal" data-target="#registro"><img src="images/fontel.png" title='Formulario de contacto telefonico' style='height: 45px;'></a></div>
    <div class="cookiesms text-center" id="cookie1">
   Si tienes problemas con tu navegación en massiva te recomendamos, que actualices tu explorador o verifiques tu configuración (caché, conexiones) para una mejor navegación con nosotros.
    <button onclick="controlcookies()">Aceptar</button>
    </div>-->
    <!--seccion para el chat de facebook-->
       <!-- Load Facebook SDK for JavaScript -->
    <div id="fb-root"></div>
    <script>
      window.fbAsyncInit = function() {
        FB.init({
          xfbml            : true,
          version          : 'v3.2'
        });
      };

      function controlcookies() {
         // si variable no existe se crea (al clicar en Aceptar)
            localStorage.controlcookie = (localStorage.controlcookie || 0);
        
            localStorage.controlcookie++; // incrementamos cuenta de la cookie
            cookie1.style.display='none'; // Esconde la política de cookies
        }

      (function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s); js.id = id;
      js.src = 'https://connect.facebook.net/es_LA/sdk/xfbml.customerchat.js';
      fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>

    <!-- Your customer chat code -->
     <div class="fb-customerchat"
      attribution=setup_tool
      page_id="232924014060286"
      theme_color="#eac52d"
      logged_in_greeting="Bienvenidos, massiva será lanzada en 2020"
      logged_out_greeting="Bienvenidos, massiva será lanzada en 2020">
    </div>


    <div id="wrapper">
        <!--seccion del menu-->
    <header>
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div id="logo">
                            <a href="index.php">
                                <img class="logo" src="images/logo-light.png" alt="Massiva Contabilidad Innovadora">
                                <img class="logo-2" src="images/logo-dark.png" alt="Massiva Contabilidad Innovadora">
                            </a>
                        </div>
                        <span id="menu-btn"></span>
                        <nav>
                            <ul id="mainmenu">
                                <li class="amaRi"><a href="index.php" style="font-family: 'century Gothic'" class="redes">Inicio<span></span></a></li>
                                <li class="redes"><a href="#section-welcome" style="font-family: 'century Gothic'" class="redes">Beneficios<span></span></a></li>
                                li class="redes"><a href="#section-startup-features" style="font-family: 'century Gothic'" class="redes">Planes<span></span></a></li
                                li class="redes"><a href="#faq" style="font-family: 'century Gothic'" class="redes">Faq´s<span></span></a></li
                                <li class="redes"><a href="#contacto" style="font-family: 'century Gothic'" class="redes">Contacto<span></span></a></li>
                                li class="redes"><a data-toggle="modal" data-target="#altaR" style="font-family: 'century Gothic'; cursor:pointer;" class="redes">Darse de alta<span></span></a></li
                                <li class="redes"><a href="https://www.facebook.com/massivamx/" target="_blank" class='redes'><i class="fa fa-facebook redes"></i><span></span></a></li>
                                <li class="redes"><a href='https://twitter.com/massivamx' target="_blank" class='redes'><i class="fa fa-twitter redes"></i><span></span></a></li>
                                li class="redes"><a data-placement="bottom"   href='https://app.massiva.mx/' target="_blank" style="font-family: 'century Gothic'" class="redes"> Ingreso<span></span></a></li
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
    </header>
        
    <!---seccion para el carrete de fondo--->
        <div id="content" class="no-bottom no-top">
            <div id="top"></div>
            <section id="section-slider" class="fullwidthbanner-container" aria-label="section-slider">
                <div id="revolution-slider">
                    <ul>
                        <li data-transition="fade" data-slotamount="10" data-masterspeed="default" data-thumb="">
                            <img src="images/slider/1.jpg"  alt=""  data-lazyload="images/slider/1.jpg" data-bgposition="right center" data-kenburns="on" data-duration="30000" data-ease="Power1.easeOut" data-scalestart="110" data-scaleend="100" data-rotatestart="0" data-rotateend="0" data-offsetstart="0 0" data-offsetend="0 0" class="rev-slidebg" data-no-retina>
                            <div class="tp-caption tp-teaser" data-x="center" data-y="180" data-width="none" data-height="none" data-whitespace="nowrap" data-transform_in="y:100px;opacity:0;s:500;e:Power2.easeOut;" data-transform_out="opacity:0;y:-100;s:400;e:Power2.easeInOut;" data-start="500" data-splitin="none"           data-splitout="none" data-responsive_offset="on" style="font-family: 'century Gothic'; text-transform: upercase;">
                                <b class="carrete">LANZAMIENTO</b>
                            </div>
                            
                            <div class="tp-caption big-s1" data-x="center" data-y="center" data-width="none" data-height="none" data-whitespace="nowrap"
                                data-transform_in="y:100px;opacity:0;s:500;e:Power2.easeOut;" data-transform_out="opacity:0;y:-100;s:200;e:Power2.easeInOut;"
                                data-start="600" data-splitin="none" data-splitout="none" data-type="text" data-responsive_offset="on"
                                style="font-family: 'Roboto', Arial, Helvetica, sans-serif;">
                                2020
                            </div>

                            <div class="tp-caption text-center"
                                data-x="center"
                                data-y="400"
                                data-width="none"
                                data-height="none"
                                data-whitespace="nowrap"
                                data-responsive_offset="on"
                                data-transform_in="y:100px;opacity:0;s:500;e:Power2.easeOut;"
                                data-transform_out="opacity:0;y:-100;s:600;e:Power2.easeInOut;"
                                data-start="1000" style="font-family: 'century Gothic'">
                                 Seguimos automatizando y simplificando
                            </div> 
                            
                        </li>
                        
                        <li data-transition="fade" data-slotamount="10" data-masterspeed="default" data-thumb="">
                            <img src="images/slider/2.jpg"  alt=""  data-lazyload="images/slider/2.jpg" data-bgposition="left center" data-kenburns="on" data-duration="30000" data-ease="Power1.easeOut" data-scalestart="110" data-scaleend="100" data-rotatestart="0" data-rotateend="0" data-offsetstart="0 0" data-offsetend="0 0" class="rev-slidebg" data-no-retina>
                            
                            <div class="tp-caption tp-teaser carrete"
                                data-x="center"
                                data-y="180"
                                data-width="none"
                                data-height="none"
                                data-whitespace="nowrap"
                                data-transform_in="y:100px;opacity:0;s:500;e:Power2.easeOut;"
                                data-transform_out="opacity:0;y:-100;s:400;e:Power2.easeInOut;"
                                data-start="500"
                                data-splitin="none"
                                data-splitout="none"
                                data-responsive_offset="on" style="font-family: 'century Gothic'; text-transform: lowercase;">
                                <b class="carrete">Simplificamos tu</b>
                            </div>
                            
                            <div class="tp-caption big-s1"
                                data-x="center"
                                data-y="center"
                                data-width="none"
                                data-height="none"
                                data-whitespace="nowrap"
                                 data-transform_in="y:100px;opacity:0;s:500;e:Power2.easeOut;"
                                data-transform_out="opacity:0;y:-100;s:200;e:Power2.easeInOut;"
                                data-start="600"
                                data-splitin="none"
                                data-splitout="none"
                                data-responsive_offset="on"
                                style="font-family: 'Roboto', Arial, Helvetica, sans-serif;">
                                facturación
                            </div>

                            <div class="tp-caption text-center"
                                data-x="center"
                                data-y="400"
                                data-width="none"
                                data-height="none"
                                data-whitespace="nowrap"
                                data-transform_in="y:100px;opacity:0;s:500;e:Power2.easeOut;"
                                data-transform_out="opacity:0;y:-100;s:600;e:Power2.easeInOut;"
                                data-start="700" style="font-family: 'century Gothic'">
                                Freelance | MiPymes | Emprendedor
                            </div>-
                            
                        </li>
                        <li data-transition="fade" data-slotamount="10" data-masterspeed="default" data-thumb="">
                            <!--  BACKGROUND IMAGE -->
                            <img src="images/slider/3.jpg"  alt=""  data-lazyload="images/slider/3.jpg" data-bgposition="left center" data-kenburns="on" data-duration="30000" data-ease="Power1.easeOut" data-scalestart="110" data-scaleend="100" data-rotatestart="0" data-rotateend="0" data-offsetstart="0 0" data-offsetend="0 0" class="rev-slidebg" data-no-retina>
                            
                            <div class="tp-caption tp-teaser carrete" data-x="center"
                                data-y="180"
                                data-width="none"
                                data-height="none"
                                data-whitespace="nowrap"
                                data-transform_in="y:100px;opacity:0;s:500;e:Power2.easeOut;"
                                data-transform_out="opacity:0;y:-100;s:400;e:Power2.easeInOut;"
                                data-start="700"
                              
                                style="font-family: 'century Gothic';  text-transform: lowercase;">
                                <b class="carrete">Dile adiós a las</b>
                            </div>
                            
                            <div class="tp-caption big-s1"
                                data-x="center"
                                data-y="center"
                                data-width="none"
                                data-height="none"
                                data-whitespace="nowrap"
                                 data-transform_in="y:100px;opacity:0;s:500;e:Power2.easeOut;"
                                data-transform_out="opacity:0;y:-100;s:200;e:Power2.easeInOut;"
                                data-start="600"
                                data-splitin="none"
                                data-splitout="none"
                                data-responsive_offset="on"
                                style="font-family: 'Roboto', Arial, Helvetica, sans-serif;">
                                declaraciones
                            </div>

                            <div class="tp-caption text-center"
                                data-x="center"
                                data-y="400"
                                data-width="none"
                                data-height="none"
                                data-whitespace="nowrap"
                                data-transform_in="y:100px;opacity:0;s:500;e:Power2.easeOut;"
                                data-transform_out="opacity:0;y:-100;s:600;e:Power2.easeInOut;"
                                data-start="700" style="font-family: 'century Gothic'">
                                Freelance | MiPymes | Emprendedor 
                            </div>-
                        </li>
                    </ul>
                </div>
            </section>
        </div>

        <!-- section begin -->
        <section id="section-welcome" class="no-top no-bottom">
            <div class="container-fluid">
                <div class="row"><br></div>
                <div class="row text-center">
                    <div class="col-md-12">
                            <h2 style="font-family: 'century Gothic'">Beneficios</h2>
                            <div class="small-border center"></div>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-1">
                <!-- <div class="row-fluid display-table sequence">-->
                    <div class="col-md-4 col-sm-1 feature-box left sq-item wow" data-bgcolor="#ffffff">
                        <div class="padding60 heightBox">
                            <i class="icon_lightbulb_alt id-color" style="color: #e7bc15"></i>
                            <div class="text">
                                    <h3 style="font-family: 'century Gothic'">Innovador</h3>
                                    <span style='font-size: 14px;'>Automatizamos y mejoramos los procesos contables tradicionales.<br></span>
                            </div>
                        </div>
                        <br> <br>
                    </div>
                    <div class="col-md-4 col-sm-1 feature-box left sq-item wow" data-bgcolor="#f3f3f3">
                        <div class="padding60 heightBox">
                            <i class="icon_cloud-upload_alt id-color"  style="color: #e7bc15"></i>
                            <div class="text">
                                    <h3 style="font-family: 'century Gothic'">Accesible</h3>
                                    <span style='font-size: 14px;'>Puedes acceder a tu perfil desde cualquier lugar y dispositivo.<br></span>
                            </div>
                        </div>
                        <br> <br>
                    </div>
                    <div class="col-md-4 col-sm-1 feature-box left sq-item wow" data-bgcolor="#e9e9e9">
                        <div class="padding60 heightBox" >
                            <i class="icon_documents_alt id-color" style="color: #e7bc15"></i>
                            <div class="text">
                                    <h3 style="font-family: 'century Gothic'">Legal</h3>
                                    <span style='font-size: 14px;'>Se trabaja bajo las regulaciones del SAT y otorgamos contratos digitales con validez legal.<br></span>
                            </div>
                        </div>
                        <br> <br>
                    </div>
                <!-- </div> -->

                </div>
                <div class="col-lg-12 col-md-12 col-sm-1">
                        <div class="col-md-6 col-sm-1 feature-box left sq-item wow" data-bgcolor="#e9e9e9">
                            <div class="padding60 heightBox">
                                <i class="icon_lock_alt id-color" style="color: #e7bc15"></i>
                                <div class="text">
                                    <h3 style="font-family: 'century Gothic'">Seguro</h3>
                                    <span style='font-size: 14px;'>Contamos con certificado SSL y PCI DSS para la protección y encriptación de tus datos.<br></span>
                                </div>
                            </div>
                            <br>
                        </div>
                        <div class="col-md-6 col-sm-1 feature-box left sq-item wow" data-bgcolor="#ffffff">
                            <div class="padding60 heightBox">
                                <i class="icon_wallet id-color" style="color: #e7bc15"></i>
                                <div class="text">
                                    <h3 style="font-family: 'century Gothic'">Económico</h3>
                                   <span style='font-size: 14px;'>Los precios y formas de pago son accesibles gracias a que innovamos en nuestros procesos contables.<br></span>
                                
                                </div>
                            </div>
                            <br>
                        </div>
                    <!--</div> -->  
                </div>
            </div>
        </section>

        <!-- section close -->
        <section id="" class="side-bg no-padding text-light" data-bgcolor="#404040">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 text-center"><br>
                        <marquee  direction="left" loop="20" scrolldelay='10' >
                        <img src="images/partner/afterbanks.png" style="height:130px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <img src="images/partner/openpay.png" style="height:130px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <img src="images/partner/naveseed1.png" style="height:110px;">
                        </marquee>
                        <br>
                    </div>
                    <br><br>
                </div>
                <br>
            </div>
        </section>
<<<<<<< HEAD
        
        <!-- seccion de planes -->
        <section id="section-startup-features" class="no-top no-bottom">
            <div class="overlay-solid">
=======



        <script>
            const toggleInclude = e => {
                let isPlus=true;
                //Si el icono actual (+), isPLus = true, si no isPlus = false
                if($(e).find('i')[0].className==="fa fa-minus-circle"){
                    isPlus=false;
                }

                //si hay menus desplegados, se remueven las clases que dan color e icono de (-) y se le asigna el (+)
                const iconTag = document.getElementsByClassName("fa-minus-circle");
                const aClass = document.getElementsByClassName("second");
                $(iconTag).removeClass('fa-minus-circle').addClass("fa-plus-circle");
                $(aClass).removeClass('second').addClass("first");
                $(e).find('i').removeClass('fa-plus-circle');

                //si (+) cambiar a (-) y <a> = amarillo
                if(isPlus===true){
                    $(e).find('i').addClass('fa-minus-circle');
                    $(e).removeClass('first').addClass("second");
                }else{
                    $(e).find('i').addClass('fa-plus-circle');
                }
            }
        </script>

        <!--Para los menús "Incluye" es necesaria la función en el script de arriba-->
        <section id="section-startup-features" class="no-top no-bottom" style="padding: 20px, 20px">
            <div class="overlay-solid"> 
>>>>>>> 1dfc12d973825cee1ec8afcc7447f0285368ab5d
                <div class="overlay-bg t0">
                    <div class="container">
                            <div class="row"><br></div>
                            <div class="row ">
                                <div class="col-md-12 col-xs-12 col-lg-12">
                                    <div class="col-md-12 text-center">
                                       <h2 style="font-family: 'century Gothic'">Nuestros planes</h2>
                                            <div class="small-border center"></div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div id="exTab2" class="container"> 
                                            <ul class="nav nav-tabs nav-pills">
                                                    <li class="active"><a href="#1" data-toggle="tab" style="font-family: 'century Gothic'" onclick='cambiar()'>Personas Físicas</a></li>
                                                    <li><a href="#4" data-toggle="tab" style="font-family: 'century Gothic'">Extras</a></li>
                                            </ul>

                                            <div class="tab-content " style="width: 100%">
                                                    <div class="tab-pane active" id="1">
                                                            <section id="pricing-table">
                                                                    <div class="acc_wrap no-style">

                                                                            <div class="accordion s1">
                                                                                    <h3 style="padding:"><b>ASALARIADOS</b><br><small><span style="font-size: 15px;"><span style="color:#f1005e"><b>$199</b></span> pago anual.</span></small></h3>

                                                                                    <a class="NoneActive first" href="#acc_1a" onclick='toggleInclude(this)'><b>Incluye<i class="fa fa-plus-circle"></i></b></a>
                                                                                    <div id="acc_1a" style="font-family: 'century Gothic'">
                                                                                            •   Análisis de situación fiscal antes del comienzo del servicio.<br>
                                                                                            •   Hoja de trabajo con concentrado de ingresos y egresos, así como cálculo de impuestos. <br>
                                                                                            •   Presentación de declaración de ISR anual en el portal SAT.<br>
                                                                                            •   Almacenamiento y pre rellenado para facturación de tickets de compra. *<br>
                                                                                            •   Asesorías telefónicas.<br>
                                                                                            •   MASSIVA MX resguarda todos tus comprobantes fiscales (declaraciones, pago de impuestos y facturas) dentro de tu propio perfil hasta por 5 años.<br><br>
                                                                                            <small>*El cliente decide a través de la plataforma ticket de compra, si massiva realiza la facturación, con un costo adicional. Consulta en tu perfil.<br></small>
                                                                                    </div>
                                                                            </div>
                                                                            <div class="accordion s1">
                                                                                    <h3 style="padding:"><b>INTERÉS</b><br><small><span style="font-size: 15px;"><span style="color:#f1005e"><b>$199</b></span> pago anual.</span></small></h3>

                                                                                    <a class="NoneActive first" href="#acc_6a" onclick='toggleInclude(this)'><b>Incluye<i class="fa fa-plus-circle"></i></b></a> <!--se cambia acc_1a por acc_6a por repeticion-->
                                                                                    <div id="acc_6a" style="font-family: 'century Gothic'">
                                                                                            •   Análisis de situación fiscal antes del comienzo del servicio.<br>
                                                                                            •   Hoja de trabajo con concentrado de ingresos y egresos, así como cálculo de impuestos. <br>
                                                                                            •   Presentación de declaración de ISR anual en el portal SAT.<br>
                                                                                            •   Almacenamiento y pre rellenado para facturación de tickets de compra. *<br>
                                                                                            •   Asesorías telefónicas.<br>
                                                                                            •   MASSIVA MX resguarda todos tus comprobantes fiscales (declaraciones, pago de impuestos y facturas) dentro de tu propio perfil hasta por 5 años.<br><br>
                                                                                            <small>*El cliente decide a través de la plataforma ticket de compra, si massiva realiza la facturación, con un costo adicional. Consulta en tu perfil.<br></small>
                                                                                    </div>
                                                                            </div>

                                                                            <div class="accordion s1">
                                                                                    <h3 style="padding:"><b>ARRENDAMIENTO</b><br><small><span style="font-size: 15px;"><span style="color:#f1005e"><b>$199</b></span> mensuales.</span></small></h3>
                                                                                    <a class="NoneActive first" href="#acc_5a" onclick='toggleInclude(this)'><b>Incluye<i class="fa fa-plus-circle"></i></b>  </a>
                                                                                    <div id="acc_5a" style="font-family: 'century Gothic'">
                                                                                            •   Análisis de situación fiscal antes del comienzo del servicio.<br>
                                                                                            •   Facturación de 10 CFDI al mes.<br>
                                                                                            •   Hoja de trabajo con concentrado de ingresos y egresos, así como cálculo de impuestos.<br>
                                                                                            •   Presentación de declaración de ISR, IVA y DIOT en el portal SAT.<br>
                                                                                            •   Almacenamiento y pre rellenado para facturación de tickets de compra. *<br>
                                                                                            •   Asesorías telefónicas.<br>
                                                                                            •   MASSIVA MX resguarda todos tus comprobantes fiscales (declaraciones, pago de impuestos y facturas) dentro de tu propio perfil hasta por 5 años.<br><br>

                                                                                            <small>*El cliente decide a través de la plataforma ticket de compra, si massiva realiza la facturación, con un costo adicional. Consulta en tu perfil.<br></small>
                                                                                    </div>
                                                                            </div>
                                                                            <div class="accordion s1">
                                                                                    <h3 style="padding:"><b>SERVICIOS PROFESIONALES BÁSICO</b><br><small><span style="font-size: 15px;"><span style="color:#f1005e"><b>$199</b></span> mensuales.</span></small></h3>
                                                                                    <a class="NoneActive first" href="#acsc5a" onclick='toggleInclude(this)'><b>Incluye<i class="fa fa-plus-circle"></i></b> </a>
                                                                                    <div id="acsc5a" style="font-family: 'century Gothic'">
                                                                                            <br>
                                                                                            •   Análisis de situación fiscal antes del comienzo del servicio.<br>
                                                                                            •   Facturación de 12 CFDI al mes.<br>
                                                                                            •   Hoja de trabajo con concentrado de ingresos y egresos, así como cálculo de impuestos.<br>
                                                                                            •   Presentación de declaración de ISR, IVA y DIOT en el portal SAT.<br>
                                                                                            •   Almacenamiento y pre rellenado para facturación de tickets de compra. *<br>
                                                                                            •   Asesorías telefónicas.<br>
                                                                                            •   MASSIVA MX resguarda todos tus comprobantes fiscales (declaraciones, pago de impuestos y facturas) dentro de tu propio perfil hasta por 5 años.<br><br>

                                                                                            <small>
                                                                                                    *El cliente decide a través de la plataforma ticket de compra, si massiva realiza la facturación, con un costo adicional. Consulta en tu perfil.<br></small>
                                                                                    </div>
                                                                            </div>

                                                                            <!--div class="accordion s1">  Se comenta por estár repetido
                                                                                    <h3 style="padding:"><b>SERVICIOS PROFESIONALES BÁSICO</b><br><small><span style="font-size: 15px;"><span style="color:#f1005e"><b>$199</b></span> mensuales.</span></small></h3>
                                                                                    <a class="NoneActive first" href="#acsc5a" onclick='toggleInclude(this)'><b>Incluye </b> </a>
                                                                                    <div id="acsc5a" style="font-family: 'century Gothic'">
                                                                                            <br>
                                                                                            •   Análisis de situación fiscal antes del comienzo del servicio.<br>
                                                                                            •   Facturación de 12 CFDI al mes.<br>
                                                                                            •   Hoja de trabajo con concentrado de ingresos y egresos, así como cálculo de impuestos.<br>
                                                                                            •   Presentación de declaración de ISR, IVA y DIOT en el portal SAT.<br>
                                                                                            •   Almacenamiento y pre rellenado para facturación de tickets de compra. *<br>
                                                                                            •   Asesorías telefónicas.<br>
                                                                                            •   MASSIVA MX resguarda todos tus comprobantes fiscales (declaraciones, pago de impuestos y facturas) dentro de tu propio perfil hasta por 5 años.<br><br>

                                                                                            <small>
                                                                                                    *El cliente decide a través de la plataforma ticket de compra, si massiva realiza la facturación, con un costo adicional. Consulta en tu perfil.<br></small>
                                                                                    </div>
                                                                            </div-->

                                                                            <div class="accordion s1">
                                                                                    <h3 style="padding:"><b>SERVICIOS PROFESIONALES PLUS</b><br><small><span style="font-size: 15px;"><span style="color:#f1005e"><b>$299</b></span> mensuales.</span></small></h3>
                                                                                    <a class="NoneActive first" href="#acc_2a" onclick='toggleInclude(this)'><b>Incluye<i class="fa fa-plus-circle"></i></b></a>
                                                                                    <div id="acc_2a" style="font-family: 'century Gothic'">
                                                                                            •   Análisis de situación fiscal antes del comienzo del servicio.<br>
                                                                                            •   Facturación de 20 <span title="hols">CFDI</span>  al mes.<br>
                                                                                            •   Hoja de trabajo con concentrado de ingresos y egresos, así como cálculo de impuestos.<br>
                                                                                            •   Presentación de declaración de ISR, IVA y DIOT en el portal SAT.<br>
                                                                                            •   Almacenamiento y pre rellenado para facturación de tickets de compra. *<br>
                                                                                            •   Asesorías telefónicas.<br>
                                                                                            •   MASSIVA MX resguarda todos tus comprobantes fiscales (declaraciones, pago de impuestos y facturas) dentro de tu propio perfil hasta por 5 años.<br><br>

                                                                                            <small>
                                                                                                    *El cliente decide a través de la plataforma ticket de compra, si massiva realiza la facturación, con un costo adicional. Consulta en tu perfil.<br></small>

                                                                                    </div>
                                                                            </div>
                                                                            <div class="accordion s1">
                                                                                    <h3 style="padding:"><b>ACTIVIDAD EMPRESARIAL</b><br><small><span style="font-size: 15px;"><span style="color:#f1005e"><b>$199</b></span> mensuales.</span></small></h3>
                                                                                    <a class="NoneActive first" href="#acc_3a" onclick='toggleInclude(this)'><b>Incluye<i class="fa fa-plus-circle"></i></b> </a>
                                                                                    <div id="acc_3a" style="font-family: 'century Gothic'">
                                                                                            •   Análisis de situación fiscal antes del comienzo del servicio.<br>
                                                                                            •   Facturación de 12 CFDI al mes.<br>
                                                                                            •   Hoja de trabajo con concentrado de ingresos y egresos, así como cálculo de impuestos.<br>
                                                                                            •   Presentación de declaración de ISR, IVA y DIOT en el portal SAT.<br>
                                                                                            •   Almacenamiento y pre rellenado para facturación de tickets de compra. *<br>
                                                                                            •   Asesorías telefónicas.<br>
                                                                                            •   MASSIVA MX resguarda todos tus comprobantes fiscales (declaraciones, pago de impuestos y facturas) dentro de tu propio perfil hasta por 5 años.<br><br>

                                                                                            <small>
                                                                                                    *El cliente decide a través de la plataforma ticket de compra, si massiva realiza la facturación, con un costo adicional. Consulta en tu perfil.<br></small>

                                                                                    </div>
                                                                            </div>
                                                                            <div class="accordion s1">
                                                                                    <h3 style="padding:"><b>RIF</b><br><small><span style="font-size: 15px;"><span style="color:#f1005e"><b>$99</b></span> mensuales.</span></small></h3>
                                                                                    <a class="NoneActive first" href="#acc_4a" onclick='toggleInclude(this)'><b>Incluye<i class="fa fa-plus-circle"></i></b></a>
                                                                                    <div id="acc_4a" style="font-family: 'century Gothic'">
                                                                                            •   Análisis de situación fiscal antes del comienzo del servicio.<br>
                                                                                            •   Facturación de 12 CFDI al mes.<br>
                                                                                            •   Hoja de trabajo con concentrado de ingresos y egresos, así como cálculo de impuestos.<br>
                                                                                            •   Presentación de declaración bimestral de ISR e IVA en el portal SAT.<br>
                                                                                            •   Almacenamiento y pre rellenado para facturación de tickets de compra. *<br>
                                                                                            •   Asesorías telefónicas.<br>
                                                                                            •   MASSIVA MX resguarda todos tus comprobantes fiscales (declaraciones, pago de impuestos y facturas) dentro de tu propio perfil hasta por 5 años.<br><br>

                                                                                            <small>
                                                                                                    *El cliente decide a través de la plataforma ticket de compra, si massiva realiza la facturación, con un costo adicional. Consulta en tu perfil.<br></small>

                                                                                    </div>
                                                                            </div>
                                                                            <div class="accordion s1">
                                                                                    <h3 style="padding:"><b>ESPECIAL</b><br><small><span style="font-size: 15px;">Costo total mensual basado en la suma de personas físicas seleccionadas*.</span></small></h3>
                                                                                    <a class="NoneActive first" href="#acsdc5a" onclick='toggleInclude(this)'><b>Incluye<i class="fa fa-plus-circle"></i></b> </a>
                                                                                    <div id="acsdc5a" style="font-family: 'century Gothic'">
                                                                                            Puedes seleccionar hasta 5 formas jurídicas a la vez.<br>
                                                                                            •   Análisis de situación fiscal antes del comienzo del servicio.<br>
                                                                                            •   Facturación de 12 CFDI al mes.<br>
                                                                                            •   Hoja de trabajo con concentrado de ingresos y egresos, así como cálculo de impuestos.<br>
                                                                                            •   Presentación de declaración de ISR, IVA y DIOT en el portal SAT.<br>
                                                                                            •   Almacenamiento y pre rellenado para facturación de tickets de compra. *<br>
                                                                                            •   Asesorías telefónicas.<br>
                                                                                            •   MASSIVA MX resguarda todos tus comprobantes fiscales (declaraciones, pago de impuestos y facturas) dentro de tu propio perfil hasta por 5 años.<br><br>

                                                                                            <small>*A la Persona Física de más valor seleccionada se suma el resto de las Personas Físicas, cobrando el 80% de su costo a la segunda y el resto de las Personas Físicas seleccionadas el 50% sobre su valor.<br>

                                                                                                    *El cliente decide a través de la plataforma ticket de compra, si massiva realiza la facturación, con un costo adicional. Consulta en tu perfil.<br></small>

                                                                                    </div>
                                                                            </div><br>
                                                                    </div>
                                                            </p>
                                                    </div>

                                                    <div class="tab-pane" id="4" style="padding-top: 0">
                                                            <p style='text-align : justify;  font-family: century Gothic'><br>
                                                                    <span style="color:#f1005e"><b>$49</b></span> pesos, 10 facturas.<br>
                                                                    <span style="color:#f1005e"><b>$99</b></span> pesos, 25 facturas. <br>
                                                                    <span style="color:#f1005e"><b>$189</b></span> pesos, 50 facturas.<br>
                                                                    <span style="color:#f1005e"><b>$289</b></span> pesos, 100 facturas. <br><br>
                                                                    -Consulta en <a href="mailto:atencionalcliente@massiva.mx">atencionalcliente@massiva.mx</a> para mayor información
                                                            </p>
                                                    </div>
                                    </div>
                                    </div>
                            </div>
                           </div>
                    </div>
                </div>
            </div>
<<<<<<< HEAD
            <br>
            <br>
            <br>
            <br
            <br>
            <br>
            <br>
=======
>>>>>>> 1dfc12d973825cee1ec8afcc7447f0285368ab5d
            <small>
        </section>

    <!-- seccion de video -->
       <section class="side-bg no-padding text-center" data-bgcolor="#404040">
            
                <div class="row">
                     <div class="col-md-3  text-center"></div>
                    <div class="col-md-6  text-center"><br>
                            <div class="embed-responsive embed-responsive-4by3 text-center">
                              <iframe class="embed-responsive-item" width="250" height="215" src="//www.youtube.com/embed/dvpRlUfqxNo" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                            </div>
                        
                        <div class="spacer-single"></div>
                    </div>
                    <div class="col-md-3  text-center"></div>
                     
                </div>
                <br>
            <br>
        </section>
<<<<<<< HEAD
=======

      

        <script>
            const toggleArrow = e => {
                const arrowEl = $(e).find('i');
                const allArrows = document.getElementsByClassName("fa-arrow-down");
                if(arrowEl[0].className==="fa fa-arrow-right"){
                    $(allArrows).removeClass('fa-arrow-down').addClass('fa-arrow-right');
                    arrowEl.removeClass('fa-arrow-right');
                    arrowEl.addClass('fa-arrow-down');
                }else{
                    arrowEl.removeClass('fa-arrow-down');
                    arrowEl.addClass('fa-arrow-right');
                }
            }
        </script>

        <div id="faq" class="no-top no-bottom"><br>
            <div class="row text-center"><div class="col-md-12"><h2 style="color:#FFFFFF" >Preguntas frecuentes</h2><div class="small-border center"></div></div></div>
            <section id="pricing-table">
                <div class="container"><br>
                    <div class="row text-justify">
                        <div class="accordion col-sm-12 col-md-12" style="font-family: 'century Gothic'">

                            <a class="" data-toggle="collapse" href="#catpr_a1" onclick="toggleArrow(this)"><h3><b>PREGUNTAS GENERALES</b><i class="fa fa-arrow-right"></i></h3></a>

                            <div class="accordion s1 collapse" id="catpr_a1">
                                <a class="NoneActive first" href="#pr_a1"><p>¿QUÉ ES MASSIVA?</p></a>
                                <div id="pr_a1">Massiva es la plataforma contable innovadora.</div>
                                <a class="NoneActive first" href="#pr_a2"><p>¿EN QUÉ ME BENEFICIA?</p></a>
                                <div id="pr_a2">Massiva te simplifica las obligaciones fiscales, la facturación y le dirás adiós a las declaraciones  para que puedas enfocarte a tu negocio. Tú le dirás adiós porque nosotros lo vamos a hacer por ti, todo para mantenerte en regla con el SAT. Como obligación fiscal, únicamente deberás autorizarnos tu declaración de forma muy sencilla y pagar tus impuestos, de todo esto te avisaremos.</div>
                                <a class="NoneActive first" href="#pr_a3"><p>¿MASSIVA ES LEGAL Y SEGURO?</p></a>
                                <div id="pr_a3">Claro, massiva te permite crecer de manera legal gracias a su equipo de contadores. Es seguro porque la plataforma contable cuenta con la última tecnología de encriptación de datos, SSL, PCDI y todos los empleados se rigen bajo contrato de confidencialidad y limitación del acceso a la información.</div>
                                <a class="NoneActive first" href="#pr_a4"><p>¿MASSIVA ES PARA MÍ?</p></a>
                                <div id="pr_a4">Es para todas las Personas Físicas, incluidos Asalariados. Posteriormente también para Personas Morales.</div>
                                <a class="NoneActive first" href="#pr_a5"><p>¿CÓMO PUEDO SER PARTE DE MASSIVA? ¿Y CUÁL ES SU COSTO?</p></a>
                                <div id="pr_a5">Ingresas a massiva.com.mx, te registras, eliges tu forma jurídica y tu modalidad de pago.</div>
                                <a class="NoneActive first" href="#pr_a6"><p>¿MASSIVA TIENE OFICINAS?</p></a>
                                <div id="pr_a6">Estamos en la nube a través de la plataforma contable más innovadora, sencilla y segura para que puedas acceder a tu perfil desde cualquier lugar o dispositivo en cualquier momento.</div>
                                <a class="NoneActive first" href="#pr_a7"><p>¿ME COBRAN ALGUNA PENALIZACIÓN EN CASO DE QUE, DESPUÉS DE ALGÚN TIEMPO YA NO QUIERA UTILIZAR LA PLATAFORMA DE MASSIVA?</p></a>
                                <div id="pr_a7">Cuando quieras darte de baja, solo deberás acceder a tu Perfil y presionar el botón de Darte de baja, con eso massiva dejará de proporcionarte el servicio sin ningún costo adicional o penalización. Solo ten en cuenta tu fecha de corte y hacerlo antes de esta fecha.</div>
                                <a class="NoneActive first" href="#pr_a8"><p>¿MASSIVA DA SERVICIO DE NÓMINAS?</p></a>
                                <div id="pr_a8">De momento massiva no proporciona el servicio de nóminas, pero sí en un futuro, te lo haremos saber cuando ocurra.</div>
                            </div>
                        </div>
                        <div class="accordion col-sm-12 col-md-12" style="font-family: 'century Gothic'">

                            <a class="first" data-toggle="collapse" href="#catpr_a2" onclick="toggleArrow(this)"><h3><b>FACTURACIÓN</b><i class="fa fa-arrow-right"></i></h3></a>
                        
                            <div class="accordion s1 collapse" id="catpr_a2">
                                <a class="NoneActive first" href="#pr_b1"><p>¿MASSIVA ME PUEDE FACTURAR LOS TICKETS DE COMPRA?</p></a>
                                <div id="pr_b1">Dentro de tu perfil puedes almacenar y facturar tus propios tickets de compra, pero sino deseas hacerlo, massiva con un costo adicional te puede facturar todos tus tickets de compra, solo sube los tickets y déjanos el resto a nosotros.</div>
                                <a class="NoneActive first" href="#pr_b2"><p>SIENDO PARTE DE MASSIVA, ¿REQUIERO HACER FACTURAS DIRECTAMENTE EN EL PORTAL DEL SAT?</p></a>
                                <div id="pr_b2">No, debes hacerla desde la plataforma, solo presiona el botón de acceso directo Hacer factura, selección al cliente que quieres hacersela y como mucha información ya está precargada, la harás de forma sencilla y rápida, massiva se encargará de timbrarla, guardártela automáticamente en Mis clientes y se la enviaremos a tu cliente. </div>
                                <a class="NoneActive first" href="#pr_b3"><p>¿NECESITO SOLICITAR FACTURAS DE MIS GASTOS?</p></a>
                                <div id="pr_b3">Si, deberás solicitar facturas de todos los gastos e inversiones que realices, pero solo los gastos que pertenezcan a tu actividad. Si tienes dudas puedes preguntar en Soporte dentro de tu perfil.</div>
                                <a class="NoneActive first" href="#pr_b4"><p>¿CUÁNTO ME COBRA MASSIVA POR FACTURA REALIZADA?</p></a>
                                <div id="pr_b4">No cobramos por factura sino por mensualida como una suscripción.</div>
                                <a class="NoneActive first" href="#pr_b5"><p>¿SI MASSIVA FACTURA, A QUIÉN LE HACEN EL DEPÓSITO?</p></a>
                                <div id="pr_b5">Siempre te lo harán a ti, sea el pago en efectivo o por transferencia bancaria, ya que massiva no recibe los pagos de tus facturas, sino que tu cliente te lo deposita directamente a ti.</div>
                                <a class="NoneActive first" href="#pr_b6"><p>SI MASSIVA REALIZA EL TIMBRADO DE MI FACTURA ¿A NOMBRE DE QUIÉN SALE? ¿BAJO QUÉ NOMBRE MASSIVA REALIZA LA FACTURA?</p></a>
                                <div id="pr_b6">Siempre saldrá a tu nombre, todo esto por motivos legales y fiscales. El realizar facturas a tu nombre te ayudará como empresa a nivel de crecimiento, posicionamiento y credibilidad.</div>
                                <a class="NoneActive first" href="#pr_b7"><p>¿PUEDO FACTURAR TODO?</p></a>
                                <div id="pr_b7">Massiva te recomienda que solo factures todo lo que esté relacionado a tu actividad. Ejemplo: Das capacitaciones, no puede facturar una venta de una casa, pero si puedes facturar plumones, rotafolios, etc.</div>
                                <a class="NoneActive first" href="#pr_b8"><p>SI NECESITO CANCELAR UNA FACTURA, ¿QUÉ DEBO HACER?</p></a>
                                <div id="pr_b8">Solo debes entrar al cliente que le hiciste la factura en Mis clientes, seleccionar el cliente, buscar la factura y presionar el botón de Cancelar. Recuerda que toma un tiempo la cancelación, ya que debe aprobar la cancelación tu cliente, esto por requisitos nuevos del SAT.</div>
                                <a class="NoneActive first" href="#pr_b9"><p>¿QUÉ PASA SI MI CLIENTE NO PAGA MIS FACTURAS?</p></a>
                                <div id="pr_b9">En el caso de que un cliente se demore en realizar el pago, puedes solicitar apoyo a masslegal para que inicie el proceso de reclamación de cantidades pertinentes establecido por massiva. Desde nuestro departamento legal y siempre que el cliente así nos lo solicite, podemos tomar las medidas legales necesarias para el pago. Este servicio tendrá un costo extra el cuál podrás consultar antes de realizar el trámite.</div>
                                <a class="NoneActive first" href="#pr_b10"><p>¿SE PUEDE FACTURAR EN DIVISA EXTRANJERA?</p></a>
                                <div id="pr_b10">Sí se puede facturar en otra divisa, sólo tendrás que seleccionarlo a la hora de que hagas la factura.</div>
                                <a class="NoneActive first" href="#pr_b11"><p>QUIERO EDITAR MI FACTURA, PERO YA SE LA ENVIÉ A MASSIVA ¿QUÉ DEBO HACER?</p></a>
                                <div id="pr_b11">Tendrás que cancelar la factura de tu cliente y volver a realizar una nueva. Recuerda que toma un tiempo la cancelación, ya que debe aprobar la cancelación tu cliente, esto por requisitos nuevos del SAT.</div>
                                <a class="NoneActive first" href="#pr_b12"><p>DECLARO EN 0, HE TENIDO UN GASTO, ¿AÚN ASÍ DEBO O PUEDO FACTURAR MIS TICKETS (GASTOS)?</p></a>
                                <div id="pr_b12">Massiva te recomienda que no factures tu ticket ya que como dices estás declarando en 0, eso significa que no tienes ingresos por lo que no deberías tener gastos. Otro caso es que tu gasto sea una inversión, un activo, para el desarrollo de tu actividad, en ese caso si podrías hacerlo. Lo que si puedes facturar son tus gastos cotidianos; teléfono, comida, etc.</div>
                                <a class="NoneActive first" href="#pr_b13"><p>¿ES NECESARIO EMITIR FACTURA (CFDI) POR MI ACTIVIDAD?</p></a>
                                <div id="pr_b13">Conforme al artículo 29 del Código Fiscal de la Federación, todos los contribuyentes están obligados a emitir Comprobantes Fiscales Digitales a través de Internet (Factura Electrónica). Pero ahora massiva te ayuda a realizarlas para que tú sólo te enfoques en tu negocio.</div>
                                <a class="NoneActive first" href="#pr_b14"><p>¿CÓMO SE ALMACENAN LAS FACTURAS ELECTRÓNICAS?</p></a>
                                <div id="pr_b14">Las facturas que tu realices se guardan automáticamente en tus clientes dentro de la sección Mis clientes, tu no debes preocuparte en guardarlas, y cuando factures gastos, igualmente se guardarán automáticamente en Mis proveedores | Gastos. Todo es automático.</div>
                            </div>
                        </div>
                        <div class="accordion col-sm-12 col-md-12" style="font-family: 'century Gothic'">

                            <a class="first" data-toggle="collapse" href="#catpr_a3" onclick="toggleArrow(this)"><h3><b>PLATAFORMA</b><i class="fa fa-arrow-right"></i></h3></a>
                        
                            <div class="accordion s1 collapse" id="catpr_a3">
                                <a class="NoneActive first" href="#pr_c1"><p>¿CÓMO ME COBRA LA PLATAFORMA?</p></a>
                                <div id="pr_c1">Para Personas Físicas el costo va desde $99 hasta $299. El cobro será mensual a través de tu tarjeta de crédito o débito, y si eliges transferencia bancaria tendrás una fecha de corte para hacer el depósito.</div>
                                <a class="NoneActive first" href="#pr_c2"><p>¿CUÁNTO ME COBRA MASSIVA POR CADA FACTURA?</p></a>
                                <div id="pr_c2">Massiva no cobra por factura, solo según tu forma jurídica te cobrará automáticamente todos los meses a tu tarjeta registrada. Si requieres más facturas de las que tiene tu paquete seleccionado, podrás comprar esas facturas extras por un costo accesible.</div>
                                <a class="NoneActive first" href="#pr_c3"><p>¿CUÁNDO DEBO PAGAR DE MIS IMPUESTOS?</p></a>
                                <div id="pr_c3">Massiva, a través de un mail, proporcionado por ti anteriormente, o un aviso a través de la plataforma, te avisará para que revises si debes pagar tus impuestoso no y así no causarte ninguna multa por retraso.</div>
                                <a class="NoneActive first" href="#pr_c4"><p>¿ES NECESARIO QUE YO ACUDA A REALIZAR MI TRÁMITE DE eFIRMA (FIEL) O MASSIVA PUEDE HACERLO POR MÍ?</p></a>
                                <div id="pr_c4">El trámite de eFirma (FIEL) es personal, por lo cual deberás de acudir directamente a las oficinas del SAT. La cita podrás realizarla desde la plataforma de massiva, solo regístrate, saca tu cita y te esperaremos para que subas el resto de archivos o documentos.</div>
                                <a class="NoneActive first" href="#pr_c5"><p>¿QUÉ REQUISITOS NECESITO PARA PAGAR MIS IMPUESTOS?</p></a>
                                <div id="pr_c5">Siempre ten a la mano:  -Tu clave de RFC a 13 dígitos y tu CURP a 18 dígitos. -Firma Electrónica Avanzada  (Fiel) vigente o su Clave de Identificación Electrónica Confidencial (CIEC) si va a presentar tu declaración por internet, en este último caso, no te preocupes porque massiva lo hará por ti. -Número de cuenta para hacer el pago del impuesto por transferencia electrónica de fondos en un banco autorizado, si te resulta cantidad a pagar.</div>
                            </div>
                        </div>

                        <div class="accordion col-sm-12 col-md-12" style="font-family: 'century Gothic'">

                            <a class="first" data-toggle="collapse" href="#catpr_a4" onclick="toggleArrow(this)"><h3><b>SOPORTE TÉCNICO</b><i class="fa fa-arrow-right"></i></h3></a>
                        
                            <div class="accordion s1 collapse" id="catpr_a4">
                                <a class="NoneActive first" href="#pr_d1"><p>¿CUÁL ES EL NIVEL DE SEGURIDAD DENTRO DE MASSIVA?</p></a>
                                <div id="pr_d1">Todos los datos que teclees, incluyendo el número de tu tarjeta de crédito, efirma, nombre, domicilio, teléfono, etc, son encriptados y algunos de eso datos, solo son de lectura, es decir que no podemos hacer ningún movimiento con ellos por tu seguridad.</div>
                                <a class="NoneActive first" href="#pr_d2"><p>NO PUEDO ACCEDER AL PORTAL</p></a>
                                <div id="pr_d2">Tras el proceso de alta y nada más tengamos revisados todos tus documentos, te llegará un email procedente de notificaciones@massiva.com.mx con tu usuario (es tu dirección de email), un link donde podrás generar tu contraseña y a su vez acceder al portal. Si en un máximo de 24 horas no has recibido este email, por favor comunícanoslo mandando un email a soportetecnico@massiva.com.mx y nos pondremos en contacto contigo y te enviaremos de nuevo el acceso.</div>
                                <a class="NoneActive first" href="#pr_d3"><p>NO SE CUÁL ES MI USUARIO ¿PUEDO CAMBIARLO?</p></a>
                                <div id="pr_d3">Tu usuario es la dirección de email con la que te diste de alta en massiva. </div>
                                <a class="NoneActive first" href="#pr_d4"><p>¿CÓMO PUEDO RESTABLECER MI CONTRASEÑA?</p></a>
                                <div id="pr_d4">¿Olvidaste tu contraseña? No pasa nada, pulsa sobre el enlace de ¨Se te olvidó tu contraseña¨. Te llevará a una nueva página donde indicarás tu usuario (es tu dirección de email) y un captcha (verifica que no eres un robot introduciendo el texto de la imagen). Una vez enviado, te mostrará un nuevo texto que te indica que en breve recibirás un email procedente de notificaciones@massiva.com.mx con las instrucciones para reestablecer la contraseña.</div>
                                <a class="NoneActive first" href="#pr_d5"><p>¿CÓMO PUEDO CERRAR MI SESIÓN?</p></a>
                                <div id="pr_d5">Existen dos formas correctas de cerrar sesión en la platafoma; la primera sería, cerrar sesión en el botón del submenú, la segunda sería, automáticamente después de 15 minutos sin actividad en su perfil, ya que por su seguridad se cerrará automáticamente.</div>
                                <a class="NoneActive first" href="#pr_d6"><p>NECESITO CAMBIAR MIS DATOS EN EL PERFIL</p></a>
                                <div id="pr_d6">Ingresa en el submenú del lado superior derecho donde aparecerá tu nombre, ahí se desplegará una opción de Perfil en la cual te aparecerá toda la información que puedes modificar.</div>
                                <a class="NoneActive first" href="#pr_d7"><p>NECESITO DARME DE BAJA</p></a>
                                <div id="pr_d7">Para poder dar de baja deberás entrar a tu Perfil y presionar el botón de Darme de baja, solo ten en cuenta tu fecha de corte.  Con massiva no hay contratos forzosos.</div>
                                <a class="NoneActive first" href="#pr_d8"><p>¿SU PLATAFORMA FUNCIONA EN PC Y MAC?</p></a>
                                <div id="pr_d8">Massiva se puede visualizar en cualquier sistema operativo que cuente con un explorador de internet. Funcionan en Google Chrome, Firefox, Safari, Ophera y también en Internet Explorer pero no es recomendable.</div>
                            </div>
                        </div>

                        <div class="accordion col-sm-12 col-md-12" style="font-family: 'century Gothic'">

                            <a class="first" data-toggle="collapse" href="#catpr_a5" onclick="toggleArrow(this)"><h3><b>OTRAS CONSULTAS O DUDAS</b><i class="fa fa-arrow-right"></i></h3></a>
                        
                            <div class="accordion s1 collapse" id="catpr_a5">
                               <a class="NoneActive first" href="#pr_e1"><p>¿TENGO QUE HACER DECLARACIONES?</p></a>
                                <div id="pr_e1">Massiva se encarga de hacer tu contabilidad y tenerla al día, realizar tus declaraciones y el seguimiento de tu pago de impuestos, mientras factures o no. Nuestro trabajo es quitarte preocupaciones y ese trabajo al que no quieres enfocarte. Solo te avisaremos por mail para que presiones el botón de Autorizar declaración y listo.</div>
                                <a class="NoneActive first" href="#pr_e2"><p>TENGO DECLARACIONES ATRASADAS ¿ME PUEDE APOYAR MASSIVA?</p></a>
                                <div id="pr_e2">Claro que sí, primero analizamos tu contabilidad atrasada bajo un costo accesible y posteriormente podrás ser parte de massiva con toda tu contabilidad saneada, donde ahora sí, nosotros nos encargaremos de realizarte las declaraciones de forma puntual para que no vuelvas a tener ningún problema fiscal. En el pre registro selecciona ¨Contabilidad Atrasada¨ para que podamos guiarte para los siguientes pasos.</div>
                                <a class="NoneActive first" href="#pr_e3"><p>¿QUÉ SIGNIFICA UN GASTO DEDUCIBLE?</p></a>
                                <div id="pr_e3">Son aquellos gastos que surgen por la realización de tus actividades. Los cuales ahora podrás tenerlos de forma ordenada y bajo control dentro de tu perfil en la plataforma de massiva. Recuerda que si facturas tus tickets tu pago de impuestos se reduce y para eso massiva te apoya con unos sencillos tips.</div>
                                <a class="NoneActive first" href="#pr_e4"><p>¿QUÉ ES CFDI?</p></a>
                                <div id="pr_e4">Son documentos digitales (PDF y XML), cuya expedición es obligatoria al realizar una actividad (ingreso), y son necesarios para deducir erogaciones (compras y gastos).</div>
                                <a class="NoneActive first" href="#pr_e5"><p>¿PARA QUÉ SIRVE EL RFC DEL SAT?</p></a>
                                <div id="pr_e5">No se utiliza solamente para pagar impuestos o consultar nuestras obligaciones fiscales. Sino que, a través del RFC podremos tener algunas otras facilidades: Se te solicita para abrir cuentas bancarias. Se te suele pedir para otorgar tarjetas de créditos. El acceso a programas sociales o becas también requiere de RFC. La compra venta de inmuebles requiere de RFC. Se utiliza para el acceso a la Seguridad Social así como para la participación en las Afore. Para solicitar un CFDI a nombre de un contribuyente. Para poder utilizar los servicios del SAT.</div>
                                <a class="NoneActive first" href="#pr_e6"><p>¿CÓMO PUEDO SABER SI SOY PERSONA FÍSICA O MORAL?</p></a>
                                <div id="pr_e6">Podrás saberlo al revisar tu RFC, si sólo tienes un RFC con parte de tus iniciales, eres Persona Física, pero si tienes un RFC donde aparecen iniciales de tu empresa, entonces eres Persona Moral.</div>
                                <a class="NoneActive first" href="#pr_e7"><p>¿USTEDES PUEDEN SOLICITAR MIS DOCUMENTOS OFICIALES A MI CONTADOR?</p></a>
                                <div id="pr_e7">Massiva, por politicas internas de seguridad y por disposición según el artículo 16 de la Constitución  sobre protección de datos personales no podríamos realizar dicha solicitud, sólo el propietario de dichos documentos oficiales podria solicitarlos, pero si requiere alguna acción legal, con gusto masslegal podría apoyarlo en ese caso, a través de nuestros asesores especialistas.</div>
                            </div>
                        </div>
                    </div>
                </div>
           </section>
        </div>
>>>>>>> 1dfc12d973825cee1ec8afcc7447f0285368ab5d
        
    <!--seccion de contacto-->
    <div id="contacti" class="no-top no-bottom">
            <section id="section-contact" class="side-bg left no-top np-bottom" data-bgcolor="#f6f6f6">
                <div class="image-container col-md-7 pull-left" data-delay="0"><div class="background-image"></div></div>
                <div class="container-fluid">
                    <div class="row-fluid">
                        <div class="col-md-7 lg-text-white">
                            <div class="inner-padding">
                                    <div class="col-md-6">
                                        <h3 style="font-family: 'century Gothic'">Oficina México</h3>
                                        <address class="s1">
                                            <span><i class="fa fa-map-marker fa-lg" style="color: #e2004a;"></i>Horario de 9:00 - 18:30</span><br>
                                            <span><i class="fa fa-envelope-o fa-lg" style="color: #e2004a"></i><a href="mailto:atencionalcliente@massiva.mx">atencionalcliente@massiva.mx</a></span><br>
                                        </address>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--formulario de contacto-->
                        <div class="col-md-5">
                            <div class="inner-padding">
                                <h3 style="font-family: 'century Gothic'">Formulario de contacto</h3>
                                <div class="row">
                                    <?php if($valCon == 1){?>
                                    <div class="alert alert-warning text-center"> Gracias por escribirnos, en breve nos pondremos en contacto contigo </div>
                                    <?php }?>
                                    <?php if($valCon == 2){?>
                                    <div class="alert alert-danger text-center"> Ocurrió un error, por favor verifica tus datos </div>
                                    <?php }?>
                                </div>

                                <form name="contactForm" class="form-underline" method="post" action='panel/admin/correos/contactoWeb.php'  style="font-family: 'century Gothic'">
                                    <input type='hidden' name='accion' id='accion' value='nuevocontracto'>
                                        <div class="field-set"><input type='text' name='name2' id='name2' class="form-control" placeholder="Nombre" required></div>
                                        <div class="field-set"><input type='text' name='apellidos2' id='apellidos2' class="form-control" placeholder="Apellidos"></div>
                                        <div class="field-set"><input type='text' name='correo2' id='correo2' class="form-control" placeholder="Email" required></div>
                                        <div class="field-set"><input type='text' name='celular2' id='celular2' class="form-control" placeholder="Celular" required></div>
                                        <div class="field-set"><input type='text' name='ciudad2' id='ciudad2' class="form-control" placeholder="Ciudad"></div>
                                        <div class="field-set">
                                            <select class="form-control" id="cActividad" name="cActividad" required>
                                                <option>Selecciona tu forma jurídica</option>
                                                <option>Persona Física</option>
                                                <option>Asalariados</option>
                                                <!--option>Persona Moral</option-->

                                                <option>Asalariados</option>
                                            </select>
                                            <div class="field-set"><textarea name='message' id='message' class="form-control" placeholder="Escriba su mensaje" required></textarea></div>
                                            <div class="spacer-half"></div>
                                            <div class="g-recaptcha" data-sitekey="6LfdeZsUAAAAAEevIg8jYdNJej570XjKhLLQtAxN"></div>
                                            <br>
                                            <div id='text-center'>
                                                <input type='submit'  style="background-color: rgb(226, 0, 74)" value='Enviar mensaje' class="btn btn-custom color-2">
                                            </div>
                                        </div>
                                </form>
                                 
                            </div>
                        </div>
                </div>
            </section>
    </div>
            
    <!--footer del sitio-->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div-- class="widget">
                        <h5 style="font-family: 'century Gothic'">AVISO LEGAL IMPORTANTE </h5>
                        <div class="tiny-border"><span></span></div>
                       <p class="text-center" style="font-family: 'century Gothic'">MASSIVA CONTABILIDAD INNOVADORA S.C. es responsable del tratamiento (uso) de sus datos personales.<br> Usted puede conocer nuestro Aviso de Privacidad integral solicitándolo al correo electrónico <a href='mailto:atencionalcliente@massiva.mx'>atencionalcliente@massiva.mx.</a></p><br>
                        <div class="text-center">
                            <a href="doc/AvisodePrivacidadMASSIVA.pdf" target="_blank" style="font-family: 'century Gothic'">Aviso de Privacidad</a> | <a href="doc/TerminoyCondicionesMASSIVA.pdf" target="_blank" style="font-family: 'century Gothic'">Términos y Condiciones</a>
                        </div><br>
                        <div class="text-center">
                        <img src="images/footer/amex.jpg" style="height: 40px;">
                        &nbsp;&nbsp;
                        <img src="images/footer/visa.png" style="height: 40px;">
                        &nbsp;&nbsp;
                        <img src="images/footer/mastercard.png" style="height: 40px;">
                        &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; 
                        <img src="images/footer/aws.png" style="height: 60px;">
                        &nbsp;&nbsp;
                        <img src="images/footer/pci.png" style="height: 40px;">
                        &nbsp;&nbsp;
                        <img src="images/footer/ssl.png" style="height: 40px;">
                        </div><br>
                    </div>
                </div>
            </div>
        </div>
        <!--valor para la informacion legal de la pagina--->
        <div class="subfooter">
            <div class="container text-center">
                  <div class="row"><div class="col-md-12" style="font-family: 'century Gothic'">&copy; 2020 Todos los Derechos Reservados. Diseño y programación por: Massiva Contabilidad Innovadora S.C.</div></div>
            </div>
        </div>
    </footer>
    <!---boton de fecla superior-->
    <a href="#" id="back-to-top" style="background-color:  rgb(226, 0, 74)"></a>
    <!---seccion para el boton de carga de la pagina-->
    <div id="preloader"><div class="s1"><span></span><span></span></div></div>

<!--scripts para los plugins--> 
    
<!--seccion de modal-->
<!---modal para el registro de informacion para contacto de telefono-->
<div class="modal inmodal fade" id="registro" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">¿Tienes dudas?</h4>
                Nuestro equipo de asesores te puede ayudar.
            </div>
            <!--valores ocultos-->
            <div class="modal-body">
                <div class="row" id='alertaLlama' name='alertaLlama'></div>
                
                    <div class="row">
                        <div class="form-group">
                            <div class="col-md-12">
                                <input type="text" id="asunto" name="asunto" style='width:100%' placeholder="Asunto" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group"><div class="col-md-12"></div></div>
                        <div class="form-group">
                             <div class="col-md-12">
                                <input type="text" id="nombre" name="nombre" style='width:100%' placeholder="Nombre" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group"><div class="col-md-12"></div></div>
                        <div class="form-group">
                            <div class="col-md-12">
                                <input type="text" id="numero" name="numero" placeholder="Teléfono" onkeypress="return NumCheck(event, this)" class="form-control" required>
                            </div>
                        </div>

                    </div>
                
                <div class="form-group"><div class="col-md-12"></div></div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="alert alert-warning text-center" role="alert" style="height: 40px !important;"><small>Nuestro tiempo de respuesta es de 3 horas máximo.</small></div>
                    </div>
                </div>
                <div class="g-recaptcha" data-sitekey="6LfdeZsUAAAAAEevIg8jYdNJej570XjKhLLQtAxN" style="text-align: -webkit-center;"></div>
            </div>
            <div class="modal-footer text-center">
                <button type="button" class="btn btn-primary" id='RNuevaLlamaREd'>Enviar</button>
                <button type="button" class="btn btn-default" id="btnCerrarLlama" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<!---modal para el formulario de incripcion-->
<div class="modal inmodal fade" id="altaR" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog  modal-lg">
        <div class="modal-content">
            <div class="modal-header text-center">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <img src="images/logocolor.png" style="height:35px;">
            </div>
            <!--valores ocultos-->

            <div class="modal-body">
                
                <div class="row" id='contentCargador' name='contentCargador'></div>
                <div class="row" id='alertAccion2' name='alertAccion2'></div>
                <form class="form-horizontal" id="fregistro" name="fregistro">
                    <div class="form-group">
                        <div class="col-xs-12 col-md-6">
                            <input type="text" class="form-control" id="nombreR" name='nombreR' placeholder="*Nombre"  onkeypress="return soloLetras(event, this)">
                        </div>
                        <div class="col-xs-12 col-md-6">
                            <input type="text" class="form-control" id="ape_paternoR" name='ape_paternoR' placeholder="*Apellido paterno"  onkeypress="return soloLetras(event, this)" >
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-12 col-md-6">
                            <input type="text" class="form-control" id="ape_maternoR" name='ape_maternoR' placeholder="*Apellido materno" required onkeypress="return soloLetras(event, this)">
                        </div>
                        <div class="col-xs-12 col-md-6">
                            <input type="text" class="form-control" id="telefonoR" name='telefonoR' placeholder="Télefono" onkeypress="return NumCheck(event, this)" >
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-12 col-md-6">
                            <input type="text" class="form-control" id="rfcR" name='rfcR' placeholder="*RFC"  maxlength="13" onblur="ValidaRfc(this.value)" style="text-transform:uppercase">
                        </div>
                        <div class="col-xs-12 col-md-6">
                            <input type="email" class="form-control" id="correoR" name='correoR' placeholder="*Correo" pattern="[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*@[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{1,5}" >
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-12 col-md-6">
                            <input type="text" class="form-control" id="tipoActividadR" name='tipoActividadR' placeholder="*Tipo de actividad que ejerces" >
                        </div>
                        <div class="col-xs-12 col-md-6">
                            <select class="form-control" id="formaJuridicaR" name='formaJuridicaR' >
                                <option>*Tu forma jurídica</option>
                                <option value="f">Persona Física</option>
                                <!--option value="m">Persona Moral</option-->

                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-12 col-md-6">
                            <select class="form-control" id="cantidadTrabajadoresR" name='cantidadTrabajadoresR' >
                              <option>Cantidad de trabajadores</option>
                              <option value="0">Tengo 0 trabajadores</option>
                              <option value="1">Tengo de 1 a 5 trabajadores</option>
                              <option value="2"> Tengo de 6 a 10 trabajadores</option>
                              <option value="3">Tengo de 11 a 20 trabajadores</option>
                              <option value="4">Tengo de 21 a 50 trabajadores</option>
                              <option value="5">Tengo más de 50 trabajadores</option>
                            </select>
                        </div>
                        <div class="col-xs-12 col-md-2">
                            <input type="checkbox" class="" id="noTengoEfirmaR" value="1" name='noTengoEfirmaR' onChange="comprobar(this);"/> No tengo eFirma
                        </div>
                        <div class="col-xs-12 col-md-4">
                            <input type="checkbox" class="" value="1" id="contabilidadAtrasadaR" name='contabilidadAtrasadaR' onChange="comprobar2(this);"/> Tengo mi contabilidad atrasada
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-12 col-md-12 text-center">
                            <input type="checkbox" class="" id="aviso" name='aviso' value="1"/>
                            <a href="doc/AvisodePrivacidadMASSIVA.pdf" target="_blank" style="font-family: 'century Gothic'">Aviso de Privacidad</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
                            <input type="checkbox" class="" id="terminos" name='terminos' value="1"/>
                            <a href="doc/TerminoyCondicionesMASSIVA.pdf" target="_blank" style="font-family: 'century Gothic'">Términos y Condiciones</a>   
                        </div>
                    </div>
                    <br>
                    
                    
       </form>
       </div>
            <div class="modal-footer text-center">
                <button type="button" id="btnRes" class="btn btn-primary">Registrarse</button>
                <button type="button" class="btn btn-default" id="btnce" data-dismiss="modal">Cerrar</button>
            </div>
       </div>
    </div>
</div>
        
</body>
</html>