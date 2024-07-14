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
  <link rel="icon" href="/SportsCenter/smarty/libs/images/logo.png" type="image/x-icon" />

  <!-- slider stylesheet -->
  <link rel="stylesheet" type="text/css"
    href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.1.3/assets/owl.carousel.min.css" />

  <!-- bootstrap core css -->
  <link rel="stylesheet" type="text/css" href="/SportsCenter/smarty/libs/css/bootstrap.css" />

  <!-- fonts style -->
  <link href="https://fonts.googleapis.com/css?family=Baloo+Chettan|Dosis:400,600,700|Poppins:400,600,700&display=swap"
    rel="stylesheet" />
  <!-- Custom styles for this template -->
  <link href="/SportsCenter/smarty/libs/css/style.css" rel="stylesheet" />
  <!-- responsive style -->
  <link href="/SportsCenter/smarty/libs/css/responsive.css" rel="stylesheet" />
   <link href="/SportsCenter/smarty/libs/css/index.css" rel="stylesheet" />
   <link href="/SportsCenter/smarty/libs/css/contattaci.css" rel="stylesheet" />
   {literal}

   <script>
        function ready(){
            if (!navigator.cookieEnabled) {
                alert('Attenzione! Attivare i cookie per proseguire correttamente la navigazione');
            }
        }
        document.addEventListener("DOMContentLoaded", ready);
    </script>
{/literal}
</head>

