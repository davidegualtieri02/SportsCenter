<?php
/* Smarty version 4.3.2, created on 2024-07-10 18:12:52
  from '/Applications/XAMPP/xamppfiles/htdocs/SportsCenter/smarty/libs/templates/login_form.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.2',
  'unifunc' => 'content_668eb304865d01_59991571',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '678e6278e7d9534c3608e5da7891a0c18bbfec67' => 
    array (
      0 => '/Applications/XAMPP/xamppfiles/htdocs/SportsCenter/smarty/libs/templates/login_form.tpl',
      1 => 1720606420,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_668eb304865d01_59991571 (Smarty_Internal_Template $_smarty_tpl) {
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
  <link href="css/login.css" rel="stylesheet"/>

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
    <a href="index.html">
      <img src="images/logo.png" alt="SportsCenter">
    </a>
  </div>
  <!-- Login section -->
  <section class="login_section layout_padding">
    <div class="container">
      <div class="form-box">
        <div class="form-value">
          <form action="/SportsCenter/Utente/login" method="post">
            <h2>Accedi a SportsCenter</h2>
            <?php if ($_smarty_tpl->tpl_vars['error']->value == true) {?>
              <p style="color: red; margin-left: 11%">credenziali errate</p>
              <?php }?>
            <?php if ($_smarty_tpl->tpl_vars['ban']->value == true) {?>
              <p style="color: red; margin-left: 7%">L'utente che sta provando ad accedere è bannato</p>
              <?php }?>
              <?php if ($_smarty_tpl->tpl_vars['regErr']->value == true) {?>
                <p style="color: red; margin-left: 7%">email o password sono già in uso</p>
                <?php }?>
            <div class="inputbox">
              <ion-icon name="mail-outline"></ion-icon>
              <label for="email" class="form-label">Email</label>
              <input type="text" id="email" name="email" class="form-control" placeholder="email" autocomplete="off">
            </div>
            <div class="inputbox">
              <ion-icon name="lock-closed-outline"></ion-icon>
              <label for="password" class="form-label">Password</label>
                <input type="text" id="password" name="password" class="form-control" placeholder="password" autocomplete="off">
            </div>
            <a type="submit" href ="/SportsCenter/Utente/home">Accedi</a>
            <div class="login">
              <p>Non hai un profilo? <a href="/SportsCenter/Utente/registrazione">Registrati</a></p>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>
  <!-- End login section -->
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
</html><?php }
}
