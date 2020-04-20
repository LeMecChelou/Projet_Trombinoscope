function connection_priority(){
    let co = document.getElementsByClassName("bouton_choix_etu")[0];
    let ins = document.getElementsByClassName("bouton_choix_etu")[1];

    if (co.id === "choix_etu_inactif"){
        co.id = "choix_etu_actif";
        ins.id = "choix_etu_inactif";

        let formulaire = document.getElementById("formulaire_etu");
        formulaire.innerHTML = "";
    }
}


function inscription_priority(){
    let co = document.getElementsByClassName("bouton_choix_etu")[0];
    let ins = document.getElementsByClassName("bouton_choix_etu")[1];

    if (ins.id === "choix_etu_inactif") {
        co.id = "choix_etu_inactif";
        ins.id = "choix_etu_actif";

        let formulaire = document.getElementById("formulaire_etu");
        formulaire.innerHTML = "";
    }
}
