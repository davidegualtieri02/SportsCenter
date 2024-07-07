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
  <link rel="stylesheet" href="css/calendario.css">
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
                    <a class="nav-link" href="prenotazioni.tpl">Prenotazioni</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="servizi.tpl">Servizi</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="contattaci.tpl">Contattaci</a>
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
  <section class="contact_section layout_padding" style="padding-top: 50px; padding-bottom: 50px;">
    <div class="container">
      <div class="heading_container"></div>
      <div class="layout_padding2-top">
        <div class="row">
          <div class="col-md-6">
            <div class="calendar-wrapper">
              <div class="calendar-header">
                <button id="btnPrev" type="button">Prev</button>
                <h2 id="monthYear"></h2>
                <button id="btnNext" type="button">Next</button>
              </div>
              <div id="divCal" class="calendar"></div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="text-center mb-4">
              <img src="images/campopadelaperto.jpg" alt="" style="max-width: 100%; height: auto;">
            </div>
            <div class="campo-description">
              <h3>Descrizione del campo:</h3>
              <p>Campo da padel all'aperto</p>
              <!-- Form per inviare la data selezionata -->
              <form id="bookingForm" method="post" action="CPrenotaCampo.php?action=MostraOrari">
                <input type="hidden" id="selectedDate" name="selectedDate">
                <button type="submit" class="btn btn-avanti float-right">Avanti</button>
              </form>
            </div>
            <p>Stai prenotando per il giorno: {$prenotazione_data}</p>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section class="info_section layout_padding2-top">
    <div class="container">
      <div class="row">
        <div class="col-md-3">
          <h6>Informazioni SportsCenter</h6>
          <p>Progetto università</p>
        </div>
        <div class="col-md-2 offset-md-1">
          <h6>Menù</h6>
          <ul>
             <li><a href="home.tpl">Home</a></li>
            <li><a href="prenotazioni.tpl">Prenotazioni</a></li>
            <li><a href="servizi.tpl">Servizi</a></li>
            <li><a href="contattaci.tpl">Contattaci</li>
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
    <p>&copy; 2024 Tutti i diritti sono riservati. Disegnato da<a href="https://html.design/">Frack,das e daieg</a></p>
  </section>
  <script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
  <script type="text/javascript" src="js/bootstrap.js"></script>
  <script type="text/javascript" src="js/calendario.js"></script>    
</body>
</html>