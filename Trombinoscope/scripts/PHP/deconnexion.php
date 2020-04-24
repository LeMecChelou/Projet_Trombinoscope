<?php
    session_start();

    if (isset($_SESSION['token'])) {
        $ligne = $_SESSION['token'];
        $id = explode(";", $_SESSION['token'])[0];
        unset($_SESSION['token']);

        include("../../trombi-etu/api/saveLog.php");
        $log = array();
        $log['Action'] = "Déconnexion: " . $id;
        $log['Type'] = "Deconnexion";
        saveLog($log, ["../../trombi-etu/files/logs_etu.json"]);

        $ligne = explode(';', $ligne);

        $type = rtrim($ligne[1]);
        if ($type == 'etudiant'){
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
