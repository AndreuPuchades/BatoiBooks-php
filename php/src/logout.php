<?php
include_once "./load.php";
unset($_SESSION["userLogin"]);
header("Location: index.php");