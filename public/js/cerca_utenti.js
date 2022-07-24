function Search(event) {
    event.preventDefault()
    //prendo il nome dell'utente cercato
    const username = document.querySelector('#search_people');

    const formdata = new FormData();

    if (username.value == '') {

        alert("Inserisci un utente da cercare");

        event.preventDefault();
    }
    formdata.append("utente_cercato", username.value);
    formdata.append('_token', CSFR_TOKEN);

    fetch(BASE_URL + "search_utente", { method: "post", body: formdata }).then(onResponse).then(stampa_utenti);

}

function onResponse(response) {
    return response.json();
}

//stampa l'utente che si è cercato secondo determinate caratteristiche
function stampa_utenti(json) {
    console.log(json);
    if (json == 0) {
        alert('Username non trovato');
    } else {
        const bookcase = document.querySelector('.utenti');
        bookcase.classList.remove('hidden');
        bookcase.innerHTML = '';

        for (utente of json) {
            const shelf = document.createElement('div');
            shelf.classList.add('div_user');

            const img_utente = document.createElement('img');
            img_utente.src = utente.propic;

            const info_user = document.createElement('div');
            info_user.classList.add('info_us');

            const info_Utente = document.createElement('p');
            info_Utente.textContent = 'Name: ' + utente.name;

            const info_Utente_surname = document.createElement('p');
            info_Utente_surname.textContent = ' Surname:' + utente.surname;

            const info_Utente_username = document.createElement('p');
            info_Utente_username.textContent = 'Username: @' + utente.username;

            const button_segui = document.createElement('button');
            button_segui.textContent = 'Segui';
            button_segui.addEventListener('click', segui);
            button_segui.name = utente.username;
            button_segui.dataset.id = utente.id;
            console.log('Username: ' + button_segui.name);

            const button_non_segui = document.createElement('button');
            button_non_segui.textContent = 'Non seguire';
            button_non_segui.name = utente.username;
            button_non_segui.dataset.id = utente.id;

            bookcase.appendChild(shelf);
            button_non_segui.addEventListener('click', non_segui);
            shelf.appendChild(img_utente);
            shelf.appendChild(info_user);
            shelf.appendChild(info_Utente_username);
            info_user.appendChild(info_Utente);
            info_user.appendChild(info_Utente_surname);

            shelf.appendChild(button_segui);
            shelf.appendChild(button_non_segui);
            button_segui.classList.add('segui');
            button_non_segui.classList.add('nonsegui');

            if (utente.following == '1') {
                button_segui.classList.add('hidden');
            }
            else {
                button_non_segui.classList.add('hidden');
            }
        }
    }
}

//Permette di seguire l'utente inserendolo nel database così da permettere la visualizzazioni dei post che ha pubblicato nella home
function segui(event) {
    event.preventDefault();
    const button = event.currentTarget.parentNode;
    const segui = button.querySelector('button.segui')
    const non_segui = button.querySelector('button.nonsegui');
    segui.classList.add('hidden');
    non_segui.classList.remove('hidden');
    console.log('segui');
    const follower = event.currentTarget;

    const formData_follower = new FormData();
    formData_follower.append('utenteseguito', follower.name);
    formData_follower.append('id', follower.dataset.id);
    formData_follower.append('_token', CSFR_TOKEN);

    fetch(BASE_URL + "follow", { method: "post", body: formData_follower }).then(onResponse_text).then(segui_text);
}

function onResponse_text(response) {
    return response.text();
}

function segui_text(text) {
    console.log(text);
}


