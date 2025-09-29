<?php

namespace PuzzleResolver;

use Exception;

class BreadthSearch
{
  public static function search(Puzzle $puzzle, array $goalState): void
  {
    $startTime = microtime(true);
    $startMemory = memory_get_usage();
    $goalAchieved = false;
    $idCounter = 0;

    $root = new Node(null, $puzzle);
    $root->id = $idCounter++;
    $tree = new Tree($root);

    $openNodes = [$root];
    $closedNodes = [];



    while (!empty($openNodes) && !$goalAchieved) {
      $tree->setCurrentNode(array_shift($openNodes));
      if ($tree->currentNode->puzzle->getState() == $goalState) {
        $goalAchieved = true;
        echo "<pre>";
        echo "<h1>Encontrado Id do nó: {$tree->currentNode->id}</h1>";
        echo "</pre>";
        break;
      }

      foreach ($puzzle::MOVES as $move) {
        try {
          $newState = new Puzzle($tree->currentNode->puzzle->getState());
          $newState->movePiece($move);
          $node = new Node($tree->currentNode, $newState);
          $node->id = $idCounter++;

          /**
           * Implementação otimizada
           */

          // $key = serializeState($node->puzzle->getState());
          // if (!isset($visited[$key])) {
          //   $visited[$key] = true;
          //   $openNodes[] = $node;
          //   $tree->insertNode($node);
          // }

          //-------------------------------------------------

          /**
           * Implementação original
           */
          $alreadyOpen = false;
          foreach ($openNodes as $n) {
            if ($n->puzzle->getState() === $node->puzzle->getState()) {
              $alreadyOpen = true;
              break;
            }
          }

          $alreadyClosed = false;
          foreach ($closedNodes as $n) {
            if ($n->puzzle->getState() === $node->puzzle->getState()) {
              $alreadyClosed = true;
              break;
            }
          }

          if (!$alreadyOpen && !$alreadyClosed) {
            $openNodes[] = $node;
            $tree->insertNode($node);
          }
        } catch (Exception $e) {
          // echo $e->getMessage() . "\n";
        }
      }
      $closedNodes[] = $tree->currentNode;
      // echo "<pre>";
      // echo "**** OPEN NODES ****\n";
      // echo print_r(array_map(fn($node) => $node->id, $openNodes), true);
      // echo "Quantidade de nós abertos: " . count($openNodes) . "\n";
      // echo "**** CLOSED NODES ****\n";
      // echo print_r(array_map(fn($node) => $node->id, ($closedNodes)), true);
      // echo "Quantidade de nós fechados: " . count($closedNodes) . "\n";
      // echo "</pre>";
    }

    $endTime = microtime(true);
    $endMemory = memory_get_usage();

    echo "<pre>";
    echo "Busca concluída!\n";
    echo "Tempo de execução: " . round($endTime - $startTime, 5) . " segundos\n";
    echo "Uso de memória: " . round(($endMemory - $startMemory) / 1024, 2) . " KB\n";
    echo "</pre>";
    if (!$goalAchieved) {
      echo "<pre>";
      echo "<h1>Sem solução</h1>";
      echo "</pre>";
    }
    echo "<pre>";
    $tree->currentNode->puzzle->printCurrentState();
    // echo print_r($visited, true);
    //printTree($tree->root);
    echo "</pre>";
  }
}
