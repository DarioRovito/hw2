window.onload = fetch_post();

//funzione che serve a visualizzare tutti i post delle persone seguite
function fetch_post() {
    fetch(BASE_URL + "postfollow").then(onResponse).then(json_post);
}

function onResponse(response) {
    console.log('Operazione andata a buon fine');
    return response.json();
}

function getTime(timestamp) {
    old = new Date(timestamp);
    diff = Date.now() - old;
    old = old.toLocaleDateString();
    diff_s = diff / 1000;

    if (diff_s / 60 < 1) {
        return parseInt(diff_s % 60) + "s";
    } else if (diff_s / 60 < 60) {
        return parseInt(diff_s / 60) + "m";
    } else if (diff_s / 3600 < 24) {
        return parseInt(diff_s / 3600) + "h";
    } else if (diff_s / 86400 < 30) {
        return parseInt(diff_s / 86400) + "gg";
    } else {
        return old;
    }
}

//Stampa i post e le informazioni dell'utente che li ha pubblicati nella home secondo delle caratterisstiche che vengono definite
function json_post(json) {
    console.log(json);
    const box_post = document.querySelector('#box_post');
    const contents = json;

    console.log(contents);
    for (i in contents) {

        const post = contents[i];
        const type = post.content.type;
        console.log(type);

        const shelf = document.createElement('div');
        shelf.classList.add('post');
        console.log(post.id);
        shelf.dataset.id = post.id;

        const info = document.createElement('div');
        info.classList.add('user_info');

        shelf_prefer = document.createElement('div');
        shelf_prefer.addEventListener('click', prefer_user);
        shelf_prefer.classList.add('img_prefer');
        shelf_prefer.dataset.username = post.username;
        console.log(shelf_prefer);
        const img_profilepic = document.createElement('img');
        img_profilepic.src = post.propic
        img_profilepic.classList.add('img_profile');

        shelf.appendChild(img_profilepic);
        const shelf_3 = document.createElement('div');
        shelf_3.classList.add('contents')

        //stampo informazioni dell'utente che ha pubblicato il post
        box_post.appendChild(shelf);
        shelf_name = document.createElement('div');
        const username = document.createElement('span');
        username.textContent = '@' + post.username;
        username.classList.add('username');
        const name = document.createElement('h1');
        name.textContent = post.name + " " + post.surname;
        name.classList.add('name');

        shelf_name.appendChild(name);
        shelf_name.appendChild(username);
        shelf_4 = document.createElement('div');
        shelf_4.classList.add('titolo');
        const titolo_post = document.createElement('h1');
        titolo_post.classList.add('titolo_post');
        titolo_post.textContent = post.content.text;
        shelf_4.appendChild(titolo_post);
        const shelf_2 = document.createElement('div');
        shelf_2.classList.add('likes_comments');

        const div_like = document.createElement('div');
        div_like.classList.add('div_like');
        const like = document.createElement('div');
        like.classList.add('img_like')
        const nlike = document.createElement('span');
        nlike.textContent = post.nlikes
        nlike.classList.add('num_like')
        time = document.createElement('span')
        time.textContent = getTime(post.time);
        console.log(time.textContent);
        time.classList.add('time');

        info.appendChild(img_profilepic);
        info.appendChild(shelf_name);
        info.appendChild(shelf_prefer);
        info.appendChild(time);
        like.appendChild(nlike);

        const div_comment = document.createElement('div');
        div_comment.classList.add('div_comment');
        const comments = document.createElement('div');
        comments.classList.add('comm');
        const numcomments = document.createElement('span');
        numcomments.classList.add('numcomments');
        numcomments.textContent = post.ncomments
        comments.dataset.id = post.id;
        comments.addEventListener('click', comment_post);
        comments.addEventListener('click', Newcomments);

        nlike.classList.add('num_like')
        nlike.addEventListener('click', All_likes);
        nlike.dataset.id = post.id;
        like.dataset.id = post.id;

        shelf.appendChild(info);
        shelf.appendChild(shelf_4)

        //if necessari per distinguere la visualizzazione dei diversi post
        if (type == 'giphy') {
            const img = document.createElement('img');
            console.log(post.content.url);
            img.src = post.content.url
            img.classList.add('img_contents');
            shelf_3.appendChild(img);
        }
        if (type == 'spotify') {
            console.log(post.content.id);
            contenuto = document.createElement('iframe');
            contenuto.src = "https://open.spotify.com/embed/track/" + post.content.id;
            contenuto.frameBorder = 0;
            contenuto.setAttribute('allowtransparency', 'true');
            contenuto.allow = "encrypted-media";
            contenuto.classList = "track";
            shelf.appendChild(contenuto)
        }
        if (type == 'sports') {
            const img = document.createElement('img');
            img.src = post.content.url
            img.classList.add('img_contents');
            shelf_3.appendChild(img);
        }
        //'appendo' tutto nella home
        div_comment.appendChild(comments);
        div_comment.appendChild(numcomments);
        shelf_2.appendChild(div_comment);
        div_like.appendChild(like);
        div_like.appendChild(nlike);
        shelf_2.appendChild(div_like);
        shelf.appendChild(shelf_2);
        shelf.appendChild(shelf_3);
        shelf.appendChild(shelf_2);

        if (post.ncomments == 0) {
            comments.classList.add('img_ncomments');
        }
        else {
            comments.classList.add('img_mcomments');
        }
        //if necessario per distinguere se un post ha già dei like al caricamento della home oppure no
        if (post.liked == 0) {
            // Aggiungo l'event listener per mettere like
            like.addEventListener('click', like_post);
        } else {
            console.log('metti liked')
            // Aggiungo la classe liked e l'event listener per togliere il like
            like.classList.remove('img_like');
            like.classList.add('img_liked');
            like.addEventListener('click', unlike_post);
        }

        if (post.prefered == 0) {
            // Aggiungo l'event listener per mettere like
            shelf_prefer.addEventListener('click', prefer_user);
        } else {
            console.log('metti liked')
            // Aggiungo la classe liked e l'event listener per togliere il like
            shelf_prefer.classList.remove('img_prefer');
            shelf_prefer.classList.add('img_prefered');
            shelf_prefer.addEventListener('click', un_prefer_user);
        }

    }

}




