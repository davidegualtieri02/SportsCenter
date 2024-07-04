// Funzione per gestire il clic su un'ora
function selectHour(hourOption) {
  // Rimuove la classe 'selected' da tutte le opzioni delle ore
  const hourOptions = document.querySelectorAll('.hour-option');
  hourOptions.forEach(option => option.classList.remove('selected'));

  // Aggiunge la classe 'selected' all'opzione dell'ora cliccata
  hourOption.classList.add('selected');

  // Recupera l'ora selezionata e aggiorna il testo visualizzato
  const hour = hourOption.textContent;
  const minute = '00'; // Imposta i minuti a "00"
  const formattedTime = `${hour}:${minute}`;
  document.getElementById('selectedTime').innerText = `Orario selezionato: ${formattedTime}`;
}

// Genera le opzioni delle ore cliccabili da 08 a 23
const hourOptionsContainer = document.getElementById('hourOptions');
for (let hour = 8; hour <= 23; hour++) {
  const hourOption = document.createElement('div');
  hourOption.textContent = hour.toString().padStart(2, '0');
  hourOption.classList.add('hour-option');
  hourOption.addEventListener('click', function() {
    selectHour(hourOption);
  });
  hourOptionsContainer.appendChild(hourOption);
}









