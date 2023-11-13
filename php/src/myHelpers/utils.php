<?php
function printErrors($errors, $field){
    if(isset($errors[$field])){
        echo '<span class="error">'. $errors[$field]. '</span>';
    }
}

function loadView($view, $data = []){
    extract($data);
    include_once $_SERVER["DOCUMENT_ROOT"]."/view/$view/.view.php";
}