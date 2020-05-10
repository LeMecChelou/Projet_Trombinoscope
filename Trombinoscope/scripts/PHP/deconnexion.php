<?php
    session_start();

    if (isset($_SESSION['id'])) {
        $ligne = $_SESSION['token'];

        if ($_SESSION['type'] == "etudiant"){
            include("./functions.inc.php");
            saveLog(["../../trombi-etu/files/logs_etu.json"], "Déconnexion: " . $_SESSION['id'], "Deconnexion");
        }

        $type = $_SESSION['type'];
        unset($_SESSION['id']);
        unset($_SESSION['type']);
        if ($type == 'etudiant'){
            header('Location: ../../trombi-etu/index.php');
        }
        else{
            header('Location: ../../trombi-admin/index.php');
        }
    }
    else{
        header("Location: http://benjamin-guirlet.alwaysdata.net");
    }
?>
