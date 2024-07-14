<?php
/* Smarty version 4.3.2, created on 2024-07-14 21:44:45
  from '/Applications/XAMPP/xamppfiles/htdocs/SportsCenter/smarty/libs/templates/homeAdmin.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.2',
  'unifunc' => 'content_66942aad1b2529_55394911',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'd56f9a41d2a86a24d0b79f42cbf8b3e1ad77417c' => 
    array (
      0 => '/Applications/XAMPP/xamppfiles/htdocs/SportsCenter/smarty/libs/templates/homeAdmin.tpl',
      1 => 1720986283,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_66942aad1b2529_55394911 (Smarty_Internal_Template $_smarty_tpl) {
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
  <link rel="stylesheet" type="text/css" href="/SportsCenter/smarty/libs/css/bootstrap.css" />

  <!-- fonts style -->
  <link href="https://fonts.googleapis.com/css?family=Baloo+Chettan|Dosis:400,600,700|Poppins:400,600,700&display=swap"
    rel="stylesheet" />
  <!-- Custom styles for this template -->
  <link href="/SportsCenter/smarty/libs/css/style.css" rel="stylesheet" />
  <!-- responsive style -->
  <link href="/SportsCenter/smarty/libs/css/responsive.css" rel="stylesheet" />
   <link href="/SportsCenter/smarty/libs/css/index.css" rel="stylesheet" />
   <link href="/SportsCenter/smarty/libs/css/contattaci.css" rel="stylesheet" />
</head>

<body>
  <div class="hero_area">
    <!-- header section strats -->
    <header class="header_section">
      <div class="container">
        <nav class="navbar navbar-expand-lg custom_nav-container">
          <a class="navbar-brand" href="/SportsCenter/Amministratore/homeAdmin">
            <img src="/SportsCenter/smarty/libs/images/logo.png" alt="" />
            <span>
              SportsCenter
            </span>
          </a>
          <div class="contact_nav" id="">
            <ul class="navbar-nav ">
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
                <a class="nav-link" href="homeAdmin">Home<span class="sr-only">(current)</span></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="/SportsCenter/Utente/logout">Logout</a>
              </li>
            </ul>
          </div>
        </div>
      </nav>
    </div>
  </div>
  <div class="slider_container">
    <div class="container">
      <div class="row">
        <div class="col-lg-6 col-md-7 offset-md-6 offset-md-5">
          <div class="detail-box">
            <h2>
              Benvenuto, <?php echo $_smarty_tpl->tpl_vars['nomeUtente']->value;?>
 (Amministratore)
            </h2>
            <h1>
            </h1>
            <p>
              
            </p>
            <div class="btn-box">
              <a href="listaUtenti" class="btn-1">
                Utenti
              </a>
              <a href="listaPrenotazioni" class="btn-1">
                Prenotazioni
              </a>
              <a href="listaRecensioni" class="btn-1">
                Recensioni
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- end slider section -->


  <!-- service section -->

  
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
        </div>
        <div class="col-md-3">
          <h6>
            Contattaci
          </h6>
          <div class="info_link-box">
            <a>
              <img src="/SportsCenter/smarty/libs/images/location-white.png" alt="">
              <span>Via Vetoio, Edificio Coppito 1, 67100 L'Aquila</span>
            </a>
            <a>
              <img src="/SportsCenter/smarty/libs/images/call-white.png" alt="">
              <span>(+39) 0862 123456</span>
            </a>
            <a>
              <img src="/SportsCenter/smarty/libs/images/mail-white.png" alt="">
              <span>info@sportscenter.com</span>
            </a>
          </div>
        </div>
        <div class="col-md-3">
          <div>
            <a href="https://www.facebook.com/univaq.it">
              <img src="/SportsCenter/smarty/libs/images/facebook_small_logo.png" alt="Logo Facebook" width=10% height=auto>
            </a>
          </div>
          <div>
            <a href="https://www.instagram.com/univaq.it">
              <img src="/SportsCenter/smarty/libs/images/instagram_small_logo.png" alt="Logo Instagram" width=10% height=auto>
            </a>
          </div>
          <div>
            <a href="https://x.com/univaq">
              <img src="/SportsCenter/smarty/libs/images/twitter_small_logo.png" alt="Logo Twitter" width=10% height=auto>
            </a>
          </div>
          <div>
            <a href="https://www.tiktok.com/">
              <img src="/SportsCenter/smarty/libs/images/tiktok_small_logo.png" alt="Logo TikTok" width=10% height=auto>
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
      &copy; 2024 Tutti i diritti sono riservati. Realizzato da
      <a href="https://www.trend-online.com/wp-content/uploads/2024/03/gerry-scotti-compagna.jpg">Francis, Das e Daieg</a>
    </p>
  </section>
  <!-- footer section -->

  <?php echo '<script'; ?>
 type="text/javascript" src="/SportsCenter/smarty/libs/js/jquery-3.4.1.min.js"><?php echo '</script'; ?>
>
  <?php echo '<script'; ?>
 type="text/javascript" src="/SportsCenter/smarty/libs/js/bootstrap.js"><?php echo '</script'; ?>
>
  <?php echo '<script'; ?>
 type="text/javascript" src="/SportsCenter/smarty/libs/js/index.js"><?php echo '</script'; ?>
>
</body>

</html><?php }
}
