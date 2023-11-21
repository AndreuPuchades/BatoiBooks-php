<?php
use BatBook\Course;

include_once "./load.php";
if (isset($_SESSION['userLogin'])) {
    if($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET["id"])){
        extract($_GET);
        $id = $_GET["id"];
        $course = Course::getCourseId($id);
        if($course) {
            include_once "./views/course.php";
            return;
        } else {
            header("Location: courses.php");
        }
    } else {
        header("Location: courses.php");
    }
} else {
    header("Location: login.php");
}