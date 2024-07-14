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
  <link rel="icon" href="/SportsCenter/smarty/libs/images/logo.png" type="image/x-icon" />

  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.1.3/assets/owl.carousel.min.css">
  <link rel="stylesheet" type="text/css" href="/SportsCenter/smarty/libs/css/bootstrap.css">
  <link href="https://fonts.googleapis.com/css?family=Baloo+Chettan|Dosis:400,600,700|Poppins:400,600,700&display=swap" rel="stylesheet">
  <link href="/SportsCenter/smarty/libs/css/style.css" rel="stylesheet">
  <link href="/SportsCenter/smarty/libs/css/responsive.css" rel="stylesheet">
  <link rel="stylesheet" href="/SportsCenter/smarty/libs/css/calendario.css">
  {literal}
    <script>
        function ready(){
            if (!navigator.cookieEnabled) {
                alert('Attenzione! Attivare i cookie per proseguire correttamente la navigazione');
            }
        }
        document.addEventListener("DOMContentLoaded", ready);

        document.addEventListener("DOMContentLoaded", function() {
          const equipmentForm = document.getElementById("equipmentForm");
          const equipmentCheckbox = document.querySelector('input[name="attrezzatura"]');
          // Aggiungi un campo nascosto per l'attrezzatura al caricamento della pagina
          let hiddenField = document.createElement("input");
          hiddenField.type = "hidden";
          hiddenField.name = "hidden_attrezzatura";
          hiddenField.value = equipmentCheckbox.checked ? "false" : "true"; // Valore iniziale
          equipmentForm.appendChild(hiddenField);
         
          equipmentCheckbox.addEventListener("change", function() {
            hiddenField.value = equipmentCheckbox.checked ? "true" : "false";
          });
         
          equipmentForm.addEventListener("submit", function(event) {
            // Assicurati che il campo nascosto sia aggiornato al submit del form
            hiddenField.value = equipmentCheckbox.checked ? "true" : "false";
          });
        });
    </script>
    {/literal}
</head>
<body class="sub_page">
  <div class="hero_area">
    <header class="header_section">
      <div class="container">
        <nav class="navbar navbar-expand-lg custom_nav-container">
          <a class="navbar-brand" href="/SportsCenter/Utente/home">
            <img src="/SportsCenter/smarty/libs/images/logo.png" alt="">
            <span>SportsCenter</span>
          </a>
          <div class="contact_nav">
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link" href="/SportsCenter/Utente/contatti">
                  <img src="/SportsCenter/smarty/libs/images/location.png" alt="">
                  <span>Location</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="/SportsCenter/Utente/contatti">
                  <img src="/SportsCenter/smarty/libs/images/call.png" alt="">
                  <span>(+39) 0862 123456</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="/SportsCenter/Utente/contatti">
                  <img src="/SportsCenter/smarty/libs/images/envelope.png" alt="">
                  <span>info@sportscenter.com</span>
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
                    <a class="nav-link" href="/SportsCenter/Utente/home">Home</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="/SportsCenter/Utente/prenotazioni">Prenotazioni</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="/SportsCenter/PrenotaCampo/servizi">Servizi</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="/SportsCenter/Utente/contatti">Contatti</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="/SportsCenter/Utente/profilo">Profilo</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="/SportsCenter/Utente/logout">Logout</a>
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
                <form id="equipmentForm" method="post" action="/SportsCenter/PrenotaCampo/MostraAttrezzatura/{$idCampo}/{$giorno}/{$orario}">
                <input type="hidden" name="idCampo" value="{$idCampo}">
                <div class="row">
                    <div class="col-md-6">
                        <h3>Seleziona l'attrezzatura per il giorno: <br>{$giorno}</h3>
                        <!-- Singola casella di controllo -->
                        <div class="equipment-list">
                            <label for="attrezzatura">
                                <br>
                                <input type="checkbox" name="attrezzatura" {if $attrezzatura == 'false'}checked{/if}><h5>Attrezzatura per {$titoloCampo}</h5>
                                </label>
                                <input type="hidden" name="selected_day" value="{$giorno}">
                                <input type="hidden" name="selected_time" value="{$orario}">
                                <br><br><br><br><br><br><br><br><br><br><br><br>
                                <a href = "/SportsCenter/PrenotaCampo/MostraAttrezzatura/{$idCampo}/{$giorno}/{$orario}/{$attrezzatura}"><button class="btn btn-avanti float-right" type="submit">Continua e paga</button></a>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-6">
                        {if $idCampo == "calcio1"} 
                          <img src="/SportsCenter/smarty/libs/images/campocalcio.jpg" alt="">
                        {elseif $idCampo == "calcio2"}
                          <img src="/SportsCenter/smarty/libs/images/campocalciointerno.jpg" alt="">
                        {elseif $idCampo == "padel1"}
                        <img src="/SportsCenter/smarty/libs/images/campopadelaperto.jpg" alt="">
                        {elseif $idCampo == "padel2"}
                        <img src="/SportsCenter/smarty/libs/images/campopadelchiuso.jpg" alt="">
                        {elseif $idCampo == "tennis1"}
                        <img src="/SportsCenter/smarty/libs/images/campotennisaperto.jpg" alt="">
                        {elseif $idCampo == "tennis2"}
                        <img src="/SportsCenter/smarty/libs/images/campotennischiuso.jpg" alt="">
                        {elseif $idCampo == "pallavolo1"}
                        <img src="/SportsCenter/smarty/libs/images/campopallavoloaperto.jpeg" alt="">
                        {elseif $idCampo == "pallavolo2"}
                        <img src="/SportsCenter/smarty/libs/images/campopallavolochiuso.jpg" alt="">
                        {elseif $idCampo == "basket1"}
                        <img src="/SportsCenter/smarty/libs/images/campobasket.jpg" alt="">
                        {else $idCampo == "basket2"}
                        <img src="/SportsCenter/smarty/libs/images/campobasketinterno.jpg" alt="">
                        {/if}
                        <div class="text-center mb-4">
                        </div>
                        <div class="campo-description">
                            <h3>Descrizione del campo:</h3>
                            <p>{$titoloCampo}.
                            Costo del campo:
                            {if $id_tesseraUtente ==0}
                                {$prezzoCampo} euro
                            {else}
                                {math equation = "x-(x * y / 100)" x =$prezzoCampo y=30 assign ="prezzo_scontato"} 
                                Prezzo originale : {$prezzoCampo} euro , prezzo scontato per utenti tesserati : {$prezzo_scontato} euro.
                            {/if}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
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
