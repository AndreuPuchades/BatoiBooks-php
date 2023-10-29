<?php
function autoLoad() {
    include ('./views/newBook.php');
    include ('./newBookForm.php');
}

spl_autoload_register('autoLoad');
session_start();
$session_vars = ['users', 'books', 'modules', 'courses', 'statuses'];

foreach ($session_vars as $session_var) {
    if (isset($_SESSION[$session_var])) {
        $$session_var = unserialize($_SESSION[$session_var]);
    } else {
        $_SESSION[$session_var] = serialize([]);
    }
}

if(isset($_SESSION['userLogin'])){
    $_SESSION['userLogin'] = [];
}

/*
foreach ($session_vars as $session_var) {
    if (isset($_SESSION[$session_var])) {
        $$session_var = unserialize($_SESSION[$session_var]);
    } else {
        if($session_var == 'users'){
            $users = [];
        } else if ($session_var == 'books'){
            $books = [];
        } else if ($session_var == 'modules'){
            $modules = [];
        } else if ($session_var == 'courses'){
            $courses = [];
        } else if($session_var == 'statuses'){
            $statuses = [];
        }

        $_SESSION[$session_var] = serialize($$session_var);
    }
}
*/