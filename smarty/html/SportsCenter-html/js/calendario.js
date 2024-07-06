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
    // Aggiungi un listener per aggiornare l'input nascosto con la data selezionata. la variabile selectedDate viene aggiornata con il valore della data scelta dall'utente
    document.querySelectorAll('.calendar .day').forEach(day => {
      day.addEventListener('click', function() {
        document.getElementById('selectedDate').value = this.dataset.date;
      });
    });