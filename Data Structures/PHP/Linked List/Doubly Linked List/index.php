<?php
// Linked Lists Vs. Arrays: Linked Lists have faster insertion/deletion than arrays, but slower random access than arrays (because arrays take up a CONTIGUOUS segment of memory, in contrast to linked lists)

// Definition: A doubly linked list is a data structure in which each node contains a data element and two pointers, one pointing to the next node in the sequence, and another pointing to the previous node. This allows for bidirectional traversal, unlike singly linked lists where traversal is only possible in one direction.
// Purpose: Doubly linked lists provide advantages over singly linked lists in scenarios where bidirectional traversal is required. The ability to traverse both forward and backward makes it easier to manipulate and navigate through the list in certain operations.

/*
    Operations and Their Complexities:
        1) Insertion:
            a) At the beginning:
                - Time Complexity: O(1)
                - Space Complexity: O(1)
            b) At the end:
                - Time Complexity: O(1)
                - Space Complexity: O(1)
            c) In the middle:
                - Time Complexity: O(n) where n is the number of elements to traverse to reach the desired position.
                - Space Complexity: O(1)

        2) Deletion:
            a) At the beginning:
                - Time Complexity: O(1)
                - Space Complexity: O(1)
            b) At the end:
                - Time Complexity: O(1)
                - Space Complexity: O(1)
            c) In the middle:
                - Time Complexity: O(n) where n is the number of elements to traverse to reach the desired position.
                - Space Complexity: O(1)

        3) Traversal:
            a) Forward:
                - Time Complexity: O(n)
                - Space Complexity: O(1)
            b) Backward:
                - Time Complexity: O(n)
                - Space Complexity: O(1)

        4) Access:
            - Time Complexity: O(n) as you may need to traverse the list to reach the desired element.
            - Space Complexity: O(1)


        Note: The space complexity is generally O(1) for these operations because they do not require additional memory proportional to the input size, except for a few constant-size variables.
*/

/*
    Real Use Cases:
        1) Doubly linked lists are used in undo-redo functionality in applications where the user can go back and forth through a series of actions.
        2) In certain memory management systems where fast deallocation of memory is required.
*/



// Implementation
class Node {
    public $data;
    public ?self $next;     // ? Nullable Operator (Nullable Type Declaration)    // Gets assigned its values by the constructor function of the DoublyLinkedList class
    public ?self $previous; // ? Nullable Operator (Nullable Type Declaration)    // Gets assigned its values by the constructor function of the DoublyLinkedList class


    public function __construct($addData) {
        $this->data     = $addData;
        $this->next     = null;
        $this->previous = null;
    }
}



class DoublyLinkedList {
    // public Node|null $head; // Initialized in the constructor function as    null      at the beginning    // This is as the same as the next line
    public ?Node $head; // Initialized in the constructor function as    null      at the beginning    // ? Nullable Operator (Nullable Type Declaration)
    // public int   $size; // Initialized in the constructor function as    zero 0    at the beginning


    public function __construct() {
        $this->head = null;
        // $this->size = 0;
    }

    // public function isEmpty(): bool {
    //     return $this->head === null;
    // }

    // public function getSize(): int {
    //     return $this->size;
    // }


    public function insertAtBeginning($insertData): void {
        // We form the $newNode object (its $data and $previous & $next)
        $newNode       = new Node($insertData);
        $newNode->next = $this->head; // Assign the $next property to be the old node
        // Note that    $newNode->previous = null    BY DEFAULT from the Node class's constructor function

        if ($this->head !== null) {
            $this->head->previous = $newNode;
        }

        $this->head = $newNode; // Assign the $head property to be the new node (in order to be later assigned to the $next property when later inserting a value to the DoublyLinkedList later)
        // $this->size++;
    }
    
