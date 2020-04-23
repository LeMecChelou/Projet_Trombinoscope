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
            $array_etu['IMAGE'] = "benjamin-guirlet.alwaysdata.net/trombi-etu/" . $etudiant[9];
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


    function getFiliere($etudiants, $filiere, $groupes, $groupeOnly){
        $array_filiere = array();
        $filiere = strtoupper($filiere);

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
                    $data[$filiere] = getFiliere($etudiants, $filiere, $groupes, true);
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
                    $data[$filiere] = getFiliere($etudiants, $filiere, $groupes, $group_only);
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
        }

        return json_encode($data);
    }


function checkAPIKey(){
    if (isset($_GET['key'])){
        $fichier = file("../files/api_keys.csv");

        for ($k = 0; $k < sizeof($fichier); $k++){
            $key = explode(";", rtrim($fichier[$k]))[1];

            if ($key == $_GET['key']){
                return generateJSON();
            }
        }

        $data = array();
        $data['Error'] = "La clé d'API n'existe pas.";
        return json_encode($data);
    }
    else{
        $data = file_get_contents("../files/helpApi.json");
        return $data;
    }
}
    header('Content-type: application/json');
    $data = checkAPIKey();
    echo $data;
?>
