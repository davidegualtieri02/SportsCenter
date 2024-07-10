<?php
/* Smarty version 4.3.2, created on 2024-07-10 18:12:52
  from '/Applications/XAMPP/xamppfiles/htdocs/SportsCenter/smarty/libs/templates/attrezzatura_calcio1.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.2',
  'unifunc' => 'content_668eb3047989b9_05202075',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'e35c9fdcf4613e50e69b98ee181da7d019ffdbc4' => 
    array (
      0 => '/Applications/XAMPP/xamppfiles/htdocs/SportsCenter/smarty/libs/templates/attrezzatura_calcio1.tpl',
      1 => 1720456382,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_668eb3047989b9_05202075 (Smarty_Internal_Template $_smarty_tpl) {
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
    <link rel="icon" href="images/logo.png" type="image/x-icon" />
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.1.3/assets/owl.carousel.min.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <link href="https://fonts.googleapis.com/css?family=Baloo+Chettan|Dosis:400,600,700|Poppins:400,600,700&display=swap" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/responsive.css" rel="stylesheet">
    <link href="css/attrezzatura.css" rel="stylesheet">
    <?php echo '<script'; ?>
>
        function ready(){
            if (!navigator.cookieEnabled) {
                alert('Attenzione! Attivare i cookie per proseguire correttamente la navigazione');
            }
        }
        document.addEventListener("DOMContentLoaded", ready);

        // Funzione per gestire il click sulla casella dell'attrezzatura
        function handleCheckboxClick() {
            var checkbox = document.getElementById('attrezzaturaCheckbox');
            var attrezzaturaValue = checkbox.checked ? 'true' : 'false'; // 'true' se spuntato, altrimenti 'false'
            // Assegna il valore dell'attrezzatura a un campo nascosto nel form
            document.getElementById('attrezzaturaHidden').value = attrezzaturaValue;
        }

        // Funzione per selezionare l'orario
        function selectTime(element) {
            var selectedTime = element.getAttribute('data-time');
            var selectedDay = element.getAttribute('data-day');
            // Imposta i valori dei campi nascosti per giorno e ora selezionati
            document.getElementById('selectedDay').value = selectedDay;
            document.getElementById('selectedTime').value = selectedTime;
        }

        // Aggiungi event listener al checkbox per gestire il click
        var checkbox = document.getElementById('attrezzaturaCheckbox');
        if (checkbox) {
            checkbox.addEventListener('click', handleCheckboxClick);
        }
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
                                        <a class="nav-link" href="home.tpl">Home</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="prenotazione.tpl">Prenotazione</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="servizi.tpl">Servizi</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link current-page" href="contattaci.tpl">Contattaci</a>
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
    </div>
    <section class="contact_section layout_padding" style="padding-top: 30px; padding-bottom: 30px;">
        <div class="container">
            <div class="heading_container"></div>
            <div class="layout_padding2-top">
                <div class="row">
                    <div class="col-md-6">
                        <!-- Singola casella di controllo -->
                        <div class="equipment-list">
                            <h3>Seleziona l'attrezzatura:</h3>
                            <form id="equipmentForm" method="post">
                                <label><input type="checkbox" id="attrezzaturaCheckbox" name="attrezzatura" value="true"> Attrezzatura</label>
                                <input type="hidden" id="attrezzaturaHidden" name="attrezzatura" value="">
                                <input type="hidden" id="selectedDay" name="selected_day" value="<?php echo $_smarty_tpl->tpl_vars['selected_day']->value;?>
">
                                <input type="hidden" id="selectedTime" name="selected_time" value="<?php echo $_smarty_tpl->tpl_vars['selected_time']->value;?>
">
                                <button type="submit" class="btn btn-avanti float-right">Continua e paga</button>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="text-center mb-4">
                            <img src="images/campocalcio.jpg" alt="Campo in erba esterna, costo campo: 60 euro" style="max-width: 100%; height: auto;">
                        </div>
                        <div class="campo-description">
                            <h3>Descrizione del campo:</h3>
                            <p>Campo da calcio a 5 all'aperto. Costo campo: 60 euro</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
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
                        <li class=" ">
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
 type="text/javascript" src="js/jquery-3.4.1.min.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 type="text/javascript" src="js/bootstrap.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 type="text/javascript" src="js/index.js"><?php echo '</script'; ?>
>
</body>
</html>
<?php }
}
