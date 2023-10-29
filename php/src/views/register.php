<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulari de Registre</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        form {
            background-color: #ffffff;
            border: 1px solid #ccc;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 400px;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        input[type="submit"],
        a {
            background-color: #007BFF;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            font-weight: bold;
        }

        .error {
            color: red;
            font-size: 12px;
            margin-top: 5px;
        }
    </style>
</head>
<body>
<form action="../register.php" method="post">
    <div>
        <label for="nick">Nick:</label>
        <input type="text" id="nick" name="nick" >
    </div>
    <?php printErrors($errors, 'nick'); ?>
    <div>
        <label for="email">Correu electrònic:</label>
        <input type="email" id="email" name="email" >
    </div>
    <?php printErrors($errors, 'email'); ?>
    <div>
        <label for="password">Contrasenya:</label>
        <input type="password" id="password" name="password"  minlength="8" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}">
    </div>
    <?php printErrors($errors, 'password'); ?>
    <div>
        <label for="confirm_password">Repeteix la Contrasenya:</label>
        <input type="password" id="confirm_password" name="confirm_password"  minlength="8" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}">
    </div>
    <?php printErrors($errors, 'confirm_password'); ?>
    <input type="submit" value="Registre">
    <a href="../index.php">Home</a>
</form>
</body>
</html>