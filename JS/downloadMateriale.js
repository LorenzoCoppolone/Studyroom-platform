/**
 * Gestisce il download del materiale
 * Usa il link diretto per sfruttare gli header di download della view
 */
function scaricaMateriale() {
    const downloadLink = document.getElementById('downloadLink');
    if (!downloadLink) {
        console.error('Elemento downloadLink non trovato');
        return;
    }
    
    // Fai il click del link direttamente
    // La view farà gli header Content-Disposition: attachment che forza il download
    // senza navigare la pagina
    downloadLink.click();
}
