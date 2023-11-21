<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exercici 2 - BatoiBook</title>
    <style>
        table {
            width: 50%;
            margin: 20px auto;
        }

        td {
            border: solid black;
            text-align: center;
        }

        td.blue {
            color: blue;
        }

        td.red {
            color: red;
        }
    </style>
</head>
<body>
<?php
function generaMatriu($files, $columnes) {
    $matriu = [];
    for ($i = 0; $i < $files; $i++) {
        for ($j = 0; $j < $columnes; $j++) {
            $matriu[$i][$j] = rand(1, 500);
        }
    }
    return $matriu;
}

function printCela($num) {
    echo '<td class="'. ($num % 2 === 0 ? 'blue' : 'red'). '">'. $num. '</td>';
}
?>

<table>
    <?php
    $matriu = generaMatriu(10, 10);
    $sumaFila = 0;
    for ($i = 0; $i < count($matriu); $i++) {
        echo '<tr>';
        for ($j = 0; $j < count($matriu[$i]); $j++) {
            $sumaFila += $matriu[$i][$j];
            printCela($matriu[$i][$j]);
        }
        printCela($sumaFila);
        $sumaFila = 0;
        echo '</tr>';
    }

    for ($j = 0; $j < count($matriu[0]); $j++) {
        $sumaColumna = 0;
        for ($i = 0; $i < count($matriu); $i++) {
            $sumaColumna += $matriu[$i][$j];
        }
        printCela($sumaColumna);
    }
    echo '<td>SUMAS</td>';
    ?>
</table>
</body>
</html>