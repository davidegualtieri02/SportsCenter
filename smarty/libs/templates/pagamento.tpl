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
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

  <script>
    function ready() {
      if (!navigator.cookieEnabled) {
        alert('Attenzione! Attivare i cookie per proseguire correttamente la navigazione');
      }
    }

    function validateForm() {
      const cardNumber = document.querySelector('input[name="numero"]').value;
      const cvv = document.querySelector('input[name="codice"]').value;
      const expiryDate = document.querySelector('input[name="data"]').value;

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
  </script>

</head>

<body>
  <div>
    <a href="index.html">
      <img src="/SportsCenter/smarty/libs/images/logo.png" alt="SportsCenter"></a>
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
              <input type="text" name="cognome" value="{$cognomeTitolare}" required>
              <label for="">Cognome</label>
            </div>
            <div class="inputbox">
              <ion-icon name="card-outline"></ion-icon>
              <input type="text" name="numero" value="{$numeroCarta}" required>
              <label for="">Numero della carta</label>
            </div>
            <div class="inputbox">
              <ion-icon name="calendar-outline"></ion-icon>
              <input type="text" name="data" value="{$dataScadenza}" required>
              <label for="">Data di scadenza (MM/AAAA)</label>
            </div>
            <div class="inputbox">
              <ion-icon name="card-outline"></ion-icon>
              <input type="text" name="codice" value="{$cvv}" required>
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
  <script type="text/javascript" src="/SportsCenter/smarty/libs/js/jquery-3.4.1.min.js"></script>
  <script type="text/javascript" src="/SportsCenter/smarty/libs/js/bootstrap.js"></script>
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


