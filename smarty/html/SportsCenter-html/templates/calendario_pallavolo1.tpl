<!DOCTYPE html>
<html lang="it">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="keywords" content="{$meta_keywords}">
  <meta name="description" content="{$meta_description}">
  <meta name="author" content="{$meta_author}">
  <title>{$page_title}</title>
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.1.3/assets/owl.carousel.min.css">
  <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
  <link href="https://fonts.googleapis.com/css?family=Baloo+Chettan|Dosis:400,600,700|Poppins:400,600,700&display=swap" rel="stylesheet">
  <link href="css/style.css" rel="stylesheet">
  <link href="css/responsive.css" rel="stylesheet">
  <link rel="stylesheet" href="calendario.css">
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f0f4f8;
      margin: 0;
    }
    .calendar-wrapper {
      background-color: #fff;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      border-radius: 10px;
      padding: 20px;
      width: 100%;
      text-align: center;
      margin-top: 20px;
      margin-bottom: 20px;
    }
    .calendar-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 10px;
    }
    .calendar-header h2 {
      margin: 0;
    }
    button {
      background-color: #007bff;
      color: white;
      border: none;
      padding: 10px 20px;
      margin: 5px;
      cursor: pointer;
      border-radius: 5px;
      transition: background-color 0.3s;
    }
    button:hover {
      background-color: #0056b3;
    }
    .calendar {
      display: grid;
      grid-template-columns: repeat(7, 1fr);
      gap: 5px;
      margin-top: 20px;
      margin-bottom: 20px;
    }
    .day {
      padding: 10px;
      text-align: center;
      cursor: pointer;
      border-radius: 5px;
      transition: background-color 0.3s;
      background-color: #e9ecef;
    }
    .day:hover {
      background-color: #dee2e6;
    }
    .selected {
      background-color: #007bff;
      color: white;
    }
    .navbar-nav .nav-link {
      color: #000;
      transition: color 0.3s;
    }
    .navbar-nav .nav-link:hover {
      color: #fff !important;
    }
    /* Aggiunta stile per il pulsante "Avanti" */
    .btn-avanti {
      background-color: #28a745;
      color: white;
      border: none;
      padding: 10px 20px;
      margin-top: 20px;
      border-radius: 5px;
      cursor: pointer;
      transition: background-color 0.3s;
    }
    .btn-avanti:hover {
      background-color: #218838;
    }
  </style>
