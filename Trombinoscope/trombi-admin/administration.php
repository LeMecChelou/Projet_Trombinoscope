<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8"/>
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

            <?php
                function checkID(){
                    session_start();
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
                }

                $id = checkID();
                echo "<h1>Bonjour $id</h1>";
            ?>
            <a id="bouton_deco" href="../scripts/PHP/deconnexion.php">Déconnexion</a>
        </header>

    </body>
</html>
