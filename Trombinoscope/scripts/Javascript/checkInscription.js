function checkInscription(){
    let div_form = document.getElementById("div_formulaire").className

    let id = document.getElementById("input_id").value;
    let prenom = document.getElementById("input_prenom").value;
    let nom = document.getElementById("input_nom").value;
    let mail = document.getElementById("input_mail").value;
    let tel = document.getElementById("input_tel").value;
    let adresse = document.getElementById("input_adresse").value;
    let mdp1 = document.getElementById("input_mdp").value;
    let mdp2 = document.getElementById("input_mdp2").value;

    /*
        Permet de réutiliser la fonction pour la partie administration car l'administration n'a pas besoin d'entrer de
        filières et de groupes.
    */
    if (div_form === "formulaire_etudiant"){
        var filiere = document.getElementById("liste_filieres").value;
        var groupe = document.getElementById("liste_groupes").value;
    }

    let erreur = document.getElementById("erreur_inscription");
    let formulaire = document.getElementById("formulaire");

    if (id === "" || prenom === "" || nom === "" || mail === "" || tel === "" || adresse === "") {
        if (div_form === "formulaire_etudiant"){
            if (filiere === "" || groupe === ""){
                erreur.innerHTML = "Un ou plusieurs champs ne sont pas remplis.";
            }
            else{
                erreur.innerHTML = "Un ou plusieurs champs ne sont pas remplis.";
            }
        }
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

            let input = document.createElement('input');
            input.setAttribute('name', "filename");
            if (div_form === "formulaire_etudiant"){
                input.setAttribute('value', "../../trombi-etu/files/etudiants.csv");
            }
            else{
                input.setAttribute('value', "../../trombi-admin/files/administration.csv");
            }
            input.setAttribute('type', 'hidden');
            formulaire.appendChild(input);

            formulaire.submit();
        }
    }
}
