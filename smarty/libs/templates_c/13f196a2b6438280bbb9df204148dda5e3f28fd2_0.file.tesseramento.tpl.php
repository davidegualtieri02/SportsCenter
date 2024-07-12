<?php
/* Smarty version 4.3.2, created on 2024-07-12 23:32:19
  from '/Users/diegoromanelli/Desktop/PPIW/Progetto/SportsCenter/smarty/libs/templates/tesseramento.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.2',
  'unifunc' => 'content_6691a0e3375bb1_22074397',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '13f196a2b6438280bbb9df204148dda5e3f28fd2' => 
    array (
      0 => '/Users/diegoromanelli/Desktop/PPIW/Progetto/SportsCenter/smarty/libs/templates/tesseramento.tpl',
      1 => 1720770429,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6691a0e3375bb1_22074397 (Smarty_Internal_Template $_smarty_tpl) {
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
  <link rel="icon" href="/SportsCenter/smarty/libs/images/logo.png" type="image/x-icon" />

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
  <!-- Custom tesseramento styles -->
  <link href="/SportsCenter/smarty/libs/css/tesseramento.css" rel="stylesheet" />
  <!-- Custom login styles -->
  <link rel="stylesheet" href="/SportsCenter/smarty/libs/css/login.css">

</head>

<body>
  <div>
    <a href="index.html">
      <img src="/SportsCenter/smarty/libs/images/logo.png" alt="SportsCenter">
    </a>
  </div>
  
  <!-- tesseramento section -->
  <section class="tesseramento_section layout_padding">
    <div class="container">
      <div class="form-box">
        <div class="form-value">
          <form id="tesseramentoForm" method="post" action="/SportsCenter/Tesseramento/MostraTesseramento">
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
              <input type="text" id="cartaScadenza" name="cartaScadenza" value="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['scadenza']->value, ENT_QUOTES, 'UTF-8', true);?>
" required placeholder="MM/AA">
              <label for="cartaScadenza">Data di Scadenza</label>
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
 type="text/javascript" src="/SportsCenter/smarty/libs/js/jquery-3.4.1.min.js"><?php echo '</script'; ?>
>
  <?php echo '<script'; ?>
 type="text/javascript" src="/SportsCenter/smarty/libs/js/bootstrap.js"><?php echo '</script'; ?>
>
  <?php echo '<script'; ?>
>
    document.getElementById('tesseramentoForm').addEventListener('submit', function(event) {
      // Numero della carta di credito
      const cartaNumero = document.getElementById('cartaNumero').value;
      if (!/^\d<?php echo 16;?>
$/.test(cartaNumero)) {
        alert('Il numero della carta deve essere di 16 cifre numeriche.');
        event.preventDefault();
        return;
      }

      // Codice CVV
      const cvv = document.getElementById('cvv').value;
      if (!/^\d<?php echo 3;?>
$/.test(cvv)) {
        alert('Il codice CVV deve essere di 3 cifre numeriche.');
        event.preventDefault();
        return;
      }

      // Data di scadenza
      const cartaScadenza = document.getElementById('cartaScadenza').value;
      const scadenzaMatch = cartaScadenza.match(/^(0[1-9]|1[0-2])\/(\d<?php echo 2;?>
)$/);
      if (!scadenzaMatch) {
        alert('La data di scadenza deve essere nel formato MM/AA.');
        event.preventDefault();
        return;
      }

      const month = parseInt(scadenzaMatch[1], 10);
      const year = parseInt(scadenzaMatch[2], 10) + 2000;
      const today = new Date();
      const expirationDate = new Date(year, month);

      if (expirationDate <= today) {
        alert('La data di scadenza non può essere passata o uguale alla data odierna.');
        event.preventDefault();
      }
    });
  <?php echo '</script'; ?>
>
</body>
</html>

<?php }
}
