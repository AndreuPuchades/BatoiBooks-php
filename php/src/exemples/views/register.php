<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulari de Registre</title>
</head>
<body>
<form action="../../exemples/registrer.php" method="post">
    <div>
        <label for="nick">Nick:</label>
        <input type="text" id="nick" name="nick" required>
    </div>
    <?php printErrors($errors, 'nick'); ?>
    <div>
        <label for="email">Correu electrònic:</label>
        <input type="email" id="email" name="email" required>
    </div>
    <?php printErrors($errors, 'email'); ?>

    <div>
        <label for="password">Contrasenya:</label>
        <input type="password" id="password" name="password" required minlength="8" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}">
    </div>
    <?php printErrors($errors, 'password'); ?>

    <div>
        <label for="confirm_password">Repeteix la Contrasenya:</label>
        <input type="password" id="confirm_password" name="confirm_password" required minlength="8" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}">
    </div>
    <?php printErrors($errors, 'confirm_password'); ?>

    <input type="submit" value="Registre">
</form>
</body>
</html>

