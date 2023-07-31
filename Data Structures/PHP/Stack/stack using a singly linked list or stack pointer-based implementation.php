<?php
// Stack (LIFO)    // https://www.youtube.com/watch?v=XSm6MivqBrM&list=PLCInYL3l2AajqOUW_2SwjWeMwf4vL4RSp&index=6
// Tip: Use ChatGPT to implement a PHP Stack
// Examples of realistic use cases of Stacks is: Undoing (CTRL + Z), and going back in browser history
// https://www.geeksforgeeks.org/implement-a-stack-using-singly-linked-list/



// Stack using a singly linked list or Stack pointer-based implementation (Stack Pointer)
class Node { // Node cotains 2 things: a value and a pointer
    public $element;
    public $next = null;


    public function __construct($element) {
        $this->element = $element;
        // $this->next    = null;
    }
}



class Stack {
    // Using 'private' properties (attributes) for 'Encapsulation': for data hiding and preventing direct access to the internal implementation details of the Stack class. This prevents external code from directly modifying the stack's internal state, such as manipulating the top index or modifying the array outside of the push and pop operations. This way, the stack operations remain consistent and follow the intended behavior. Additionally, encapsulation provides flexibility in the future if you want to modify the underlying implementation of the stack. For example, you could change the implementation to use a different data structure without affecting the external code that uses the Stack class.
    /*
        private $top; // the top of the Stack (last element)


        public function __construct() {
            $this->top = null;
        }
    */


    private $top = null; // the top of the Stack (last element)


    public function push($element): void { // push/append to the end of the Stack
        $newNode       = new Node($element);
        $newNode->next = $this->top;
        $this->top     = $newNode;
    }

    public function pop(): void { // remove the last element of the Stack
        if ($this->isStackEmpty()) {
            echo 'Stack is already empty!';
        } else {
            $this->top->element = null;
            $this->top = $this->top->next;
            // $this->top->element = null;
        }
    }

    public function getTop() { // get the top element of the Stack
        if ($this->isStackEmpty()) {
            echo 'Stack is empty!';
        } else {
            return $this->top->element;
        }
    }

    public function isStackEmpty(): bool {
        return $this->top === null;  // Boolean
    }

    public function getStackSize(): int {
        $elements_count = 0;
        // $current_element = $this->top;

        while ($this->top !== null) { // Keep looping till it's equal to null
            $this->top = $this->top->next;            

            $elements_count++;
        }

        return $elements_count;
    }

}



$stackObject = new Stack();
// echo '<pre>', var_dump($stackObject), '</pre>';


$stackObject->push('Ear');
$stackObject->push('Mitsubishi');
$stackObject->push('train');
$stackObject->push('London');
// echo '<pre>', var_dump($stackObject), '</pre>';

// echo $stackObject->getTop() . '<br>';
$stackObject->pop();
// echo $stackObject->getTop() . '<br>';
echo '<pre>', var_dump($stackObject), '</pre>';

// echo '<pre>', var_dump($stackObject->isStackEmpty()), '</pre>';

echo $stackObject->getStackSize() . '<br>';