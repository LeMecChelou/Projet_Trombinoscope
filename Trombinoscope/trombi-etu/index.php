<?php
function hashPassword($passwd){
    return hash('sha256', $passwd);
}
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>Étudiants</title>
        <link rel="stylesheet" type="text/css" href="assets/style.css"/>
        <script>
            function getHashPasswd(passwd){ return <?php echo "hashPassword(" ?> passwd <?php echo ")"; ?> }
        </script>
        <script src="../scripts/Javascript/formsButtons.js"></script>
        <script src="../scripts/Javascript/checkConnection.js"></script>
        <script src="../scripts/Javascript/checkInscription.js"></script>

    </head>

    <body>
        <header id="header">
            <a href="http://benjamin-guirlet.yo.fr">
            <!-- <a href="../index.php"> -->
                <img id="logo_site" src="assets/logo_site.png" alt="Logo"/>
            </a>
            <h1>Étudiants</h1>
        </header>

        <div id="conteneur_choix">

            <div id="boutons_choix">
                <div id="bouton_droit">
                    <button class="bouton_choix" id="choix_actif" onclick="connection_priority();">Connexion</button>
                </div>
                <div id="bouton_gauche">
                    <button class="bouton_choix" id="choix_inactif" onclick="inscription_priority();">Inscription</button>
                </div>
            </div>

            <div id="div_formulaire" class="formulaire_etudiant">
                <form id="formulaire" enctype="multipart/form-data" method="post" action="../scripts/PHP/check_connection.php">

                    <label class="input_label" for="input_id">Identifiant</label>
                    <input type="text" id="input_id" class="input_form" name="input_id"/>

                    <label class="input_label" for="input_passwd">Mot de passe</label>
                    <input type="password" id="input_mdp" class="input_form" name="input_mdp"/>

                    <p id='erreur_formulaire'></p>
                    <input type="button" id="bouton_submit_form" value="Se connecter" onclick="checkConnection();"/>
                </form>
            </div>
        </div>
    </body>
</html>