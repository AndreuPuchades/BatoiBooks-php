<?php
use BatBook\Family;
?>

<!DOCTYPE html>
<html lang="ca">
<head>
    <title>Login</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .course{
            width: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .detalls {
            width: 100%;
            padding: 20px;
            box-sizing: border-box;
            background-color: #fff;
            margin: 20px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
            border-radius: 10px;
        }

        h2 {
            font-size: 24px;
            color: #333;
            margin: 0;
        }

        h4 {
            font-size: 18px;
            color: #555;
        }

        h6 {
            font-size: 14px;
            color: #777;
        }

        a {
            background-color: #007BFF;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            font-weight: bold;
        }
    </style>
</head>
<body>
<div class="course">
    <div class="detalls">
        <h2>Id -> <?= $course->getId() ?></h2>
        <h4>Family -> <?= Family::getFamilyById($course->getIdFamily())->getCliteral()?></h4>
        <h4>Cycle -> <?= $course->getCycle() ?></h4>
        <h4>Cliteral -> <?= ($course->getCliteral())?></h4>
        <h4>Vliteral -> <?= $course->getVliteral() ?></h4>
        <a href="../courses.php">Llista Cicles</a>
    </div>
</div>
</body>
</html>