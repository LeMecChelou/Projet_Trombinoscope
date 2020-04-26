<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8"/>
        <title>Étudiants</title>
        <link rel="stylesheet" type="text/css" href="assets/style.css"/>
        <script src="./scripts/getTrombinoscope.js"></script>
    </head>

    <body>
        <header id="header">
            <a href="http://benjamin-guirlet.yo.fr">
                <!-- <a href="../index.php"> -->
                <img id="logo_site" src="assets/logo_site.png" alt="Logo"/>
            </a>

            <?php
                function checkID(){
                    if (isset($_SESSION['token'])){
                        $id = explode(";", rtrim($_SESSION['token']))[0];
                        $fichier = file("./files/administration.csv");

                        for ($k = 0; $k < sizeof($fichier); $k++){
                            $check_id = explode(";", rtrim($fichier[$k]))[0];

                            if ($id == $check_id){
                                return $id;
                            }
                        }
                        header("Location: ./index.php");
                    }
                    else{
                        header('Location: ./index.php');
                    }
                    return "None";
                }

                $id = checkID();
                echo "<h1>Bonjour $id</h1>";
            ?>
            <a id="bouton_deco" href="../scripts/PHP/deconnexion.php">Déconnexion</a>
        </header>

        <div id="parametres">
            <h2>Paramètres</h2>
                <label class="label_select_parametres" for="select_filiere">Sélectionner une filière:</label>
                <select id="select_filiere" class="select_parametres" onchange="getGroups();">
                    <option value="all" selected="selected">Toutes les filières</option>
                    <option value="L1-MIPI">L1-MIPI</option>
                    <option value="L2-MI">L2-MI</option>
                    <option value="L3-I">L3-I</option>
                    <option value="LP RS">LP RS</option>
                    <option value="LPI-RIWS">LPI-RIWS</option>
                </select>

                <label class="label_select_parametres" for="select_groupe">Sélectionnez le groupe:</label>
                <select id="select_groupe" class="select_parametres">
                    <option value="all" selected="selected">Tous les groupes</option>
                </select>

                <button id="bouton_validation_parametres" onclick="getJSON();">Valider</button>

        </div>

        <div id="trombinoscope">

        </div>

    </body>
</html>
