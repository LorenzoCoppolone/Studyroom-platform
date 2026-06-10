// =============================================
// StudyRoom — upload.js
// Pagina di caricamento materiale:
//  - selettore tipo (Appunto / Esame)
//  - anteprima del nome del file scelto
//  - campi Corso di Laurea / Insegnamento ad
//    autocompletamento: l'utente scrive e vede
//    solo le voci che corrispondono.
//  - l'Insegnamento resta bloccato finché non si
//    sceglie un corso, poi mostra solo gli
//    insegnamenti di quel corso.
// =============================================

document.addEventListener("DOMContentLoaded", () => {

    // ---------------------------------------------
    // SELETTORE TIPO (Appunto / Esame)
    // ---------------------------------------------
    const btnAppunto = document.getElementById("btnAppunto");
    const btnEsame   = document.getElementById("btnEsame");
    const tipoInput  = document.getElementById("tipoInput");
    const tagSelect  = document.getElementById("tagSelect");

    function selezionaTipo(tipo) {
        tipoInput.value = tipo;
        btnAppunto.classList.toggle("active", tipo === "appunto");
        btnEsame.classList.toggle("active", tipo === "esame");

        const isEsame = tipo === "esame";
        tagSelect.disabled = isEsame;
        if (isEsame) tagSelect.value = "";
    }

    if (btnAppunto && btnEsame) {
        btnAppunto.addEventListener("click", () => selezionaTipo("appunto"));
        btnEsame.addEventListener("click", () => selezionaTipo("esame"));
    }

    // ---------------------------------------------
    // ANTEPRIMA NOME FILE
    // ---------------------------------------------
    const fileInput = document.getElementById("fileInput");
    const fileName  = document.getElementById("fileName");

    if (fileInput && fileName) {
        fileInput.addEventListener("change", () => {
            fileName.textContent = fileInput.files.length ? fileInput.files[0].name : "";
        });
    }

    // ---------------------------------------------
    // COMBOBOX AD AUTOCOMPLETAMENTO
    // ---------------------------------------------
    /**
     * @param {object} cfg
     *   comboId   id del contenitore .combo
     *   inputId   id dell'input di testo visibile
     *   valueId   id dell'input hidden col valore reale
     *   listId    id della <ul> dei suggerimenti
     *   filtroExtra (item) => bool  filtro aggiuntivo opzionale
     *   onSelect  (item) => void    callback alla scelta
     *   onClear   () => void        callback quando si svuota la scelta
     */
    function creaCombo(cfg) {
        const root   = document.getElementById(cfg.comboId);
        const input  = document.getElementById(cfg.inputId);
        const hidden = document.getElementById(cfg.valueId);
        const list   = document.getElementById(cfg.listId);
        const items  = Array.from(list.querySelectorAll(".combo-item"));
        const empty  = list.querySelector(".combo-empty");
        const filtroExtra = cfg.filtroExtra || (() => true);
        let activeIndex = -1;

        const visibili = () => items.filter(it => !it.hidden);

        function filtra() {
            const q = input.value.trim().toLowerCase();
            let conta = 0;
            items.forEach(it => {
                const ok = it.dataset.label.toLowerCase().includes(q) && filtroExtra(it);
                it.hidden = !ok;
                it.classList.remove("active");
                if (ok) conta++;
            });
            if (empty) empty.hidden = conta > 0;
            activeIndex = -1;
            list.classList.add("open");
        }

        function apri()  { if (!input.disabled) filtra(); }
        function chiudi() {
            list.classList.remove("open");
            activeIndex = -1;
            items.forEach(it => it.classList.remove("active"));
        }

        function evidenzia() {
            const vis = visibili();
            items.forEach(it => it.classList.remove("active"));
            const it = vis[activeIndex];
            if (it) {
                it.classList.add("active");
                it.scrollIntoView({ block: "nearest" });
            }
        }

        function scegli(it) {
            input.value  = it.dataset.label;
            hidden.value = it.dataset.value;
            input.classList.remove("input-error");
            chiudi();
            if (cfg.onSelect) cfg.onSelect(it);
        }

        // Mentre si scrive, la scelta precedente non è più valida
        input.addEventListener("input", () => {
            hidden.value = "";
            if (cfg.onClear) cfg.onClear();
            filtra();
        });

        input.addEventListener("focus", apri);

        input.addEventListener("keydown", (e) => {
            const vis = visibili();
            if (e.key === "ArrowDown") {
                e.preventDefault();
                if (!list.classList.contains("open")) { apri(); return; }
                activeIndex = Math.min(activeIndex + 1, vis.length - 1);
                evidenzia();
            } else if (e.key === "ArrowUp") {
                e.preventDefault();
                activeIndex = Math.max(activeIndex - 1, 0);
                evidenzia();
            } else if (e.key === "Enter") {
                if (list.classList.contains("open") && vis[activeIndex]) {
                    e.preventDefault();
                    scegli(vis[activeIndex]);
                }
            } else if (e.key === "Escape") {
                chiudi();
            }
        });

        // mousedown (non click) così scatta prima del blur dell'input
        items.forEach(it => {
            it.addEventListener("mousedown", (e) => {
                e.preventDefault();
                scegli(it);
            });
        });

        // Click fuori dal componente: chiude e ripulisce testo non confermato
        document.addEventListener("click", (e) => {
            if (!root.contains(e.target)) {
                chiudi();
                if (!hidden.value) input.value = "";
            }
        });

        return {
            input,
            hidden,
            azzera() {
                input.value = "";
                hidden.value = "";
                chiudi();
            },
            blocca() {
                this.azzera();
                input.disabled = true;
                if (input.dataset.placeholderLocked) input.placeholder = input.dataset.placeholderLocked;
            },
            sblocca() {
                input.disabled = false;
                if (input.dataset.placeholderReady) input.placeholder = input.dataset.placeholderReady;
            }
        };
    }

    const comboCdl = document.getElementById("cdlCombo") && document.getElementById("insCombo");

    if (comboCdl) {
        let cdlSelezionato = document.getElementById("cdlValue").value;

        const insegnamento = creaCombo({
            comboId: "insCombo",
            inputId: "insInput",
            valueId: "insValue",
            listId:  "insList",
            filtroExtra: (it) => it.dataset.cdl === cdlSelezionato
        });

        const corso = creaCombo({
            comboId: "cdlCombo",
            inputId: "cdlInput",
            valueId: "cdlValue",
            listId:  "cdlList",
            onSelect: (it) => {
                cdlSelezionato = it.dataset.value;
                insegnamento.azzera();
                insegnamento.sblocca();
            },
            onClear: () => {
                cdlSelezionato = "";
                insegnamento.blocca();
            }
        });

        // Stato iniziale: insegnamento sbloccato solo se un corso è già scelto
        if (cdlSelezionato) {
            insegnamento.sblocca();
        } else {
            insegnamento.blocca();
        }

        // ---------------------------------------------
        // VALIDAZIONE: serve una scelta valida, non testo libero
        // ---------------------------------------------
        const form = corso.input.closest("form");
        if (form) {
            form.addEventListener("submit", (e) => {
                let ok = true;
                // I campi sono obbligatori solo dove l'input è marcato required
                // (upload). Sulla ricerca corso/insegnamento sono filtri opzionali
                // e il submit non deve essere bloccato.
                if (corso.input.required && !corso.hidden.value) {
                    corso.input.classList.add("input-error");
                    corso.input.focus();
                    ok = false;
                }
                if (ok && insegnamento.input.required && !insegnamento.hidden.value) {
                    insegnamento.input.classList.add("input-error");
                    insegnamento.input.focus();
                    ok = false;
                }
                if (!ok) e.preventDefault();
            });
        }
    }
});