<body>
  <div class="hero_area">
    <!-- header section strats -->
    <header class="header_section">
      <div class="container">
        <nav class="navbar navbar-expand-lg custom_nav-container">
          <a class="navbar-brand" href="/SportsCenter/Utente/home">
            <img src="/SportsCenter/smarty/libs/images/logo.png" alt="" />
            <span>
              SportsCenter
            </span>
          </a>
          <div class="contact_nav" id="">
            <ul class="navbar-nav ">
              <li class="nav-item">
                <a class="nav-link" href="/SportsCenter/Utente/contatti">
                  <img src="/SportsCenter/smarty/libs/images/location.png" alt="" />
                  <span>Location</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="/SportsCenter/Utente/contatti">
                  <img src="/SportsCenter/smarty/libs/images/call.png" alt="" />
                  <span>(+39) 0862 123456</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="/SportsCenter/Utente/contatti">
                  <img src="/SportsCenter/smarty/libs/images/envelope.png" alt="" />
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
              <li class="nav-item active">
                <a class="nav-link" href="home">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="prenotazioni">Prenotazioni</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="/SportsCenter/PrenotaCampo/servizi">Servizi</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="/SportsCenter/Utente/contatti">Contatti</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="profilo">Profilo</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="logout">Logout</a>
              </li>
            </ul>
          </div>
        </div>
      </nav>
    </div>
  </div>
  <div class="slider_container">
    <div class="container">
      <div class="row">
        <div class="col-lg-6 col-md-7 offset-md-6 offset-md-5">
          <div class="detail-box">
            <h2>
              {$nomeUtente}, gioca insieme a noi
            </h2>
            <h1>
              Prenota un campo
            </h1>
            <p>Prenota un campo del nostro centro sportivo. Se non hai l'attrezzatura necessaria, te la diamo noi! Tutto in qualche click</p>
            <div class="btn-box">
              <a href = "/SportsCenter/PrenotaCampo/servizi" class="btn-1">
                Prenota ora
              </a>
              <a href="/SportsCenter/Recensione/mostraRecensioni" class="btn-1">
                Recensioni
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- end slider section -->


  <!-- service section -->

  <section class="service_section layout_padding">
    <div class="container">
      <div class="heading_container">
        <h2>
          I nostri campi
        </h2>
      </div>
      <div class="service_container">
        <div class="box">
          <img src="/SportsCenter/smarty/libs/images/campocalcio.jpg" alt="">
          <h6 class="visible_heading">
            CALCIO ALL'APERTO
          </h6>
          <div class="link_box">
            <a href="/SportsCenter/PrenotaCampo/MostraCalendario/calcio1">
              <img src="/SportsCenter/smarty/libs/images/link.png" alt="">
            </a>
            <h6>
              CALCIO ALL'APERTO
            </h6>
          </div>
        </div>
        <div class="box">
          <img src="/SportsCenter/smarty/libs/images/campocalciointerno.jpg" alt="">
          <h6 class="visible_heading">
            CALCIO AL CHIUSO
          </h6>
          <div class="link_box">
            <a href="/SportsCenter/PrenotaCampo/MostraCalendario/calcio2">
              <img src="/SportsCenter/smarty/libs/images/link.png" alt="">
            </a>
            <h6>
              CALCIO AL CHIUSO
            </h6>
          </div>
        </div>
        <div class="box">
          <img src="/SportsCenter/smarty/libs/images/campopadelaperto.jpg" alt="">
          <h6 class="visible_heading">
            PADEL ALL'APERTO
          </h6>
          <div class="link_box">
            <a href="/SportsCenter/PrenotaCampo/MostraCalendario/padel1">
              <img src="/SportsCenter/smarty/libs/images/link.png" alt="">
            </a>
            <h6>
              PADEL ALL'APERTO
            </h6>
          </div>
        </div>
        <div class="box">
          <img src="/SportsCenter/smarty/libs/images/campopadelchiuso.jpg" alt="">
          <h6 class="visible_heading">
            PADEL AL CHIUSO
          </h6>
          <div class="link_box">
            <a href="/SportsCenter/PrenotaCampo/MostraCalendario/padel2">
              <img src="/SportsCenter/smarty/libs/images/link.png" alt="">
            </a>
            <h6>
              PADEL AL CHIUSO
            </h6>
          </div>
        </div>
        <div class="box">
          <img src="/SportsCenter/smarty/libs/images/campotennisaperto.jpg" alt="">
          <h6 class="visible_heading">
            TENNIS ALL'APERTO
          </h6>
          <div class="link_box">
            <a href="/SportsCenter/PrenotaCampo/MostraCalendario/tennis1">
              <img src="/SportsCenter/smarty/libs/images/link.png" alt="">
            </a>
            <h6>
              TENNIS ALL'APERTO
            </h6>
          </div>
        </div>
        <div class="box">
          <img src="/SportsCenter/smarty/libs/images/campotennischiuso.jpg" alt="">
          <h6 class="visible_heading">
            TENNIS AL CHIUSO
          </h6>
          <div class="link_box">
            <a href="/SportsCenter/PrenotaCampo/MostraCalendario/tennis2">
              <img src="/SportsCenter/smarty/libs/images/link.png" alt="">
            </a>
            <h6>
              TENNIS AL CHIUSO
            </h6>
          </div>
        </div>
        <div class="box">
          <img src="/SportsCenter/smarty/libs/images/campopallavoloaperto.jpeg" alt="">
          <h6 class="visible_heading">
            PALLAVOLO ALL'APERTO
          </h6>
          <div class="link_box">
            <a href="/SportsCenter/PrenotaCampo/MostraCalendario/pallavolo1">
              <img src="/SportsCenter/smarty/libs/images/link.png" alt="">
            </a>
            <h6>
              PALLAVOLO ALL'APERTO
            </h6>
          </div>
        </div>
        <div class="box">
          <img src="/SportsCenter/smarty/libs/images/campopallavolochiuso.jpg" alt="">
          <h6 class="visible_heading">
            PALLAVOLO AL CHIUSO
          </h6>
          <div class="link_box">
            <a href="/SportsCenter/PrenotaCampo/MostraCalendario/pallavolo2">
              <img src="/SportsCenter/smarty/libs/images/link.png" alt="">
            </a>
            <h6>
              PALLAVOLO AL CHIUSO
            </h6>
          </div>
        </div>
        <div class="box">
          <img src="/SportsCenter/smarty/libs/images/campobasket.jpg" alt="">
          <h6 class="visible_heading">
            BASKET ALL'APERTO
          </h6>
          <div class="link_box">
            <a href="/SportsCenter/PrenotaCampo/MostraCalendario/basket1">
              <img src="/SportsCenter/smarty/libs/images/link.png" alt="">
            </a>
            <h6>
              BASKET ALL'APERTO
            </h6>
          </div>
        </div>
        <div class="box">
          <img src="/SportsCenter/smarty/libs/images/campobasketchiuso.jpg" alt="">
          <h6 class="visible_heading">
            BASKET AL CHIUSO
          </h6>
          <div class="link_box">
            <a href="/SportsCenter/PrenotaCampo/MostraCalendario/basket2">
              <img src="/SportsCenter/smarty/libs/images/link.png" alt="">
            </a>
            <h6>
              BASKET AL CHIUSO
            </h6>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- end service section -->

    <!-- Us section -->

    <section class="us_section layout_padding">
      <div class="container">
        <div class="heading_container">
          <h2>
            Perché scegliere noi
          </h2>
        </div>
        <div class="us_container">
          <div class="box">
            <div class="img-box">
              <img src="/SportsCenter/smarty/libs/images/u-1.png" alt="">
            </div>
            <div class="detail-box">
              <h5>
                ATTREZZATURA DI QUALITÀ
              </h5>
              <p>
                La nostra attrezzatura è di qualità A++, certificata CONI.
              </p>
            </div>
          </div>
          <div class="box">
            <div class="img-box">
              <img src="/SportsCenter/smarty/libs/images/u-2.png" alt="">
            </div>
            <div class="detail-box">
              <h5>
                STRUTTURA ALL'AVANGUARDIA
              </h5>
              <p>
                Tutti i nostri campi sono di ultima generazione e sottoposti a regolare manutenzione.
              </p>
            </div>
          </div>
          <div class="box">
            <div class="img-box">
              <img src="/SportsCenter/smarty/libs/images/u-3.png" alt="">
            </div>
            <div class="detail-box">
              <h5>
                COMFORT E COMODITÀ
              </h5>
              <p>
                Ogni prenotazione comprende uno spogliatoio dotato di bagni e docce.
              </p>
            </div>
          </div>
          <div class="box">
            <div class="img-box">
              <img src="/SportsCenter/smarty/libs/images/u-4.png" alt="">
            </div>
            <div class="detail-box">
              <h5>
                BASTANO POCHI CLICK!
              </h5>
              <p>
                Tramite la nostra piattaforma, è possibile prenotare il campo, l'attrezzatura e saldare la quota in pochi minuti.
              </p>
            </div>
          </div>
        </div>
      </div>
    </section>
  
    <!-- end us section -->


  <!-- client section -->

  <section class="client_section layout_padding">
    <div class="container">
      <div class="heading_container">
        <h2>
          Riconoscimenti e iniziative
        </h2>
      </div>
      <div id="carouselExample2Indicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
          <li data-target="#carouselExample2Indicators" data-slide-to="0" class="active"></li>
          <li data-target="#carouselExample2Indicators" data-slide-to="1"></li>
          <li data-target="#carouselExample2Indicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
          <div class="carousel-item active">
            <div class="box">
              <div class="img-box">
                <img src="/SportsCenter/smarty/libs/images/coni.png" alt="CONI">
              </div>
              <div class="detail-box">
                <h5>
                  Qualifiche sportive CONI
                </h5>
                <p>
                  Il centro sportivo SportsCenter è uno dei pochi ad avere solo ed esclusivamente personale altamente qualificato. Tutto il personale ha ricevuto dal CONI riconoscimenti tecnico-formativi delle qualifiche sportive.
                </p>
              </div>
            </div>
          </div>
          <div class="carousel-item">
            <div class="box">
              <div class="img-box">
                <img src="/SportsCenter/smarty/libs/images/stemma_laquila.png" alt="Stemma L'Aquila">
              </div>
              <div class="detail-box">
                <h5>
                  Parter del Comune dell'Aquila
                </h5>
                <p>
                  Il centro sportivo SportsCenter è dal 2020 partner ufficiale del Comune dell'Aquila, nonché primo sponsor della Perdonanza Celestiniana, evento storico-religioso annuale tra i più importanti d'Italia.
                </p>
              </div>
            </div>
          </div>
          <div class="carousel-item">
            <div class="box">
              <div class="img-box">
                <img src="/SportsCenter/smarty/libs/images/idc.png" alt="Istituto Dottrina Cristiana">
              </div>
              <div class="detail-box">
                <h5>
                  Scuola e formazione
                </h5>
                <p>
                  Il centro sportivo SportsCenter è da sempre al fianco dei ragazzi e delle ragazze, sin dalle scuole elementari. È promotore di numerose iniziative al fianco dell'Istituto Dottrina Cristiana dell'Aquila, per far avvicinare i più piccoli ad uno stile di vita sano, che non può mancare di sport e movimento.
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
  </section>

  <!-- end client section -->

    <!-- result section -->

    <section class="result_section">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-6 px-0">
            <div class="img-box">
              <img src="/SportsCenter/smarty/libs/images/result-img.jpg" alt="">
            </div>
          </div>
          <div class="col-lg-4 col-md-5">
            <div class="detail-box">
              <h2>
                DIVENTA PARTNER: <br>
                TESSERATI CON NOI
              </h2>
              <p>
                Tesserati subito con noi: versando una quota annuale, puoi usufruire di fantastici sconti e vantaggi esclusivi!
              </p>
              <a href="/SportsCenter/Utente/profilo/tesseramento">
                Scopri di più
              </a>
            </div>
          </div>
        </div>
      </div>
    </section>
  
    <!-- end result section -->


  <!-- contact section -->
  <section class="contact_section layout_padding">
    <div class="container">
      <div class="heading_container">
        <h2>
          <span>
            Dove trovarci
          </span>
        </h2>
      </div>
      <div class="layout_padding2-top">
        <div class="row">
          <div class="col-md-6">
            <div class="social_links">
          <div class="info_link-box">
            <a href="https://www.facebook.com/univaq.it">
              <img src="/SportsCenter/smarty/libs/images/facebook_logo.png" alt="Logo Facebook" width=10% height=auto>
              <span>Trovaci su Facebook</span>
            </a>
            <a href="https://www.instagram.com/univaq.it">
              <img src="/SportsCenter/smarty/libs/images/instagram_logo.png" alt="Logo Instagram" width=10% height=auto>
              <span>Trovaci su Instagram</span>
            </a>
            <a href="https://x.com/univaq">
              <img src="/SportsCenter/smarty/libs/images/twitter_logo.png" alt="Logo Twitter" width=10% height=auto>
              <span>Trovaci su Twitter/X</span>
            </a>
            <a href="https://www.tiktok.com/">
              <img src="/SportsCenter/smarty/libs/images/tiktok_logo.png" alt="Logo TikTok" width=10% height=auto>
              <span>Trovaci su TikTok</span>
            </a>
          </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="map_container">
              <div class="map-responsive">
                <iframe
                  src="https://www.google.com/maps/embed/v1/place?key=AIzaSyA0s1a7phLN0iaD6-UE7m4qP-z21pH0eSc&q=Università+degli+Studi+dell'Aquila+Coppito"
                  width="600" height="300" frameborder="0" style="border:0; width: 100%; height:100%"
                  allowfullscreen></iframe>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- end contact section -->


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
            <li class="">
              <a class="" href="/SportsCenter/Utente/home">Home</a>
            </li>
            <li class="">
              <a class="" href="/SportsCenter/Utente/prenotazioni">Prenotazioni</a>
            </li>
            <li class="">
              <a class="" href="/SportsCenter/PrenotaCampo/servizi">Servizi</a>
            </li>
            <li class="">
              <a class="" href="/SportsCenter/Utente/contatti">Contatti</a>
            </li>
            <li class="">
              <a class="" href="/SportsCenter/Utente/profilo">Profilo</a>
            </li>
            <li class="">
              <a class="" href="/SportsCenter/Utente/logout">Logout</a>
            </li>
          </ul>
        </div>
        <div class="col-md-3">
          <h6>
            Contattaci
          </h6>
          <div class="info_link-box">
            <a href="/SportsCenter/Utente/contatti">
              <img src="/SportsCenter/smarty/libs/images/location-white.png" alt="">
              <span>Via Vetoio, Edificio Coppito 1, 67100 L'Aquila</span>
            </a>
            <a href="/SportsCenter/Utente/contatti">
              <img src="/SportsCenter/smarty/libs/images/call-white.png" alt="">
              <span>(+39) 0862 123456</span>
            </a>
            <a href="/SportsCenter/Utente/contatti">
              <img src="/SportsCenter/smarty/libs/images/mail-white.png" alt="">
              <span>info@sportscenter.com</span>
            </a>
          </div>
        </div>
        <div class="col-md-3">
          <div>
            <a href="https://www.facebook.com/univaq.it">
              <img src="/SportsCenter/smarty/libs/images/facebook_small_logo.png" alt="Logo Facebook" width=10% height=auto>
            </a>
          </div>
          <div>
            <a href="https://www.instagram.com/univaq.it">
              <img src="/SportsCenter/smarty/libs/images/instagram_small_logo.png" alt="Logo Instagram" width=10% height=auto>
            </a>
          </div>
          <div>
            <a href="https://x.com/univaq">
              <img src="/SportsCenter/smarty/libs/images/twitter_small_logo.png" alt="Logo Twitter" width=10% height=auto>
            </a>
          </div>
          <div>
            <a href="https://www.tiktok.com/">
              <img src="/SportsCenter/smarty/libs/images/tiktok_small_logo.png" alt="Logo TikTok" width=10% height=auto>
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
      &copy; 2024 Tutti i diritti sono riservati. Realizzato da
      <a href="https://www.trend-online.com/wp-content/uploads/2024/03/gerry-scotti-compagna.jpg">Francis, Das e Daieg</a>
    </p>
  </section>
  <!-- footer section -->

  <script type="text/javascript" src="/SportsCenter/smarty/libs/js/jquery-3.4.1.min.js"></script>
  <script type="text/javascript" src="/SportsCenter/smarty/libs/js/bootstrap.js"></script>
  <script type="text/javascript" src="/SportsCenter/smarty/libs/js/index.js"></script>
</body>
</html>