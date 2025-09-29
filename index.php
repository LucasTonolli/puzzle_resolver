<?php
ini_set('display_errors', 'Off'); // Disable displaying errors on the page
ini_set('log_errors', 'On');     // Enable error logging
ini_set('error_log', 'debug.log');
ini_set('memory_limit', '256M');
set_time_limit(180);

require_once "Puzzle.php";
require_once "Tree.php";
require_once "Node.php";
require_once "helpers.php";
require_once "BreadthSearch.php";
require_once "BetterChoiceSearch.php";

use PuzzleResolver\BetterChoiceSearch;
use PuzzleResolver\BreadthSearch;
use PuzzleResolver\Puzzle;


$initialState = [
    [5, 1, 3, 4],
    [9, 0, 6, 8],
    [13, 2, 7, 12],
    [14, 10, 11, 15]
];

$goalState = [
    [1, 2, 3, 4],
    [5, 6, 7, 8],
    [9, 10, 11, 12],
    [13, 14, 15, 0]
];
$puzzle = new Puzzle($initialState);

echo "<h1>Estado inicial:</h1>\n";
echo "<pre>\n";
$puzzle->printCurrentState();
echo "</pre>\n\n\n";

echo "<h1>Busca melhor escolha (A*):</h1>\n\n\n";
BetterChoiceSearch::search($puzzle, $goalState);

// echo "<h1>Busca em largura (BFS):</h1>\n\n\n";
// BreadthSearch::search($puzzle, $goalState);
