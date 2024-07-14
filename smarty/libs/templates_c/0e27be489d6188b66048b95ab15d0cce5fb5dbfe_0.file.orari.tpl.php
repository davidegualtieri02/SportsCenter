<?php
/* Smarty version 4.3.2, created on 2024-07-14 20:32:51
  from '/Applications/XAMPP/xamppfiles/htdocs/SportsCenter/smarty/libs/templates/orari.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.2',
  'unifunc' => 'content_669419d3376d66_17429135',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '0e27be489d6188b66048b95ab15d0cce5fb5dbfe' => 
    array (
      0 => '/Applications/XAMPP/xamppfiles/htdocs/SportsCenter/smarty/libs/templates/orari.tpl',
      1 => 1720981969,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_669419d3376d66_17429135 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'/Applications/XAMPP/xamppfiles/htdocs/SportsCenter/smarty/libs/plugins/function.math.php','function'=>'smarty_function_math',),));
?>
<!DOCTYPE html>
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
    <link href="/SportsCenter/smarty/libs/css/orari.css" rel="stylesheet">
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
                                        <a class="nav-link" href="/SportsCenter/Utente/prenotazioni">Prenotazioni</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="/SportsCenter/PrenotaCampo/servizi">Servizi</a>
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
    </div>

    <section class="contact_section layout_padding" style="padding-top: 50px; padding-bottom: 50px;">
        <div class="container">
            <div class="heading_container"></div>
            <div class="layout_padding2-top">
                <form id="timeForm" method="post" action="/SportsCenter/PrenotaCampo/MostraOrari/<?php echo $_smarty_tpl->tpl_vars['idCampo']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['giorno']->value;?>
">
                <input type="hidden" name="idCampo" value="<?php echo $_smarty_tpl->tpl_vars['idCampo']->value;?>
">
                <div class="row">
                    <div class="col-md-6">
                        <h3>Seleziona un orario per il giorno: <br><?php echo $_smarty_tpl->tpl_vars['giorno']->value;?>
</h3>
                        <!-- Tabella degli orari -->
                            <table class="orari-table">
                                <thead>
                                    <h5 style="color: #90EE90; ">
                                    <br><br>Ore disponibili:
                                    </h5>
                                </thead>
                                <style>
                                  .disabled {
                                    color: #ccc;
                                    pointer-events: none;
                                  }
                                </style>
                                <?php echo '<script'; ?>
>
                                    function selectTime(cell) {
                                    if (!cell.classList.contains('disabled')) {
                                        alert('Hai selezionato: ' + cell.getAttribute('data-time'));
                                    }
                                }
                                <?php echo '</script'; ?>
>
                                <tbody>
                                  <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['orari']->value, 'ora', false, 'key');
$_smarty_tpl->tpl_vars['ora']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['ora']->value) {
$_smarty_tpl->tpl_vars['ora']->do_else = false;
?>
                                    <?php if ($_smarty_tpl->tpl_vars['key']->value%4 == 0) {?><tr><?php }?>
                                <td onclick="selectTime(this)" data-time="<?php echo $_smarty_tpl->tpl_vars['ora']->value['orario'];?>
" <?php if (!$_smarty_tpl->tpl_vars['ora']->value['disponibile']) {?>class="disabled"<?php }?>>
                                      <?php echo $_smarty_tpl->tpl_vars['ora']->value['orario'];?>

                                </td>
                                    <?php if ($_smarty_tpl->tpl_vars['key']->value%4 == 3 || $_smarty_tpl->tpl_vars['key']->value == count($_smarty_tpl->tpl_vars['orari']->value)-1) {?></tr><?php }?>
                                  <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                                </tbody>
                            </table>
                            <input type="hidden" name="selected_day" value="<?php echo $_smarty_tpl->tpl_vars['giorno']->value;?>
">
                            <input type="hidden" name="selected_time" id="selected_time">
                    </div>
                    <div class="col-md-6">
                        <?php if ($_smarty_tpl->tpl_vars['idCampo']->value == "calcio1") {?> 
                          <img src="/SportsCenter/smarty/libs/images/campocalcio.jpg" alt="">
                        <?php } elseif ($_smarty_tpl->tpl_vars['idCampo']->value == "calcio2") {?>
                          <img src="/SportsCenter/smarty/libs/images/campocalciointerno.jpg" alt="">
                        <?php } elseif ($_smarty_tpl->tpl_vars['idCampo']->value == "padel1") {?>
                        <img src="/SportsCenter/smarty/libs/images/campopadelaperto.jpg" alt="">
                        <?php } elseif ($_smarty_tpl->tpl_vars['idCampo']->value == "padel2") {?>
                        <img src="/SportsCenter/smarty/libs/images/campopadelchiuso.jpg" alt="">
                        <?php } elseif ($_smarty_tpl->tpl_vars['idCampo']->value == "tennis1") {?>
                        <img src="/SportsCenter/smarty/libs/images/campotennisaperto.jpg" alt="">
                        <?php } elseif ($_smarty_tpl->tpl_vars['idCampo']->value == "tennis2") {?>
                        <img src="/SportsCenter/smarty/libs/images/campotennischiuso.jpg" alt="">
                        <?php } elseif ($_smarty_tpl->tpl_vars['idCampo']->value == "pallavolo1") {?>
                        <img src="/SportsCenter/smarty/libs/images/campopallavoloaperto.jpeg" alt="">
                        <?php } elseif ($_smarty_tpl->tpl_vars['idCampo']->value == "pallavolo2") {?>
                        <img src="/SportsCenter/smarty/libs/images/campopallavolochiuso.jpg" alt="">
                        <?php } elseif ($_smarty_tpl->tpl_vars['idCampo']->value == "basket1") {?>
                        <img src="/SportsCenter/smarty/libs/images/campobasket.jpg" alt="">
                        <?php } else { ?>
                        <img src="/SportsCenter/smarty/libs/images/campobasketinterno.jpg" alt="">
                        <?php }?>
                        <div class="text-center mb-4">
                        </div>
                        <div class="campo-description">
                            <h3>Descrizione del campo:</h3>
                            <p><?php echo $_smarty_tpl->tpl_vars['titoloCampo']->value;?>
.
                            Costo del campo:
                            <?php if ($_smarty_tpl->tpl_vars['id_tesseraUtente']->value == 0) {?>
                                <?php echo $_smarty_tpl->tpl_vars['prezzoCampo']->value;?>
 euro
                            <?php } else { ?>
                                <?php echo smarty_function_math(array('equation'=>"x-(x * y / 100)",'x'=>$_smarty_tpl->tpl_vars['prezzoCampo']->value,'y'=>30,'assign'=>"prezzo_scontato"),$_smarty_tpl);?>
 
                                Prezzo originale : <?php echo $_smarty_tpl->tpl_vars['prezzoCampo']->value;?>
 euro , prezzo scontato per utenti tesserati : <?php echo $_smarty_tpl->tpl_vars['prezzo_scontato']->value;?>
 euro.
                            <?php }?>
                            </p>
                            <!-- Pulsante "Avanti" allineato a destra -->
                            <a href = "/SportsCenter/PrenotaCampo/MostraOrari/<?php echo $_smarty_tpl->tpl_vars['idCampo']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['giorno']->value;?>
"><button class="btn btn-avanti float-right" type="submit">Avanti</button></a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
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
 type="text/javascript" src="/SportsCenter/smarty/libs/js/orari.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
>
    function selectTime(element) {
        // Ottieni l'orario selezionato dall'elemento cliccato
        var selectedTime = element.getAttribute('data-time');
        // Imposta il valore dell'input nascosto 'selected_time' con l'orario selezionato
        document.getElementById('selected_time').value = selectedTime;
    }
<?php echo '</script'; ?>
>
</body>
</html>
<?php }
}
