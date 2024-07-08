<!DOCTYPE html>
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
              <input type="text" id="nome" name="nome" value="{$nome|escape}" required placeholder=" ">
              <label for="nome">Nome</label>
            </div>
            <div class="inputbox">
              <input type="text" id="cognome" name="cognome" value="{$cognome|escape}" required placeholder=" ">
              <label for="cognome">Cognome</label>
            </div>
            <div class="inputbox">
              <input type="email" id="email" name="email" value="{$email|escape}" required placeholder=" ">
              <label for="email">Email</label>
            </div>
            <h3>Dati della Carta di Pagamento</h3>
            <div class="inputbox">
              <input type="text" id="cartaNome" name="cartaNome" value="{$nomeTitolare|escape}" required placeholder=" ">
              <label for="cartaNome">Nome del Titolare</label>
            </div>
            <div class="inputbox">
              <input type="text" id="cartaCognome" name="cartaCognome" value="{$cognomeTitolare|escape}" required placeholder=" ">
              <label for="cartaCognome">Cognome del Titolare</label>
            </div>
            <div class="inputbox">
              <input type="text" id="cartaNumero" name="cartaNumero" value="{$numeroCarta|escape}" required placeholder=" ">
              <label for="cartaNumero">Numero della Carta</label>
            </div>
            <div class="inputbox">
              <input type="text" id="cvv" name="cvv" value="{$cvv|escape}" required placeholder=" ">
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
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
  <script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
  <script type="text/javascript" src="js/bootstrap.js"></script>
  <script>
    function openNav() {
      document.getElementById("myNav").classList.toggle("menu_width");
      document.querySelector(".custom_menu-btn").classList.toggle("menu_btn-style");
    }
  </script>
</body>
</html>
