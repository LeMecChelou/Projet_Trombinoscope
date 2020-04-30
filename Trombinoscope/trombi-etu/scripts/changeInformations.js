function changeHTMLInformations(){
    let div_infos = document.getElementById("div_table_info_etu");

    div_infos.innerHTML = "<h2 id=\"titre_div_infos_change\">Changement d'informations</h2>\n" +
        "                        <form method=\"post\" enctype='multipart/form-data' id='form_change_infos' action=\"../scripts/PHP/change_informations.php\">\n" +
        "                            <label class=\"titre_change\" for=\"input_change_pp\">Image de profil</label>\n" +
        "                            <input type=\"file\" id=\"input_change_pp\" class=\"input_change\" name=\"change_pp\" accept=\".jpg, .jpeg, .png\">\n" +
        "\n" +
        "                            <label class=\"titre_change\" for=\"change_id\">Identifiant:</label>\n" +
        "                            <input type=\"text\" id=\"change_id\" class=\"input_change\" name=\"change_id\"/>\n" +
        "\n" +
        "                            <label class=\"titre_change\" for=\"change_prenom\">Prénom:</label>\n" +
        "                            <input type=\"text\" id=\"change_prenom\" class=\"input_change\" name=\"change_prenom\"/>\n" +
        "\n" +
        "                            <label class=\"titre_change\" for=\"change_nom\">Nom:</label>\n" +
        "                            <input type=\"text\" id=\"change_nom\" class=\"input_change\" name=\"change_nom\"/>\n" +
        "\n" +
        "                            <label class=\"titre_change\" for=\"change_mail\">Mail:</label>\n" +
        "                            <input type=\"text\" id=\"change_mail\" class=\"input_change\" name=\"change_mail\"/>\n" +
        "\n" +
        "                            <label class=\"titre_change\" for=\"change_tel\">Téléphone</label>\n" +
        "                            <input type=\"text\" id=\"change_tel\" class=\"input_change\" name=\"change_tel\"/>\n" +
        "\n" +
        "                            <label class=\"titre_change\" for=\"change_adresse\">Adresse:</label>\n" +
        "                            <input type=\"text\" id=\"change_adresse\" class=\"input_change\" name=\"change_adresse\"/>\n" +
        "\n" +
        "                            <label class=\"titre_change\" for=\"liste_filieres\">Choix de la filière:</label>\n" +
        "                            <select id=\"liste_filieres\" class=\"input_change\" name=\"change_filiere\" onchange=\"setLoadGroups();\">\n" +
        "                                <option value=\"\">...</option>\n" +
        "                                <option value=\"L1-MIPI\">L1-MIPI</option>\n" +
        "                                <option value=\"L2-MI\">L2-MI</option>\n" +
        "                                <option value=\"L3-I\">L3-I</option>\n" +
        "                                <option value=\"LP RS\">LP RS</option>\n" +
        "                                <option value=\"LPI-RIWS\">LPI-RIWS</option>\n" +
        "                            </select>\n" +
        "\n" +
        "                            <label class=\"titre_change\" for=\"liste_groupes\">Choix du groupe:</label>\n" +
        "                            <select id=\"liste_groupes\" class=\"input_change\" name=\"change_groupe\">\n" +
        "                                <option value=\"\">...</option>\n" +
        "                            </select>\n" +
        "\n" +
        "                            <label class=\"titre_change\" for=\"change_mdp1\">Nouveau mot de passe:</label>\n" +
        "                            <input type=\"password\" id=\"change_mdp1\" class=\"input_change\" name=\"change_mdp1\"/>\n" +
        "\n" +
        "                            <label class=\"titre_change\" for=\"change_mdp2\">Entrez de nouveau le mot de passe:</label>\n" +
        "                            <input type=\"password\" id=\"change_mdp2\" class=\"input_change\" name=\"change_mdp2\"/>\n" +
        "\n" +
        "                            <label id=\"label_verif_mdp\" class=\"titre_change\" for=\"verif_mdp\">Entrez votre mot de passe actuel:</label>\n" +
        "                            <input type=\"password\" id=\"verif_mdp\" class=\"input_change\" name=\"verif_mdp\"/>\n" +
        "\n" +
        "                            <p id=\"erreur_mdp\"></p>\n" +
        "\n" +
        "                            <input type=\"button\" id=\"bouton_submit_change\" class=\"input_change\" onclick=\"submitChanges();\" value=\"Sauvegarder\"/>\n" +
        "                            <input type=\"button\" id=\"bouton_cancel_changes\" class=\"input_change\" onclick=\"cancelChanges();\" value=\"Annuler\"/>\n" +
        "                        </form>";
}


function cancelChanges(){
    document.location = "./etudiant.php";
}

function submitChanges(){
    let mdp1 = document.getElementById("change_mdp1").value;
    let mdp2 = document.getElementById("change_mdp2").value;

    let erreur = document.getElementById("erreur_mdp");
    let form = document.getElementById("form_change_infos");

    if (mdp1 !== mdp2){
        erreur.innerHTML = "Les nouveaux mots de passe sont différents.";
    }
    else {
        form.submit();
    }
}