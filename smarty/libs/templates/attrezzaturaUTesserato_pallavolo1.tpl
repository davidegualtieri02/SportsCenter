<!DOCTYPE html>
<html lang="it">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="keywords" content="">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>SportsCenter</title>
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.1.3/assets/owl.carousel.min.css">
  <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
  <link href="https://fonts.googleapis.com/css?family=Baloo+Chettan|Dosis:400,600,700|Poppins:400,600,700&display=swap" rel="stylesheet">
  <link href="css/style.css" rel="stylesheet">
  <link href="css/responsive.css" rel="stylesheet">
  <link href="css/attrezzatura.css" rel="stylesheet">
  <script>
        function ready(){
            if (!navigator.cookieEnabled) {
                alert('Attenzione! Attivare i cookie per proseguire correttamente la navigazione');
            }
        }
        document.addEventListener("DOMContentLoaded", ready);
    </script>
</head>
<body class="sub_page">
  <div class="hero_area">
    <header class="header_section">
      <div class="container">
        <nav class="navbar navbar-expand-lg custom_nav-container">
          <a class="navbar-brand" href="home.tpl">
            <img src="images/logo.png" alt="">
            <span>SportsCenter</span>
          </a>
          <div class="contact_nav">
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link" href="contattaci.tpl">
                  <img src="images/location.png" alt="">
                  <span>Location</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="contattaci.tpl">
                  <img src="images/call.png" alt="">
                  <span>Tel: +393661830182</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="contattaci.tpl">
                  <img src="images/envelope.png" alt="">
                  <span>daiegrom@gmail.com</span>
                </a>
              </li>
            </ul>
          </div>
        </nav>
      </div>
    </header>
    <section class="slider_section position-relative">
      <div class="container">
        <div class="custom_nav2">
          <nav class="navbar navbar-expand-lg custom_nav-container">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <div class="d-flex flex-column flex-lg-row align-items-center">
                <ul class="navbar-nav">
                  <li class="nav-item">
                    <a class="nav-link" href="home.tpl">Home</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="prenotazione.tpl">Prenotazione</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="servizi.tpl">Servizi</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link current-page" href="contattaci.tpl">Contattaci</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="profilo.tpl">Profilo</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="index.tpl">Logout</a>
                  </li>
                </ul>
              </div>
            </div>
          </nav>
        </div>
      </div>
    </section>
  </div>
  <section class="contact_section layout_padding" style="padding-top: 30px; padding-bottom: 30px;">
    <div class="container">
      <div class="heading_container"></div>
      <div class="layout_padding2-top">
        <div class="row">
          <div class="col-md-6">
            <!-- Singola casella di controllo -->
            <div class="equipment-list">
              <h3>Seleziona l'attrezzatura:</h3>
              <form id="equipmentForm" method="post">
                <label><input type="checkbox" name="attrezzatura" value="true"> Attrezzatura</label>
                <button type="submit" class="btn btn-avanti float-right">Continua e paga</button>
              </form>
            </div>
          </div>
          <div class="col-md-6">
            <div class="text-center mb-4">
              <img src="images/campopallavoloaperto.jpeg" alt="Campo in erba esterna, costo campo: 60 euro" style="max-width: 100%; height: auto;">
            </div>
            <div class="campo-description">
              <h3>Descrizione del campo:</h3>
              <p>Campo da pallavolo all'aperto. Costo campo: 40 euro</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section class="info_section layout_padding2-top">
    <div class="container">
      <div class="row">
        <div class="col-md-3">
          <h6>Il nostro centro è pazzesco</h6>
          <p>veramente</p>
        </div>
        <div class="col-md-2 offset-md-1">
          <h6>Menù</h6>
          <ul>
            <li class=""><a href="home.tpl">Home</a></li>
            <li><a href="prenotazioni.tpl">Prenotazioni</a></li>
            <li><a href="servizi.tpl">Servizi</a></li>
            <li><a href="contattaci.tpl">Contattaci</a></li>
            <li><a href="profilo.tpl">Profilo</a></li>
            <li><a href="index.tpl">Logout</a></li>
          </ul>
        </div>
        <div class="col-md-3">
          <h6>Contattaci</h6>
          <div class="info_link-box">
            <a href=""><img src="images/location-white.png" alt=""><span> Coppito1,Via Vetoio 3</span></a>
            <a href=""><img src="images/call-white.png" alt=""><span>+393661830182</span></a>
            <a href=""><img src="images/mail-white.png" alt=""><span> daiegrom@gmail.com</span></a>
          </div>
          <div class="info_social">
            <div><a href=""><img src="images/facebook-logo-button.png" alt=""></a></div>
            <div><a href=""><img src="images/twitter-logo-button.png" alt=""></a></div>
            <div><a href=""><img src="images/linkedin.png" alt=""></a></div>
            <div><a href=""><img src="images/instagram.png" alt=""></a></div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section class="container-fluid footer_section">
    <p>&copy; 2024 All Rights Reserved. Design by <a href="https://html.design/">Frack,daieg e das</a></p>
  </section>
  <script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
  <script type="text/javascript" src="js/bootstrap.js"></script>
  <script type="text/javascript" src="js/attrezzatura.js"></script>
</body>
</html>