<?php
    session_start();

    if (isset($_SESSION['token'])) {
        $ligne = $_SESSION['token'];
        $infos = explode(";", rtrim($_SESSION['token']));
        unset($_SESSION['token']);

        if ($infos[1] == "etudiant"){
            include("../../trombi-etu/api/saveLog.php");
            $log = array();
            $log['Action'] = "Déconnexion: " . $infos[0];
            $log['Type'] = "Deconnexion";
            saveLog($log, ["../../trombi-etu/files/logs_etu.json"]);
        }


        if ($infos[1] == 'etudiant'){
            header('Location: ../../trombi-etu/index.php');
        }
        else{
            header('Location: ../../trombi-admin/index.php');
        }
    }
    else{
        header("Location: http://benjamin-guirlet.yo.fr");
    }
?>
