<?php
include_once ("./exceptions/InvalidFormatException.php");
include_once ("./exceptions/WeakPasswordException.php");
include_once('./modelos/Book.php');
include_once('./modelos/User.php');
include_once('./modelos/Course.php');
include_once('./modelos/Module.php');

try {
    $classes = [
    $book = new Book(1, 101, 'Editorial XYZ', 20.99, 300, 'available', 'book.jpg', 'Good book', null),
    $user = new User('user@example.com', 'StrongPassword123', 'JohnDoe'),
    $course = new Course('CycleName', 201, 'VLiteralValue', 'CLiteralValue')
    ];
} catch (WeakPasswordException $e){
    echo '<p>'. $e. '</p>';
}

echo '<p>'. $classes[0]. '</p>';
echo '<p>'. $classes[1]. '</p>';