function checkInscription(){
    let div_form = document.getElementById("div_formulaire").className;

    let id = document.getElementById("input_id").value;
    let prenom = document.getElementById("input_prenom").value;
    let nom = document.getElementById("input_nom").value;
    let mail = document.getElementById("input_mail").value;
    let mdp1 = document.getElementById("input_mdp").value;
    let mdp2 = document.getElementById("input_mdp2").value;


    let erreur = document.getElementById("erreur_formulaire");
    let formulaire = document.getElementById("formulaire");

    // Le compte est un compte étudiant.
    if (div_form === "formulaire_etudiant"){
        let tel = document.getElementById("input_tel").value;
        let adresse = document.getElementById("input_adresse").value;

        let filiere = document.getElementById("liste_filieres").value;
        let groupe = document.getElementById("liste_groupes").value;

        if (id === "" || prenom === "" || nom === "" || mail === "" || tel === "" || adresse === "" ||
            filiere === "" || groupe === ""){
            erreur.innerHTML = "Un ou plusieurs champs ne sont pas remplis.";
        }
        else{
            if (mdp1 === "" || mdp2 === ""){
                erreur.innerHTML = "Un mot de passe est vide.";
            }
            else if (mdp1 !== mdp2){
                erreur.innerHTML = "Les mots de passe sont différents.";
            }
            else{
                erreur.innerHTML = "";

                let chemin = document.createElement('input');
                chemin.setAttribute('name', "filename");
                chemin.setAttribute('value', "../../trombi-etu/files/etudiants.csv");
                chemin.setAttribute('type', 'hidden');
                formulaire.appendChild(chemin);

                let type = document.createElement('input');
                type.setAttribute('name', 'type');
                type.setAttribute('value', 'etudiant');
                type.setAttribute('type', 'hidden');
                formulaire.appendChild(type);

                formulaire.submit();
            }
        }
    }
    else{   // Si le compte créé est un compte administration.
        if (id === "" || prenom === "" || nom === "" || mail === ""){
            erreur.innerHTML = "Les mots de passe sont différents.";
        }
        else{
            if (mdp1 === "" || mdp2 === ""){
                erreur.innerHTML = "Un mot de passe est vide.";
            }
            else if (mdp1 !== mdp2){
                erreur.innerHTML = "Les mots de passe sont différents.";
            }
            else{
                erreur.innerHTML = "";

                let chemin = document.createElement('input');
                chemin.setAttribute('name', "filename");
                chemin.setAttribute('value', "../../trombi-admin/files/administration.csv");
                chemin.setAttribute('type', 'hidden');
                formulaire.appendChild(chemin);

                let type = document.createElement('input');
                type.setAttribute('name', 'type');
                type.setAttribute('value', 'administration');
                type.setAttribute('type', 'hidden');
                formulaire.appendChild(type);

                formulaire.submit();
            }
        }
    }

}
