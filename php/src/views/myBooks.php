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
    $books = Book::getBookByIdUser(unserialize($_SESSION['userLogin'])->getId());
    include_once "../header.php";

    echo "<table>";
    echo "<tr><td>Id</td><td>IdUser</td><td>IdModule</td><td>Publisher</td><td>Price</td><td>Pages</td><td>Status</td><td>Comments</td><td>SoldDate</td><td>Photo</td></tr>";
    if(!empty($books)){
        foreach ($books as $book){
            $module = Module::getModuleCode($book->getIdModule());
            $user = User::getUserId($book->getIdUser());
            echo '<tr><td>'. $book->getId(). '</td><td>'. $user->getNick(). '</td><td>'. $module->getCliteral(). '</td><td>'. $book->getPublisher(). '</td>
                <td>'. $book->getPrice(). ' €</td><td>'. $book->getPages(). ' paginas</td><td>'. $book->getStatus(). '</td><td>'. $book->getComments(). '</td>
                <td>'. $book->getSoldDateForm(). '</td><td><img src="../'. $book->getPhoto(). '" width="100" height="100"></td>
                <td><a href="../modifyBook.php?id='. $book->getId(). '">Modificar</a><a href="../deleteBook.php?id='. $book->getId(). '">Eliminar</a></td></tr>';
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