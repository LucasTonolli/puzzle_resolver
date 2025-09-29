<?php

namespace PuzzleResolver;

use PuzzleResolver\Puzzle;

class Node
{
    public int $id = 0;
    public int $heuristicPoints = 0;
    public int $depth = 0;
    public array $children = [];

    public function __construct(public ?Node $parent, public Puzzle $puzzle) {}

    public function addChild(Node $child)
    {
        $this->children[] = $child;
    }

    public function setHeuristicPoints(int $heuristicPoints)
    {
        $this->heuristicPoints = $heuristicPoints;
    }
}
