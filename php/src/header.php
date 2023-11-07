<div id="header">
    <?php
    if (isset($_SESSION['userLogin'])) {
        echo 'Hola, <span id="user">' . unserialize($_SESSION['userLogin'])->getNick() . '</span> &nbsp&nbsp| &nbsp&nbsp';
        echo '<a href="../newBookForm.php">Nuevo Libro</a> | &nbsp&nbsp';
        echo '<a href="myBooks.php">Listado Libros</a> | &nbsp&nbsp';
        echo '<a href="../logout.php">Logout</a>';
    } else {
        echo '<a href="login.php">Login</a> | &nbsp&nbsp';
        echo '<a href="register.php"> Register</a>';
    }
    ?>
</div>