</head>
<body class="sub_page">
  <div class="hero_area">
    <header class="header_section">
      <div class="container">
        <nav class="navbar navbar-expand-lg custom_nav-container">
          <a class="navbar-brand" href="index.html">
            <img src="{$logo_src}" alt="">
            <span>{$site_name}</span>
          </a>
          <div class="contact_nav">
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link" href="contact.html">
                  <img src="images/location.png" alt="">
                  <span>{$location_text}</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="service.html">
                  <img src="images/call.png" alt="">
                  <span>{$phone_text}</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="service.html">
                  <img src="images/envelope.png" alt="">
                  <span>{$email_text}</span>
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
                    <a class="nav-link" href="index.html">Home <span class="sr-only">(current)</span></a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="about.html">About </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="service.html">Services </a></li>
                  <li class="nav-item active">
                    <a class="nav-link" href="contact.html">Contact Us</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="index.html">Logout</a>
                  </li>
                </ul>
                <form class="form-inline my-2 my-lg-0 ml-0 ml-lg-4 mb-3 mb-lg-0">
                  <button class="btn my-2 my-sm-0 nav_search-btn" type="submit"></button>
                </form>
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
              <img src="{$campo_img_src}" alt="{$campo_img_alt}" style="max-width: 100%; height: auto;">
            </div>
            <div class="campo-description">
              <h3>Descrizione del campo:</h3>
              <p>{$campo_descrizione}</p>
              <!-- Pulsante "Avanti" allineato a destra -->
              <button class="btn btn-avanti float-right">{$avanti_button_text}</button>
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
          <h6>{$centro_heading}</h6>
          <p>{$centro_description}</p>
        </div>
        <div class="col-md-2 offset-md-1">
          <h6>Menus</h6>
          <ul>
            <li class="active"><a href="index.html">Home <span class="sr-only">(current)</span></a></li>
            <li><a href="about.html">About </a></li>
            <li><a href="service.html">Services </a></li>
            <li><a href="contact.html">Contact Us</a></li>
            <li><a href="index.html">Logout</a></li>
          </ul>
        </div>
        <div class="col-md-3">
          <h6>Useful Links</h6>
          <ul>
            <li><a href="#">{$link1_text}</a></li>
            <li><a href="#">{$link2_text}</a></li>
            <li><a href="#">{$link3_text}</a></li>
            <li><a href="#">{$link4_text}</a></li>
            <li><a href="#">{$link5_text}</a></li>
          </ul>
        </div>
        <div class="col-md-3">
          <h6>Contact Us</h6>
          <div class="info_link-box">
            <a href=""><img src="images/location-white.png" alt=""><span>{$address}</span></a>
            <a href=""><img src="images/call-white.png" alt=""><span>{$phone}</span></a>
            <a href=""><img src="images/mail-white.png" alt=""><span>{$email}</span></a>
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
    <p>&copy; {$current_year} All Rights Reserved. Design by <a href="https://html.design/">Free Html Templates</a></p>
  </section>
  <script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
  <script type="text/javascript" src="js/bootstrap.js"></script>
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const navLinks = document.querySelectorAll('.navbar-nav .nav-link');

      navLinks.forEach(link => {
        link.addEventListener('mouseenter', function () {
          this.style.color = '#fff'; /* Cambia il colore del testo al passaggio del mouse */
        });

        link.addEventListener('mouseleave', function () {
          this.style.color = '#000'; /* Ripristina il colore nero al termine del passaggio del mouse */
        });
      });
    });

    function openNav() {
      document.getElementById("myNav").classList.toggle("menu_width");
      document.querySelector(".custom_menu-btn").classList.toggle("menu_btn-style");
    }

    document.addEventListener('DOMContentLoaded', function () {
      const divCal = document.getElementById('divCal');
      const monthYear = document.getElementById('monthYear');
      const btnPrev = document.getElementById('btnPrev');
      const btnNext = document.getElementById('btnNext');

      const months = ["Gennaio", "Febbraio", "Marzo", "Aprile", "Maggio", "Giugno", "Luglio", "Agosto", "Settembre", "Ottobre", "Novembre", "Dicembre"];
      let currentMonth = new Date().getMonth();
      let currentYear = new Date().getFullYear();

      function renderCalendar(month, year) {
        divCal.innerHTML = '';
        monthYear.textContent = `${months[month]} ${year}`;

        const firstDay = new Date(year, month, 1).getDay();
        const daysInMonth = new Date(year, month + 1, 0).getDate();

        for (let i = 0; i < firstDay; i++) {
          const emptyCell = document.createElement('div');
          divCal.appendChild(emptyCell);
        }

        for (let day = 1; day <= daysInMonth; day++) {
          const dayElement = document.createElement('div');
          dayElement.classList.add('day');
          dayElement.textContent = day;
          dayElement.addEventListener('click', function () {
            document.querySelectorAll('.day').forEach(el => el.classList.remove('selected'));
            dayElement.classList.add('selected');
            console.log('Giorno selezionato:', day);
          });
          divCal.appendChild(dayElement);
        }
      }

      btnPrev.addEventListener('click', function () {
        currentMonth--;
        if (currentMonth < 0) {
          currentMonth = 11;
          currentYear--;
        }
        renderCalendar(currentMonth, currentYear);
      });

      btnNext.addEventListener('click', function () {
        currentMonth++;
        if (currentMonth > 11) {
          currentMonth = 0;
          currentYear++;
        }
        renderCalendar(currentMonth, currentYear);
      });

      renderCalendar(currentMonth, currentYear);
    });
  </script>
</body>
</html>