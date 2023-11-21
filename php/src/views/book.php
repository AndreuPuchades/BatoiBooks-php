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

        img {

            display: block;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            margin-top: 10px;
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
<div class="book">
    <div class="detalls">
        <h3>Modul -> <?= $course->getIdModule() ?></h3>
        <p>Id Usuari -> <?= $course->getIdUser() ?></p>
        <p>Editorial -> <?= $course->getPublisher() ?></p>
        <p>Venido -> <?= ($course->getSoldDate())?'Si':'NO' ?></p>
        <p>Preu -> <?= $course->getPrice() ?></p>
        <p>Pagines -> <?= $course->getPages() ?></p>
        <p>Estat -> <?= $course->getStatus() ?></p>
        <p>Comentari -> <?= $course->getComments() ?></p>
        <a href="../index.php">Home</a>
    </div>
    <div class="col-6">
        <img src="<?= $course->getPhoto() ?>" width="300" height="300">
    </div>
</div>
</body>
</html>