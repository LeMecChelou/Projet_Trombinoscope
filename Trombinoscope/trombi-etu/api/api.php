<?php
    function checkAPIKey(){
        if (isset($_GET['key'])){
            $fichier = file("../files/api_keys.csv");

            
        }
    }


    function generateJSON(){

        // Affichage du JSON.
        $data = file_get_contents("../files/helpApi.json");
        header("Content-type: application/json");
        echo $data;
    }

    checkAPIKey();
?>
