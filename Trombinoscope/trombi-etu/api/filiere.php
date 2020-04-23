<?php
    $data = ["Test" => ['test1', 'test2', 'test3' => ['test3test1', 'test3test2']]];
    $data = json_encode($data);
    header("Content-type: application/json");
    echo $data;
?>
