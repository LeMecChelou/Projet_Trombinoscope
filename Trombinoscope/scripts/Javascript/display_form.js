function connection_priority(){
    let co = document.getElementsByClassName("bouton_choix")[0];
    let ins = document.getElementsByClassName("bouton_choix")[1];

    if (co.id === "choix_inactif"){
        co.id = "choix_actif";
        ins.id = "choix_inactif";

        let formulaire = document.getElementById("formulaire");
        formulaire.innerHTML = "<form method=\"post\" action=\"../scripts/PHP/check_connection.php\">\n" +
            "                    <label class=\"input_label\" for=\"input_id\">Identifiant</label>\n" +
            "                    <input type=\"text\" id=\"input_id\" class=\"input_co\" name=\"input_id\"/>\n" +
            "\n" +
            "                    <label class=\"input_label\" for=\"input_passwd\">Mot de passe</label>\n" +
            "                    <input type=\"password\" id=\"input_passwd\" class=\"input_co\" name=\"input_passwd\"/>\n" +
            "\n" +
            "                    <input type=\"button\" id=\"bouton_submit_co\" value=\"Se connecter\" onclick=\"checkConnection();\"/>\n" +
            "                </form>";
    }
}


function inscription_priority(){
    let co = document.getElementsByClassName("bouton_choix")[0];
    let ins = document.getElementsByClassName("bouton_choix")[1];

    if (ins.id === "choix_inactif") {
        co.id = "choix_inactif";
        ins.id = "choix_actif";

        let formulaire = document.getElementById("formulaire");
        formulaire.innerHTML = "";
    }
}
