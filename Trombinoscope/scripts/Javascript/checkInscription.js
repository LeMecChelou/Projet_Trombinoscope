function checkInscription(){
    let id = document.getElementById("input_id").value;
    let prenom = document.getElementById("input_prenom").value;
    let nom = document.getElementById("input_nom").value;
    let mail = document.getElementById("input_mail").value;
    let tel = document.getElementById("input_tel").value;
    let adresse = document.getElementById("input_adresse").value;
    let mdp1 = document.getElementById("input_mdp_ins").value;
    let mdp2 = document.getElementById("input_mdp2_ins").value;
    let filiere = document.getElementById("liste_filieres").value;
    let groupe = document.getElementById("liste_groupes").value;
    let image = document.getElementById("input_img_profil");

    console.log(image);
    let erreur = document.getElementById("erreur_inscription");
    let formulaire = document.getElementById("formulaire_ins");

    if (id === "" || prenom === "" || nom === "" || mail === "" || tel === "" || adresse === "" ||
        filiere === "" || groupe === "" || image === "") {
        erreur.innerHTML = "Un ou plusieurs champs ne sont pas remplis.";
    }
    else{
        if (mdp1 !== mdp2){
            erreur.innerHTML = "Les mots de passe sont différents.";
        }
        else{
            if (checkImage(image) === 1){
                erreur.innerHTML = "L'image ne fait pas la bonne taille.";
            }
            else if (checkImage(image) === 2){
                erreur.innerHTML = "Le fichier chargé n'est pas une image.";
            }
            else {
                erreur.innerHTML = "";
                formulaire.submit();
            }
        }
    }
}


function checkImage(image){

}
