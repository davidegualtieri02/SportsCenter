<?php
/* Smarty version 4.3.2, created on 2024-07-10 18:12:52
  from '/Applications/XAMPP/xamppfiles/htdocs/SportsCenter/smarty/libs/templates/scrivi_recensione.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.2',
  'unifunc' => 'content_668eb304aa1520_49188522',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '90408469e71b4c611b3be42c93cb7a5199fc61d7' => 
    array (
      0 => '/Applications/XAMPP/xamppfiles/htdocs/SportsCenter/smarty/libs/templates/scrivi_recensione.tpl',
      1 => 1720602932,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_668eb304aa1520_49188522 (Smarty_Internal_Template $_smarty_tpl) {
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

    <!-- slider stylesheet -->
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.1.3/assets/owl.carousel.min.css" />

    <!-- bootstrap core css -->
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />

    <!-- fonts style -->
    <link
        href="https://fonts.googleapis.com/css?family=Baloo+Chettan|Dosis:400,600,700|Poppins:400,600,700&display=swap"
        rel="stylesheet" />
    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet" />
    <!-- responsive style -->
    <link href="css/responsive.css" rel="stylesheet" />
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

<body class="sub_page about_page">
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
                                    <span>tel: +393661830182</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="contattaci.tpl">
                                    <img src="images/envelope.png" alt="" />
                                    <span>daiegrom@gmail.com</span>
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
                                        <a class="nav-link" href="home.tpl">Home</a>
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
                        Data: <?php echo $_smarty_tpl->tpl_vars['prenotazione']->value['data'];?>
<br>
                        Ora: <?php echo $_smarty_tpl->tpl_vars['prenotazione']->value['ora'];?>
<br>
                        Campo: <?php echo $_smarty_tpl->tpl_vars['prenotazione']->value['campo'];?>
<br>
                        Attrezzatura: <?php echo $_smarty_tpl->tpl_vars['prenotazione']->value['attrezzatura'];?>
<br>
                    </p>
                    <a class="btn btn-primary" href="CPrenotaCampo.php?action=annullaPrenotazione&prenotazioneId=<?php echo $_smarty_tpl->tpl_vars['prenotazione']->value->getId();?>
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
                    <form id="recensione-form" action="CRecensione.php?action=scriviRecensione" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="azione" value="scrivi_recensione">
                        <input type="hidden" name="prenotazione" value="<?php echo $_smarty_tpl->tpl_vars['prenotazione']->value;?>
">
                        <input type="hidden" name="idutente" value="<?php echo $_smarty_tpl->tpl_vars['idutente']->value;?>
">
                        <textarea id="recensione-text" name="recensione_text" rows="4" cols="50"
                            placeholder="Scrivi la tua recensione qui..."></textarea>
                        <br>
                        <input type="file" name="recensione_immagini[]" id="recensione-immagini" multiple>
                        <div id="preview"></div>
                        <br>
                        <button type="submit" class="btn btn-success" id="submit-recensione">Invia Recensione</button>
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
                        Informazioni SportsCenter
                    </h6>
                    <p>
                        Progetto esame
                    </p>
                </div>
                <div class="col-md-2 offset-md-1">
                    <h6>
                        Menù
                    </h6>
                    <ul>
                        <li class="">
                            <a class="" href="home.tpl">Home</a>
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
                            <a class="" href="profilo.tpl">Profilo</a>
                        </li>
                        <li class="">
                            <a class="" href="index.tpl">Logout</a>
                        </li>
                    </ul>
                </div>
                <div class="col-md-3">
                    <h6>
                        Contattaci
                    </h6>
                    <div class="info_link-box">
                        <a href="">
                            <img src="images/location-white.png" alt="">
                            <span> coppito1,via vetoio3</span>
                        </a>
                        <a href="">
                            <img src="images/call-white.png" alt="">
                            <span>+39 3661830182</span>
                        </a>
                        <a href="">
                            <img src="images/mail-white.png" alt="">
                            <span> lorfrac@gmail.com</span>
                        </a>
                    </div>
                    <div class="info_social">
                        <div>
                            <a href="">
                                <img src="images/facebook-logo-button.png" alt="">
                            </a>
                        </div>
                        <div>
                            <a href="">
                                <img src="images/twitter-logo-button.png" alt="">
                            </a>
                        </div>
                        <div>
                            <a href="">
                                <img src="images/linkedin.png" alt="">
                            </a>
                        </div>
                        <div>
                            <a href="">
                                <img src="images/instagram.png" alt="">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end info section -->

    <!-- footer section -->
    <section class="container-fluid footer_section">
        <p>
            &copy; 2024 All Rights Reserved. Design by
            <a href="https://html.design/">frack,daieg e das</a>
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
 type="text/javascript" src="js/profilo.js"><?php echo '</script'; ?>
>
    

</body>

</html>
<?php }
}
