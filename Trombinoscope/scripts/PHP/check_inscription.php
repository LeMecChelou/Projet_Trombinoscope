<?php
    function getInfosInscription(){
        $mdp = hash('sha256', $_POST['input_mdp']);

        if ($_POST['type'] == 'etudiant') {
            # Template du compte ETUDIANT dans le CSV:
            # ID;PRENOM;NOM;FILIERE;GROUPE;MAIL;TELEPHONE;ADRESSE;MDP;<SI IMAGE -> 'LINK' ELSE -> None
            $compte = $_POST['input_id'] . ";" . $_POST['input_prenom'] . ";" . $_POST['input_nom'] . ";" .
                $_POST['input_filiere'] . ";" . $_POST['input_groupe'] . ";" . $_POST['input_mail'] . ";" .
                $_POST['input_tel'] . ";" . $_POST['input_adresse'] . ";" . $mdp . ";None\n";
        }
        else{
            # Template du compte ADMINISTRATION dans le CSV:
            # ID;PRENOM;NOM;MAIL;MDP
            $compte = $_POST['input_id'] . ";" . $_POST['input_prenom'] . ";" . $_POST['input_nom'] . ";" .
                $_POST['input_mail'] . ";" . $mdp . "\n";
        }




        file_put_contents($_POST['filename'], $compte, FILE_APPEND);

        if ($_POST['type'] == 'etudiant'){
            header('Location: ../../trombi-etu/index.php');
        }
        else{
            header('Location: ../../trombi-admin/index.php');
        }
    }

    getInfosInscription();
?>
