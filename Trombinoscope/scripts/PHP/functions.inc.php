<?php
    function checkToken($cheminFichier, $page_index, $type){
        session_start();

        if (isset($_SESSION['id'])){

            if ($_SESSION['type'] == $type){
                $fichier = file($cheminFichier);

                for ($k = 0; $k < sizeof($fichier); $k++){
                    $ligne = explode(";", rtrim($fichier[$k]));

                    if ($ligne[0] == $_SESSION['id']){
                        header($page_index);
                    }
                }
            }
        }
    }
?>