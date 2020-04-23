<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>Documentation</title>
        <link rel="stylesheet" type="text/css" href="assets/style.css"/>
        <script src="./scripts/getApiKey.js"></script>

    </head>

    <body>
        <header id="header">
            <a href="http://benjamin-guirlet.yo.fr">
                <!-- <a href="../index.php"> -->
                <img id="logo_site" src="assets/logo_site.png" alt="Logo"/>
            </a>
            <h1>Documentation</h1>
            <a id="bouton_api" href="./index.php">Compte</a>
        </header>

        <div id="documentation">
            <h2 id="titre_documentation">Documentation</h2>

        </div>
        <div id="get_api_key">
            <h2>Récupérer votre clé d'API</h2>
                <p id="key_api_paragraphe">
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
                    <label id="label_mail_api_key" for="mail_api_key">Entrez votre mail:</label>
                    <input type="text" id="mail_api_key" name="mail_api_key"/>
                    <p id="erreur_mail_api"></p>
                    <input type="button" id="bouton_mail_key" value="Générer la clé d'API" onclick="getApiKey();">
                </form>
        </div>
    </body>
</html>
