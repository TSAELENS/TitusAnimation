import jsCalendar from './js/jsCalendar.js';

document.addEventListener('DOMContentLoaded', () => {
  const calendarEl = document.querySelector('#calendar');
  if (!calendarEl) return;

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


  // --- Initialisation du calendrier
  const calendar = jsCalendar.new(calendarEl, new Date(), {firstDayOfTheWeek: 2});

  // Appliquer les classes selon les dispos
  calendar.onDateRender((date, element) => {
    const dateStr = date.toISOString().slice(0,10);
    const etat = data[dateStr];
    if (etat) {
      element.classList.add(`etat-${etat}`);
    }
  });

  // Gérer le clic sur une date
  calendar.onDateClick((event, date) => {
    // Supprimer l'ancienne sélection
    document.querySelectorAll('.jsCalendar td.selected').forEach(el => el.classList.remove('selected'));
    // Marquer la nouvelle
    event.target.classList.add('selected');

    const details = document.getElementById("event-details");
    const formattedDate = date.toLocaleDateString("fr-FR", {
      weekday: "long",
      year: "numeric",
      month: "long",
      day: "numeric"
    });
        details.innerHTML = `
      <h2 class="text-xl font-bold mb-2">Détails</h2>
      <p class="text-gray-700">Date sélectionnée :</p>
      <p class="text-gray-900 font-semibold">${formattedDate}</p>
    `;

  });

  // Forcer le rendu initial
  calendar.refresh();
});

