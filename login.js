//preleva il contenuto dalla casella di testo e verifica che sia > 0
function checkName(event) {
    const input = event.currentTarget;
    
    if (formStatus[input.nome] = input.value.length > 0) {
        input.parentNode.parentNode.classList.remove('notvalid');
    } else {
        input.parentNode.parentNode.classList.add('notvalid');
    }
    checkForm();
}

//verifica che l'username non esista
function checkUsername(event) {
    const input = document.querySelector('.username input');

    if(!/^[a-zA-Z0-9_]{1,15}$/.test(input.value)) {
        input.parentNode.parentNode.querySelector('span').textContent = "Sono ammesse lettere, numeri e underscore. Max. 15";
        input.parentNode.parentNode.classList.add('notvalid');
        formStatus.username = false;
        checkForm();
    } else {
        fetch("check_username.php?q="+encodeURIComponent(input.value)).then(fetchResponse).then(jsonCheckUsername);
    }    
}

function jsonCheckUsername(json) {
    // Controllo il campo exists ritornato dal JSON
    if (formStatus.username = !json.exists) {
        document.querySelector('.username').classList.remove('notvalid');
    } else {
        document.querySelector('.username span').textContent = "Nome utente già utilizzato";
        document.querySelector('.username').classList.add('notvalid');
    }
    checkForm();
}

function checkEmail(event) {
    const emailInput = document.querySelector('.email input');
    if(!/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(String(emailInput.value).toLowerCase())) {
        document.querySelector('.email span').textContent = "Email non valida";
        document.querySelector('.email').classList.add('notvalid');
        formStatus.email = false;
        checkForm();
    } else {
        fetch("check_email.php?q="+encodeURIComponent(String(emailInput.value).toLowerCase())).then(fetchResponse).then(jsonCheckEmail);
    }
}

function jsonCheckEmail(json) {
    // Controllo il campo exists ritornato dal JSON
    if (formStatus.email = !json.exists) {
        document.querySelector('.email').classList.remove('notvalid');
    } else {
        document.querySelector('.email span').textContent = "Email già utilizzata";
        document.querySelector('.email').classList.add('notvalid');
    }
    checkForm();
}

function fetchResponse(response) {
    if (!response.ok) return null;
    return response.json();
}

function checkForm() {
    // Controlla consenso dati personali
    //document.getElementById('submit').disabled = !document.querySelector('.allow input').checked || 
    // Controlla che tutti i campi siano pieni
    Object.keys(formStatus).length !== 5 || 
    // Controlla che i campi non siano false
    Object.values(formStatus).includes(false);
}


function checkPassword(event) {
    const passwordInput = document.querySelector('.password input');
    if (formStatus.password = passwordInput.value.length >= 8) {
        document.querySelector('.password').classList.remove('notvalid');
    } else {
        document.querySelector('.password').classList.add('notvalid');
    }
    checkForm();
}

const formStatus = {'nome': true};
document.querySelector('.nome input').addEventListener('blur', checkName);
document.querySelector('.cognome input').addEventListener('blur', checkName);
document.querySelector('.username input').addEventListener('blur', checkUsername);
document.querySelector('.email input').addEventListener('blur', checkEmail);
document.querySelector('.password input').addEventListener('blur', checkPassword);