    public function insertAtEnd($insertData): void {
        $newNode = new Node($insertData);

        /* if ($this->isEmpty()) {
            $this->head = $newNode;
        } else { */
        // We'll loop through the whole Doubly Linked List from its beginning ($head) to its end (we know it's its end when $next is 'null')
        $currentNode = $this->head;

        // while ($currentNode->next !== null) { // This while loop will stop when the Node's $next property is 'null'
        while ($currentNode->next !== null && $currentNode !== null) { // This while loop will stop when the Node's $next property is 'null'
            $currentNode = $currentNode->next;
        }

        if ($currentNode !== null) {
            $currentNode->next = $newNode;
            $newNode->previous = $currentNode;
        } else {
            $this->head = $newNode;
        }

        // $currentNode->next = $newNode;
        /* } */

        // $this->size++;
    }

    public function displayForward(): void {
        $currentNode = $this->head;

        while ($currentNode !== null) {
            echo '<b>' . $currentNode->data . '</b>, ';

            $currentNode = $currentNode->next;
        }
    }

    public function displayBackward(): void {
        $currentNode = $this->head;

        while ($currentNode !== null && $currentNode->next !== null) {
            $currentNode = $currentNode->next;
        }

        while ($currentNode !== null) {
            echo '<b>' . $currentNode->data . '</b>, ';

            $currentNode = $currentNode->previous;
        }
    }

    /*
        public function deleteFromBeginning() {
            if ($this->isEmpty()) {
                return null;
            } else {
                $this->head = $this->head->next; // Update head to the next node
                // $this->size--;

                /*
                    // And the same thing but better for Memory Management and PHP's Garbage Collector (Garbage Collection), we unset the deleted $head by equaling it to 'null' to indicates to PHP's garbage collector that the original head node is no longer needed and can be freed up from memory when appropriate
                    $toDeleteHead = $this->head; // Store reference to the original head
                    $this->head = $this->head->next; // Update head to the next node
                    $toDeleteHead = null; // Unset the reference to the original head to indicates to PHP's garbage collector that the original head node is no longer needed and can be freed up from memory when appropriate
                    $this->size--;
                */
        /*
            }
        }

        public function deleteFromEnd() {
            if ($this->isEmpty()) {
                return null;
            } else {
                // If the Doubly Linked List contains 1 one Node only
                if ($this->head->next === null) {
                    $this->head = null;

                    // If the Doubly Linked List contains more than 1 one Node
                } else {
                    $currentNode = $this->head;
                    $previousNode = null;

                    while ($currentNode->next !== null) {
                        $previousNode = $currentNode;
                        $currentNode = $currentNode->next;
                    }

                    // After the while loop has finished, the $previousNode will be the second-to-last node

                    $previousNode->next = null;
                }

                // $this->size--;
            }
        }

        public function insertAtPosition($insertData, int $insertionPosition): void {
            if ($insertionPosition < 0 || $insertionPosition > $this->size) {
                echo '<b>Invalid insertion position!</b><br>';
                return; // Stop function's execution
            }

            if ($insertionPosition === 0) { // Meaning insert at the beginning
                $this->insertAtBeginning($insertData);
            } elseif ($insertionPosition === $this->size) { // Meaning insert at the end
                $this->insertAtEnd($insertData);
            } else { // If the $insertionPosition in the middle i.e. anything other than the beginning or the end
                $previousNode = null;
                $currentNode  = $this->head;
                $currentPosition = 0;

                while ($currentPosition < $insertionPosition) {
                    $previousNode = $currentNode;
                    $currentNode  = $currentNode->next;

                    $currentPosition++;
                }

                $newNode = new Node($insertData);
                $previousNode->next = $newNode;
                $newNode->next = $currentNode;

                // $this->size++;
            }
        }

        public function deleteAtPosition(int $deletionPosition): void {
            if ($deletionPosition < 0 || $deletionPosition >= $this->size) { // We use    >=    because we used a zero-indexed numbering for the linked list (the last position would be the linked list size - 1 (just like arrays))
                echo '<b>Invalid deletion position!</b><br>';
                return; // Stop function's execution
            }

            if ($deletionPosition === 0) { // Meaning delete from the beginning
                $this->deleteFromBeginning();
            } elseif ($deletionPosition === $this->size - 1) { // Meaning delete from the end    // We use    $this->size - 1    because we used a zero-indexed numbering for the linked list (the last position would be the linked list size - 1 (just like arrays))
                $this->deleteFromEnd();
            } else { // If the $deletionPosition in the middle i.e. anything other than the beginning or the end
                $previousNode = null;
                $currentNode  = $this->head;
                $currentPosition = 0;

                while ($currentPosition < $deletionPosition) {
                    $previousNode = $currentNode;
                    $currentNode  = $currentNode->next;

                    $currentPosition++;
                }

                $previousNode->next = $currentNode->next;

                // $this->size--;
            }
        }

        public function getElementAtPosition(int $getPosition) {
            if ($getPosition < 0 || $getPosition >= $this->size) { // We use    >=    because we used a zero-indexed numbering for the linked list (the last position would be the linked list size - 1 (just like arrays))
                echo '<b>Invalid element position to get!</b><br>';
                return null; // Stop function's execution
            }

            $currentNode = $this->head;
            $currentPosition = 0;

            while ($currentPosition < $getPosition) {
                $currentNode = $currentNode->next;

                $currentPosition++;
            }


            return $currentNode->data;
        }

        public function search($searchData): bool {
            $currentNode = $this->head;

            while ($currentNode != null) {
                if ($currentNode->data === $searchData) {
                    return true;
                }

                $currentNode = $currentNode->next;
            }

            return false;
        }

        public function display(): void {
            $currentNode = $this->head;
            
            while ($currentNode != null) {
                echo '<b>' . $currentNode->data . '</b>, ';

                $currentNode = $currentNode->next;
            }

            echo '<br>';
        }
    */
}



