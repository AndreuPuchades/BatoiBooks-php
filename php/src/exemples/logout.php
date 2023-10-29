<?php
include_once ('./load.php');
if($_SESSION['userLogin'] == []){
    unset($_SESSION['userLogin']);
} else {
    echo '<p>No estas registrado</p>';
}