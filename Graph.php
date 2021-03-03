<?php

namespace App;

use SplDoublyLinkedList;
use SplQueue;

class Graph
{
    private array $graph;

    private array $visited = [];

    public function __construct(array $graph)
    {
        $this->graph = $graph;
    }

    public function breadthFirstSearch(string $origin, string $destination): void
    {
        foreach ($this->graph as $vertex => $adj) {
            $this->visited[$vertex] = false;
        }

        $q = new SplQueue();
        $q->enqueue($origin);

        $this->visited[$origin] = true;

        /** @var SplDoublyLinkedList[] $path */
        $path = [];
        $path[$origin] = new SplDoublyLinkedList();
        $path[$origin]->setIteratorMode(SplDoublyLinkedList::IT_MODE_FIFO|SplDoublyLinkedList::IT_MODE_KEEP);
        $path[$origin]->push($origin);

        while (false === $q->isEmpty() && $q->bottom() !== $destination) {
            $t = $q->dequeue();

            if (0 < count($this->graph[$t])) {
                foreach ($this->graph[$t] as $vertex) {
                    if (false === $this->visited[$vertex]) {
                        $q->enqueue($vertex);
                        $this->visited[$vertex] = true;
                        $path[$vertex] = clone $path[$t];
                        $path[$vertex]->push($vertex);
                    }
                }
            }
        }

        if (array_key_exists($destination, $path)) {
            echo "$origin to $destination in " . (count($path[$destination]) - 1) . " hops \n";
            $sep = '';
            foreach ($path[$destination] as $vertex) {
                echo $sep, $vertex;
                $sep = '->';
            }
            echo "\n";
        } else {
            echo "No route from $origin to $destination";
        }
    }
}