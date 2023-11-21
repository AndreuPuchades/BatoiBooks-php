<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/load.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Home</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f2f2f2;
        }

        #mostrar, #modificar, #eliminar {
            background-color: #555;
            color: white;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
        }

        #header {
            background-color: #2380ec;
            color: #acecb6;
            padding: 10px;
        }

        #header a {
            color: #fff;
            text-decoration: none;
            margin-right: 10px;
        }

        #header a:hover {
            color: #333333;
        }

        #user {
            font-weight: bold;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: #fff;
        }

        table, th, td {
            border: 1px solid #c7d4e9;
        }

        th, td {
            padding: 8px;
            text-align: left;
        }

        tr:nth-child(even) {
            background-color: #e1e8f7;
        }

        tr:hover {
            background-color: #d4e2f4;
        }

        h3 {
            color: #1a73e8;
        }

        img {
            display: block;
            margin: auto;
        }
    </style>
</head>
<body>
<?php
use BatBook\Course;
use BatBook\Family;
use BatBook\User;

if(isset($_SESSION['userLogin'])){
    $courses = Course::getCoursesAll();
    include_once "../header.php";
    $idUser = unserialize($_SESSION['userLogin'])->getId();
    $user = User::getUserId($idUser);
    echo "<table>";
    echo "<tr><td>Id</td><td>Cycle</td><td>Familia</td><td>VLiteral</td><td>Cliteral</td><td>Acciones</td></tr>";
    if(!empty($courses)){
        foreach ($courses as $course){
            $family = Family::getFamilyById($course->getIdFamily());
            echo '<tr><td>'. $course->getId(). '</td><td>'. $course->getCycle(). '</td><td>'. $family->getCliteral(). '</td><td>'. $course->getVliteral(). '</td><td>'. $course->getCliteral(). '</td>';
            if($user->getAdministrador()){
                echo '<td><a id="mostrar" href="../course.php?id='. $course->getId(). '">Mostrar</a><a id="modificar" href="../editCourse.php?id='. $course->getId(). '">Modificar</a><a id="eliminar" href="../deleteCourse.php?id='. $course->getId(). '">Eliminar</a></td></tr>';
            } else {
                echo '<td>No eres administrador</td></tr>';
            }
        }
        echo "</table></div>";
    } else {
        echo "<h3>No existes courses.</h3>";
    }
} else {
    header("Location: ../login.php");
}
?>
</body>
</html>