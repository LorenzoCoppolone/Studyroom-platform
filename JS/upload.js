// Toggle Appunto / Esame
const btnAppunto = document.getElementById("btnAppunto");
const btnEsame = document.getElementById("btnEsame");
const tagSelect = document.getElementById("tagSelect");

btnAppunto.onclick = () => {
    btnAppunto.classList.add("active");
    btnEsame.classList.remove("active");
    tagSelect.disabled = false;
};

btnEsame.onclick = () => {
    btnEsame.classList.add("active");
    btnAppunto.classList.remove("active");
    tagSelect.disabled = true;
};

// Recupera dati del file da sessionStorage (se presenti) e precompila il form altrimenti mostra form vuoto
const name = sessionStorage.getItem('fileName');
const type = sessionStorage.getItem('fileType');
const data = JSON.parse(sessionStorage.getItem('fileData'));

if (name && data) {
    const file = new File([new Uint8Array(data)], name, { type });

    const input = document.getElementById('fileInputHidden');
    if (input) {
        const dataTransfer = new DataTransfer();
        dataTransfer.items.add(file);
        input.files = dataTransfer.files;
    }
}

// File picker
document.querySelector(".upload-btn").onclick = () => {
    document.getElementById("fileInput").click();
};

document.getElementById("fileInput").onchange = () => {
    const file = document.getElementById("fileInput").files[0];
    const fileNameBox = document.getElementById("fileName");

    if (file) {
        fileNameBox.textContent = "File selezionato: " + file.name;
    }
};

