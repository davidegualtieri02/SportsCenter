<!DOCTYPE html>
<html>

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
  <style>
    .about_section {
      background-image: url('images/ragazzi.png');
      background-size: cover;
      background-position: center;
    }
  </style>
</head>

<body class="sub_page about_page">
  <div class="hero_area">
    <!-- header section strats -->
    <header class="header_section">
      <div class="container">
        <nav class="navbar navbar-expand-lg custom_nav-container">
          <a class="navbar-brand" href="home.tpl">
            <img src="images/logo.png" alt="" />
            <span>
              SportsCenter
            </span>
          </a>
          <div class="contact_nav" id="">
            <ul class="navbar-nav ">
              <li class="nav-item">
                <a class="nav-link" href="contattaci.tpl">
                  <img src="images/location.png" alt="" />
                  <span>Location</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="contattaci.tpl">
                  <img src="images/call.png" alt="" />
                  <span>(+39) 0862 123456</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="contattaci.tpl">
                  <img src="images/envelope.png" alt="" />
                  <span>info@sportscenter.com</span>
                </a>
              </li>
            </ul>
          </div>
        </nav>
      </div>
    </header>
    <!-- end header section -->
    <!-- slider section -->
    <section class="slider_section position-relative">
      <div class="container">
        <div class="custom_nav2">
          <nav class="navbar navbar-expand-lg custom_nav-container">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
              aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
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
                  <li class="nav-item active">
                    <a class="nav-link" href="profilo.tpl">Profilo<span class="sr-only">(current)</span></a>
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
    <!-- end slider section -->
  </div>

  <!-- about section -->
  <section class="about_section layout_padding">
    <div class="container">
      <div class="heading_container">
        <h2>
          Profilo di {$nomeUtente}
        </h2>
      </div>
      <div class="box">
        <div class="detail-box">
          <h2>
            Di seguito, trovi tutti i tuoi dati:
          </h2>
          <ul>
            <li>Nome: {$nomeUtente}</li>
            <li>Cognome: {$cognomeUtente}</li>
            <li>Email: {$emailUtente}</li>
            {if $id_tesseraUtente == 0}
            <li>Tessera: non posseduta</li>
            {else}
            <li>ID tessera: {$id_tesseraUtente}</li>
            {/if}
          </ul>
          <a class="btn btn-primary" href="tesseramento.tpl" id="tesseramento-button">Tesseramento</a>
        </div>
      </div>
    </div>
  </section>
  <!-- end about section -->

  <!-- info section -->

  <section class="info_section layout_padding2-top">

    <div class="container">
      <div class="row">
        <div class="col-md-3">
          <h6>
            Qualche info su SportsCenter
          </h6>
          <p>
            In realtà non esiste alcun centro sportivo, è il progetto per un esame universitario.
          </p>
        </div>
        <div class="col-md-2 offset-md-1">
          <h6>
            Menu
          </h6>
          <ul>
            <li class=" active">
              <a class="" href="index.tpl">Home<span class="sr-only">(current)</span></a>
            </li>
            <li class="">
              <a class="" href="prenotazioni.tpl">Prenotazioni</a>
            </li>
            <li class="">
              <a class="" href="servizi.tpl">Servizi</a>
            </li>
            <li class="">
              <a class="" href="contattaci.tpl">Contattaci</a>
            </li>
            <li class="">
              <a class="" href="login_form.tpl">Login</a>
            </li>
          </ul>
        </div>
        <div class="col-md-3">
          <h6>
            Contattaci
          </h6>
          <div class="info_link-box">
            <a href="contattaci.tpl">
              <img src="images/location-white.png" alt="">
              <span>Via Vetoio, Edificio Coppito 1, 67100 L'Aquila</span>
            </a>
            <a href="contattaci.tpl">
              <img src="images/call-white.png" alt="">
              <span>(+39) 0862 123456</span>
            </a>
            <a href="contattaci.tpl">
              <img src="images/mail-white.png" alt="">
              <span>info@sportscenter.com</span>
            </a>
          </div>
        </div>
        <div class="col-md-3">
          <div>
            <a href="https://www.facebook.com/univaq.it">
              <img src="images/facebook_small_logo.png" alt="Logo Facebook" width=10% height=auto>
            </a>
          </div>
          <div>
            <a href="https://www.instagram.com/univaq.it">
              <img src="images/instagram_small_logo.png" alt="Logo Instagram" width=10% height=auto>
            </a>
          </div>
          <div>
            <a href="https://x.com/univaq">
              <img src="images/twitter_small_logo.png" alt="Logo Twitter" width=10% height=auto>
            </a>
          </div>
          <div>
            <a href="https://www.tiktok.com/">
              <img src="images/tiktok_small_logo.png" alt="Logo TikTok" width=10% height=auto>
            </a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- end info section -->


  <!-- footer section -->
  <section class="container-fluid footer_section ">
    <p>
      &copy; 2024 Tutti i diritti sono riservati. Realizzato da Francis, Das & Daieg. E come semo?</a>
    </p>
  </section>
  <!-- footer section -->

  <script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
  <script type="text/javascript" src="js/bootstrap.js"></script>
  <script type="text/javascript" src="js/index.js"></script>
</body>

</html>