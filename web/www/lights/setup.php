<?php

function getRandomInitialIndexes($rows, $cols) {
    $totalBoxes = $rows * $cols;
    $indexArray = range(0, $totalBoxes - 1);
    shuffle($indexArray);

    // Extract the first 10 elements from the shuffled array
    $randomIndexes = array_slice($indexArray, 0, 10);

    return $randomIndexes;
}



if (isset($_GET['rows']) && isset($_GET['cols'])) {
    $rows = intval($_GET['rows']);
    $cols = intval($_GET['cols']);

    $selectedIndexes = getRandomInitialIndexes($rows, $cols);

    header('Content-Type: application/json');
    echo json_encode($selectedIndexes);
} else {
    http_response_code(400);
}
