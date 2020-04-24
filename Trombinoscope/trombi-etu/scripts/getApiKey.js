function getApiKey(){
    let mail = document.getElementById("mail_api_key");
    let form = document.getElementById("formulaire_mail_api");
    let erreur =document.getElementById("erreur_get");

    if (mail.value !== ""){
        let cle = createKey();

        let key_api = document.createElement('input');
        key_api.setAttribute('name', "key_api");
        key_api.setAttribute('value', cle);
        key_api.setAttribute('type', 'hidden');

        form.appendChild(key_api);
        form.submit();
    }
    else{
        erreur.innerHTML = "Vous n'avez pas renseigné votre email."
    }
}


function createKey(){
    let cle = "";
    let pos;

    for (let k = 0; k < 30; k++){
        pos = Math.floor(Math.random() * 57 + 65);
        cle += String.fromCharCode(pos);
    }

    return cle;
}
