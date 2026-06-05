// =============================================
// StudyRoom — modificaProfilo.js
// Anteprima live dell'immagine profilo selezionata
// nella pagina di modifica profilo.
// =============================================

const inputImmagine = document.getElementById("immagine");

if (inputImmagine) {
    inputImmagine.addEventListener("change", (e) => {
        const file = e.target.files[0];
        if (!file) return;

        const wrapper = document.getElementById("previewWrapper");
        let img = document.getElementById("previewImg");

        // Se non c'è ancora un'immagine, rimuovo l'icona placeholder e creo l'<img>
        if (!img) {
            const placeholder = document.getElementById("previewPlaceholder");
            if (placeholder) placeholder.remove();

            img = document.createElement("img");
            img.id = "previewImg";
            img.alt = "Foto profilo";
            wrapper.appendChild(img);
        }

        img.src = URL.createObjectURL(file);
    });
}
