<?php
    function saveApiKey(){
        $fichier = file("../files/api_keys.csv");

        for ($k = 0; $k < sizeof($fichier); $k++){
            $mail = explode(";", rtrim($fichier[$k]))[0];

            if ($mail == $_POST['mail_api_key']){
                header('Location: ../documentation_api.php?key=1');
                return;
            }
        }

        $new_fichier = fopen("../files/api_keys.csv", "w");
        for ($k = 0; $k < sizeof($fichier); $k++){
            fwrite($new_fichier, $fichier[$k]);
        }

        $ligne = $_POST['mail_api_key'] . ";" . $_POST['key_api'] . "\n";
        fwrite($new_fichier, $ligne);


        header('Location: ../documentation_api.php?key=' . $_POST['key_api']);
    }

    saveApiKey();
?>
