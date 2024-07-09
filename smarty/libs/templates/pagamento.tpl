<!DOCTYPE html>
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
  <link href = "css/pagamento.css" rel="stylesheet"/>
  <!-- Ionicons -->
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

  <script>
        function ready(){
            if (!navigator.cookieEnabled) {
                alert('Attenzione! Attivare i cookie per proseguire correttamente la navigazione');
            }
        }
        document.addEventListener("DOMContentLoaded", ready);
    </script>
    
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
          <form action="">
            <h2>Inserisci i dati della carta</h2>
            <div class="inputbox">
              <ion-icon name="person-outline"></ion-icon>
              <input type="nome" name = "nome" value = "{$nomeTitolare}" required>
              <label for="">Nome</label>
            </div>
            <div class="inputbox">
              <ion-icon name="person-outline"></ion-icon>
              <input type="cognome" name = "cognome" value = "{$cognomeTitolare}" required>
              <label for="">Cognome</label>
            </div>
            <div class="inputbox">
              <ion-icon name="card-outline"></ion-icon>
              <input type="numero"  name = "numero" value = "{$numeroCarta}" required>
              <label for="">Numero della carta</label>
            </div>
            <div class="inputbox">
              <ion-icon name="calendar-outline"></ion-icon>
              <input type="data" name = "data" value = "{$dataScadenza}" required>
              <label for="">Data di scadenza (MM/AAAA)</label>
            </div>
            <div class="inputbox">
              <ion-icon name="card-outline"></ion-icon>
              <input type="codice" name = "codice" value ="{$cvv}" required>
              <label for="">CVV (XYZ)</label>
            </div>
            <a href = "confermaPrenotazione.tpl">Conferma e paga </a>
          </form>
        </div>
      </div>
    </div>
  </section>
  <!-- End registration section -->

  <!-- Scripts -->
  <script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
  <script type="text/javascript" src="js/bootstrap.js"></script>
  <script>
    function openNav() {
      document.getElementById("myNav").classList.toggle("menu_width");
      document
        .querySelector(".custom_menu-btn")
        .classList.toggle("menu_btn-style");
    }
  </script>
</body>

</html>

