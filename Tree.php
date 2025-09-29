<?php

namespace PuzzleResolver;

class Tree
{
    public Node $currentNode;
    public function __construct(public Node $root)
    {
        $this->currentNode = $root;
    }

    public function setCurrentNode(Node $node)
    {
        $this->currentNode = $node;
    }

    public function insertNode(Node $node)
    {
        $this->currentNode->addChild($node);
    }
}
