import jsCalendar from './js/jsCalendar.js';

document.addEventListener('DOMContentLoaded', () => {
  const calendarEl = document.querySelector('#calendar');
  if (!calendarEl) return;

  let data = {};

  fetch('/agenda/calendrier/data')
    .then(res => res.json())
    .then(events => {
      // Transformer les données en objet clé/valeur pour un accès rapide
      events.forEach(event => {
        let status = '';
        if (event.etat === 0) status = 'ferme';
        else if (event.etat === 1) status = 'disponible';
        else if (event.etat === 2) status = 'reserve';
        data[event.date] = {
          etat: status,
          description: event.description
        };
      });

      // Refresh pour appliquer les couleurs une fois les données reçues
      calendar.refresh();
    });



  // --- Initialisation du calendrier
  const calendar = jsCalendar.new(calendarEl, new Date(), {firstDayOfTheWeek: 2});

  // Appliquer les classes selon les dispos
  calendar.onDateRender((date, element) => {
    const dateStr = date.toISOString().slice(0, 10);
    if (data[dateStr]) {
      element.classList.add(`etat-${data[dateStr].etat}`);
    }
  });

 calendar.onDateClick((event, date) => {
  document.querySelectorAll('.jsCalendar td.selected').forEach(el => el.classList.remove('selected'));
  event.target.classList.add('selected');

  const dateStr = date.toISOString().slice(0, 10);
  const formattedDate = date.toLocaleDateString("fr-FR", {
    weekday: "long",
    year: "numeric",
    month: "long",
    day: "numeric"
  });

  const details = document.getElementById("event-details");
  details.innerHTML = `
    <h2 class="text-xl font-bold mb-2">Détails</h2>
    <p class="text-gray-700">Date sélectionnée :</p>
    <p class="text-gray-900 font-semibold">${formattedDate}</p>
    <p class="text-gray-600 mt-2">${data[dateStr]?.description || "Aucune information."}</p>
  `;
});


  // Forcer le rendu initial
  calendar.refresh();
});

