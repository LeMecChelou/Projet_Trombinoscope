<?php
    function getBackApiKey(){
        $keys = json_decode(file_get_contents("../files/api_keys.json"));

        foreach ($keys as $ligne){
            if ($ligne[0] == $_POST['mail_back_key']){
                header('Location: ../documentation_api.php?key_back=' . $ligne[1]);
                return;
            }
        }

        header("Location: ../documentation_api.php?key_back=1");
    }

    getBackApiKey();
?>
