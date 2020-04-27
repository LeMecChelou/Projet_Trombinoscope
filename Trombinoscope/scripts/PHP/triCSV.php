<?php
    function triCSV($fichier){
        $fichier = file($fichier);

        $premier = 0;
        for ($x = 0; $x < sizeof($fichier); $x++){
            $ligne = explode(";", rtrim($fichier[$x]));

            for ($k = 0; $k < sizeof($fichier); $k++){
                $temp = explode(";", rtrim($fichier[$k]));
                if (ord($ligne[$premier][0]))
            }
        }

    }
?>