//permette di non seguire più un utente, così da non vedere più i suoi post
function non_segui(event) {
    event.preventDefault();
    const button = event.currentTarget.parentNode;
    const segui = button.querySelector('button.segui')
    const non_segui = button.querySelector('button.nonsegui');
    segui.classList.remove('hidden');
    non_segui.classList.add('hidden');

    console.log('non segui');
    const utente_nonseguito = event.currentTarget;

    const formdata_non_follower = new FormData();
    console.log(utente_nonseguito.dataset.id);
    formdata_non_follower.append('utentenonseguito', utente_nonseguito.name);
    formdata_non_follower.append('id', utente_nonseguito.dataset.id);
    formdata_non_follower.append('_token', CSFR_TOKEN);

    fetch(BASE_URL + "unfollow", { method: "post", body: formdata_non_follower }).then(onResponse_text).then(Non_seguire);
}


function Non_seguire(text) {
    console.log(text);
}

//Permette di cercare tutti gli utenti iscritti al sito web e quindi presenti nel database
function search_tutti(event) {
    event.preventDefault();
    const formdata = new FormData();
    formdata.append("tutti_utenti", formdata.value);
    formdata.append('_token', CSFR_TOKEN);

    fetch(BASE_URL + "search_utenti", { method: "post", body: formdata }).then(onResponse).then(stampa_tutti_utenti);
}

//Permette di visualizzare tutti gli utenti iscritti al sito web e quindi presenti nel database
function stampa_tutti_utenti(json) {
    console.log(json);
    if (json == 0) {
        alert('Username non trovato');
    } else {
        console.log(json);
        const bookcase = document.querySelector('.utenti');
        bookcase.classList.remove('hidden');
        bookcase.innerHTML = '';

        for (utente of json) {
            console.log(utente);
            const shelf = document.createElement('div');
            shelf.classList.add('div_user');

            const img_utente = document.createElement('img');
            img_utente.src = utente.propic;

            const info_user = document.createElement('div');
            info_user.classList.add('info_us');

            const info_Utente = document.createElement('p');
            info_Utente.textContent = 'Name: ' + utente.name;

            const info_Utente_surname = document.createElement('p');
            info_Utente_surname.textContent = ' Surname:' + utente.surname;

            const info_Utente_username = document.createElement('p');
            info_Utente_username.textContent = 'Username: @' + utente.username;

            const button_segui = document.createElement('button');
            button_segui.textContent = 'Segui';
            button_segui.addEventListener('click', segui);
            button_segui.name = utente.username;
            button_segui.dataset.id = utente.id;
            button_segui.name = utente.username;
            console.log('Username: ' + button_segui.name);

            const button_non_segui = document.createElement('button');
            button_non_segui.textContent = 'Non seguire';
            button_non_segui.addEventListener('click', non_segui);
            button_non_segui.name = utente.username;
            button_non_segui.dataset.id = utente.id;

            bookcase.appendChild(shelf);

            shelf.appendChild(img_utente);
            shelf.appendChild(info_user);
            shelf.appendChild(info_Utente_username);
            info_user.appendChild(info_Utente);
            info_user.appendChild(info_Utente_surname);

            shelf.appendChild(button_segui);
            shelf.appendChild(button_non_segui);
            button_segui.classList.add('segui');
            button_non_segui.classList.add('nonsegui');

            if (utente.following == '1') {

                button_segui.classList.add('hidden');
            }
            else {
                button_non_segui.classList.add('hidden');
            }
        }
    }
}

//apre la sidebar laterale nella versione mobile
function open_sidebar() {
    console.log('open sidebar');
    const sidebar = document.querySelector('#sidebar');
    sidebar.classList.remove('hidden');
}

//chiude la sidebar laterale nella versione mobile
function close_sidebar() {
    const  sidebar = document.querySelector('#sidebar');
    sidebar.classList.add('hidden');
}

const Cerca = document.querySelector('.CercaUtente');
Cerca.addEventListener('click', Search);

const sidebar_button = document.querySelector('div#sidebar_button');
sidebar_button.addEventListener('click', open_sidebar);
const sidebar = document.querySelector('#sidebar');
sidebar.addEventListener('click', close_sidebar);

const tutti = document.querySelector('.TuttiUtenti');
tutti.addEventListener('click', search_tutti);



