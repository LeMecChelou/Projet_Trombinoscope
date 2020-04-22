<?php
    session_start();
    function checkPasswordChange(){
        $token = str_replace("\n", "", explode(";", $_SESSION['token'])[1]);
        echo $token;
        if (isset($_POST['verif_mdp'])){

            if ($token == "etudiant"){
                $fichier = file('./files/etudiants.csv');
                $mdp_verif = hash("sha256", $_POST['verif_mdp']);

                for ($k = 0; $k < sizeof($fichier); $k++){
                    $mdp = explode(";", $fichier[$k])[8];
                    if ($mdp == $mdp_verif){
                        changeInformations();
                    }
                }
                header("Location: ../../trombi-etu/etudiant.php?error=2");
            }
            else{
                $fichier = file('./files/administration.csv');
                $mdp_verif = hash("sha256", $_POST['verif_mdp']);

                for ($k = 0; $k < sizeof($fichier); $k++){
                    $mdp = explode(";", $fichier[$k])[6];
                    if ($mdp == $mdp_verif){
                        changeInformations();
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


    function changeInformations(){
        session_start();
        $type = explode(";", $_SESSION['token'])[1];
        $type = str_replace("\n", "", $type);

        echo $type;
        if ($type == 'etudiant'){
            $new_compte = "";

            var_dump($_POST);
            # header('Location: ../../trombi-etu/etudiant.php');
        }
        else{
            header('Location: ../../trombi-admin/administration.php');
        }
    }

    checkPasswordChange();
?>
