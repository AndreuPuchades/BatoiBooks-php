<?php
function printErrors($errors, $field){
    if(isset($errors[$field])){
        echo '<span class="error">'. $errors[$field]. '</span>';
    }
}