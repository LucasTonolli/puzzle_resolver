<?php

namespace PuzzleResolver;

use Exception;

class Puzzle
{

  public const MOVES = ["up", "down", "left", "right"];
  public function __construct(private array $state) {}

  public function movePiece(string $direction): void
  {
    $missingPieceRow = 0;
    $missingPieceCol = 0;

    for ($i = 0; $i < count($this->state); $i++) {
      for ($j = 0; $j < count($this->state[$i]); $j++) {
        if ($this->state[$i][$j] === 0) {
          $missingPieceRow = $i;
          $missingPieceCol = $j;
          break;
        }
      }
    }

    $size = count($this->state);

    if ($direction === "up" && $missingPieceRow > 0) {
      $oldValue = $this->state[$missingPieceRow - 1][$missingPieceCol];
      $this->state[$missingPieceRow - 1][$missingPieceCol] = 0;
      $this->state[$missingPieceRow][$missingPieceCol] = $oldValue;
    } else if ($direction === "left" && $missingPieceCol > 0) {
      $oldValue = $this->state[$missingPieceRow][$missingPieceCol - 1];
      $this->state[$missingPieceRow][$missingPieceCol - 1] = 0;
      $this->state[$missingPieceRow][$missingPieceCol] = $oldValue;
    } else if ($direction == "right" && $missingPieceCol < $size - 1) {
      $oldValue = $this->state[$missingPieceRow][$missingPieceCol + 1];
      $this->state[$missingPieceRow][$missingPieceCol + 1] = 0;
      $this->state[$missingPieceRow][$missingPieceCol] = $oldValue;
    } else if ($direction == "down" && $missingPieceRow < $size - 1) {
      $oldValue = $this->state[$missingPieceRow + 1][$missingPieceCol];
      $this->state[$missingPieceRow + 1][$missingPieceCol] = 0;
      $this->state[$missingPieceRow][$missingPieceCol] = $oldValue;
    } else {
      throw new Exception("Movimento inválido");
    }
  }

  public function getState(): array
  {
    return $this->state;
  }

  public function printCurrentState(): void
  {
    foreach ($this->state as $row) {
      echo implode(" ", $row) . "\n";
    }
  }
}
