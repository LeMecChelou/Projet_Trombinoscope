<?php
    session_start();
    function checkPasswordChange(){
        $token = rtrim(explode(";", $_SESSION['token'])[1]);
        if (isset($_POST['verif_mdp'])){

            if ($token == "etudiant"){
                $fichier = file('../../trombi-etu/files/etudiants.csv');
                $mdp_verif = hash("sha256", $_POST['verif_mdp']);

                for ($k = 0; $k < sizeof($fichier); $k++){
                    $ligne = explode(";", rtrim($fichier[$k]));
                    $mdp = $ligne[8];

                    if ($mdp == $mdp_verif){
                        changeInformations($ligne, $fichier, $k);
                        return;
                    }
                }
                header("Location: ../../trombi-etu/etudiant.php?error=2");
            }
            else{
                $fichier = file('../../trombi-admin/files/administration.csv');
                $mdp_verif = hash("sha256", $_POST['verif_mdp']);

                for ($k = 0; $k < sizeof($fichier); $k++){
                    $ligne = explode(";", rtrim($fichier[$k]));
                    $mdp = $ligne[6];

                    if ($mdp == $mdp_verif){
                        changeInformations($ligne, $fichier, $k);
                    }
                }
                header("Location: ../../trombi-admin/administration.php?error=2");
            }

        }
        else{
            if ($token == "etudiant"){
                header('Location: ../../trombi-etu/etudiant.php?error=1');
            }
            else{
                header('Location: ../../trombi-admin/administration.php?error=1');
            }
        }
    }


    function changeInformations($compte, $fichier, $pos){
        $type = explode(";", $_SESSION['token'])[1];
        $type = rtrim($type);

        if ($type == 'etudiant'){
            $new_compte = "";

            if ($_POST['change_id'] != ""){
                $new_compte = $new_compte . $_POST['change_id'] . ";";
                $_SESSION['token'] = $_POST['change_id']. ';etudiant';
            }
            else{
                $new_compte = $new_compte . $compte[0] . ";";
            }
            if ($_POST['change_prenom'] != ""){
                $new_compte = $new_compte . $_POST['change_prenom'] . ";";
            }
            else{
                $new_compte = $new_compte . $compte[1] . ";";
            }
            if ($_POST['change_nom'] != ""){
                $new_compte = $new_compte . $_POST['change_nom'] . ";";
            }
            else{
                $new_compte = $new_compte . $compte[2] . ";";
            }

            $new_compte = $new_compte . $compte[3] . ";" . $compte[4] . ";";

            if ($_POST['change_mail'] != ""){
                $new_compte = $new_compte . $_POST['change_mail'] . ";";
            }
            else{
                $new_compte = $new_compte . $compte[5] . ";";
            }
            if ($_POST['change_tel'] != ""){
                $new_compte = $new_compte . $_POST['change_tel'] . ";";
            }
            else{
                $new_compte = $new_compte . $compte[6] . ";";
            }
            if ($_POST['change_adresse'] != ""){
                $new_compte = $new_compte . $_POST['change_adresse'] . ";";
            }
            else{
                $new_compte = $new_compte . $compte[7] . ";";
            }
            if ($_POST['change_mdp1'] != ""){
                $mdp1 = hash('sha256', $_POST['change_mdp1']);
                $new_compte = $new_compte . $mdp1 . ";";
            }
            else{
                $new_compte = $new_compte . $compte[8] . ";";
            }
            if ($_FILES["change_pp"]['name'] != ""){
                $type = rtrim(explode("/", $_FILES['change_pp']['type'])[1]);
                $new_name = $compte[0] . "." . $type;
                $dir = "../../trombi-etu/images_etu/" . $new_name;

                $size = getimagesize($_FILES['change_pp']['tmp_name']);

                if (($size[0] < 160 || $size[0] > 175) || ($size[1] < 160 || $size[1] > 175)){
                    $error_image = true;
                    $new_compte = $new_compte . $compte[9] . "\n";
                }
                else{
                    if ($compte[9] != "None"){
                        unlink("../../trombi-etu/" . $compte[9]);
                    }
                    move_uploaded_file($_FILES['change_pp']['tmp_name'], $dir);
                    $new_compte = $new_compte . "images_etu/$new_name" . "\n";
                    $error_image = false;
                }
            }
            else{
                $new_compte = $new_compte . $compte[9] . "\n";
            }

            $fichier[$pos] = $new_compte;
            $new_fichier = fopen('../../trombi-etu/files/etudiants.csv', 'w');
            for ($k = 0; $k < sizeof($fichier); $k++){
                fwrite($new_fichier, $fichier[$k]);
            }

            if ($error_image){
                header('Location: ../../trombi-etu/etudiant.php?error=4');
            }
            else{
                header('Location: ../../trombi-etu/etudiant.php');
            }
        }
        else{
            $new_compte = "";

            if ($_POST['change_id'] != ""){
                $new_compte = $new_compte . $_POST['change_id'] . ";";
                $_SESSION['token'] = $_POST['change_id']. ';etudiant';
            }
            else{
                $new_compte = $new_compte . $compte[0] . ";";
            }
            if ($_POST['change_prenom'] != ""){
                $new_compte = $new_compte . $_POST['change_prenom'] . ";";
            }
            else{
                $new_compte = $new_compte . $compte[1] . ";";
            }
            if ($_POST['change_nom'] != ""){
                $new_compte = $new_compte . $_POST['change_nom'] . ";";
            }
            else{
                $new_compte = $new_compte . $compte[2] . ";";
            }
            if ($_POST['change_mail'] != ""){
                $new_compte = $new_compte . $_POST['change_mail'] . ";";
            }
            else{
                $new_compte = $new_compte . $compte[3] . ";";
            }
            if ($_POST['change_mdp1'] != ""){
                $mdp1 = hash('sha256', $_POST['change_mdp1']);
                $new_compte = $new_compte . $mdp1 . ";";
            }
            else{
                $new_compte = $new_compte . $compte[4] . ";";
            }

            $fichier[$pos] = $new_compte;
            $new_fichier = fopen('../../trombi-etu/files/etudiants.csv', 'w');
            for ($k = 0; $k < sizeof($fichier); $k++){
                fwrite($new_fichier, $fichier[$k]);
            }

            header('Location: ../../trombi-admin/administration.php');
        }
    }

    checkPasswordChange();
?>