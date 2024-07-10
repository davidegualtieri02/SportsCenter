<?php
/* Smarty version 4.3.2, created on 2024-07-10 18:12:52
  from '/Applications/XAMPP/xamppfiles/htdocs/SportsCenter/smarty/libs/templates/pagamento.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.2',
  'unifunc' => 'content_668eb304ae57b4_72537582',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'b2896e2776fcceb44e78db24989c62ef6b058c4e' => 
    array (
      0 => '/Applications/XAMPP/xamppfiles/htdocs/SportsCenter/smarty/libs/templates/pagamento.tpl',
      1 => 1720621979,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_668eb304ae57b4_72537582 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html lang="en">

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

  <!-- Bootstrap core CSS -->
  <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Baloo+Chettan|Dosis:400,600,700|Poppins:400,600,700&display=swap"
    rel="stylesheet" />

  <!-- Custom styles -->
  <link href="css/style.css" rel="stylesheet" />
  <link href="css/responsive.css" rel="stylesheet" />
  <link href="css/registrazione.css" rel="stylesheet" /> <!-- Include registrazione.css for registration form styles -->
  <link href="css/login.css" rel="stylesheet"/>
  <link href="css/pagamento.css" rel="stylesheet"/>
  <!-- Ionicons -->
  <?php echo '<script'; ?>
 type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"><?php echo '</script'; ?>
>
  <?php echo '<script'; ?>
 nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"><?php echo '</script'; ?>
>

  <?php echo '<script'; ?>
>
    function ready() {
      if (!navigator.cookieEnabled) {
        alert('Attenzione! Attivare i cookie per proseguire correttamente la navigazione');
      }
    }

    function validateForm() {
      const cardNumber = document.querySelector('input[name="numero"]').value;
      const cvv = document.querySelector('input[name="codice"]').value;
      const expiryDate = document.querySelector('input[name="data"]').value;

      const cardNumberPattern = /^\d<?php echo 16;?>
$/;
      const cvvPattern = /^\d<?php echo 3;?>
$/;
      const expiryDatePattern = /^(0[1-9]|1[0-2])\/\d<?php echo 4;?>
$/;

      let isValid = true;
      let errorMessage = '';

      if (!cardNumberPattern.test(cardNumber)) {
        isValid = false;
        errorMessage += 'Il numero di carta deve contenere esattamente 16 cifre numeriche.\n';
      }

      if (!cvvPattern.test(cvv)) {
        isValid = false;
        errorMessage += 'Il codice CVV deve contenere esattamente 3 cifre numeriche.\n';
      }

      if (!expiryDatePattern.test(expiryDate)) {
        isValid = false;
        errorMessage += 'La data di scadenza deve essere nel formato MM/AAAA.\n';
      } else {
        const [month, year] = expiryDate.split('/').map(Number);
        const today = new Date();
        const expiry = new Date(year, month - 1, today.getDate());

        if (expiry <= today) {
          isValid = false;
          errorMessage += 'La data di scadenza non deve essere uguale o precedente alla data odierna.\n';
        }
      }

      if (!isValid) {
        alert(errorMessage);
      }

      return isValid;
    }

    document.addEventListener("DOMContentLoaded", ready);
  <?php echo '</script'; ?>
>

</head>

<body>
  <div>
    <a href="index.html">
      <img src="images/logo.png" alt="SportsCenter"></a>
  </div>
  <!-- Registration section -->
  <section class="login_section layout_padding">
    <div class="container">
      <div class="form-box">
        <div class="form-value">
          <form action="/SportsCenter/PrenotaCampo/MostraConfermaPrenotazione" onsubmit="return validateForm()">
            <h2>Inserisci i dati della carta</h2>
            <div class="inputbox">
              <ion-icon name="person-outline"></ion-icon>
              <label for="username" class="form-label">Username</label>
              <input type="text" id="username" name="username" class="form-control" placeholder="Username" autocomplete="off">
            </div>
            <div class="inputbox">
              <ion-icon name="person-outline"></ion-icon>
              <input type="text" name="cognome" value="<?php echo $_smarty_tpl->tpl_vars['cognomeTitolare']->value;?>
" required>
              <label for="">Cognome</label>
            </div>
            <div class="inputbox">
              <ion-icon name="card-outline"></ion-icon>
              <input type="text" name="numero" value="<?php echo $_smarty_tpl->tpl_vars['numeroCarta']->value;?>
" required>
              <label for="">Numero della carta</label>
            </div>
            <div class="inputbox">
              <ion-icon name="calendar-outline"></ion-icon>
              <input type="text" name="data" value="<?php echo $_smarty_tpl->tpl_vars['dataScadenza']->value;?>
" required>
              <label for="">Data di scadenza (MM/AAAA)</label>
            </div>
            <div class="inputbox">
              <ion-icon name="card-outline"></ion-icon>
              <input type="text" name="codice" value="<?php echo $_smarty_tpl->tpl_vars['cvv']->value;?>
" required>
              <label for="">CVV (XYZ)</label>
            </div>
            <button type="submit">Conferma e paga</button>
          </form>
        </div>
      </div>
    </div>
  </section>
  <!-- End registration section -->

  <!-- Scripts -->
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
      document
        .querySelector(".custom_menu-btn")
        .classList.toggle("menu_btn-style");
    }
  <?php echo '</script'; ?>
>
</body>

</html>


<?php }
}
