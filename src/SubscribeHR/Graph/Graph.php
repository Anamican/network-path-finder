<?php


namespace SubscribeHR\Graph;


class Graph
{
    protected $vertices;
    protected $verticesMap;
    protected $weights;
    protected $path;

    public function __construct($verticesMap, $vertices) {
        $this->verticesMap = $verticesMap;
        $this->vertices = $vertices;
    }

    public function getWeights(){
        return $this->weights;
    }

    public function getPath(){
        return $this->path;
    }

    public function isReachable($source, $destination) {
        // If either the source or target is not one of the vertices
        // finding a path is not possible
        if(!isset($this->vertices[$source]) || !isset($this->vertices[$destination])){
            return false;
        }

        // If both the source and target are the same, no need to find path
        if($source === $destination){
            return false;
        }

        foreach ($this->vertices as $vertex => $ignorable) {
            $this->weights[$vertex] = INF;
        }

        $queue = new \SplQueue();
        $this->weights[$source] = 0;
        $queue->enqueue($source);

        while (!$queue->isEmpty()) {
            $current = $queue->dequeue();
            if(isset($this->verticesMap[$current])){
                foreach ($this->verticesMap[$current] as $vertex => $weight) {
                    if ($this->weights[$vertex] === INF) {
                        $this->weights[$vertex] = $this->weights[$current] + $weight;
                        $this->path[$current][] = $vertex;
                        $queue->enqueue($vertex);
                    }
                }
            }
        }

        // Path not found
        if($this->weights[$destination] === INF){
            return false;
        }

        // Path reachable
        return true;
    }
}