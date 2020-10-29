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

    public function getWeight($vertex){
        return isset($this->weights[$vertex])?$this->weights[$vertex]:0;
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

        foreach ($this->vertices as $vertex => $ignorable) {
            $this->weights[$vertex] = INF;
        }

        $this->weights[$source] = 0;
        $edges = array();

        while (!empty($this->weights)) {
            $min = array_search(min($this->weights), $this->weights);
            if($min == $destination) break;

            if(isset($this->verticesMap[$min])){
                foreach ($this->verticesMap[$min] as $vertex => $weight) {
                    if(!empty($this->weights[$vertex]) &&
                        (($this->weights[$min] + $weight) < $this->weights[$vertex])) {
                        $this->weights[$vertex] = $this->weights[$min] + $weight;
                        $edges[$vertex] = array($min, $this->weights[$vertex]);
                    }
                }
            }
            unset($this->weights[$min]);
        }

        // Path not found
        if($this->weights[$destination] === INF){
            return false;
        }

        $vertex = $destination;
        while($vertex != $source){
            $this->path[] = $vertex;
            $vertex = $edges[$vertex][0];
        }
        $this->path[] = $source;
        $this->path = array_reverse($this->path);

       // Path reachable
       return true;
    }
}