//funzione che crea una barra così da permettere di inserire un nuovo commento nei post
function comment_post(event) {
    console.log(event.currentTarget);
    console.log(event.currentTarget.parentNode.parentNode.parentNode)
    const box = event.currentTarget.parentNode.parentNode.parentNode;
    const div_comment = document.createElement('div');
    box.appendChild(div_comment);

    div_comment.classList.add('comment');
    div_message = document.createElement('div');
    div_message.classList.add('message');

    const shelf_form = document.createElement('form');
    shelf_form.classList.add('form');
    text_comments = document.createElement('input');
    text_comments.setAttribute('type', 'text');
    text_comments.classList.add('text');
    text_comments.name = 'comment';

    const commenta_post1 = document.createElement('input');
    commenta_post1.setAttribute('type', 'submit');
    commenta_post1.classList.add('subit');
    commenta_post1.addEventListener('click', sendNewComment)

    const c_postid = document.createElement('input');
    c_postid.setAttribute('type', 'hidden');
    c_postid.name = 'postid';

    shelf_form.appendChild(c_postid);
    div_comment.appendChild(shelf_form);
    div_comment.appendChild(div_message);
    shelf_form.appendChild(text_comments);
    shelf_form.appendChild(commenta_post1);
    const b = event.currentTarget;
    console.log(b);
    text_comments.dataset.id = b.dataset.id;
    commenta_post1.dataset.id = b.dataset.id;
    c_postid.value = b.dataset.id;

    b.removeEventListener('click', comment_post);
    b.addEventListener('click', uncomment_post);

}


function Newcomments(event) {
    console.log('invia commento');
    const post = event.currentTarget.parentNode.parentNode.parentNode;
    console.log(post.dataset.id);

    fetch(BASE_URL + "post" + "/" + post.dataset.id + "/comments").then(onResponse).then(function (json) { return updateComments(json, post) });

    img_button = post.querySelector('div.comm')
    console.log(img_button);
    img_button.removeEventListener('click', Newcomments);
}


