import jsCalendar from './js/jsCalendar.js';

document.addEventListener('DOMContentLoaded', () => {
  const calendarEl = document.querySelector('#calendar');
  if (!calendarEl) return;

  // Init calendrier
  const calendar = jsCalendar.new(calendarEl, new Date());

  // Données statiques (à remplacer plus tard par ton fetch)
  const data = {
    "2025-04-03": "disponible",
    "2025-04-05": "reserve",
    "2025-04-09": "ferme",
    "2025-04-015": "disponible",
    "2025-05-01": "disponible",
    "2025-05-02": "reserve",
    "2025-05-04": "ferme",
    "2025-05-08": "disponible"
  };

  // Appliquer les classes selon l'état de chaque date visible
  calendar.onDateRender(function(date, element) {
    const dateStr = date.toISOString().split('T')[0];
    const etat = data[dateStr];

    if (etat) {
      element.classList.add(`etat-${etat}`);
    }
  });
  calendar.refresh();

});
