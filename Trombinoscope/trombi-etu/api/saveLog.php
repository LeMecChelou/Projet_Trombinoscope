<?php
    function saveLog($log, $array_files){
        $log['Year'] = intval(date('Y'));
        $log['Month'] = intval(date('m'));
        $log['Day'] = intval(date('d'));
        $log['Hour'] = intval(date('H') + 2);
        $log['Minute'] = intval(date('i'));
        $log['Second'] = intval(date('s'));


        foreach ($array_files as $file){
            $fichier = json_decode(file_get_contents($file));
            $fichier[] = $log;
            file_put_contents($file, json_encode($fichier), LOCK_EX);
        }
    }
?>