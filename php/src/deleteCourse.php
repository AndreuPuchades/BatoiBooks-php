<?php
include_once "load.php";
use BatBook\Course;

if (isset($_SESSION['userLogin'])) {
    if($_SERVER['REQUEST_METHOD'] == 'GET'){
        extract($_GET);
        $idCourse = $_GET["id"];
        Course::delete($idCourse);
    }
    header("Location: courses.php");
} else {
    header("Location: login.php");
}