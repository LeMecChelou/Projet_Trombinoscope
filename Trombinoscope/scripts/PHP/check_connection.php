<?php
    function checkID(){

        if ($_POST['type'] == "etudiant"){
            $fichier = file("../../trombi-etu/files/etudiants.csv");
        }
        else{
            $fichier = file("../../trombi-admin/files/administration.csv");
        }

        for ($k = 0; $k < sizeof($fichier); $k++){
            $ligne = rtrim($fichier[$k]);
            $ligne = explode(";", $ligne);

            if ($ligne[0] == $_POST['input_id']){
                 checkPasswd($ligne);
                 return;
            }
        }

        if ($_POST['type'] == 'etudiant'){
            header('Location: ../../trombi-etu/index.php?error=1');
        }
        else{
            header('Location: ../../trombi-admin/index.php?error=1');
        }
    }


    function checkPasswd($compte){

        if ($_POST['type'] == 'etudiant'){
            $mdp = hash('sha256', rtrim($_POST['input_mdp'] . $compte[9]));

            if ($mdp == $compte[8]){
                session_start();
                $_SESSION['token'] = $compte[0] . ';etudiant';

                include("../../trombi-etu/api/saveLog.php");
                $log = array();
                $log['Action'] = "Connexion: " . $compte[0];
                $log['Type'] = "Connexion";
                saveLog($log, ["../../trombi-etu/files/logs_etu.json"]);

                header('Location: ../../trombi-etu/etudiant.php');
            }
            else{
                header('Location: ../../trombi-etu/index.php?error=2');
            }
        }
        else{
            $mdp = hash('sha256', $_POST['input_mdp'] . $compte[5]);

            if ($mdp == $compte[4]){
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