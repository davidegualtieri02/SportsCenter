<?php
/* Smarty version 4.3.2, created on 2024-07-14 20:20:56
  from '/Applications/XAMPP/xamppfiles/htdocs/SportsCenter/smarty/libs/templates/scrivi_recensione.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.2',
  'unifunc' => 'content_669417081bb971_77369978',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '90408469e71b4c611b3be42c93cb7a5199fc61d7' => 
    array (
      0 => '/Applications/XAMPP/xamppfiles/htdocs/SportsCenter/smarty/libs/templates/scrivi_recensione.tpl',
      1 => 1720981254,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_669417081bb971_77369978 (Smarty_Internal_Template $_smarty_tpl) {
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
  <link rel="icon" href="/SportsCenter/smarty/libs/images/logo.png" type="image/x-icon" />

  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.1.3/assets/owl.carousel.min.css">
  <link rel="stylesheet" type="text/css" href="/SportsCenter/smarty/libs/css/bootstrap.css">
  <link href="https://fonts.googleapis.com/css?family=Baloo+Chettan|Dosis:400,600,700|Poppins:400,600,700&display=swap" rel="stylesheet">
  <link href="/SportsCenter/smarty/libs/css/style.css" rel="stylesheet">
  <link href="/SportsCenter/smarty/libs/css/responsive.css" rel="stylesheet">
  
    <?php echo '<script'; ?>
>
        function ready() {
            if (!navigator.cookieEnabled) {
                alert('Attenzione! Attivare i cookie per proseguire correttamente la navigazione');
            }
        }
        document.addEventListener("DOMContentLoaded", ready);
    <?php echo '</script'; ?>
>
    
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
                <a class="nav-link" href="/SportsCenter/Utente/contatti">
                  <img src="/SportsCenter/smarty/libs/images/location.png" alt="">
                  <span>Location</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="/SportsCenter/Utente/contatti">
                  <img src="/SportsCenter/smarty/libs/images/call.png" alt="">
                  <span>(+39) 0862 123456</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="/SportsCenter/Utente/contatti">
                  <img src="/SportsCenter/smarty/libs/images/envelope.png" alt="">
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
                        <button class="navbar-toggler" type="button" data-toggle="collapse"
                            data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>

                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <div class="d-flex flex-column flex-lg-row align-items-center">
                                <ul class="navbar-nav">
                                    <li class="nav-item">
                                        <a class="nav-link" href="/SportsCenter/Utente/home">Home</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="/SportsCenter/Utente/prenotazioni">Prenotazioni</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="/SportsCenter/PrenotaCampo/home">Servizi</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="/SportsCenter/Utente/contatti">Contatti</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="/SportsCenter/Utente/profilo">Profilo</a>
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
        </section>
        <!-- end slider section -->
    </div>

    <!-- about section -->
    <section class="about_section layout_padding">
        <div class="container">
            <div class="heading_container">
                <h2>
                    Prenotazione
                </h2>
            </div>
            <div class="box">
                <div class="detail-box">
                    <p>
                        Codice prenotazione: <?php echo $_smarty_tpl->tpl_vars['id_prenotazione']->value;?>
<br>
                        Data: <?php echo $_smarty_tpl->tpl_vars['dataPrenotazione']->value;?>
<br>
                        Orario: <?php echo $_smarty_tpl->tpl_vars['orarioPrenotazione']->value;?>
:00<br>
                        Campo: <?php echo $_smarty_tpl->tpl_vars['titoloCampo']->value;?>
<br>
                        Attrezzatura: 
                        <?php if ($_smarty_tpl->tpl_vars['attrezzatura']->value == 1) {?>
                        richiesta.
                        <?php } else { ?>
                        non richiesta.
                        <?php }?>
                        <br>
                    </p>
                    <a class="btn btn-primary" href="/SportsCenter/PrenotaCampo/annullaPrenotazione/<?php echo $_smarty_tpl->tpl_vars['id_prenotazione']->value;?>
">Annulla prenotazione</a>
                </div>
            </div>
        </div>
    </section>
    <!-- end about section -->

    <!-- recensione section -->
    <section class="recensione_section layout_padding">
        <div class="container">
            <div class="heading_container">
                <h2>
                    Lascia una Recensione
                </h2>
            </div>
            <div class="box">
                <div class="detail-box">
                    <form id="recensione-form" action="/SportsCenter/Recensione/scriviRecensione/<?php echo $_smarty_tpl->tpl_vars['id_prenotazione']->value;?>
" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="id_prenotazione" value="<?php echo $_smarty_tpl->tpl_vars['id_prenotazione']->value;?>
">
                        <input type="hidden" name="idUtente" value="<?php echo $_smarty_tpl->tpl_vars['idUtente']->value;?>
">
                        <textarea id="recensione-text" name="recensione_text" rows="4" cols="50"
                            placeholder="Scrivi la tua recensione qui... (allega una immagine)"></textarea>
                        <br>
                        <input type="file" name="recensione_image" id="recensione_image">
                        <div id="preview"></div>
                        <br>
                        <a href = "/SportsCenter/Recensione/scriviRecensione/<?php echo $_smarty_tpl->tpl_vars['id_prenotazione']->value;?>
"><button type="submit" class="btn btn-success">Invia Recensione</button></a>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- end recensione section -->

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
            <li class="">
              <a class="" href="/SportsCenter/Utente/home">Home</a>
            </li>
            <li class="">
              <a class="" href="/SportsCenter/Utente/prenotazioni">Prenotazioni</a>
            </li>
            <li class="">
              <a class="" href="/SportsCenter/PrenotaCampo/servizi">Servizi</a>
            </li>
            <li class="">
              <a class="" href="/SportsCenter/Utente/contatti">Contatti</a>
            </li>
            <li class="">
              <a class="" href="/SportsCenter/Utente/profilo">Profilo</a>
            </li>
            <li class="">
              <a class="" href="/SportsCenter/Utente/logout">Logout</a>
            </li>
          </ul>
        </div>
        <div class="col-md-3">
          <h6>
            Contattaci
          </h6>
          <div class="info_link-box">
            <a href="/SportsCenter/Utente/contatti">
              <img src="/SportsCenter/smarty/libs/images/location-white.png" alt="">
              <span>Via Vetoio, Edificio Coppito 1, 67100 L'Aquila</span>
            </a>
            <a href="/SportsCenter/Utente/contatti">
              <img src="/SportsCenter/smarty/libs/images/call-white.png" alt="">
              <span>(+39) 0862 123456</span>
            </a>
            <a href="/SportsCenter/Utente/contatti">
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
</html>
<?php }
}
