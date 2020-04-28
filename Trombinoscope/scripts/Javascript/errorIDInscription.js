function checkIdError(){
    let url = window.location.toString();
    let get = new URLSearchParams(url);

    let param;
    for (let p of get){
        param = p[0].split("?");

        if (param[0] === "error" || param[1] === "error"){
            if (p[1] === "1.1"){
                inscription_priority();
                let erreur = document.getElementById("erreur_formulaire");
                erreur.innerHTML = "L'identifiant est déjà utilisé.";
            }
        }
    }
}