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

        #modificar, #eliminar {
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
use BatBook\Book;
use BatBook\Module;
use BatBook\User;
if(isset($_SESSION['userLogin'])){
    $books = Book::getAllBooks();
    include_once "../header.php";
    $idUser = unserialize($_SESSION['userLogin'])->getId();

    echo "<table>";
    echo "<tr><td>Usuario</td><td>Modulo</td><td>Editorial</td><td>Precio</td><td>Páginas</td><td>Estado</td><td>Comentario</td><td>Fecha de Venta</td><td>Photo</td><td>Acciones</td></tr>";
    if(!empty($books)){
        foreach ($books as $book){
            $module = Module::getModuleCode($book->getIdModule());
            $user = User::getUserId($book->getIdUser());
            echo '<tr><td>'. $user->getNick(). '</td><td>'. $module->getCliteral(). '</td><td>'. $book->getPublisher(). '</td>
                <td>'. $book->getPrice(). ' €</td><td>'. $book->getPages(). ' paginas</td><td>'. $book->getStatus(). '</td><td>'. $book->getComments(). '</td>
                <td>'. $book->getSoldDateForm(). '</td><td><img src="../'. $book->getPhoto(). '" width="100" height="100"></td>';
            if($idUser === $user->getId()){
                echo '<td><a id="modificar" href="../editBook.php?id='. $book->getId(). '">Modificar</a><a id="eliminar" href="../deleteBook.php?id='. $book->getId(). '">Eliminar</a></td></tr>';
            } else {
                echo '<td>No eres el dueño</td></tr>';
            }
        }
        echo "</table></div>";
    } else {
        echo "<h3>No existes libros.</h3>";
    }
} else {
    header("Location: ../login.php");
}
?>
</body>
</html>