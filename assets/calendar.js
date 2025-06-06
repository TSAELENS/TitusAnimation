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
  const calendar = jsCalendar.new(calendarEl, new Date());

  // Appliquer les classes selon les dispos
  calendar.onDateRender((date, element) => {
    // Masquer les jours hors du mois courant
    if (!calendar.isInMonth(date)) {
      element.style.display = 'none';
      return;
    }

    // Formater la date en YYYY-MM-DD
    const dateStr = date.toISOString().split('T')[0];

    // Appliquer la classe selon l'état (si trouvé)
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
  });

  // Forcer le rendu initial
  calendar.refresh();
});

