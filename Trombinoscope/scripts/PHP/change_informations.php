<?php
    session_start();
    function checkPasswordChange(){
        $token = rtrim(explode(";", $_SESSION['token'])[1]);
        $id = rtrim(explode(";", $_SESSION['token'])[0]);
        if (isset($_POST['verif_mdp'])){

            if ($token == "etudiant"){
                $fichier = file('../../trombi-etu/files/etudiants.csv');

                for ($k = 0; $k < sizeof($fichier); $k++){
                    $ligne = explode(";", rtrim($fichier[$k]));
                    $mdp = $ligne[8];
                    $mdp_verif = hash("sha256", $_POST['verif_mdp'] . $ligne[9]);

                    if ($mdp == $mdp_verif && $id == $ligne[0]){
                        changeInformations($ligne, $fichier, $k);
                        return;
                    }
                }
                header("Location: ../../trombi-etu/etudiant.php?error=2");
            }
        }
        else{
            if ($token == "etudiant"){
                header('Location: ../../trombi-etu/etudiant.php?error=1');
            }
        }
    }


    function changeInformations($compte, $fichier, $pos){
        $type = explode(";", $_SESSION['token'])[1];
        $type = rtrim($type);

        include("./functions.inc.php");
        $log = array();
        $log['Action'] = "Changement d'information(s): " . $compte[0];
        $log['Type'] = "ChangeInfos";
        saveLog($log, ["../../trombi-etu/files/logs_etu.json"]);

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

            if ($_POST['change_filiere'] != ""){
                $new_compte = $new_compte . $_POST['change_filiere'] . ";";
            }
            else{
                $new_compte = $new_compte . $compte[3] . ";";
            }

            if ($_POST['change_groupe'] != ""){
                $new_compte = $new_compte . $_POST['change_groupe'] . ";";
            }
            else{
                $new_compte = $new_compte . $compte[4] . ";";
            }

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
                $random_string = uniqid();
                $mdp1 = hash('sha256', $_POST['change_mdp1'] . $random_string);
                $new_compte = $new_compte . $mdp1 . ";" . $random_string . ";";
            }
            else{
                $new_compte = $new_compte . $compte[8] . ";" . $compte[9] . ";";
            }

            $error_image = false;
            if ($_FILES["change_pp"]['name'] != ""){
                $type = rtrim(explode("/", $_FILES['change_pp']['type'])[1]);
                $new_name = $compte[0] . "." . $type;
                $dir = "../../trombi-etu/images_etu/" . $new_name;

                $size = getimagesize($_FILES['change_pp']['tmp_name']);

                if (($size[0] < 160 || $size[0] > 175) || ($size[1] < 160 || $size[1] > 175)){
                    $error_image = true;
                    $new_compte = $new_compte . $compte[10] . "\n";
                }
                else{
                    if ($compte[9] != "None"){
                        unlink("../../trombi-etu/" . $compte[10]);
                    }
                    move_uploaded_file($_FILES['change_pp']['tmp_name'], $dir);
                    $new_compte = $new_compte . "images_etu/$new_name" . "\n";
                }
            }
            else{
                $new_compte = $new_compte . $compte[10] . "\n";
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
    }

    checkPasswordChange();
?>
