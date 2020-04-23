<?php
    function getStudent($etudiant){
        $array_etu = array();

        $array_etu['ID'] = $etudiant[0];
        $array_etu['PRENOM'] = $etudiant[1];
        $array_etu['NOM'] = $etudiant[2];
        $array_etu['FILIERE'] = $etudiant[3];
        $array_etu['GROUPE'] = $etudiant[4];
        $array_etu['MAIL'] = $etudiant[5];
        $array_etu['TELEPHONE'] = $etudiant[6];
        $array_etu['ADRESSE'] = $etudiant[7];
        if ($etudiant[8] != "None"){
            $array_etu['IMAGE'] = "benjamin-guirlet.alwaysdata.net/trombi-etu/" . $etudiant[8];
        }
        else{
            $array_etu['IMAGE'] = "benjamin-guirlet.alwaysdata.net/trombi-etu/assets/none_pp.png";
        }

        return $array_etu;
    }


    function getGroup($etudiants, $groupe){
        $array_groupe = array();

        for ($k = 0; $k < sizeof($etudiants); $k++){
            $ligne = explode(";", rtrim($etudiants[$k]));

            if ($ligne[4] == $groupe){
                $array_groupe[] = getStudent($ligne);
            }
        }

        return $array_groupe;
    }


    function getFiliere($etudiants, $filiere, $groupes, $getEtu){
        // $getEtu -> True: les étudiants seront affichés, False: non.
        $array_filiere = array();
        $filiere = strtoupper($filiere);

        foreach($groupes as $groupe){
            $array_filiere[$groupe] = getGroup($etudiants, $groupe);
        }

        return $array_filiere;
    }


    function generateJSON(){

        $etudiants = file("../files/etudiants.csv");

        if (isset($_GET['all'])){
            if ($_GET['all'] == '1'){
                // Récupération des filières.
                $data = array();

                $filieres = file_get_contents("../files/filieres.json");
                $filieres = json_decode($filieres);

                foreach ($filieres as $filiere => $groupes){
                    $data[$filiere] = getFiliere($etudiants, $filiere, $groupes, true);
                }
            }
        }

        // Affichage du JSON.
        $data = json_encode($data);
        header("Content-type: application/json");
        echo $data;
    }


function checkAPIKey(){
    if (isset($_GET['key'])){
        $fichier = file("../files/api_keys.csv");

        for ($k = 0; $k < sizeof($fichier); $k++){
            $key = explode(";", rtrim($fichier[$k]))[1];

            if ($key == $_GET['key']){
                generateJSON();
                return;
            }
        }

        $json_error = file_get_contents("../files/errorAPI.json");
        echo $json_error;
    }
    else{
        $json = file_get_contents("../files/helpApi.json");
        echo $json;
    }
}
    header('Content-type: application/json');
    checkAPIKey();
?>
