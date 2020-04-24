function getBackApiKey(){
    let mail = document.getElementById("mail_back_key");
    let form = document.getElementById("form_back_mail_api");
    let erreur =document.getElementById("erreur_back");

    if (mail.value !== ""){
        form.submit();
    }
    else{
        erreur.innerHTML = "Vous n'avez pas renseigner d'email.";
    }
}