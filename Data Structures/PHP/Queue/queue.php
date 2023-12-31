<?php

// FIFO (first in, first out)
// enqueue (added at the rear) X dequeue (removed at the front)
// Definition: A queue is a linear data structure that follows the FIFO (First In, First Out) principle. It works similar to a queue in the real world, where the first element added to the queue is the first one to be removed. Elements are added at the rear (enqueue) and removed from the front (dequeue) of the queue.
// Purpose: Queues are used when you need to manage data in a sequential order, especially when the order of processing is essential.
/*
    Real Use Cases:
        1) Print Queue: Documents sent to a printer are processed in the order they were submitted.
        2) Breadth-First Search (BFS): In graph algorithms, a queue is used to traverse nodes level by level.
        3) Task Scheduling: CPU task scheduling, where processes are executed in the order they arrive.
        4) Buffering: Data is transferred asynchronously between two processes with different speeds.
        5) Web Servers: Handling requests from clients.
        6) Operating Systems: Managing system processes.
        7) Print Spooling: Queuing documents for printing.
        8) Breadth-First Search (BFS): Graph traversal algorithms.
        9) Task Management: Managing asynchronous tasks in programming.
*/

/*
    Queue Operations and Their Complexities:
    1) Enqueue (Push):  Adds an element to the rear of the queue:                       Time Complexity: O(1), Space Complexity: O(1)
    2) Dequeue (Pop):   Removes the element from the front of the queue:                Time Complexity: O(1), Space Complexity: O(1)
    3) Peek    (Front): Gets the element at the front of the queue without removing it: Time Complexity: O(1), Space Complexity: O(1)
*/



// Implementation
class Queue {
    private $queue; // Initialized as an empty array in the constructor function


    public function __construct() {
        $this->queue = [];
    }



    public function enqueue($item) {
        $this->queue[] = $item; // Append to the end of the array    // Or    array_push($this->queue, $item); // Push onto the end of array
        // array_push($this->queue, $item); // Push onto the end of array
    }

    public function dequeue() {
        if ($this->isEmpty()) {
            return null;
        }
        
        return array_shift($this->queue); // Remove/Shift an element off the beginning of array
    }

    public function peek() {
        return $this->isEmpty() ? null : $this->queue[0];
    }


    // Helpers
    public function isEmpty() {
        return empty($this->queue);
    }
}

// Usage:
$queueObject = new Queue();
$queueObject->enqueue('bread');
$queueObject->enqueue('butter');
$queueObject->enqueue('jam');

$queueObject->dequeue();

echo '<pre>', var_dump($queueObject->peek()), '</pre>';



echo '<pre>', var_dump($queueObject), '</pre>';