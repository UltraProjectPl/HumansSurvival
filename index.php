<?php

require_once 'vendor/autoload.php';

use App\Graph;

$graph = [
    'A' => ['B', 'F'],
    'B' => ['A', 'D', 'E'],
    'C' => ['F'],
    'D' => ['B', 'E'],
    'E' => ['B', 'D', 'F'],
    'F' => ['A', 'E', 'C'],
    'G' => ['B']
];

$g = new Graph($graph);

$g->breadthFirstSearch('D', 'C');
echo '<br>';
$g->breadthFirstSearch('B', 'F');
echo '<br>';
$g->breadthFirstSearch('A', 'C');
echo '<br>';
$g->breadthFirstSearch('A', 'G');
