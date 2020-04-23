<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>Étudiants</title>
        <link rel="stylesheet" type="text/css" href="assets/style.css"/>
        <script src='./scripts/changeInformations.js'></script>
    </head>

    <body>
        <header id="header">
            <a href="http://benjamin-guirlet.yo.fr">
                <!-- <a href="../index.php"> -->
                <img id="logo_site" src="assets/logo_site.png" alt="Logo"/>
            </a>
            <h1>Étudiants</h1>
            <a id="bouton_deco" href="../scripts/PHP/deconnexion.php">Déconnexion</a>
            <a id="bouton_api" href="documentation_api.php">API</a>
        </header>

        <div id="conteneur_infos_etu">
            <div id="conteneur_infos">
                <div id="div_table_info_etu">
                    <h2 id="titre_div_infos">Informations</h2>
                    <p id="erreur_mdp">
                        <?php
                            if (isset($_GET['error'])){
                                if ($_GET['error'] == "1"){
                                    echo "Le mot de passe actuel n'a pas été renseigné.";
                                }
                                if ($_GET['error'] == "2"){
                                    echo "Le mot de passe actuel est faux.";
                                }
                                if ($_GET['error'] == "3"){
                                    echo "Le fichier téléversé n'ests pas une image.";
                                }
                                if ($_GET['error'] == "4"){
                                    echo "L'image de profil ne respecte pas les dimensions (160 <= x/y <= 175)";
                                }
                            }
                        ?>
                    </p>
                    <table id="table_info_etu">
                        <?php
                            session_start();
                            if (isset($_SESSION['token'])){
                                $id = $_SESSION['token'];
                                $id = explode(';', $id)[0];

                                $fichier = file("./files/etudiants.csv");
                                for ($k = 0; $k < sizeof($fichier); $k++){
                                    $ligne = explode(";", rtrim($fichier[$k]));

                                    if ($id == $ligne[0]){
                                        if ($ligne[9] == "None"){
                                            echo "<img id='error' class='image_profil' src='./assets/pp_none.png' alt=\"Image de profil d'erreur.\"/>";
                                        }
                                        else{
                                            echo "<img id='None' class='image_profil' src='$ligne[9]' alt=\"Image de profil.\"/>";
                                        }

                                        echo "<p id='erreur_image_profil'></p>";

                                        echo "<tr><td class='colonne_titre'>Identifiant:</td><td>$ligne[0]</td></tr>";
                                        echo "<tr><td class='colonne_titre'>Identifiant API:</td><td>" . $ligne[0][0] . $k . "</td>";
                                        echo "<tr><td class='colonne_titre'>Prénom:</td><td>$ligne[1]</td></tr>";
                                        echo "<tr><td class='colonne_titre'>Nom:</td><td>$ligne[2]</td></tr>";
                                        echo "<tr><td class='colonne_titre'>Filière:</td><td>$ligne[3]</td></tr>";
                                        echo "<tr><td class='colonne_titre'>Groupe:</td><td>$ligne[4]</td></tr>";
                                        echo "<tr><td class='colonne_titre'>Mail:</td><td>$ligne[5]</td></tr>";
                                        echo "<tr><td class='colonne_titre'>Numéro:</td><td>$ligne[6]</td></tr>";
                                        echo "<tr><td class='colonne_titre'>Adresse:</td><td>$ligne[7]</td></tr>";

                                    }
                                }
                            }
                            else{
                                header('Location: ./index.php');
                            }

                        ?>
                    </table>
                    <button id="bouton_change_infos" onclick='changeHTMLInformations();'>Changer les informations</button>
                </div>
            </div>
        </div>

    </body>
</html>
