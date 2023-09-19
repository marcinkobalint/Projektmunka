//súgü gomb

// Első lépés: Az elemek kiválasztása az azonosítójuk alapján
const helpButton = document.getElementById('helpButton');
const helpContent = document.getElementById('helpContent');
const closeButton = document.getElementById('closeButton');

// súgó gombra kattintás
helpButton.addEventListener('click', () => {
  helpContent.style.display = 'block';
});

// bezárás gommbra kattintás
closeButton.addEventListener('click', () => {
  helpContent.style.display = 'none';
});


