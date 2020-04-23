<?php
    function saveApiKey(){
        $fichier = json_decode(file_get_contents("../files/api_keys.json"));
        $new_user = array();

        foreach ($fichier as $infos){
            if ($infos[0] == $_POST['mail_api_key']){
                header('Location: ../documentation_api.php?key=1');
                return;
            }
        }

        $new_user[] = $_POST['mail_api_key'];
        $new_user[] = $_POST['key_api'];
        $new_user[] = 0;
        $new_user[] = 0;

        $fichier[] = $new_user;

        $new_fichier = fopen("../files/api_keys.json", "w");
        fwrite($new_fichier, json_encode($fichier));
        fclose($new_fichier);

        header('Location: ../documentation_api.php?key=' . $_POST['key_api']);
    }

    saveApiKey();
?>
