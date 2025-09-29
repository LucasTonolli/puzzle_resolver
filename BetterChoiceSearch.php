<?php

namespace PuzzleResolver;

use Exception;

class BetterChoiceSearch
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
      error_log("Open Nodes: " . count($openNodes));
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

          $alreadyInOpen = false;
          foreach ($openNodes as $openNode) {
            if ($node->puzzle->getState() == $openNode->puzzle->getState()) {
              $alreadyInOpen = true;
              break;
            }
          }

          $alreadyInClosed = false;
          foreach ($closedNodes as $closedNode) {
            if ($node->puzzle->getState() == $closedNode->puzzle->getState()) {
              $alreadyInClosed = true;
              break;
            }
          }

          $node->depth = $tree->currentNode->depth + 1;

          if (!$alreadyInOpen && !$alreadyInClosed) {


            $node->setHeuristicPoints(self::getHeuristicPoints($node->puzzle, $goalState, $tree->currentNode->depth));
            $tree->insertNode($node);
            $openNodes[] = $node;
          } else if ($alreadyInOpen) {
            $tree->insertNode($node);
            $node->setHeuristicPoints(self::getHeuristicPoints($node->puzzle, $goalState, $tree->currentNode->depth));

            foreach ($openNodes as $index => $openNode) {
              if ($node->puzzle->getState() == $openNode->puzzle->getState()) {
                if ($node->heuristicPoints < $openNode->heuristicPoints) {
                  unset($openNodes[$index]);
                  $openNodes[] = $node;
                }
                break;
              }
            }
          } else if ($alreadyInClosed) {

            $node->setHeuristicPoints(self::getHeuristicPoints($node->puzzle, $goalState, $tree->currentNode->depth));
            $tree->insertNode($node);
            foreach ($closedNodes as $index => $closedNode) {

              if ($node->puzzle->getState() == $closedNode->puzzle->getState()) {
                if ($node->heuristicPoints < $closedNode->heuristicPoints) {
                  unset($closedNodes[$index]);
                  $openNodes[] = $node;
                }
                break;
              }
            }
          }
        } catch (Exception $e) {
        }
      }
      $closedNodes[] = $tree->currentNode;
      usort($openNodes, fn($a, $b) => $a->heuristicPoints - $b->heuristicPoints);
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
    echo "</pre>";
  }

  private static function getHeuristicPoints(Puzzle $puzzle, array $goalState, int $nodeDepth): int
  {
    $movesToGoal = 0;
    $currentState = $puzzle->getState();
    for ($i = 0; $i < count($currentState); $i++) {
      for ($j = 0; $j < count($currentState[$i]); $j++) {
        if ($currentState[$i][$j] != $goalState[$i][$j]) {
          $valuePositionInGoalState = self::findPosition($goalState, $currentState[$i][$j]);
          $movesToGoal += self::getManhattanDistance($j, $i, $valuePositionInGoalState['column'], $valuePositionInGoalState['row']);
        }
      }
    }
    return $movesToGoal + $nodeDepth;
  }

  private static function getManhattanDistance(int $column1, int $row1, int $column2, int $row2): int
  {
    return abs($column2 - $column1) + abs($row2 - $row1);
  }

  private static function findPosition(array $goalState, $value): array
  {
    for ($i = 0; $i < count($goalState); $i++) {
      for ($j = 0; $j < count($goalState[$i]); $j++) {
        if ($goalState[$i][$j] == $value) {
          return ['column' => $j, 'row' => $i];
        }
      }
    }
  }
}
