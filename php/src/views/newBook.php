<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        .error {
            color: red;
        }
    </style>
</head>
<body>
<form method="post" action="../newBookForm.php">
    <div class="form-group row">
        <label for="url" class="col-4 col-form-label">Mòdul: </label>
        <div class="col-8">
            <select name="module" id="module" class="form-select" multiple="false">
                <?php
                foreach ($modulesOptions as $value) {?>
                    <option value="<?= $value->getCode()?>"><?= $value->getCliteral()?></option>
                    <?php
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
                <input id="publisher" name="publisher" placeholder="Escriu la editorial" type="text" class="form-control">
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
                <input id="price" name="price" placeholder="Escriu el preu" type="text" class="form-control">
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
                <input id="pages" name="pages" placeholder="Escriu les pagines" type="text" class="form-control">
            </div>
        </div>
    </div>
    <?php printErrors($errors, 'pages') ?>

    <div class="form-group row">
        <label for="url" class="col-4 col-form-label">Estat: </label>
        <div class="col-8">
            <select id="status" name="status" class="form-select" multiple="false">
                <?php
                foreach ($statusOptions as $value) {?>
                    <option value="<?= $value?>"><?= $value?></option>
                    <?php
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
                <input type="file" name="photo" id="photo" class="form-control" accept="image/*">
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
                <input id="comments" name="comments" placeholder="Escriu un comentari" type="text" class="form-control">
            </div>
        </div>
    </div>
    <?php printErrors($errors, 'comments') ?>

    <div class="form-group row">
        <div class="offset-4 col-8">
            <button name="submit" type="submit" class="btn btn-primary">Submit</button>
        </div>
    </div>
</form>
</body>
</html>