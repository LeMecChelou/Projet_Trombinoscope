<?php
    function getInfosInscription($post){
        $mdp = hash('sha256', $post['input_mdp']);

        # Template du compte dans le CSV:
        # ID;PRENOM;NOM;FILIERE;GROUPE;MAIL;TELEPHONE;ADRESSE;MDP;<SI IMAGE -> 'LINK' ELSE -> None
        $compte = $post['input_id'] . ";" . $post['input_prenom'] . ";" . $post['input_nom'] . ";" . ";" . $post['input_mail'] . ";" . $post['input_tel'] . ";" . $post['input_adresse'] . ";" . $mdp . ";None\n";

        foreach ($post as $var){
            echo $var . "\n";
        }

        # file_put_contents($post['filename'], $compte, FILE_APPEND);
    }

    getInfosInscription($_POST);
?>
