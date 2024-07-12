<?php
/* Smarty version 4.3.2, created on 2024-07-12 23:32:19
  from '/Users/diegoromanelli/Desktop/PPIW/Progetto/SportsCenter/smarty/libs/templates/confermaPrenotazione.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.2',
  'unifunc' => 'content_6691a0e33d6015_31874414',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'bfa001aef3e0d0b699c5fb4dcd203606bba6fe2a' => 
    array (
      0 => '/Users/diegoromanelli/Desktop/PPIW/Progetto/SportsCenter/smarty/libs/templates/confermaPrenotazione.tpl',
      1 => 1720687036,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6691a0e33d6015_31874414 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html lang="it">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="keywords" content="">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>SportsCenter</title>
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.1.3/assets/owl.carousel.min.css">
  <link rel="stylesheet" type="text/css" href="/SportsCenter/smarty/libs/css/bootstrap.css">
  <link href="https://fonts.googleapis.com/css?family=Baloo+Chettan|Dosis:400,600,700|Poppins:400,600,700&display=swap" rel="stylesheet">
  <link href="/SportsCenter/smarty/libs/css/style.css" rel="stylesheet">
  <link href="/SportsCenter/smarty/libs/css/responsive.css" rel="stylesheet">
  <link href="/SportsCenter/smarty/libs/css/attrezzatura.css" rel="stylesheet">
</head>
<body class="sub_page">
  <div class="hero_area">
    <header class="header_section">
      <div class="container">
        <nav class="navbar navbar-expand-lg custom_nav-container">
          <a class="navbar-brand" href="/SportsCenter/Utente/home">
            <img src="/SportsCenter/smarty/libs/images/logo.png" alt="">
            <span>SportsCenter</span>
          </a>
          <div class="contact_nav">
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link" href="/SportsCenter/Utente/home/contattaci">
                  <img src="/SportsCenter/smarty/libs/images/location.png" alt="">
                  <span>Location</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="/SportsCenter/Utente/home/contattaci">
                  <img src="/SportsCenter/smarty/libs/images/call.png" alt="">
                  <span>(+39) 0862 123456</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="/SportsCenter/Utente/home/contattaci">
                  <img src="/SportsCenter/smarty/libs/images/envelope.png" alt="">
                  <span>info@sportscenter.com</span>
                </a>
              </li>
            </ul>
          </div>
        </nav>
      </div>
    </header>
    <section class="slider_section position-relative">
      <div class="container">
        <div class="custom_nav2">
          <nav class="navbar navbar-expand-lg custom_nav-container">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <div class="d-flex flex-column flex-lg-row align-items-center">
                <ul class="navbar-nav">
                  <li class="nav-item">
                    <a class="nav-link" href="/SportsCenter/Utente/home">Home</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="/SportsCenter/Utente/home/prenotazioni">Prenotazioni/a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="/SportsCenter/Utente/home/servizi">Servizi</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link current-page" href="/SportsCenter/Utente/home/contattaci">Contattaci</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="/SportsCenter/Utente/home/profilo">Profilo</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="/SportsCenter/">Logout</a>
                  </li>
                </ul>
                <form class="form-inline my-2 my-lg-0 ml-0 ml-lg-4 mb-3 mb-lg-0">
                  <button class="btn my-2 my-sm-0 nav_search-btn" type="submit"></button>
                </form>
              </div>
            </div>
          </nav>
        </div>
      </div>
    </section>
  </div>
  <section class="contact_section layout_padding" style="padding-top: 30px; padding-bottom: 30px;">
    <div class="container">
    <form method="post" action="/SportsCenter/PrenotaCampo/MostraConfermaPrenotazione">
      <div class="heading_container">
        <h2>Prenotazione effettuata</h2>
      </div>
      <div class="layout_padding2-top">
        <div class="row">
          <div class="col-md-12 text-center">
            <p style="font-size: 18px;">Dati della prenotazione:</p>
            <p>Data: <?php echo $_smarty_tpl->tpl_vars['data']->value;?>
</p>
            <p>Ora: <?php echo $_smarty_tpl->tpl_vars['ora']->value;?>
</p>
            <p>Attività: <?php echo $_smarty_tpl->tpl_vars['titoloCampo']->value;?>
</p>
            <p>Costo: <?php echo $_smarty_tpl->tpl_vars['prezzoCampo']->value;?>
</p>
            <p>Attrezzatura: <?php if ($_smarty_tpl->tpl_vars['attrezzatura']->value) {?>Sì<?php } else { ?>No<?php }?></p>
            <p>Pagamento: Pagamento effettuato con successo</p>
          </div>
        </div>
      </div>
      </form>
    </div>
  </section>

  <!-- info section -->

  <section class="info_section layout_padding2-top">
    <div class="container">
      <div class="row">
        <div class="col-md-3">
          <h6>
            Qualche info su SportsCenter
          </h6>
          <p>
            In realtà non esiste nessun centro sportivo, è il progetto per un esame universitario.
          </p>
        </div>
        <div class="col-md-2 offset-md-1">
          <h6>
            Menù
          </h6>
          <ul>
            <li class=" active">
              <a class="" href="/SportsCenter/Utente/home">Home</a>
            </li>
            <li class="">
              <a class="" href="/SportsCenter/Utente/home/prenotazioni">Prenotazioni</a>
            </li>
            <li class="">
              <a class="" href="/SportsCenter/Utente/home/servizi">Servizi</a>
            </li>
            <li class="">
              <a class="" href="/SportsCenter/Utente/home/contattaci">Contattaci</a>
            </li>
            <li class="">
            <a class="" href="/SportsCenter/Utente/home/profilo">Profilo</a>
          </li>
            <li class="">
              <a class="" href="/SportsCenter/">Logout</a>
            </li>
          </ul>
        </div>
        <div class="col-md-3">
          <h6>
            Contattaci
          </h6>
          <div class="info_link-box">
            <a href="">
              <img src="/SportsCenter/smarty/libs/images/location-white.png" alt="">
              <span>Via Vetoio, Coppito 1, L'Aquila</span>
            </a>
            <a href="">
              <img src="im/SportsCenter/smarty/libs/images/call-white.png" alt="">
              <span>(+39) 0862 123456</span>
            </a>
            <a href="">
              <img src="ima/SportsCenter/smarty/libs/images/mail-white.png" alt="">
              <span>info@sportscenter.com</span>
            </a>
          </div>
          <div class="info_social">
            <div>
              <a href="">
                <img src="/SportsCenter/smarty/libs/images/facebook-logo-button.png" alt="">
              </a>
            </div>
            <div>
              <a href="">
                <img src="/SportsCenter/smarty/libs/images/twitter-logo-button.png" alt="">
              </a>
            </div>
            <div>
              <a href="">
                <img src="/SportsCenter/smarty/libs/images/linkedin.png" alt="">
              </a>
            </div>
            <div>
              <a href="">
                <img src="/SportsCenter/smarty/libs/images/instagram.png" alt="">
              </a>
            </div>
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
 src="/SportsCenter/smarty/libs/js/attrezzatura.js"><?php echo '</script'; ?>
>
</body>
</html>
<?php }
}
