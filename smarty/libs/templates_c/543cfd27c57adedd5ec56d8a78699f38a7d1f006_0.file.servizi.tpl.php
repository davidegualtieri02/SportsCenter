<?php
/* Smarty version 4.3.2, created on 2024-07-10 18:12:52
  from '/Applications/XAMPP/xamppfiles/htdocs/SportsCenter/smarty/libs/templates/servizi.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.2',
  'unifunc' => 'content_668eb304a7a190_25349803',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '543cfd27c57adedd5ec56d8a78699f38a7d1f006' => 
    array (
      0 => '/Applications/XAMPP/xamppfiles/htdocs/SportsCenter/smarty/libs/templates/servizi.tpl',
      1 => 1720427587,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_668eb304a7a190_25349803 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html>

<head>
  <!-- Basic -->
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <!-- Mobile Metas -->
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <!-- Site Metas -->
  <meta name="keywords" content="" />
  <meta name="description" content="" />
  <meta name="author" content="" />

  <title>SportsCenter</title>
  <link rel="icon" href="images/logo.png" type="image/x-icon" />

  <!-- slider stylesheet -->
  <link rel="stylesheet" type="text/css"
    href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.1.3/assets/owl.carousel.min.css" />

  <!-- bootstrap core css -->
  <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />

  <!-- fonts style -->
  <link href="https://fonts.googleapis.com/css?family=Baloo+Chettan|Dosis:400,600,700|Poppins:400,600,700&display=swap"
    rel="stylesheet" />
  <!-- Custom styles for this template -->
  <link href="css/style.css" rel="stylesheet" />
  <!-- responsive style -->
  <link href="css/responsive.css" rel="stylesheet" />
   <link href="css/index.css" rel="stylesheet" />
   <link href="css/contattaci.css" rel="stylesheet" />

   <?php echo '<script'; ?>
>
        function ready(){
            if (!navigator.cookieEnabled) {
                alert('Attenzione! Attivare i cookie per proseguire correttamente la navigazione');
            }
        }
        document.addEventListener("DOMContentLoaded", ready);
    <?php echo '</script'; ?>
>

</head>

<body>
  <div class="hero_area">
    <!-- header section strats -->
    <header class="header_section">
      <div class="container">
        <nav class="navbar navbar-expand-lg custom_nav-container">
          <a class="navbar-brand" href="home.tpl">
            <img src="images/logo.png" alt="" />
            <span>
              SportsCenter
            </span>
          </a>
          <div class="contact_nav" id="">
            <ul class="navbar-nav ">
              <li class="nav-item">
                <a class="nav-link" href="contattaci.tpl">
                  <img src="images/location.png" alt="" />
                  <span>Location</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="contattaci.tpl">
                  <img src="images/call.png" alt="" />
                  <span>Tel: (+39) 0862 123456</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="contattaci.tpl">
                  <img src="images/envelope.png" alt="" />
                  <span>info@sportscenter.com</span>
                </a>
              </li>
            </ul>
          </div>
        </nav>
      </div>
    </header>
<!-- end header section -->
<!-- slider section -->
<section class="slider_section position-relative">
  <div class="container">
    <div class="custom_nav2">
      <nav class="navbar navbar-expand-lg custom_nav-container">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <div class="d-flex flex-column flex-lg-row align-items-center">
            <ul class="navbar-nav">
              <li class="nav-item active">
                <a class="nav-link" href="home.tpl">Home<span class="sr-only">(current)</span></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="prenotazioni.tpl">Prenotazioni</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="servizi.tpl">Servizi</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="contattaci.tpl">Contattaci</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="profilo.tpl">Profilo</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="index.tpl">Logout</a>
              </li>
            </ul>
          </div>
        </div>
          </nav>
        </div>
      </div>
    </section>
    <!-- end slider section -->
  </div>

  <!-- service section -->

  <section class="service_section layout_padding">
    <div class="container">
      <div class="heading_container">
        <h2>
          I nostri campi
        </h2>
      </div>
      <div class="service_container">
        <div class="box">
          <img src="images/campocalcio.jpg" alt="">
          <h6 class="visible_heading">
            CALCIO ALL'APERTO
          </h6>
          <div class="link_box">
            <a href="calendario_calcio1.tpl">
              <img src="images/link.png" alt="">
            </a>
            <h6>
              CALCIO ALL'APERTO
            </h6>
          </div>
        </div>
        <div class="box">
          <img src="images/campocalciointerno.jpg" alt="">
          <h6 class="visible_heading">
            CALCIO AL CHIUSO
          </h6>
          <div class="link_box">
            <a href="calendario_calcio2.tpl">
              <img src="images/link.png" alt="">
            </a>
            <h6>
              CALCIO AL CHIUSO
            </h6>
          </div>
        </div>
        <div class="box">
          <img src="images/campopadelaperto.jpg" alt="">
          <h6 class="visible_heading">
            PADEL ALL'APERTO
          </h6>
          <div class="link_box">
            <a href="calendario_padel1.tpl">
              <img src="images/link.png" alt="">
            </a>
            <h6>
              PADEL ALL'APERTO
            </h6>
          </div>
        </div>
        <div class="box">
          <img src="images/campopadelchiuso.jpg" alt="">
          <h6 class="visible_heading">
            PADEL AL CHIUSO
          </h6>
          <div class="link_box">
            <a href="calendario_padel2.tpl">
              <img src="images/link.png" alt="">
            </a>
            <h6>
              PADEL AL CHIUSO
            </h6>
          </div>
        </div>
        <div class="box">
          <img src="images/campotennisaperto.jpg" alt="">
          <h6 class="visible_heading">
            TENNIS ALL'APERTO
          </h6>
          <div class="link_box">
            <a href="calendario_tennis1.tpl">
              <img src="images/link.png" alt="">
            </a>
            <h6>
              TENNIS ALL'APERTO
            </h6>
          </div>
        </div>
        <div class="box">
          <img src="images/campotennischiuso.jpg" alt="">
          <h6 class="visible_heading">
            TENNIS AL CHIUSO
          </h6>
          <div class="link_box">
            <a href="calendario_tennis2.tpl">
              <img src="images/link.png" alt="">
            </a>
            <h6>
              TENNIS AL CHIUSO
            </h6>
          </div>
        </div>
        <div class="box">
          <img src="images/campopallavoloaperto.jpeg" alt="">
          <h6 class="visible_heading">
            PALLAVOLO ALL'APERTO
          </h6>
          <div class="link_box">
            <a href="calendario_pallavolo1.tpl">
              <img src="images/link.png" alt="">
            </a>
            <h6>
              PALLAVOLO ALL'APERTO
            </h6>
          </div>
        </div>
        <div class="box">
          <img src="images/campopallavolochiuso.jpg" alt="">
          <h6 class="visible_heading">
            PALLAVOLO AL CHIUSO
          </h6>
          <div class="link_box">
            <a href="calendario_pallavolo2.tpl">
              <img src="images/link.png" alt="">
            </a>
            <h6>
              PALLAVOLO AL CHIUSO
            </h6>
          </div>
        </div>
        <div class="box">
          <img src="images/campobasket.jpg" alt="">
          <h6 class="visible_heading">
            BASKET ALL'APERTO
          </h6>
          <div class="link_box">
            <a href="calendario_basket1.tpl">
              <img src="images/link.png" alt="">
            </a>
            <h6>
              BASKET ALL'APERTO
            </h6>
          </div>
        </div>
        <div class="box">
          <img src="images/campobasketchiuso.jpg" alt="">
          <h6 class="visible_heading">
            BASKET AL CHIUSO
          </h6>
          <div class="link_box">
            <a href="calendario_basket2.tpl">
              <img src="images/link.png" alt="">
            </a>
            <h6>
              BASKET AL CHIUSO
            </h6>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- end service section -->

  <!-- info section -->

  <section class="info_section layout_padding2-top">

    <div class="container">
      <div class="row">
        <div class="col-md-3">
          <h6>
            Qualche info su SportsCenter
          </h6>
          <p>
            In realtà non esiste alcun centro sportivo, è il progetto per un esame universitario.
          </p>
        </div>
        <div class="col-md-2 offset-md-1">
          <h6>
            Menu
          </h6>
          <ul>
            <li class=" active">
              <a class="" href="index.tpl">Home<span class="sr-only">(current)</span></a>
            </li>
            <li class="">
              <a class="" href="prenotazioni.tpl">Prenotazioni</a>
            </li>
            <li class="">
              <a class="" href="servizi.tpl">Servizi</a>
            </li>
            <li class="">
              <a class="" href="contattaci.tpl">Contattaci</a>
            </li>
            <li class="">
              <a class="" href="login_form.tpl">Login</a>
            </li>
          </ul>
        </div>
        <div class="col-md-3">
          <h6>
            Contattaci
          </h6>
          <div class="info_link-box">
            <a href="contattaci.tpl">
              <img src="images/location-white.png" alt="">
              <span>Via Vetoio, Edificio Coppito 1, 67100 L'Aquila</span>
            </a>
            <a href="contattaci.tpl">
              <img src="images/call-white.png" alt="">
              <span>(+39) 0862 123456</span>
            </a>
            <a href="contattaci.tpl">
              <img src="images/mail-white.png" alt="">
              <span>info@sportscenter.com</span>
            </a>
          </div>
        </div>
        <div class="col-md-3">
          <div>
            <a href="https://www.facebook.com/univaq.it">
              <img src="images/facebook_small_logo.png" alt="Logo Facebook" width=10% height=auto>
            </a>
          </div>
          <div>
            <a href="https://www.instagram.com/univaq.it">
              <img src="images/instagram_small_logo.png" alt="Logo Instagram" width=10% height=auto>
            </a>
          </div>
          <div>
            <a href="https://x.com/univaq">
              <img src="images/twitter_small_logo.png" alt="Logo Twitter" width=10% height=auto>
            </a>
          </div>
          <div>
            <a href="https://www.tiktok.com/">
              <img src="images/tiktok_small_logo.png" alt="Logo TikTok" width=10% height=auto>
            </a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- end info section -->


  <!-- footer section -->
  <section class="container-fluid footer_section ">
    <p>
      &copy; 2024 Tutti i diritti sono riservati. Realizzato da Francis, Das & Daieg. E come semo?</a>
    </p>
  </section>
  <!-- footer section -->

  <?php echo '<script'; ?>
 type="text/javascript" src="js/jquery-3.4.1.min.js"><?php echo '</script'; ?>
>
  <?php echo '<script'; ?>
 type="text/javascript" src="js/bootstrap.js"><?php echo '</script'; ?>
>
  <?php echo '<script'; ?>
 type="text/javascript" src="js/index.js"><?php echo '</script'; ?>
>
</body>

</html><?php }
}
