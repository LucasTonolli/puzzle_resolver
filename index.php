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
use PuzzleResolver\Node;
use PuzzleResolver\Puzzle;
use PuzzleResolver\Tree;

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

$node = new Node(null, $puzzle);
$tree = new Tree($node);
$idCounter = 1;
for ($i = 1; $i <= 2; $i++) {
    echo "<h1>Rodada $i:</h1>\n";
    echo "<pre>\n";
    foreach ($puzzle::MOVES as $move) {
        try {
            $newState = new Puzzle($tree->currentNode->puzzle->getState());
            $newState->movePiece($move);
            $node = new Node($tree->currentNode, $newState);
            $node->id = $idCounter++;
            $tree->insertNode($node);
        } catch (Exception $e) {
            echo $e->getMessage() . "\n";
        }
    }
    printTree($tree->currentNode, 0);

    $tree->setCurrentNode($tree->currentNode->children[0]);

    echo "</pre>\n\n\n";
}
