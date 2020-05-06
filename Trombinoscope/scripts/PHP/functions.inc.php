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


    function saveLog($log, $array_files){
        $log['Year'] = intval(date('Y'));
        $log['Month'] = intval(date('m'));
        $log['Day'] = intval(date('d'));
        $log['Hour'] = intval(date('H') + 2);
        $log['Minute'] = intval(date('i'));
        $log['Second'] = intval(date('s'));


        foreach ($array_files as $file){
            $fichier = json_decode(file_get_contents($file));
            $fichier[] = $log;
            file_put_contents($file, json_encode($fichier), LOCK_EX);
        }
    }
?>