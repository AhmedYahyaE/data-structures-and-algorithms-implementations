<?php
// Stack (LIFO)
// Examples of realistic use cases of Stacks is: Undoing (CTRL + Z), and going back in browser history



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


    public function push($element): void { // push onto the top of the Stack (i.e. append to the end of the PHP array)
        $newNode       = new Node($element);
        $newNode->next = $this->top;
        $this->top     = $newNode;
    }

    public function pop(): void { // pop the last element off the Stack (i.e. remove the last element from the PHP array)
        if ($this->isStackEmpty()) {
            echo 'Stack is already empty!';
        } else {
            $this->top->element = null;
            $this->top = $this->top->next;
            // $this->top->element = null;
        }
    }

    public function getTop() { // retrieve/get the top element of the Stack
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

$stackObject->push('Ear');
$stackObject->push('Mitsubishi');
$stackObject->push('train');
$stackObject->push('London');

$stackObject->pop();

echo '<pre>', var_dump($stackObject), '</pre>';
echo $stackObject->getStackSize() . '<br>';