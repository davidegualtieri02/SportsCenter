<?php
/* Smarty version 4.3.2, created on 2024-07-14 19:32:21
  from '/Applications/XAMPP/xamppfiles/htdocs/SportsCenter/smarty/libs/templates/login_form.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.2',
  'unifunc' => 'content_66940ba566b9d3_88101566',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '678e6278e7d9534c3608e5da7891a0c18bbfec67' => 
    array (
      0 => '/Applications/XAMPP/xamppfiles/htdocs/SportsCenter/smarty/libs/templates/login_form.tpl',
      1 => 1720978277,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_66940ba566b9d3_88101566 (Smarty_Internal_Template $_smarty_tpl) {
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
  <link href="/SportsCenter/smarty/libs/css/login.css" rel="stylesheet"/>

  <!-- Ionicons -->
  <?php echo '<script'; ?>
 type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"><?php echo '</script'; ?>
>
  <?php echo '<script'; ?>
 nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"><?php echo '</script'; ?>
>
  
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

<body>
  <div>
    <a href="/SportsCenter/Utente/index">
      <img src="/SportsCenter/smarty/libs/images/logo.png" alt="SportsCenter">
    </a>
  </div>
  <!-- Login section -->
  <section class="login_section layout_padding">
    <div class="container">
      <div class="form-box">
        <div class="form-value">
            <h2>Accedi a SportsCenter</h2>
            <form id = "myform" action="login" method = "post" onsubmit="return validateForm()">
            <?php if ($_smarty_tpl->tpl_vars['error']->value == true) {?>
              <p style="color: red; margin-left: 11%">Attenzione: credenziali errate.</p>
              <?php }?>
            <?php if ($_smarty_tpl->tpl_vars['ban']->value == true) {?>
              <p style="color: red; margin-left: 7%">Attenzione: l'utente che sta provando ad accedere risulta bannato.</p>
              <?php }?>
              <?php if ($_smarty_tpl->tpl_vars['regErr']->value == true) {?>
                <p style="color: red; margin-left: 7%">Attenzione: email o password già in uso.</p>
                <?php }?>
            <div class="inputbox">
              <ion-icon name="person-outline"></ion-icon>
              <label class="form-label"></label>
              <input id = "email" name = "email" type="text" class="form-control" placeholder="Inserisci la tua email">
            </div>
            <div class="inputbox">
              <ion-icon name="lock-closed-outline"></ion-icon>
              <label class="form-label"></label>
              <input id = "password" name = "password" type="password" class="form-control" placeholder="Inserisci la password">
            </div>
            <a href="login"><button type="submit" id="submitButton">Accedi</button></a>
            </form>
            <div class="login">
              <p><br>Non hai un profilo? <a href="registrazione">Registrati</a></p>
            </div>
        </div>
      </div>
    </div>
  </section>
  <!-- End login section -->
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
</html><?php }
}
