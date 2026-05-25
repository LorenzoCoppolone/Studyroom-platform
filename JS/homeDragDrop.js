// HOME — Gestione click + drag & drop
const dropZone = document.getElementById('dropZone');
// CLICK NORMALE → vai alla pagina di caricamento
dropZone.addEventListener('click', () => {
    location.href = '/carica.html';
});
// NECESSARIO per permettere il drop
dropZone.addEventListener('dragover', (e) => {
    e.preventDefault();
});
// DROP → salva file in sessionStorage → redirect
dropZone.addEventListener('drop', async (e) => {
    e.preventDefault();
    const file = e.dataTransfer.files[0];
    if (!file) return;
    // Leggi il file come array di byte
    const arrayBuffer = await file.arrayBuffer();
    // Salva in sessionStorage
    sessionStorage.setItem('fileName', file.name);
    sessionStorage.setItem('fileType', file.type);
    sessionStorage.setItem('fileData', JSON.stringify([...new Uint8Array(arrayBuffer)]));
    sessionStorage.setItem('fileSize', file.size);
    location.href = '/avviaCaricamento'; // Vai alla pagina di caricamento
});
