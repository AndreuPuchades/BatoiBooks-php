<!DOCTYPE html>
<html lang="es">
<?php
extract($_POST);
unset($_POST['submit']);

try {
    $arrayModules = Module::importModuleFromCSV('./csv/modulesbook.csv');
    $arrayCourses = Course::importCourseFromCSV('./csv/coursesbook.csv');
} catch (InvalidFormatException $e) {
    echo $e;
}
?>

<head>
    <title>Buscar Libro</title>
</head>

<body>
<?php
if(isset($_POST["idBook"])){
    ?>
    <form action="book.php" method="post">
        <?php
        echo '<label id="nom">Id del Libro: </label><input type="text" id="idBook" name="idBook"> ';
        ?>
        <input type="submit" name="submit">
    </form>

    <?php
} else {
    $idBook = $_POST["idBook"];
    $arrayBooks = [""]; // Aqui se deberia poner el array de los libros para que lo encuentre, pero no se donde hay que buscarl por que no hay ningun csv de libros.

    for ($i = 0; $i < count($arrayBooks); $i++) {
        if($arrayBooks[$i]["id"] == $idBook){
            echo $arrayBooks[$i];
            return;
        }
    }
    throw new NotFoundException("No existe un libro con la id ". $idBook);
}
?>
</body>
</html>