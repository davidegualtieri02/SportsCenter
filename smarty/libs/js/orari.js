 function selectTime(cell) {
      // Rimuove la classe 'selected' da tutte le celle della tabella
      const allCells = document.querySelectorAll('.orari-table td');
      allCells.forEach(c => c.classList.remove('selected'));

      // Aggiunge la classe 'selected' alla cella selezionata
      cell.classList.add('selected');

      // Esempio di output del tempo selezionato
      console.log('Orario selezionato:', cell.textContent.trim());
    }

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
      const btnAvanti = document.querySelector('.btn-avanti');
      const orariCells = document.querySelectorAll('.orari-table td');

      orariCells.forEach(cell => {
        cell.addEventListener('click', function () {
          orariCells.forEach(c => c.classList.remove('selected'));
          cell.classList.add('selected');
          console.log('Orario selezionato:', cell.textContent.trim());
        });
      });

      btnAvanti.addEventListener('click', function () {
        // Logica per procedere al passaggio successivo
        console.log('Passaggio al passo successivo');
      });
    });
    function selectTime(td) {
      var selectedTime = td.innerHTML;
      document.getElementById('selected_time').value = selectedTime;
    }










