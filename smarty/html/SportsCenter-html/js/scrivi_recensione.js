document.getElementById('recensione-immagini').addEventListener('change', function(event) {
      var files = event.target.files;
      var preview = document.getElementById('preview');
      preview.innerHTML = '';
      
      for (var i = 0; i < files.length; i++) {
        var file = files[i];
        var reader = new FileReader();
        
        reader.onload = function(e) {
          var image = document.createElement('img');
          image.style.maxWidth = '200px';
          image.style.maxHeight = '200px';
          image.style.marginRight = '10px';
          image.src = e.target.result;
          preview.appendChild(image);
        };
        
        reader.readAsDataURL(file);
      }
    });

    document.getElementById('submit-recensione').addEventListener('click', function() {
      var recensioneText = document.getElementById('recensione-text').value;
      var files = document.getElementById('recensione-immagini').files;

      // Eseguire l'invio dei dati al backend, includendo i file (immagini) caricati
      // In questa sezione si implementa la logica per inviare i dati della recensione e le immagini al backend

      console.log('Recensione testuale:', recensioneText);
      console.log('Immagini caricate:', files);
      