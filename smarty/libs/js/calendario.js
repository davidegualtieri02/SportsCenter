document.addEventListener('DOMContentLoaded', () => {
    const btnPrev = document.getElementById('btnPrev');
    const btnNext = document.getElementById('btnNext');
    const monthYear = document.getElementById('monthYear');
    const divCal = document.getElementById('divCal');
    const selectedDayInput = document.getElementById('selectedDayInput');
  
    let currentDate = new Date();
    let selectedDay = null;
    let selectedDate = null; // Variabile per memorizzare la data selezionata

    function renderCalendar(date) {
        divCal.innerHTML = '';
      
        const year = date.getFullYear();
        const month = date.getMonth();
      
        monthYear.textContent = `${date.toLocaleString('default', { month: 'long' })} ${year}`;
      
        const firstDay = new Date(year, month, 1).getDay();
        const lastDate = new Date(year, month + 1, 0).getDate();
        const today = new Date();
      
        for (let i = 0; i < firstDay; i++) {
            const emptyCell = document.createElement('div');
            emptyCell.className = 'day';
            divCal.appendChild(emptyCell);
        }
      
        for (let day = 1; day <= lastDate; day++) {
            const dayCell = document.createElement('div');
            dayCell.className = 'day';
            dayCell.textContent = day;
          
            const dayDate = new Date(year, month, day);
            if (dayDate < today.setHours(0, 0, 0, 0)) {
                dayCell.classList.add('disabled');
            } else {
                dayCell.addEventListener('click', () => {
                    if (selectedDay) {
                        selectedDay.classList.remove('selected');
                    }
                    dayCell.classList.add('selected');
                    selectedDay = dayCell;
                  
                    // Impostare il valore dell'input nascosto
                    selectedDayInput.value = `${year}-${month + 1}-${day}`;

                    // Memorizzare la data selezionata nella variabile
                    selectedDate = new Date(year, month, day);
                    console.log("Data selezionata:", selectedDate);
                });
            }
          
            divCal.appendChild(dayCell);
        }
    }
  
    btnPrev.addEventListener('click', () => {
        currentDate.setMonth(currentDate.getMonth() - 1);
        renderCalendar(currentDate);
    });
  
    btnNext.addEventListener('click', () => {
        currentDate.setMonth(currentDate.getMonth() + 1);
        renderCalendar(currentDate);
    });
  
    renderCalendar(currentDate);
});

