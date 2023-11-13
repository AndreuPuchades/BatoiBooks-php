<?php
include_once "load.php";
use BatBook\Book;
use Dompdf\Dompdf;

$id = $_GET["bookId"] ?? null;
$book = Book::getBookById($id);
if($book){
    $pdf = new DOMPDF();
    $pdf->loadHtml($book);
    $pdf->setPaper("A4", "landscape");
    $pdf->render();
    $pdf->stream();
} else {
    header("Location: errors/not-found.php");
    exit();
}