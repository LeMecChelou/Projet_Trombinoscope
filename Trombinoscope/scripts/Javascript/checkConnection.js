function checkConnection() {
    let form = document.getElementById("formulaire");
    let type_form = document.getElementById("div_formulaire").className;

    let id = document.getElementById("input_id").value;
    let mdp = document.getElementById("input_mdp").value;

    let erreur = document.getElementById("erreur_formulaire");

    if (id === ""){
        erreur.innerHTML = "L'identifiant n'est pas renseigné.";
    }
    else if (mdp === ""){
        erreur.innerHTML = "Le mot de passe n'est pas renseigné.";
    }
    else{
        erreur.innerHTML = "";

        // Permet d'indiquer le type du compte pour procéder à la connexion dans le PHP.
        let set_type = document.createElement('input');
        set_type.setAttribute('name', 'type');

        if (type_form === 'formulaire_etudiant'){
            set_type.setAttribute('value', 'etudiant');
        }
        else{
            set_type.setAttribute('value', 'administration');
        }
        set_type.setAttribute('type', 'hidden');
        form.appendChild(set_type);

        form.submit();
    }
}