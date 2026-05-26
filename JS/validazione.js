
// Mostra/nascondi password
function toggleVis(inputId, iconId) {
    const input = document.getElementById(inputId);
    const icon  = document.getElementById(iconId);
    input.type  = input.type === 'password' ? 'text' : 'password';
    icon.classList.toggle('bx-show');
    icon.classList.toggle('bx-hide');
}

document.getElementById('togglePassword').addEventListener('click', () => toggleVis('password', 'togglePassword'));
document.getElementById('toggleConferma').addEventListener('click', () => toggleVis('confermaPassword', 'toggleConferma'));

// Conferma password
document.getElementById('confermaPassword').addEventListener('input', function () {
    const v = this.value;
    const msgEl = document.getElementById('err-conferma');
    const input = this;

    if (!v) {
        input.classList.remove('valido', 'errore');
        msgEl.textContent = '';
        return;
    }

    if (v !== document.getElementById('password').value) {
        input.classList.remove('valido');
        input.classList.add('errore');
        msgEl.textContent = 'Le password non coincidono.';
        msgEl.classList.remove('ok');
    } else {
        input.classList.remove('errore');
        input.classList.add('valido');
        msgEl.textContent = '✓ Le password coincidono';
        msgEl.classList.add('ok');
    }
});
// Rivalida conferma quando si modifica la password principale
document.getElementById('password').addEventListener('input', function () {
    const conf = document.getElementById('confermaPassword');
    if (conf.value) conf.dispatchEvent(new Event('input'));
});