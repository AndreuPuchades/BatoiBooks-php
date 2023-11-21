<?php
use BatBook\exceptions\InvalidFormatException;
use BatBook\Family;

try {
    $family = Family::getFamilyById($course->getIdFamily());
} catch (InvalidFormatException | Exception $e) {
    echo $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        form {
            width: 70%;
            max-width: 600px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .col-form-label {
            font-weight: bold;
        }

        input[type="text"],
        input[type="number"],
        select,
        input[type="file"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        .input-group {
            display: flex;
        }

        .input-group-prepend {
            width: 30px;
            background-color: #eee;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1px solid #ccc;
            border-right: none;
            border-radius: 4px 0 0 4px;
        }

        .input-group-text {
            color: #777;
        }

        input[type="file"] {
            padding: 10px;
        }

        .btn-primary, a {
            background-color: #007bff;
            color: #fff;
            padding: 12px 24px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .error {
            color: red;
            font-size: 14px;
            margin-top: 5px;
        }

        .form-group.row::after {
            content: "";
            display: table;
            clear: both;
        }

        .col-4 {
            width: 30%;
            float: left;
            text-align: right;
            padding-top: 10px;
        }

        .col-8 {
            width: 70%;
            float: left;
        }

        input:focus,
        select:focus {
            border-color: #007bff;
            outline: none;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
        }

        input[type="file"]:focus {
            border-color: #007bff;
            outline: none;
            box-shadow: none;
        }
    </style>
</head>
<body>
<form method="post" action="../editCourse.php" enctype="multipart/form-data">
    <input type="hidden" id="id" name="id" value="<?= $course->getId() ?>">
    <input type="hidden" id="idFamily" name="idFamily" value="<?= $family->getId() ?>" class="form-control">

    <div class="form-group row">
        <label for="family" class="col-4 col-form-label">Family: </label>
        <div class="col-8">
            <div class="input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <i class="fa fa-envelope-open-o"></i>
                    </div>
                </div>
                <input type="text" id="family" name="family" value="<?= $family->getCliteral() ?>" class="form-control" readonly>
            </div>
        </div>
    </div>

    <div class="form-group row">
        <label for="cycle" class="col-4 col-form-label">Cycle: </label>
        <div class="col-8">
            <div class="input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <i class="fa fa-envelope-open-o"></i>
                    </div>
                </div>
                <input id="cycle" name="cycle" value="<?= $course->getCycle() ?>" placeholder="Escriu el cycle" type="text" class="form-control">
            </div>
        </div>
    </div>
    <?php printErrors($errors, 'cycle') ?>

    <div class="form-group row">
        <label for="cliteral" class="col-4 col-form-label">Cliteral: </label>
        <div class="col-8">
            <div class="input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <i class="fa fa-envelope-open-o"></i>
                    </div>
                </div>
                <input id="cliteral" name="cliteral" value="<?= $course->getCliteral() ?>" placeholder="Escriu el cliteral" type="text" class="form-control">
            </div>
        </div>
    </div>
    <?php printErrors($errors, 'cliteral') ?>

    <div class="form-group row">
        <label for="vliteral" class="col-4 col-form-label">Vliteral: </label>
        <div class="col-8">
            <div class="input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <i class="fa fa-envelope-open-o"></i>
                    </div>
                </div>
                <input id="vliteral" name="vliteral" value="<?= $course->getVliteral() ?>" placeholder="Escriu el vliteral" type="text" class="form-control">
            </div>
        </div>
    </div>
    <?php printErrors($errors, 'vliteral') ?>

    <div class="form-group row">
        <div class="offset-4 col-8">
            <button name="submit" type="submit" class="btn btn-primary">Submit</button>
            <a href="../courses.php">Listado Ciclos</a>
        </div>
    </div>
</form>
</body>
</html>