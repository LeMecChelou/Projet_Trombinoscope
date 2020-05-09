<?php
    session_start();
    $json_filieres = file_get_contents("http://benjamin-guirlet.alwaysdata.net/trombi-etu/assets/filieres.json");
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8"/>
        <title>Administration</title>
        <link rel="stylesheet" type="text/css" href="assets/style.css"/>
        <link rel="stylesheet" type="text/css" href="assets/impression.css" media="print"/>
        <script src="scripts/functionTrombinoscope.js"></script>
        <script>
            function setGroups(){
                getGroups( <?php echo $json_filieres; ?>);
            }
        </script>
    </head>

    <body>
        <header id="header">
            <a href="http://bguirlet.alwaysdata.net/">
                <img id="logo_site" src="assets/logo_site.png" alt="Logo"/>
            </a>

            <?php
                if (isset($_SESSION['type'])){

                    if ($_SESSION['type'] == "administration"){
                        $fichier = file("./files/administration.csv");

                        for ($k = 0; $k < sizeof($fichier); $k++){
                            $check_id = explode(";", rtrim($fichier[$k]))[0];

                            $found = false;
                            if ($_SESSION['id'] == $check_id){
                                echo "<h1>Bonjour " . $_SESSION['id'] . "</h1>";
                                $found = true;
                            }
                        }
                        if (!($found)){
                            header("Location: ./index.php");
                        }
                    }
                }
                else{
                    header('Location: ./index.php');
                }
            ?>
            <a id="bouton_deco" href="../scripts/PHP/deconnexion.php">Déconnexion</a>
        </header>

        <div id="parametres">
            <h2>Paramètres</h2>
            <label class="label_param_trombi" for="select_filiere">Sélectionner une filière:</label>
            <select id="select_filiere" class="select_parametres" onchange="setGroups();">
                <option value="L1-MIPI" selected="selected">L1-MIPI</option>
                <option value="L2-MI">L2-MI</option>
                <option value="L3-I">L3-I</option>
                <option value="LP RS">LP RS</option>
                <option value="LPI-RIWS">LPI-RIWS</option>
            </select>

            <label class="label_param_trombi" for="select_groupe">Sélectionnez le groupe:</label>
            <select id="select_groupe" class="select_parametres">
                <option value="all" selected="selected">Tous les groupes</option>
                <option value='A1'>A1</option>
                <option value='A2'>A2</option>
                <option value='A3'>A3</option>
            </select>

            <label class="label_param_trombi" for="input_nb_etudiants_max">Entrez le nombre d'étudiants max:</label>
            <input type="number" id="input_nb_etudiants_max" class="select_parametres" value="0"/>

            <button id="bouton_validation_parametres" onclick="getJSON();">Valider</button>
        </div>

        <div id="impression">
            <button id="bouton_impression" onclick="checkImpression();">Imprimer</button>
        </div>

        <div id="trombinoscope">
            <h2>Trombinoscope</h2>
            <div id="div_trombi">
            </div>
        </div>

    </body>
</html>
