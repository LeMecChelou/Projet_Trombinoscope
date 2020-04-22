<?php
    session_start();

    if (isset($_SESSION['token'])) {
        $ligne = $_SESSION['token'];
        unset($_SESSION['token']);

        $ligne = explode(';', $ligne);

        $type = str_replace("\n", "", $ligne[1]);
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