// Usage
$DoublyLinkedListObject = new DoublyLinkedList();
echo '<pre>', var_dump($DoublyLinkedListObject), '</pre>';


$DoublyLinkedListObject->insertAtBeginning('First');
echo '<pre>', var_dump($DoublyLinkedListObject), '</pre>';

$DoublyLinkedListObject->insertAtBeginning('Second');
echo '<pre>', var_dump($DoublyLinkedListObject), '</pre>';

// $DoublyLinkedListObject->insertAtBeginning('Third');
// echo '<pre>', var_dump($DoublyLinkedListObject), '</pre>';

// $DoublyLinkedListObject->insertAtEnd('Eventual');
// echo '<pre>', var_dump($DoublyLinkedListObject), '</pre>';

// $DoublyLinkedListObject->deleteFromBeginning();
// echo '<pre>', var_dump($DoublyLinkedListObject), '</pre>';

// $DoublyLinkedListObject->deleteFromEnd();
// echo '<pre>', var_dump($DoublyLinkedListObject), '</pre>';


// echo '<pre>', var_dump($DoublyLinkedListObject->getSize()), '</pre>';

// $DoublyLinkedListObject->insertAtPosition('first (ZEROTH) insertion', 0);
// echo '<pre>', var_dump($DoublyLinkedListObject), '</pre>';
// $DoublyLinkedListObject->insertAtPosition('second insertion', 1);
// echo '<pre>', var_dump($DoublyLinkedListObject), '</pre>';
// $DoublyLinkedListObject->insertAtPosition('third insertion', 2);
// echo '<pre>', var_dump($DoublyLinkedListObject), '</pre>';
// $DoublyLinkedListObject->insertAtPosition('bad insertion', 5);
// echo '<pre>', var_dump($DoublyLinkedListObject), '</pre>';
// $DoublyLinkedListObject->insertAtPosition('POSITION ONE 1 INSERTION', 1);
// echo '<pre>', var_dump($DoublyLinkedListObject), '</pre>';

// $DoublyLinkedListObject->deleteAtPosition(1);
// echo '<pre>', var_dump($DoublyLinkedListObject), '</pre>';

// echo '<pre>', var_dump($DoublyLinkedListObject->getElementAtPosition(2)), '</pre>';

// echo '<pre>', var_dump($DoublyLinkedListObject->search('second insertion')), '</pre>';
// echo '<pre>', var_dump($DoublyLinkedListObject->search('something doesn\'t exit!')), '</pre>';

// $DoublyLinkedListObject->display();