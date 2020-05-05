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


    function triComptes($array){
        $new_array = array();
        $full_size = sizeof($array);

        for ($k = 0; $k < $full_size; $k++){
            $save_account = $array[0];
            $ligne_compte = explode(";", rtrim($save_account));

            for ($i = 0; $i < sizeof($array); $i++){
                $l_compte = explode(";", rtrim($array[$i]));

                if (ord($l_compte[2][0]) < ord($ligne_compte[2][0])){
                    $pos = $i;
                    $save_account = $array[$i];
                    $ligne_compte = $l_compte;
                }
            }

            $new_array[] = $save_account;
            unset($array[$pos]);
        }

        var_dump($new_array);
    }
?>