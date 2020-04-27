<?php
    function getStudent($etudiant, $pos){
        $array_etu = array();

        $array_etu['ID'] = $etudiant[0][0] . $pos;
        $array_etu['PRENOM'] = $etudiant[1];
        $array_etu['NOM'] = $etudiant[2];
        $array_etu['FILIERE'] = $etudiant[3];
        $array_etu['GROUPE'] = $etudiant[4];
        $array_etu['MAIL'] = $etudiant[5];
        $array_etu['TELEPHONE'] = $etudiant[6];
        $array_etu['ADRESSE'] = $etudiant[7];
        if ($etudiant[9] != "None"){
            $array_etu['IMAGE'] = "http://benjamin-guirlet.alwaysdata.net/trombi-etu/" . $etudiant[10];
        }
        else{
            $array_etu['IMAGE'] = "benjamin-guirlet.alwaysdata.net/trombi-etu/assets/pp_none.png";
        }

        return $array_etu;
    }


    function getGroup($etudiants, $groupe){
        $array_groupe = array();

        for ($k = 0; $k < sizeof($etudiants); $k++){
            $ligne = explode(";", rtrim($etudiants[$k]));

            if ($ligne[4] == $groupe){
                $array_groupe[] = getStudent($ligne, $k);
            }
        }

        return $array_groupe;
    }


    function getFiliere($etudiants, $groupes, $groupeOnly){
        $array_filiere = array();

        foreach($groupes as $groupe){
            if (!$groupeOnly){
                $array_filiere[$groupe] = getGroup($etudiants, $groupe);
            }
            else{
                $array_filiere[] = $groupe;
            }
        }

        return $array_filiere;
    }


    function generateJSON(){

        $etudiants = file("../files/etudiants.csv");
        $filieres = json_decode(file_get_contents("../files/filieres.json"));
        $data = array();

        // Ressort toutes les filières avec les groupes et les étudiants.
        if (isset($_GET['all'])) {
            if ($_GET['all'] == '1') {

                // Récupération des filières.
                foreach ($filieres as $filiere => $groupes) {
                    $data[$filiere] = getFiliere($etudiants, $groupes, false);
                }

                return json_encode($data);
            }

            $data['Error'] = "La valeur de *all* est fausse (valeur = 1).";
            return json_encode($data);
        }

        // Ressort une filière spécifique avec ou sans les étudiants.
        $group_only = false;
        if (isset($_GET['filiere'])){

            if (isset($_GET['grp'])){
                if ($_GET['grp'] == "1"){
                    $group_only = true;
                }
                else{
                    $data['Error'] = "La valeur de *grp* est fausse (valeur = 1).";
                    return json_encode($data);
                }
            }

            foreach ($filieres as $filiere => $groupes){
                if ($filiere == strtoupper($_GET['filiere'])){
                    $data[$filiere] = getFiliere($etudiants, $groupes, $group_only);
                    return json_encode($data);
                }
            }

            $data['Error'] = "La filière " . $_GET['filiere'] . " n'existe pas.";
            return json_encode($data);
        }

        // Ressort tout les étudiants d'un groupe.
        if (isset($_GET['groupe'])){
            foreach ($filieres as $filiere => $groupes){
                foreach ($groupes as $groupe){
                    if ($groupe == strtoupper($_GET['groupe'])){
                        $data[$groupe] = getGroup($etudiants, $groupe);

                        return json_encode($data);
                    }
                }
            }

            $data['Error'] = "Le groupe " . $_GET['groupe'] . " n'existe pas.";
            return json_encode($data);
        }

        // Ressort tout les étudiants.
        if (isset($_GET['all_etu'])){
            if ($_GET['all_etu'] == "1"){
                for ($k = 0; $k < sizeof($etudiants); $k++){
                    $etudiant = explode(";", rtrim($etudiants[$k]));
                    $data[] = getStudent($etudiant, $k);
                }
                return json_encode($data);
            }

            $data['Error'] = "La valeur de *all_etu* est fausse (valeur = 1).";
            return json_encode($data);
        }

        // Ressort uniquement l'étudiant spécifié.
        if (isset($_GET['etu'])){
            for ($k = 0; $k < sizeof($etudiants); $k++){
                $etudiant = explode(";", rtrim($etudiants[$k]));
                $id = $etudiant[0][0] . $k;

                if ($_GET['etu'] == $id){
                    $data[] = getStudent($etudiant, $k);

                    return json_encode($data);
                }
            }

            $data['Error'] = "L'étudiant " . $_GET['etu'] . " n'existe pas.";
            return json_encode($data);
        }

        // Pour afficher le fichier des logs.
        if (isset($_GET['log'])){
            if ($_GET['log'] == "1"){
                $data = json_decode(file_get_contents("../files/logs_etu.json"));
                return json_encode(array_reverse($data));
            }

            $data['Error'] = "La valeur de *log* est fausse. log => 1.";
            return json_encode($data);
        }

        return file_get_contents("../files/helpApi.json");
    }


    function checkRequestsLimit($fichier, $infos){

        $date = getdate();
        if ($infos[3] != $date['hours'] + 2){
            $infos[3] = $date['hours'] + 2;
            $infos[2] = 0;

            $new_fichier = array();
            $new_fichier[] = $infos;

            for ($k = 0; $k < sizeof($fichier); $k++){

                if ($fichier[$k][0] != $infos[0]){
                    $new_fichier[] = $fichier[$k];
                }
            }

            $fichier = fopen("../files/api_keys.json", "w");
            fwrite($fichier, json_encode($new_fichier));
            fclose($fichier);

            return true;
        }
        else if ($infos[2] < 100){
            $infos[2] += 1;

            $new_fichier = array();
            $new_fichier[] = $infos;

            for ($k = 0; $k < sizeof($fichier); $k++){

                if ($fichier[$k][0] != $infos[0]){
                    $new_fichier[] = $fichier[$k];
                }
            }

            $fichier = fopen("../files/api_keys.json", "w");
            fwrite($fichier, json_encode($new_fichier));
            fclose($fichier);

            return true;
        }

        return false;
    }


    function checkAPIKey(){
        if (isset($_GET['key'])){
            $fichier = json_decode(file_get_contents("../files/api_keys.json"));
            $data = array();

            foreach ($fichier as $infos){
                if (rtrim($infos[1]) == $_GET['key']){
                    $allow = checkRequestsLimit($fichier, $infos);
                    if ($allow){
                        return generateJSON();
                    }
                    else{
                        $data['Error'] = "Vous avez dépassé le nombre de requêtes maximal par heure.";
                        return json_encode($data);
                    }
                }
            }

            $data['Error'] = "La clé d'API n'existe pas.";
            return json_encode($data);
        }
        else{
            $data = file_get_contents("../files/helpApi.json");
            return $data;
        }
    }


    function addLog($request){

        $log = array();

        $log['Action'] = $request;
        $log['Type'] = 'API';

        include("./saveLog.php");
        saveLog($log, ["../files/logs_api.json", "../files/logs_etu.json"]);
    }


    header('Content-type: application/json');
    // Changer ce header pour mettre le CORS uniquement pour le deuxième site.
    header("Access-Control-Allow-Origin: *");
    $data = checkAPIKey();
    echo $data;
?>
