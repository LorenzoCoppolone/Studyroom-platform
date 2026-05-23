/**
 * filters.js – StudyRoom
 *
 * Gestisce:
 *  - Select ricercabili (Choices.js)
 *  - Dipendenza: Insegnamento → Corso di Laurea
 *  - Filtraggio degli insegnamenti in base al corso selezionato
 *
 * Nessun submit automatico.
 * Nessuna manipolazione manuale delle option.
 */

document.addEventListener('DOMContentLoaded', () => {

    /* -------------------------------------------------------------- */
    /* 1. Inizializza Choices.js                                       */
    /* -------------------------------------------------------------- */

    const corsoSelect = new Choices('#select-corso', {
        searchPlaceholderValue: 'Cerca corso...',
        itemSelectText: '',
        allowHTML: false
    });

    const insegnamentoSelect = new Choices('#select-insegnamento', {
        searchPlaceholderValue: 'Cerca insegnamento...',
        itemSelectText: '',
        allowHTML: false
    });

    /* -------------------------------------------------------------- */
    /* 2. Filtra insegnamenti in base al corso selezionato             */
    /* -------------------------------------------------------------- */

    const selectCorso = document.getElementById('select-corso');
    const selectInsegnamento = document.getElementById('select-insegnamento');

    selectCorso.addEventListener('change', function () {
        const corsoId = this.value;

        // Se nessun corso selezionato → disabilita insegnamento
        if (!corsoId) {
            selectInsegnamento.disabled = true;
            insegnamentoSelect.clearStore();
            return;
        }

        // Abilita insegnamento
        selectInsegnamento.disabled = false;

        // Recupera tutte le option originali
        const tutte = [...document.querySelectorAll('#select-insegnamento option')];

        // Filtra solo quelle del corso selezionato
        const filtrate = tutte.filter(opt =>
            opt.dataset.corsoId === corsoId || opt.value === ''
        );

        // Ricostruisci la select con Choices.js
        insegnamentoSelect.clearStore();
        insegnamentoSelect.setChoices(
            filtrate.map(opt => ({
                value: opt.value,
                label: opt.textContent,
                selected: opt.selected
            })),
            'value',
            'label',
            true
        );
    });

});