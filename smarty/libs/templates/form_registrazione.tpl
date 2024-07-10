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
  <!-- Ionicons -->
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

  <script>
    function ready(){
      if (!navigator.cookieEnabled) {
        alert('Attenzione! Attivare i cookie per proseguire correttamente la navigazione');
      }
    }

    function validateForm() {
      const password = document.querySelector('input[name="password"]').value;

      const passwordPattern = /^(?=.*\d)(?=.*[a-zA-Z]).{6,}$/;

      let isValid = true;
      let errorMessage = '';

      if (!passwordPattern.test(password)) {
        isValid = false;
        errorMessage += 'La password deve contenere almeno 6 caratteri, inclusi sia caratteri numerici che non numerici.\n';
      }

      if (!isValid) {
        alert(errorMessage);
      }

      return isValid;
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
          <form action="SportsCenter/Utente/registrazione" method="post" onsubmit="return validateForm()">
            <h2>Registrati su SportsCenter</h2>
            <div class="inputbox">
              <ion-icon name="person-outline"></ion-icon>
              <label class="form-label">Nome</label>
              <input name = "nome" type="text" class="form-control" placeholder="inserisci il tuo nome">
            </div>
            <div class="inputbox">
              <ion-icon name="person-outline"></ion-icon>
              <label class="form-label">Cognome</label>
              <input name = "cognome" type="text" class="form-control" placeholder="inserisci il tuo cognome">
            </div>
            <div class="inputbox">
              <ion-icon name="mail-outline"></ion-icon>
              <label class="form-label">Email</label>
              <input name = "email" type="text" class="form-control" placeholder="inserisci l'email">
            </div>
            <div class="inputbox">
              <ion-icon name="lock-closed-outline"></ion-icon>
              <label class="form-label">Password</label>
              <input name = "password" type="text" class="form-control" placeholder="inserisci password">
            </div>
            <a  type="submit" href = "/SportsCeneter/Utente/login" >Registrati</a>
            <p></p>
            <div class="login">
              <p>Hai già un profilo? <a href="/SportsCeneter/Utente/login">Login</a></p>
            </div>
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



