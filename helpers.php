<?php

use PuzzleResolver\Node;

function serializeState(array $state): string
{
  return  md5(json_encode($state));
}

function printTree(Node $node, int $level = 0)
{
  if ($node === null) return;

  echo "Nodo {$node->id}\nNivel: $level\nNodo pai: " . $node->parent->id . "\n";
  echo "\n";
  $node->puzzle->printCurrentState();
  echo "\n";
  foreach ($node->children as $child) {
    printTree($child, $level + 1);
  }
}
