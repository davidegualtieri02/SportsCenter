<?php
/* Smarty version 4.3.2, created on 2024-07-14 20:36:13
  from '/Applications/XAMPP/xamppfiles/htdocs/SportsCenter/smarty/libs/templates/pagamento.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.2',
  'unifunc' => 'content_66941a9da55249_02613431',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'b2896e2776fcceb44e78db24989c62ef6b058c4e' => 
    array (
      0 => '/Applications/XAMPP/xamppfiles/htdocs/SportsCenter/smarty/libs/templates/pagamento.tpl',
      1 => 1720982171,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_66941a9da55249_02613431 (Smarty_Internal_Template $_smarty_tpl) {
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
  <link rel="icon" href="/SportsCenter/smarty/libs/images/logo.png" type="image/x-icon" />

  <!-- Bootstrap core CSS -->
  <link rel="stylesheet" type="text/css" href="/SportsCenter/smarty/libs/css/bootstrap.css" />

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Baloo+Chettan|Dosis:400,600,700|Poppins:400,600,700&display=swap"
    rel="stylesheet" />

  <!-- Custom styles -->
  <link href="/SportsCenter/smarty/libs/css/style.css" rel="stylesheet" />
  <link href="/SportsCenter/smarty/libs/css/responsive.css" rel="stylesheet" />
  <link href="/SportsCenter/smarty/libs/css/registrazione.css" rel="stylesheet" /> <!-- Include registrazione.css for registration form styles -->
  <link href="/SportsCenter/smarty/libs/css/login.css" rel="stylesheet"/>
  <link href="/SportsCenter/smarty/libs/css/pagamento.css" rel="stylesheet"/>
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
      const cardNumber = document.querySelector('input[name="numerocarta"]').value;
      const cvv = document.querySelector('input[name="cvv"]').value;
      const expiryDate = document.querySelector('input[name="datascadenza"]').value;

      const cardNumberPattern = /^\d{16}$/;
      const cvvPattern = /^\d{3}$/;
      const expiryDatePattern = /^(0[1-9]|1[0-2])\/\d{4}$/;

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
      } 
      else {
        const [month, year] = expiryDate.split('/').map(Number);
        const today = new Date();
        const expiry = new Date(year, month - 1, 1); // Imposta il giorno a 1 per evitare problemi con i mesi che hanno meno giorni
         
        if (expiry.getTime() <= today.getTime()) {
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
    <a href="/SportsCenter/PrenotaCampo/servizi">
      <img src="/SportsCenter/smarty/libs/images/logo.png" alt="SportsCenter"></a>
  </div>
  <!-- Registration section -->
  <section class="login_section layout_padding">
    <div class="container">
      <div class="form-box">
        <div class="form-value">
          <form action="/SportsCenter/PrenotaCampo/MostraPagamento/<?php echo $_smarty_tpl->tpl_vars['idCampo']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['giorno']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['orario']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['attrezzatura']->value;?>
" method="post" onsubmit="return validateForm()">
            <input type="hidden" name="idCampo" value="<?php echo $_smarty_tpl->tpl_vars['idCampo']->value;?>
">
            <input type="hidden" name="selected_day" value="<?php echo $_smarty_tpl->tpl_vars['giorno']->value;?>
">
            <input type="hidden" name="selected_time" value="<?php echo $_smarty_tpl->tpl_vars['orario']->value;?>
">
            <input type="hidden" name="hidden_attrezzatura" value="<?php echo $_smarty_tpl->tpl_vars['attrezzatura']->value;?>
">
            <h2>Inserisci i dati della carta</h2>
            <div class="inputbox">
              <ion-icon name="person-outline"></ion-icon>
              <label class="form-label"></label>
              <input id="nometitolare" type="text" name="nometitolare" class="form-control" placeholder="Nome titolare" required>
            </div>
            <div class="inputbox">
              <ion-icon name="person-outline"></ion-icon>
              <label class="form-label"></label>
              <input id="cognometitolare" type="text" name="cognometitolare" class="form-control" placeholder="Cognome titolare" required>
            </div>
            <div class="inputbox">
              <ion-icon name="card-outline"></ion-icon>
              <label class="form-label"></label>
              <input id="numerocarta" type="text" name="numerocarta" class="form-control" placeholder="Numero della carta" required>
            </div>
            <div class="inputbox">
              <ion-icon name="calendar-outline"></ion-icon>
              <label class="form-label"></label>
              <input id="datascadenza" type="text" name="datascadenza" class="form-control" placeholder="Data di scadenza (MM/AAAA)"required>
            </div>
            <div class="inputbox">
              <ion-icon name="card-outline"></ion-icon>
              <label class="form-label"></label>
              <input id="cvv" type="password" name="cvv" class="form-control" placeholder="CVV (XYZ)"required>
            </div>
            <a href = "/SportsCenter/PrenotaCampo/MostraPagamento/<?php echo $_smarty_tpl->tpl_vars['idCampo']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['giorno']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['orario']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['attrezzatura']->value;?>
"><button type="submit">Conferma e paga</button></a>
          </form>
        </div>
      </div>
    </div>
  </section>
  <!-- End registration section -->

  <!-- Scripts -->
  <?php echo '<script'; ?>
 type="text/javascript" src="/SportsCenter/smarty/libs/js/jquery-3.4.1.min.js"><?php echo '</script'; ?>
>
  <?php echo '<script'; ?>
 type="text/javascript" src="/SportsCenter/smarty/libs/js/bootstrap.js"><?php echo '</script'; ?>
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