function sendNewComment(event) {
    event.preventDefault();
    const cont = event.currentTarget.parentNode.parentNode.parentNode;
    console.log(cont.dataset.id);

    const formData = new FormData(event.currentTarget.parentNode);
    formData.append('id', cont.dataset.id);
    formData.append('_token', CSFR_TOKEN);

    fetch(BASE_URL + "comment", { method: 'post', body: formData }).then(onResponse).then(function (json) { return updateComments(json, cont); });
}

//funzione necessaria per aggiornare i commenti dopo che ve ne vengono pubblicati dei nuovi
function updateComments(json, section) {
    console.log(section);
console.log(json);
    comme = section.querySelector('span.numcomments');
    console.log(comme);
    comme.textContent = json.length;
    box_me = section.querySelector('div.message');
    box_me.innerHTML = '';

    console.log(box_me);
    if (json.length > 0) {
        div_comme = section.querySelector('div.comm');
        div_comme.classList.add('img_mcomments');
        div_comme.classList.remove('img_ncomments');
    }
    for (i = Object.keys(json).length - 1; i >= 0; i--) {
        console.log('entra qui');
        // Creo gli oggetti che contengono i commenti
        const comment = document.createElement('div');
        comment.classList.add('commenti');

        const user = document.createElement('div');
        user.classList.add('userinfo');

        comment.appendChild(user);
        const pic = document.createElement('div');
        pic.classList.add('img_profile');

        user.appendChild(pic);
        const img_profilepic = document.createElement('img');
        img_profilepic.src = json[i].propic;
        pic.appendChild(img_profilepic);
        const username = document.createElement('span');

        username.href = json[i].username;
        username.classList.add('username');
        username.textContent = "@" + json[i].username;
        user.appendChild(username);

        const time = document.createElement('span');
        time.textContent = getTime(json[i].time);
        time.classList.add('time');
        user.appendChild(time);

        const text = document.createElement('div');
        text.classList.add('text');
        text.textContent = json[i].text;

        comment.append(user)
        comment.appendChild(text);
        box_me.appendChild(comment);
    }
}


//funzione chhe chiude la barra di visualizzazione dei commenti
function uncomment_post(event) {
    form = event.currentTarget.parentNode.parentNode.parentNode;

    commenti = form.querySelector('div.comment');
    commenti.remove();
    const b = event.currentTarget;
    console.log(b);

    b.removeEventListener('click', uncomment_post);
    b.addEventListener('click', comment_post);
    b.addEventListener('click', Newcomments);
}



function prefer_user(event) {
    event.preventDefault();
    prefer = event.currentTarget;
    console.log(prefer.dataset.username);

    prefer.classList.remove('img_prefer');
    prefer.classList.add('img_prefered');

    prefer.removeEventListener('click', prefer_user);
    prefer.addEventListener('click', un_prefer_user);

    const formData = new FormData;
    formData.append('username', prefer.dataset.username);
    formData.append('_token', CSFR_TOKEN);

    fetch(BASE_URL + "prefers", { method: 'post', body: formData })

}


function un_prefer_user(event) {
    event.preventDefault();
    prefer = event.currentTarget;
    console.log(prefer.dataset.username);

    const formData = new FormData;
    formData.append('username', prefer.dataset.username);
    formData.append('_token', CSFR_TOKEN);

    prefer.classList.remove('img_prefered');
    prefer.classList.add('img_prefer');

    prefer.removeEventListener('click', un_prefer_user);
    prefer.addEventListener('click', prefer_user);

    fetch(BASE_URL + "deleteprefers", { method: 'post', body: formData });

}

