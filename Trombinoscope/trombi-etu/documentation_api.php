<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>Documentation</title>
        <link rel="stylesheet" type="text/css" href="assets/style.css"/>
        <script src="./scripts/getApiKey.js"></script>
        <script src="./scripts/getBackApiKey.js"></script>

    </head>

    <body>
        <header id="header">
            <a href="http://benjamin-guirlet.yo.fr">
                <!-- <a href="../index.php"> -->
                <img id="logo_site" src="assets/logo_site.png" alt="Logo"/>
            </a>
            <h1>Documentation de l'API</h1>
            <a id="bouton_api" href="./index.php">Compte</a>
        </header>

        <div id="documentation">
            <h2>Documentation</h2>
                <p class="h2_indentation">
                    Cette api permet de récupérer des informations sur les étudiants inscrit.
                </p>
                <p class="h2_indentation">
                    Tous les liens de l'API ont pour racine: http://benjamin-guirlet.alwaysdata.net/trombi-etu/
                </p>
                <p class="h2_indentation">
                    Url de l'API: <a href="./api/api.php" target="_blank">benjamin-guirlet.alwaysdata.net/trombi-etu/api/api.php</a>
                </p>
                <p class="h2_indentation">
                    Chaque étudiant a comme informations:
                </p>
                <table>
                    <tr><td class="nom_cle_json">ID</td><td>Identifiant de l'étudiant dans l'API.</td></tr>
                    <tr><td class="nom_cle_json">PRENOM</td><td>Le prénom de l'étudiant.</td></tr>
                    <tr><td class="nom_cle_json">NOM</td><td>Le nom de l'étudiant.</td></tr>
                    <tr><td class="nom_cle_json">FILIERE</td><td>La filiere de l'étudiant.</td></tr>
                    <tr><td class="nom_cle_json">MAIL</td><td>Le mail de l'étudiant.</td></tr>
                    <tr><td class="nom_cle_json">TELEPHONE</td><td>Le numéro de téléphone de l'étudiant.</td></tr>
                    <tr><td class="nom_cle_json">ADRESSE</td><td>L'adresse de l'étudiant.</td></tr>
                    <tr><td class="nom_cle_json">IMAGE</td><td>Le lien vers l'image de profil de l'étudiant.</td></tr>
                </table>

            <h2>Commandes</h2>
                <h3>All</h3>
                    <p class="h3_indentation">
                        Permet de récupérer toutes les filières avec leurs groupes et leurs étudiants.
                    </p>
                    <ul class="infos_commandes">
                       <li><span>Requête</span>: /api/api.php?key=*key*&all=1</li>
                        <li><span>Paramètres</span>: <ul><li>key: la clé d'API de l'utilisateur.</li><li>all: 1 -> la commande pour tout afficher.</li></ul></li>
                    </ul>

                <h3>Filières</h3>
                    <p class="h3_indentation">
                        Permet de récupérer les groupes et étudiants d'une filière.
                    </p>
                    <ul class="infos_commandes">
                        <li><span>Requête</span>: /api/api.php?key=*key*&filiere=*filiere*[&grp=1]</li>
                        <li><span>Paramètres</span>: <ul><li>key: la clé d'API de l'utilisateur.</li><li>filiere: le nom de la filière demandée.</li><li>grp: [optionnel] -> 1 pour afficher uniquement les groupes et pas les étudiants</li></ul></li>
                    </ul>
                <h3>Groupe</h3>
                    <p class="h3_indentation">
                        Permet de récupérer les étudiants d'un groupe.
                    </p>
                    <ul class="infos_commandes">
                        <li><span>Requête</span>: /api/api.php?key=*key*&groupe=*groupe*</li>
                        <li><span>Paramètres</span>: <ul><li>key: la clé d'API de l'utilisateur.</li><li>groupe: le nom du groupe.</li></ul></li>
                    </ul>
                <h3>Étudiants</h3>
                    <p class="h3_indentation">
                        Permet de récupèrer, soit tout les étudiants, soit un étudiant (au choix). Il faut donc entrer uniquement un des deux paramètres.
                    </p>
                    <ul class="infos_commandes">
                        <li><span>Requête</span>: /api/api.php?key=*key*&filiere=*filiere*[&grp=1]</li>
                        <li><span>Paramètres</span>: <ul><li>key: la clé d'API de l'utilisateur.</li><li>all_etu: 1 -> renvoi tout les utilisateurs.</li><li>etu: identifiant de l'étudiant. Renvoi l'étudiant spécifié.</li></ul></li>
                    </ul>

        </div>
        <div id="get_api_key">
            <h2>Demander votre clé d'API</h2>
                <p class="key_api_paragraphe">
                    <?php
                        if (isset($_GET['key'])){
                            if ($_GET['key'] == '1'){
                                echo "Vous avez déjà une clé.";
                            }
                            else{
                                echo "Votre clé est: " . $_GET['key'];
                            }
                        }
                    ?>
                </p>
                <form id="formulaire_mail_api" method="post" action="./scripts/saveApiKey.php">
                    <label class="label_mail" id="label_mail_api_key" for="mail_api_key">Entrez votre mail:</label>
                    <input type="text" class="mail_api_key_class" id="mail_api_key" name="mail_api_key"/>
                    <p class="erreur_mail_api" id="erreur_get"></p>
                    <input type="button" class="bouton_mail_key" id="bouton_mail_key" value="Générer la clé d'API" onclick="getApiKey();">
                </form>
        </div>
        <div id="get_back_api_key">
            <h2>Retrouver votre clé d'API</h2>
                <p class="key_api_paragraphe">
                    <?php
                        if (isset($_GET['key_back'])){
                            if ($_GET['key_back'] == '1'){
                                echo "Vous n'avez pas de clé.";
                            }
                            else{
                                echo "Votre clé est: " . $_GET['key_back'];
                            }
                        }
                    ?>
                </p>

                <form id="form_back_mail_api" method="post" action="./scripts/getBackApiKey.php">
                    <label class="label_mail" id="label_mail_back_key" for="mail_back_key">Entrez votre mail:</label>
                    <input type="text" class="mail_api_key_class" id="mail_back_key" name="mail_back_key"/>
                    <p class="erreur_mail_api" id="erreur_back"></p>
                    <input type="button" class="bouton_mail_key" id="bouton_back_key" value="Récupérer la clé d'API" onclick="getBackApiKey();">
                </form>
        </div>
    </body>
</html>
