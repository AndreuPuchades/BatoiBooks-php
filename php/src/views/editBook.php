<?php
use BatBook\exceptions\InvalidFormatException;
use BatBook\Module;

try {
    $modulesOptions = Module::getModulesInArray();
    $statusOptions = ['Good', 'Bad', 'Used', 'New'];
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
<form method="post" action="../editBook.php" enctype="multipart/form-data">
    <input type="hidden" id="id" name="id" value="<?= $book->getId() ?>">
    <div class="form-group row">
        <label for="url" class="col-4 col-form-label">Mòdul: </label>
        <div class="col-8">
            <select name="module" id="module" class="form-select" multiple="false">
                <?php
                foreach ($modulesOptions as $value) {
                    if($value->getCode() == $book->getIdModule()){
                        ?>
                        <option value="<?= $value->getCode()?>" selected><?= $value->getCliteral()?></option>
                        <?php
                    } else {
                        ?>
                        <option value="<?= $value->getCode()?>"><?= $value->getCliteral()?></option>
                        <?php
                    }
                }
                ?>
            </select>
        </div>
    </div>

    <div class="form-group row">
        <label for="email" class="col-4 col-form-label">Editorial: </label>
        <div class="col-8">
            <div class="input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <i class="fa fa-envelope-open-o"></i>
                    </div>
                </div>
                <input id="publisher" name="publisher" value="<?= $book->getPublisher() ?>" placeholder="Escriu la editorial" type="text" class="form-control">
            </div>
        </div>
    </div>
    <?php printErrors($errors, 'publisher') ?>

    <div class="form-group row">
        <label for="url" class="col-4 col-form-label">Precio: </label>
        <div class="col-8">
            <div class="input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <i class="fa fa-envelope-open-o"></i>
                    </div>
                </div>
                <input id="price" name="price" value="<?= $book->getPrice() ?>" placeholder="Escriu el preu" type="number" class="form-control">
            </div>
        </div>
    </div>
    <?php printErrors($errors, 'price') ?>

    <div class="form-group row">
        <label for="url" class="col-4 col-form-label">Pàgines: </label>
        <div class="col-8">
            <div class="input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <i class="fa fa-envelope-open-o"></i>
                    </div>
                </div>
                <input id="pages" name="pages" value="<?= $book->getPages() ?>" placeholder="Escriu les pagines" type="number" class="form-control">
            </div>
        </div>
    </div>
    <?php printErrors($errors, 'pages') ?>

    <div class="form-group row">
        <label for="url" class="col-4 col-form-label">Estat: </label>
        <div class="col-8">
            <select id="status" name="status" class="form-select" multiple="false">
                <?php
                foreach ($statusOptions as $value) {
                    if($value == $book->getStatus()){
                        ?>
                        <option value="<?= $value?>" selected><?= $value?></option>
                        <?php
                    } else {
                        ?>
                        <option value="<?= $value?>"><?= $value?></option>
                        <?php
                    }
                }
                ?>
            </select>
        </div>
    </div>
    <?php printErrors($errors, 'status') ?>

    <div class="form-group row">
        <label for="url" class="col-4 col-form-label">Foto: </label>
        <div class="col-8">
            <div class="input-group">
                <input type="file" name="photo" value="<?= $book->getPhoto() ?>" id="photo" class="form-control" accept="image/*">
            </div>
        </div>
    </div>
    <?php printErrors($errors, 'photo') ?>

    <div class="form-group row">
        <label for="url" class="col-4 col-form-label">Comentari: </label>
        <div class="col-8">
            <div class="input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <i class="fa fa-envelope-open-o"></i>
                    </div>
                </div>
                <input id="comments" name="comments" value="<?= $book->getComments() ?>" placeholder="Escriu un comentari" type="text" class="form-control">
            </div>
        </div>
    </div>
    <?php printErrors($errors, 'comments') ?>

    <div class="form-group row">
        <div class="offset-4 col-8">
            <button name="submit" type="submit" class="btn btn-primary">Submit</button>
            <a href="../index.php">Home</a>
        </div>
    </div>
</form>
</body>
</html>