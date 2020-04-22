function connection_priority(){
    let co = document.getElementsByClassName("bouton_choix")[0];
    let ins = document.getElementsByClassName("bouton_choix")[1];

    if (co.id === "choix_inactif"){
        co.id = "choix_actif";
        ins.id = "choix_inactif";

        let formulaire = document.getElementById("formulaire");
        formulaire.action = "../scripts/PHP/check_connection.php";

        formulaire.innerHTML = "<form method='post' action='../scripts/PHP/check_connection.php'>\n" +
            "                    <label class='input_label' for='input_id'>Identifiant</label>\n" +
            "                    <input type='text' id='input_id' class='input_form' name='input_id'/>\n" +
            "\n" +
            "                    <label class='input_label' for='input_passwd'>Mot de passe</label>\n" +
            "                    <input type='password' id='input_mdp' class='input_form' name='input_mdp'/>\n" +
            "\n" +
            "                    <p id='erreur_formulaire'>\n" +
            "                        <?php" +
            "                            if (isset($_GET['error'])){" +
            "                                if ($_GET['error'] == '1'){" +
            "                                    echo 'Identifiant incorrect.';" +
            "                                }" +
            "                                if ($_GET['error'] == '2'){" +
            "                                    echo 'Mot de passe erroné.';" +
            "                                }" +
            "                            }" +
            "                        ?>\n" +
            "                    </p>" +
            "                    <input type='button' id='bouton_submit_form' value='Se connecter' onclick='checkConnection();'/>\n" +
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
        formulaire.action = "../scripts/PHP/check_inscription.php";
        let div_form = document.getElementById("div_formulaire");

        if (div_form.className === "formulaire_etudiant"){
            formulaire.innerHTML = "<form method='post' id='formulaire_ins' action='../scripts/PHP/check_inscription.php'>\n" +
                "                    <label class='input_label' for='input_id'>Identifiant</label>\n" +
                "                    <input type='text' id='input_id' class='input_form' name='input_id'/>\n" +
                "\n" +
                "                    <label class='input_label' for='input_prenom'>Prénom</label>\n" +
                "                    <input type='text' id='input_prenom' class='input_form' name='input_prenom'/>\n" +
                "\n" +
                "                    <label class='input_label' for='input_nom'>Nom</label>\n" +
                "                    <input type='text' id='input_nom' class='input_form' name='input_nom'/>\n" +
                "\n" +
                "                    <label class='input_label' for='input_mail'>Mail</label>\n" +
                "                    <input type='text' id='input_mail' class='input_form' name='input_mail'/>\n" +
                "\n" +
                "                    <label class='input_label' for='input_tel'>Numéro de téléphone</label>\n" +
                "                    <input type='text' id='input_tel' class='input_form' name='input_tel'/>\n" +
                "\n" +
                "                    <label class='input_label' for='input_adresse'>Adresse</label>\n" +
                "                    <input type='text' id='input_adresse' class='input_form' name='input_adresse'/>\n" +
                "\n" +
                "                    <label class='input_label' for='input_mdp'>Mot de passe</label>\n" +
                "                    <input type='password' id='input_mdp' class='input_form' name='input_mdp'/>\n" +
                "\n" +
                "                    <label class='input_label' for='input_mdp2'>Entrez de nouveau le mot de passe</label>\n" +
                "                    <input type='password' id='input_mdp2' class='input_form' name='input_mdp2'/>\n" +
                "                    <label class='input_label' for='liste_filieres'>Choix de la filère: </label>\n" +
                "                    <select id='liste_filieres' class='input_form' name='input_filiere' onchange=\"loadGroups();\">\n" +
                "                        <option value=''>...</option>\n" +
                "                        <option value='L1-MIPI'>L1-MIPI</option>\n" +
                "                        <option value='L2-MI'>L2-MI</option>\n" +
                "                        <option value='L3-I'>L3-I</option>\n" +
                "                        <option value='LP RS'>LP RS</option>\n" +
                "                        <option value='LPI-RIWS'>LPI-RIWS</option>\n" +
                "                    </select>" +
                "                    <label class='input_label' for='liste_groupes'>Choix du groupe: </label>\n" +
                "                    <select id='liste_groupes' class='input_form' name='input_groupe'>\n" +
                "                        <option value=''>...</option>\n" +
                "                    </select>\n" +
                "                    <p id='erreur_formulaire'></p>\n" +
                "                    <input type='button' id='bouton_submit_form' value='Valider' onclick='checkInscription();'/>\n" +
                "                </form>";
        }
        else{
            formulaire.innerHTML = "<form method='post' id='formulaire_ins' action='../scripts/PHP/check_inscription.php'>\n" +
                "                    <label class='input_label' for='input_id'>Identifiant</label>\n" +
                "                    <input type='text' id='input_id' class='input_form' name='input_id'/>\n" +
                "\n" +
                "                    <label class='input_label' for='input_prenom'>Prénom</label>\n" +
                "                    <input type='text' id='input_prenom' class='input_form' name='input_prenom'/>\n" +
                "\n" +
                "                    <label class='input_label' for='input_nom'>Nom</label>\n" +
                "                    <input type='text' id='input_nom' class='input_form' name='input_nom'/>\n" +
                "\n" +
                "                    <p id='erreur_formulaire'></p>\n" +
                "                    <input type='button' id='bouton_submit_form' value='Valider' onclick='checkInscription();'/>\n" +
                "                </form>";
        }

    }
}


function loadGroups(){
    let filiere = document.getElementById("liste_filieres").value;
    let groupes =document.getElementById("liste_groupes");

    if (filiere === "L1-MIPI"){
        groupes.innerHTML = "<option value=''>...</option>" +
            "<option value='M1'>M1</option>" +
            "<option value='M2'>M2</option>" +
            "<option value='M3'>M3</option>" +
            "<option value='M4'>M4</option>" +
            "<option value='M5'>M5</option>";
    }
    else if (filiere === "L2-MI"){
        groupes.innerHTML = "<option value=''>...</option>" +
            "<option value='A1'>A1</option>" +
            "<option value='A2'>A2</option>" +
            "<option value='A3'>A3</option>";
    }
    else if (filiere === "L3-I"){
        groupes.innerHTML = "<option value=''>...</option>" +
            "<option value='I1'>I1</option>" +
            "<option value='I2'>I2</option>" +
            "<option value='I3'>I3</option>";
    }
    else if (filiere === "LP RS"){
        groupes.innerHTML = "<option value=''>...</option>" +
            "<option value='LP1'>LP1</option>" +
            "<option value='LP1'>LP1</option>";
    }
    else if (filiere === "LPI-RIWS"){
        groupes.innerHTML = "<option value=''>...</option>" +
            "<option value='LPI1'>LPI1</option>" +
            "<option value='LPI2'>LPI2</option>";
    }
    else{
        groupes.innerHTML = "<option value=''>...</option>";
    }
}
