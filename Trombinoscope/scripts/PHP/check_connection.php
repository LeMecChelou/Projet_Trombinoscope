<?php
    function checkID(){

        if ($_POST['type'] == "etudiant"){
            $fichier = file("../../trombi-etu/files/etudiants.csv");
        }
        else{
            $fichier = file("../../trombi-admin/files/etudiants.csv");
        }

        for ($k = 0; $k < sizeof($fichier); $k++){
            $ligne = str_replace("\n", "", $fichier[$k]);
            $ligne = explode(";", $ligne);

            echo $_POST['input_id'] . " " . $ligne[0] . "\n";
            if ($ligne[0] == $_POST['input_id']){
                checkPasswd($ligne);
            }
        }

        /*if ($_POST['type'] == 'etudiant'){
            header('Location: ../../trombi-etu/index.php?error=1');
        }
        else{
            header('Location: ../../trombi-admin/index.php?error=1');
        }*/
    }


    function checkPasswd($compte){
        $mdp = hash('sha256', $_POST['input_mdp']);

        if ($_POST['type'] == 'etudiant'){
            if ($mdp == $compte[8]){
                session_start();
                $_SESSION['token'] = $compte[0] . ';etudiant';
                header('Location: ../../trombi-etu/etudiant.php');
            }
            else{
                header('Location: ../../trombi-etu/index.php?error=2');
            }
        }
        else{
            if ($mdp == $compte[6]){
                session_start();
                $_SESSION['token'] = $compte[0] . ';administration';
                header('Location: ../../trombi-admin/administration.php');
            }
            else{
                header('Location: ../../trombi-admin/index.php?error=2');
            }
        }

    }

    checkID();
?>