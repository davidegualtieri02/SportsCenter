document.addEventListener("DOMContentLoaded", function() {
  const equipmentForm = document.getElementById("equipmentForm");
  const equipmentCheckbox = document.querySelector('input[name="attrezzatura"]');
  
  // Aggiungi un campo nascosto per l'attrezzatura al caricamento della pagina
  let hiddenField = document.createElement("input");
  hiddenField.type = "hidden";
  hiddenField.name = "attrezzatura";
  hiddenField.value = "false"; // Valore predefinito
  equipmentForm.appendChild(hiddenField);

  equipmentCheckbox.addEventListener("change", function() {
    if (equipmentCheckbox.checked) {
      hiddenField.value = "true"; // Imposta il valore a "true" se il checkbox è selezionato
    } else {
      hiddenField.value = "false"; // Imposta il valore a "false" se il checkbox non è selezionato
    }
  });

  equipmentForm.addEventListener("submit", function(event) {
    // Non fare nulla qui, lascia che il form si comporti normalmente
    // Il valore di attrezzatura è già stato impostato correttamente
    // con l'evento change del checkbox
  });
});

