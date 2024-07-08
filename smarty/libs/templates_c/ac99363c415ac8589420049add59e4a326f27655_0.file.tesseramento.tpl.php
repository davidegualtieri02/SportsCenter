<?php
/* Smarty version 4.3.2, created on 2024-07-08 23:13:03
  from '/home/davide/Desktop/prog_web/SportsCenter/smarty/libs/templates/tesseramento.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.2',
  'unifunc' => 'content_668c565f687d53_38154308',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'ac99363c415ac8589420049add59e4a326f27655' => 
    array (
      0 => '/home/davide/Desktop/prog_web/SportsCenter/smarty/libs/templates/tesseramento.tpl',
      1 => 1720472585,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_668c565f687d53_38154308 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html lang="it">
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
  <!-- Custom tesseramento styles -->
  <link href="css/tesseramento.css" rel="stylesheet" />
  <!-- Custom login styles -->
  <link rel="stylesheet" href="css/login.css">

</head>

<body>
  <div>
    <a href="index.html">
      <img src="images/logo.png" alt="SportsCenter">
    </a>
  </div>
  
  <!-- tesseramento section -->
  <section class="tesseramento_section layout_padding">
    <div class="container">
      <div class="form-box">
        <div class="form-value">
          <form id="tesseramentoForm" method="post" action="process_tesseramento.php">
            <h2>Modulo di Tesseramento</h2>
            <div class="inputbox">
              <input type="text" id="nome" name="nome" value="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['nome']->value, ENT_QUOTES, 'UTF-8', true);?>
" required placeholder=" ">
              <label for="nome">Nome</label>
            </div>
            <div class="inputbox">
              <input type="text" id="cognome" name="cognome" value="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['cognome']->value, ENT_QUOTES, 'UTF-8', true);?>
" required placeholder=" ">
              <label for="cognome">Cognome</label>
            </div>
            <div class="inputbox">
              <input type="email" id="email" name="email" value="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['email']->value, ENT_QUOTES, 'UTF-8', true);?>
" required placeholder=" ">
              <label for="email">Email</label>
            </div>
            <h3>Dati della Carta di Pagamento</h3>
            <div class="inputbox">
              <input type="text" id="cartaNome" name="cartaNome" value="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['nomeTitolare']->value, ENT_QUOTES, 'UTF-8', true);?>
" required placeholder=" ">
              <label for="cartaNome">Nome del Titolare</label>
            </div>
            <div class="inputbox">
              <input type="text" id="cartaCognome" name="cartaCognome" value="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['cognomeTitolare']->value, ENT_QUOTES, 'UTF-8', true);?>
" required placeholder=" ">
              <label for="cartaCognome">Cognome del Titolare</label>
            </div>
            <div class="inputbox">
              <input type="text" id="cartaNumero" name="cartaNumero" value="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['numeroCarta']->value, ENT_QUOTES, 'UTF-8', true);?>
" required placeholder=" ">
              <label for="cartaNumero">Numero della Carta</label>
            </div>
            <div class="inputbox">
              <input type="text" id="cvv" name="cvv" value="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['cvv']->value, ENT_QUOTES, 'UTF-8', true);?>
" required placeholder=" ">
              <label for="cvv">Codice CVV</label>
            </div>
            <div class="inputbox">
              <input type="text" id="costo" name="costo" value="150 €" readonly placeholder=" ">
              <label for="costo">Costo del Tesseramento</label>
            </div>
            <button type="submit">Tesserati</button>
          </form>
        </div>
      </div>
    </div>
  </section>

  <!-- Scripts -->
  <?php echo '<script'; ?>
 type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"><?php echo '</script'; ?>
>
  <?php echo '<script'; ?>
 nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"><?php echo '</script'; ?>
>
  <?php echo '<script'; ?>
 type="text/javascript" src="js/jquery-3.4.1.min.js"><?php echo '</script'; ?>
>
  <?php echo '<script'; ?>
 type="text/javascript" src="js/bootstrap.js"><?php echo '</script'; ?>
>
  <?php echo '<script'; ?>
>
    function openNav() {
      document.getElementById("myNav").classList.toggle("menu_width");
      document.querySelector(".custom_menu-btn").classList.toggle("menu_btn-style");
    }
  <?php echo '</script'; ?>
>
</body>
</html>
<?php }
}
