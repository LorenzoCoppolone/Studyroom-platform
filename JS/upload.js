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

// File picker
document.querySelector(".upload-box").onclick = () => {
    document.getElementById("fileInput").click();
};
document.getElementById("fileInput").onchange = () => {
    const file = document.getElementById("fileInput").files[0];
    const fileNameBox = document.getElementById("fileName");

    if (file) {
        fileNameBox.textContent = "File selezionato: " + file.name;
        document.querySelector(".upload-box").classList.remove("input-error");
        document.getElementById("err-file").textContent = "";
    }
};


// LISTE DINAMICHE
const cdlInput = document.getElementById("cdlInput");
const cdlList = document.getElementById("cdlList");

const insInput = document.getElementById("insInput");
const insList = document.getElementById("insList");
const titoloInput = document.getElementById("titoloInput");

// Esempio dati
const corsi = ["Ingegneria Informatica", "Ingegneria Meccanica", "Biotecnologie", "Economia", "Lettere"];
const insegnamenti = {
    "Ingegneria Informatica": ["Algoritmi", "Reti", "Basi di Dati"],
    "Ingegneria Meccanica": ["Termodinamica", "Materiali"],
    "Biotecnologie": ["Genetica", "Biochimica"],
    "Economia": ["Microeconomia", "Macroeconomia"],
    "Lettere": ["Letteratura Italiana", "Linguistica"]
};

// FILTRO CDL
cdlInput.oninput = () => {
    const val = cdlInput.value.toLowerCase();
    cdlList.innerHTML = "";
    cdlList.style.display = "flex";

    corsi
        .filter(c => c.toLowerCase().includes(val))
        .forEach(c => {
            const div = document.createElement("div");
            div.textContent = c;
            div.onclick = () => {
                cdlInput.value = c;
                cdlList.style.display = "none";

                insInput.disabled = false;
                insInput.placeholder = "Seleziona insegnamento";
            };
            cdlList.appendChild(div);
        });
};

// FILTRO INSEGNAMENTI
insInput.oninput = () => {
    const val = insInput.value.toLowerCase();
    insList.innerHTML = "";
    insList.style.display = "flex";

    (insegnamenti[cdlInput.value] || [])
        .filter(i => i.toLowerCase().includes(val))
        .forEach(i => {
            const div = document.createElement("div");
            div.textContent = i;
            div.onclick = () => {
                insInput.value = i;
                insList.style.display = "none";
            };
            insList.appendChild(div);
        });
};

// CARICA
function showError(input, errorBox, message) {
    if (input) input.classList.add("input-error");
    if (errorBox) errorBox.textContent = message;
}

function clearError(input, errorBox) {
    if (input) input.classList.remove("input-error");
    if (errorBox) errorBox.textContent = "";
}
document.getElementById("btnCarica").onclick = () => {

    let valid = true;

    const file = document.getElementById("fileInput").files[0];
    const isAppunto = btnAppunto.classList.contains("active");
    const isEsame = btnEsame.classList.contains("active");

    const cdl = cdlInput.value.trim();
    const ins = insInput.value.trim();
    const titolo = titoloInput.value.trim();
    const tag = tagSelect.value;
    const terms = document.getElementById("termsCheck").checked;

    // FILE
    if (!file) {
        showError(document.querySelector(".upload-box"), document.getElementById("err-file"), "Seleziona un file PDF");
        valid = false;
    } else if (file.type !== "application/pdf") {
        showError(document.querySelector(".upload-box"), document.getElementById("err-file"), "Il file deve essere un PDF");
        valid = false;
    } else if (file.size > 2 * 1024 * 1024) { // 2MB
    showError(document.querySelector(".upload-box"), document.getElementById("err-file"), "Il file deve essere più piccolo di 2MB");
    valid = false;
    } else {
        clearError(document.querySelector(".upload-box"), document.getElementById("err-file"));
    }


    // CDL
    if (cdl === "") {
        showError(cdlInput, document.getElementById("err-cdl"), "Seleziona un corso di laurea");
        valid = false;
    } else {
        clearError(cdlInput, document.getElementById("err-cdl"));
    }

    // INSEGNAMENTO (solo Appunto)
    if (isAppunto && ins === "") {
        showError(insInput, document.getElementById("err-ins"), "Seleziona un insegnamento");
        valid = false;
    } else {
        clearError(insInput, document.getElementById("err-ins"));
    }

    // TITOLO
    if (titolo === "") {
        showError(titoloInput, document.getElementById("err-titolo"), "Inserisci un titolo");
        valid = false;
    } else {
        clearError(titoloInput, document.getElementById("err-titolo"));
    }

    // TAG (solo Appunto)
    if (isAppunto && tag === "") {
        showError(tagSelect, document.getElementById("err-tag"), "Seleziona un tag");
        valid = false;
    } else {
        clearError(tagSelect, document.getElementById("err-tag"));
    }

    // TERMINI
    if (!terms) {
        showError(document.getElementById("termsCheck"), document.getElementById("err-terms"), "Devi accettare i termini");
        valid = false;
    } else {
        clearError(document.getElementById("termsCheck"), document.getElementById("err-terms"));
    }


    // Se tutto è valido → invio al controller
    if (valid) {

        const formData = new FormData();
        formData.append("file", file);
        formData.append("tipo", isAppunto ? "appunto" : "esame");
        formData.append("cdl", cdl);
        formData.append("insegnamento", ins);
        formData.append("titolo", titolo);
        formData.append("tag", tag);

        fetch("/controller/upload", {
            method: "POST",
            body: formData
        })
        .then(res => res.json())
        .then(data => {

            if (data.success === true) {
                window.location.href = "successo.html";
            } else {
                window.location.href = "errore.html";
            }

        })
        .catch(() => {
            window.location.href = "errore.html";
        });
    }

};
