document.getElementById('submit-recensione').addEventListener('click', function() {
  var recensioneText = document.getElementById('recensione-text').value;
  var files = document.getElementById('recensione-immagini').files;

  // Creare un oggetto FormData per inviare i dati
  var formData = new FormData();
  formData.append('recensione', recensioneText);
  for (var i = 0; i < files.length; i++) {
    formData.append('immagini[]', files[i]);
  }

  // Eseguire la chiamata AJAX o fetch per inviare i dati al backend
  fetch('/Controller/CRecensione.php', {// è il percorso in cui ho il metodo scriviRecensione()
    method: 'POST',
    body: formData
  })
  .then(function(response) {
    if (!response.ok) {
      throw new Error('Errore durante l\'invio dei dati');
    }
    return response.json(); // Se il server risponde con JSON, altrimenti usa response.text()
  })
  .then(function(data) {
    // Gestire la risposta dal backend, se necessario
    console.log('Risposta dal backend:', data);
    // Esempio: aggiornare l'UI per mostrare che la recensione è stata inviata
    alert('Recensione inviata con successo!');
    // Esempio: ripulire il form o fare altro aggiornamento dell'interfaccia utente
    document.getElementById('recensione-text').value = '';
    document.getElementById('recensione-immagini').value = ''; // Resetta l'input file se necessario
    document.getElementById('preview').innerHTML = ''; // Ripulisci la preview delle immagini
  })
  .catch(function(error) {
    console.error('Errore durante l\'invio dei dati:', error);
    // Gestire gli errori, ad esempio mostrando un messaggio all'utente
    alert('Si è verificato un errore durante l\'invio della recensione.');
  });
});
