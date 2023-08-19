<?php
// Stack (LIFO)
// Examples of realistic use cases of Stacks is: Undoing (CTRL + Z), and going back in browser history, ...



// Array-based implementation
class Stack {
    // Using 'private' properties (attributes) for 'Encapsulation': for data hiding and preventing direct access to the internal implementation details of the Stack class. This prevents external code from directly modifying the stack's internal state, such as manipulating the top index or modifying the array outside of the push and pop operations. This way, the stack operations remain consistent and follow the intended behavior. Additionally, encapsulation provides flexibility in the future if you want to modify the underlying implementation of the stack. For example, you could change the implementation to use a different data structure without affecting the external code that uses the Stack class.
    /*
        private $top; // the top of the Stack (last element)
        private $stackArray;


        public function __construct() {
            $this->top = -1;
            $this->stackArray = [];
        }
    */


    private $top = -1; // the top of the Stack (last element)
    private $stackArray = [];



    public function push($element): void { // push onto the top of the Stack (i.e. append to the end of the PHP array)
        $this->top++;
        $this->stackArray[$this->top] = $element;
    }

    public function pop(): void { // pop the last element off the Stack (i.e. remove the last element from the PHP array)
        if ($this->isStackEmpty()) {
            echo 'Stack is already empty!';
        } else {
            unset($this->stackArray[$this->top]);
            $this->top--;
        }
    }

    public function getTop() { // retrieve/get the top element of the Stack
        if ($this->isStackEmpty()) {
            echo 'Stack is empty!';
        } else {
            return $this->stackArray[$this->top];
        }
    }

    public function isStackEmpty(): bool {
        return $this->top == -1;  // Boolean
        // return $this->top < 0; // Boolean
    }

    public function getStackSize(): int {
        return $this->top + 1;
    }

}



$stackObject = new Stack();

$stackObject->push('E');
$stackObject->push(17);
$stackObject->push('car');

echo $stackObject->getTop() . '<br>';
$stackObject->pop();
echo $stackObject->getTop() . '<br>';

echo '<pre>', var_dump($stackObject->isStackEmpty()), '</pre>';

echo $stackObject->getStackSize() . '<br>';