<?php
    include("functions.inc.php");

    function checkID($chemin){
        $fichier = file($chemin);

        for ($k = 0; $k < sizeof($fichier); $k++){
            $id = explode(";", rtrim($fichier[$k]))[0];

            if ($id == $_POST['input_id']){
                return false;
            }
        }

        return true;
    }


    function getInfosInscription(){
        $random_string = uniqid();
        $mdp = hash('sha256', $_POST['input_mdp'] . $random_string);

        if ($_POST['type'] == 'etudiant') {
            if (checkID($_POST['filename'])){
                # Template du compte ETUDIANT dans le CSV:
                # ID;PRENOM;NOM;FILIERE;GROUPE;MAIL;TELEPHONE;ADRESSE;MDP;RANDOM_STRING;<SI IMAGE -> 'LINK' ELSE -> None
                $compte = $_POST['input_id'] . ";" . $_POST['input_prenom'] . ";" . $_POST['input_nom'] . ";" .
                    $_POST['input_filiere'] . ";" . $_POST['input_groupe'] . ";" . $_POST['input_mail'] . ";" .
                    $_POST['input_tel'] . ";" . $_POST['input_adresse'] . ";" . $mdp . ";" . $random_string;

                if ($_FILES["input_pp"]['name'] != ""){
                    $type = rtrim(explode("/", $_FILES['input_pp']['type'])[1]);
                    $new_name = $_POST['input_id'] . "." . $type;
                    $dir = "../../trombi-etu/images_etu/" . $new_name;

                    $size = getimagesize($_FILES['input_pp']['tmp_name']);

                    if (($size[0] < 160 || $size[0] > 175) || ($size[1] < 160 || $size[1] > 175)){
                        header('Location: ../../trombi-etu/index.php?error=1.2');
                        return;
                    }
                    else{
                        move_uploaded_file($_FILES['input_pp']['tmp_name'], $dir);
                        $compte = $compte . ";images_etu/$new_name" . "\n";
                    }
                }
                else{
                    header('Location: ../../trombi-etu/index.php?error=1.3');
                    return;
                }

                saveLog(["../../trombi-etu/files/logs_etu.json"], "Inscription: " . $_POST['input_id'], "Inscription");
            }
            else{
                header("Location: ../../trombi-etu/index.php?error=1.1");
                return;
            }
        }
        else{
            if (checkID($_POST['filename'])){
                # Template du compte ADMINISTRATION dans le CSV:
                # ID;PRENOM;NOM;MAIL;MDP
                $compte = $_POST['input_id'] . ";" . $_POST['input_prenom'] . ";" . $_POST['input_nom'] . ";" .
                    $_POST['input_mail'] . ";" . $mdp . ";" . $random_string . "\n";
            }
            else{
                header("Location: ../../trombi-admin/index.php?error=1.1");
                return;
            }
        }

        $array_compte = file($_POST['filename']);
        $array_compte[] = $compte;

        sort($array_compte, SORT_STRING);

        $fichier = fopen($_POST['filename'], "w");
        foreach ($array_compte as $compte){
            fwrite($fichier, $compte);
        }
        fclose($fichier);

        if ($_POST['type'] == 'etudiant'){
            header('Location: ../../trombi-etu/index.php');
        }
        else{
            header('Location: ../../trombi-admin/index.php');
        }
    }

    getInfosInscription();
?>
