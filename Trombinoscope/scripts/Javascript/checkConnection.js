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

        // Permet d'envoyer le mot de passe déjà hasher dans la requête POST.
        let mdp_hash = getHashPasswd(mdp);
        let give_mdp = document.createElement('input');
        give_mdp.setAttribute('name', 'mdp');
        give_mdp.setAttribute('value', mdp_hash);
        give_mdp.setAttribute('type', 'hidden');
        form.appendChild(give_mdp);

        // Permet d'indiquer le type du compte pour procéder à la connexion dans le PHP.
        let set_type = document.createElement('input');
        set_type.setAttribute('name', 'type');

        if (type_form === 'formulaire_etdudiant'){
            set_type.setAttribute('value', 'etudiant');
        }
        else{
            set_type.setAttribute('value', 'administration');
        }
        set_type.setAttribute('type', 'hidden');
        form.appendChild(set_type);

        // Enlève le mot de passe non-chiffré.
        mdp.value = "";
        form.submit();
    }
}