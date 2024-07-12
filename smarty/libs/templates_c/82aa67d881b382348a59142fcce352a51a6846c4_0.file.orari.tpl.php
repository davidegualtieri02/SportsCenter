<?php
/* Smarty version 4.3.2, created on 2024-07-12 23:32:19
  from '/Users/diegoromanelli/Desktop/PPIW/Progetto/SportsCenter/smarty/libs/templates/orari.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.2',
  'unifunc' => 'content_6691a0e3322543_93618839',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '82aa67d881b382348a59142fcce352a51a6846c4' => 
    array (
      0 => '/Users/diegoromanelli/Desktop/PPIW/Progetto/SportsCenter/smarty/libs/templates/orari.tpl',
      1 => 1720770429,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6691a0e3322543_93618839 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'/Users/diegoromanelli/Desktop/PPIW/Progetto/SportsCenter/smarty/libs/plugins/function.math.php','function'=>'smarty_function_math',),));
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
                                <a class="nav-link" href="/SportsCenter/Utente/home/contattaci">
                                    <img src="/SportsCenter/smarty/libs/images/location.png" alt="">
                                    <span>Location</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/SportsCenter/Utente/home/contattaci">
                                    <img src="/SportsCenter/smarty/libs/images/call.png" alt="">
                                    <span>Tel: +393661830182</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="contattaci.tpl">
                                    <img src="/SportsCenter/smarty/libs/images/envelope.png" alt="">
                                    <span>daiegrom@gmail.com</span>
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
                                        <a class="nav-link" href="/SportsCenter/Utente/servizi">Servizi</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="/SportsCenter/Utente/contattaci">Contattaci</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="/SportsCenter/Utente/profilo">Profilo</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="/SportsCenter/">Logout</a>
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
                <div class="row">
                    <div class="col-md-6">
                        <h3>Seleziona un orario per il giorno: <?php echo $_smarty_tpl->tpl_vars['giorno']->value;?>
</h3>
                        <!-- Tabella degli orari -->
                        <form id="timeForm" method="post" action="/SportsCenter/PrenotaCampo/MostraOrari">
                            <table class="orari-table">
                                <thead>
                                    <tr>
                                        <th>Ore disponibili</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
$_smarty_tpl->tpl_vars['__smarty_section_i'] = new Smarty_Variable(array());
if (true) {
for ($__section_i_5_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] = 0; $__section_i_5_iteration <= 16; $__section_i_5_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']++){
?>
                                    <?php if ($_smarty_tpl->tpl_vars['i']->value%4 == 0) {?><tr><?php }?>
                                    <td onclick="selectTime(this)" data-time="<?php echo $_smarty_tpl->tpl_vars['i']->value+8;?>
:00"><?php echo $_smarty_tpl->tpl_vars['i']->value+8;?>
:00</td>
                                    <?php if ($_smarty_tpl->tpl_vars['i']->value%4 == 3) {?></tr><?php }?>
                                    <?php
}
}
?>
                                </tbody>
                            </table>
                            
                            <input type="hidden" name="selected_time" id="selected_time" value="">
                            <input type="hidden" name="selected_day" value="<?php echo $_smarty_tpl->tpl_vars['giorno']->value;?>
">
                            <a type="submit" class="btn btn-avanti float-right" href ="/SportsCenter/home/servizi/<?php echo $_smarty_tpl->tpl_vars['idCampo']->value;?>
/calendario/<?php echo $_smarty_tpl->tpl_vars['selected_day']->value;?>
/orari/<?php echo $_smarty_tpl->tpl_vars['selected_time']->value;?>
/attrezzatura">Avanti</a>
                        </form>
                    </div>
                    <div class="col-md-6">
                        <div class="text-center mb-4">
                            <img src="data:<?php echo $_smarty_tpl->tpl_vars['imageCampo']->value->getTipo();?>
;base64,<?php echo $_smarty_tpl->tpl_vars['imageCampo']->value->getEncodedData();?>
" alt="<?php echo $_smarty_tpl->tpl_vars['titoloCampo']->value;?>
" style="max-width: 100%; height: auto;">
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
                                <?php echo smarty_function_math(array('equation'=>"x-(x * y / 100)",'x'=>$_smarty_tpl->tpl_vars['prezzocampo']->value,'y'=>30,'assign'=>"prezzo_scontato"),$_smarty_tpl);?>
 
                                Prezzo originale : <?php echo $_smarty_tpl->tpl_vars['prezzoCampo']->value;?>
 euro , prezzo scontato per utenti tesserati : <?php echo $_smarty_tpl->tpl_vars['prezzo_scontato']->value;?>
 euro.
                            <?php }?>
                            </p>
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
            <li class="">
              <a class="" href="/SportsCenter/Utente/home">Home</a>
            </li>
            <li class="">
              <a class="" href="/SportsCenter/Utente/prenotazioni">Prenotazioni</a>
            </li>
            <li class="">
              <a class="" href="/SportsCenter/Utente/servizi">Servizi</a>
            </li>
            <li class="">
              <a class="" href="/SportsCenter/Utente/contattaci">Contattaci</a>
            </li>
            <li class="">
              <a class="" href="/SportsCenter/Utente/profilo">Profilo</a>
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
            <a href="contattaci.tpl">
              <img src="/SportsCenter/smarty/libs/images/location-white.png" alt="">
              <span>Via Vetoio, Edificio Coppito 1, 67100 L'Aquila</span>
            </a>
            <a href="contattaci.tpl">
              <img src="/SportsCenter/smarty/libs/images/call-white.png" alt="">
              <span>(+39) 0862 123456</span>
            </a>
            <a href="contattaci.tpl">
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

    <section class="container-fluid footer_section">
        <p>&copy; 2024 Tutti i diritti sono riservati. Disegnato da<a href="https://html.design/">Frack,daieg e das</a></p>
    </section>

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
