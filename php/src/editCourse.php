<?php
use BatBook\Course;

include_once "./load.php";
if (isset($_SESSION['userLogin'])) {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        extract($_POST);

        if (!empty($_POST["cycle"])) {
            if(strlen($_POST["cycle"]) > 50){
                $errors["cycle"] = "El camp cycle te mes de 50 caracters.";
            }
        } else {
            $errors["cycle"] = "El camp cycle és obligatori.";
        }

        if (!empty($_POST["cliteral"])) {
            if(strlen($_POST["cliteral"]) > 100){
                $errors["cliteral"] = "El camp cliteral te mes de 100 caracters.";
            }
        } else {
            $errors["cliteral"] = "El camp cliteral és obligatori.";
        }

        if (!empty($_POST["vliteral"])) {
            if(strlen($_POST["vliteral"]) > 100){
                $errors["vliteral"] = "El camp vliteral te mes de 100 caracters.";
            }
        } else {
            $errors["vliteral"] = "El camp vliteral és obligatori.";
        }

        if(empty($errors)){
            $book = new Course($_POST["id"], $_POST["cycle"], $_POST["idFamily"], $_POST["vliteral"], $_POST["cliteral"]);
            Course::update($book);
            header("Location: courses.php");
        } else {
            $id = $_POST["id"];
            $course = Course::getCourseId($id);
            if($course){
                include_once "./views/editCourse.php";
                return;
            }
        }
    } else {
        $errors = [];
        if($_SERVER['REQUEST_METHOD'] == 'GET'){
            extract($_GET);
            $id = $_GET["id"];
            $course = Course::getCourseId($id);
            if($course) {
                include_once "./views/editCourse.php";
                return;
            }
        }

        include_once "./courses.php";
    }
} else {
    header("Location: login.php");
}