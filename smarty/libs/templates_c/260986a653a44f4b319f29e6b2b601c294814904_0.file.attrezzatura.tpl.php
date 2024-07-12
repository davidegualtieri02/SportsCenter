<?php
/* Smarty version 4.3.2, created on 2024-07-12 23:32:19
  from '/Users/diegoromanelli/Desktop/PPIW/Progetto/SportsCenter/smarty/libs/templates/attrezzatura.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.2',
  'unifunc' => 'content_6691a0e3408461_88032453',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '260986a653a44f4b319f29e6b2b601c294814904' => 
    array (
      0 => '/Users/diegoromanelli/Desktop/PPIW/Progetto/SportsCenter/smarty/libs/templates/attrezzatura.tpl',
      1 => 1720770429,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6691a0e3408461_88032453 (Smarty_Internal_Template $_smarty_tpl) {
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
    <link rel="icon" href="/SportsCenter/smarty/libs/images/logo.png" type="image/x-icon" />
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.1.3/assets/owl.carousel.min.css">
    <link rel="stylesheet" type="text/css" href="/SportsCenter/smarty/libs/css/bootstrap.css">
    <link href="https://fonts.googleapis.com/css?family=Baloo+Chettan|Dosis:400,600,700|Poppins:400,600,700&display=swap" rel="stylesheet">
    <link href="/SportsCenter/smarty/libs/css/style.css" rel="stylesheet">
    <link href="/SportsCenter/smarty/libs/css/responsive.css" rel="stylesheet">
    <link href="/SportsCenter/smarty/libs/css/attrezzatura.css" rel="stylesheet">
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
            document.getElementById('attrezzatura').value = attrezzaturaValue;
        }

        // Funzione per selezionare l'orario
        function selectTime(element) {
            var selectedTime = element.getAttribute('data-time');
            var selectedDay = element.getAttribute('data-day');
            // Imposta i valori dei campi nascosti per giorno e ora selezionati
            document.getElementById('data').value = selectedDay;
            document.getElementById('orario').value = selectedTime;
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
                            <a class="navbar-brand" href="/SportsCenter/Utente/home">
                            <img src="/SportsCenter/smarty/libs/images/logo.png" alt="" />
                            <span>
                                SportsCenter
                            </span>
                            </a>
                            <div class="contact_nav" id="">
                            <ul class="navbar-nav ">
                                <li class="nav-item">
                                <a class="nav-link" href="/SportsCenter/Utente/contattaci">
                                    <img src="/SportsCenter/smarty/libs/images/location.png" alt="" />
                                    <span>Location</span>
                                </a>
                                </li>
                                <li class="nav-item">
                                <a class="nav-link" href="/SportsCenter/Utente/contattaci">
                                    <img src="/SportsCenter/smarty/libs/images/call.png" alt="" />
                                    <span>Tel: (+39) 0862 123456</span>
                                </a>
                                </li>
                                <li class="nav-item">
                                <a class="nav-link" href="/SportsCenter/Utente/contattaci">
                                    <img src="/SportsCenter/smarty/libs/images/envelope.png" alt="" />
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
                                    <a class="nav-link" href="/SportsCenter/Utente/home">Home<</a>
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
    <section class="contact_section layout_padding" style="padding-top: 30px; padding-bottom: 30px;">
        <div class="container">
            <div class="heading_container"></div>
            <div class="layout_padding2-top">
                <div class="row">
                    <div class="col-md-6">
                        <!-- Singola casella di controllo -->
                        <div class="equipment-list">
                            <h3>Seleziona l'attrezzatura:</h3>
                            <form id="equipmentForm" method="post" action="/SportsCenter/PrenotaCampo/MostraAttrezzatura">
                                <label>
                                    <input type="checkbox" id="attrezzaturaCheckbox" name="attrezzatura" value="true" onchange="updateAttrezzaturaHidden()"> Attrezzatura
                                </label>
                                <input type="hidden" id="attrezzaturaHidden" name="attrezzatura">
                                <input type="hidden" id="selectedDay" name="data" value="<?php echo $_smarty_tpl->tpl_vars['selected_day']->value;?>
">
                                <input type="hidden" id="selectedTime" name="orario" value="<?php echo $_smarty_tpl->tpl_vars['selected_time']->value;?>
">
                                <a type="submit" class="btn btn-avanti float-right" href = "/SportsCenter/Utente/home/servizi/<?php echo $_smarty_tpl->tpl_vars['idCampo']->value;?>
/calendario/<?php echo $_smarty_tpl->tpl_vars['selected_day']->value;?>
/orari/<?php echo $_smarty_tpl->tpl_vars['selected_time']->value;?>
/attrezzatura/<?php echo $_smarty_tpl->tpl_vars['attrezzatura']->value;?>
">Continua e paga</a>
                            </form>
                        </div>
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
    <?php echo '<script'; ?>
>
    function updateAttrezzaturaHidden() {
        var checkbox = document.getElementById('attrezzaturaCheckbox');
        var hiddenField = document.getElementById('attrezzatura');
        hiddenField.value = checkbox.checked ? 'true' : 'false';
    }

    document.getElementById('equipmentForm').addEventListener('submit', function() {
        updateAttrezzaturaHidden();
    });
<?php echo '</script'; ?>
>
</body>
</html>
<?php }
}