//funzione che incrementa il like ai post
function like_post(event) {
    event.preventDefault()
    like = event.currentTarget;
    console.log(like.dataset.id);

    const formData = new FormData;
    formData.append('postid', like.dataset.id);
    formData.append('_token', CSFR_TOKEN);

    // Cambio la classe del bottone  
    like.classList.remove('img_like');
    like.classList.add('img_liked');

    // Aggiorno i listener
    like.removeEventListener('click', like_post);
    like.addEventListener('click', unlike_post);
    fetch(BASE_URL + "post_like", { method: 'post', body: formData }).then(onResponse).then(function (json) { return updatelike(json, like); });
}


function updatelike(json, like) {
    console.log(json);

    if (json == '0') {
        console.log('entra qui')
        liked = like.parentNode.querySelector('span.num_like ');
        console.log(liked);
        liked.textContent = json;
    }
    else {
        console.log(json.nlikes)
        console.log(like.parentNode);
        liked = like.parentNode.querySelector('span.num_like ');
        console.log(liked);
        liked.textContent = json.nlikes;
    }
}

//funzione che permettere di togliere il like precedentemente inserito ad un post
function unlike_post(event) {
    like = event.currentTarget;
    console.log(like.dataset.id);

    const formData = new FormData;
    formData.append('nonlike_post', like.dataset.id);
    formData.append('_token', CSFR_TOKEN);

    like.classList.remove('img_liked');
    like.classList.add('img_like');

    like.removeEventListener('click', unlike_post);
    like.addEventListener('click', like_post);

    fetch(BASE_URL + "post_dont_like", { method: 'post', body: formData }).then(onResponse).then(function (json) { return updatelike(json, like); });
}

//funzione che permette di visualizzare tutti i like che hanno inserito gli utenti ad un post
function All_likes(event) {
    event.preventDefault();
    const Like_Post = event.currentTarget;
    console.log(Like_Post.dataset.id);

    const formdata = new FormData();
    formdata.append('_token', CSFR_TOKEN);
    formdata.append('like_post', Like_Post.dataset.id);

    fetch(BASE_URL + "viewlike", { method: "post", body: formdata }).then(onResponse).then(view_likes);
}


//funzione che incrementa la modale in cui vengono visualizzati i like di un post
function view_likes(json) {
    console.log(json);

    if (json == 0) {
        alert('Non ci sono likes in questo post');
    } else {
        const box_utente = document.querySelector('#modale_like');
        box_utente.classList.remove('hidden');

        const shelf = document.createElement('div');
        shelf.classList.add('view_like');
        box_utente.appendChild(shelf);
        box_utente.innerHTML = '';

        const btnEsc = document.createElement('button');
        const div_button = document.createElement('div');
        div_button.classList.add('div_button');

        box_utente.appendChild(shelf);
        shelf.appendChild(div_button);
        div_button.appendChild(btnEsc);

        for (utente of json) {
            const boxProfili = document.createElement('div');
            boxProfili.classList.add('user_info');

            const imgProfili = document.createElement('img');
            imgProfili.classList.add('img_profile');
            imgProfili.src = utente.propic;

            const utente_username = document.createElement('span');
            utente_username.classList.add('info');
            utente_username.textContent = '@' + utente.username;

            btnEsc.classList.add('Esc_modal');
            btnEsc.addEventListener('click', EsciModale);

            shelf.appendChild(boxProfili);
            boxProfili.appendChild(imgProfili);
            boxProfili.appendChild(utente_username);

        }
    }
}

function EsciModale(event) {
    const Esc = document.querySelector('#modale_like');
    Esc.classList.add('hidden');
}

//funzione che apre la sidebar laterale nella versione mobile
function open_sidebar() {
    console.log('open sidebar');
    sidebar = document.querySelector('#sidebar');
    sidebar.classList.remove('hidden');
}

//funzione che chiude la sidebar laterale nella versione mobile
function close_sidebar() {
    sidebar = document.querySelector('#sidebar');
    side = sidebar.querySelector('#sidebar_links');
    sidebar.classList.add('hidden');
}

//inserisco gli event listener necessari per il funzionamento delle diverse funzioni
sidebar_button = document.querySelector('div#sidebar_button');
sidebar_button.addEventListener('click', open_sidebar);
sidebar = document.querySelector('#sidebar');
sidebar.addEventListener('click', close_sidebar);

