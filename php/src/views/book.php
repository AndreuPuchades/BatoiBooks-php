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

        .detalls {
            width: 50%;
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
            max-width: 100%;
            height: auto;
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
<div class="detalls">
    <h3>Modul -> <?= $book->getIdModule() ?></h3>
    <p>Id Usuari -> <?= $book->getIdUser() ?></p>
    <p>Editorial -> <?= $book->getPublisher() ?></p>
    <p>Venido -> <?= ($book->getSoldDate())?'Si':'NO' ?></p>
    <p>Preu -> <?= $book->getPrice() ?></p>
    <p>Pagines -> <?= $book->getPages() ?></p>
    <p>Estat -> <?= $book->getStatus() ?></p>
    <p>Comentari -> <?= $book->getComments() ?></p>
    <a href="../index.php">Home</a>
</div>
<div class="col-6">
    <img src="<?= $book->getPhoto() ?>" alt="Photo:"/>
</div>
</body>
</html>