<?php
// Linked Lists Vs. Arrays: Linked Lists have faster insertion/deletion than arrays, but slower random access than arrays (because arrays take up a CONTIGUOUS segment of memory, in contrast to linked lists)

// Definition: A linked list is a linear data structure consisting of a sequence of nodes. Each node contains data and a reference (or pointer) to the next node in the sequence. It doesn't necessarily occupy contiguous memory locations like arrays. In a singly linked list, traversal is unidirectional and can only move forward through the list, starting from the head (the first node).
/*
    Purpose:
        1) Dynamic Size: Easily add or remove elements at the beginning or end without reallocating memory (unlike arrays).
        2) Efficient Insertions/Deletions: Insertions and deletions at the beginning take constant time, while those at the end require traversing the list, typically taking linear time.
*/

/*
    Operations and Their Complexities:
        1) Insertion at the Beginning (prepend) (insertAtBeginning): Time Complexity: O(1), Space Complexity: O(1)
            Explanation:
                - Time: Constant time as it involves creating a new node and updating the head pointer, independent of the list size.
                - Space: Constant space is used for the new node created.
        2) Deletion at the Beginning (deleteAtBeginning): Time Complexity: O(1), Space Complexity: O(1)
            Explanation:
                - Time: Constant time as it involves updating the head pointer, irrespective of the list size.
                - Space: No additional space required.
        3) Insertion at the End (append) (insertAtEnd): Time Complexity: O(n), Space Complexity: O(1)
            Explanation:
                - Time: Linear time because inserting at the end requires traversing the entire list to reach the last node before adding the new node.
                - Space: Constant space as only the new node is created, no additional space proportional to the list size.
        4) Deletion at the End (deleteAtEnd): Time Complexity: O(n), Space Complexity: O(1)
            Explanation:
                - Time: Linear time because deleting the last node involves traversing the entire list to reach the second-to-last node.
                - Space: No additional space required beyond the temporary variables used.
        5) Traversal (traverse): Time Complexity: O(n), Space Complexity: O(1)
            Explanation:
                - Time: Linear time as it requires visiting every node in the list.
                - Space: No additional space required beyond the temporary variables used.
        6) Searching for an Element (search): Time Complexity: O(n), Space Complexity: O(1)
            Explanation:
                - Time: Linear time as it might need traversing the entire list to find the element.
                - Space: No additional space required beyond the temporary variables used.
        7) Space Complexity for the Singly Linked List:
            Overall Space Complexity: O(n)
            Explanation:
                The space used by the linked list itself grows linearly with the number of nodes since each node consumes a constant amount of space.
        
        These complexities help in understanding the performance characteristics of various operations on a singly linked list, considering both time and space aspects.
*/

/*
    Real Use Cases:
        1) Implementation of Stacks and Queues: Singly linked lists can be used to implement these abstract data types efficiently.
        2) Memory allocation in Language Runtimes: They're used in memory allocation for dynamic data structures.
        3) Applications involving frequent insertions/deletions: When frequent modifications to the data structure are expected, linked lists can be advantageous.
*/



// Implementation
class Node {
    public $data;
    public ?self $next; // ? Nullable Operator (Nullable Type Declaration)    // Gets assigned its values by the constructor function of the SinglyLinkedList class


    public function __construct($addData) {
        $this->data = $addData;
        $this->next = null;
    }
}



class SinglyLinkedList {
    // public Node|null $head; // Initialized in the constructor function as    null      at the beginning    // This is as the same as the next line
    public ?Node $head; // Initialized in the constructor function as    null      at the beginning    // ? Nullable Operator (Nullable Type Declaration)
    public int   $size; // Initialized in the constructor function as    zero 0    at the beginning


    public function __construct() {
        $this->head = null;
        $this->size = 0;
    }

    public function isEmpty(): bool {
        return $this->head === null;
    }

    public function getSize(): int {
        return $this->size;
    }


    public function insertAtBeginning($insertData): void {
        $newNode       = new Node($insertData);
        $newNode->next = $this->head; // Assign the $next property to be the old node

        $this->head = $newNode; // Assign the $head property to be the new node (in order to be later assigned to the $next property when later inserting a value to the SinglyLinkedList later)
        $this->size++;
    }
    
    public function insertAtEnd($insertData): void {
        $newNode = new Node($insertData);

        if ($this->isEmpty()) {
            $this->head = $newNode;
        } else {
            // We'll loop through the whole Singly Linked List from its beginning ($head) to its end (we know it's its end when $next is 'null')
            $currentNode = $this->head;

            while ($currentNode->next !== null) { // This while loop will stop when the Node's $next property is 'null'
                $currentNode = $currentNode->next;
            }

            $currentNode->next = $newNode;
        }

        $this->size++;
    }

    public function deleteFromBeginning() {
        if ($this->isEmpty()) {
            return null;
        } else {
            $this->head = $this->head->next; // Update head to the next node
            $this->size--;

            /*
                // And the same thing but better for Memory Management and PHP's Garbage Collector (Garbage Collection), we unset the deleted $head by equaling it to 'null' to indicates to PHP's garbage collector that the original head node is no longer needed and can be freed up from memory when appropriate
                $toDeleteHead = $this->head; // Store reference to the original head
                $this->head = $this->head->next; // Update head to the next node
                $toDeleteHead = null; // Unset the reference to the original head to indicates to PHP's garbage collector that the original head node is no longer needed and can be freed up from memory when appropriate
                $this->size--;
            */
        }
    }

    public function deleteFromEnd() {
        if ($this->isEmpty()) {
            return null;
        } else {
            // If the Singly Linked List contains 1 one Node only
            if ($this->head->next === null) {
                $this->head = null;

                // If the Singly Linked List contains more than 1 one Node
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

            $this->size--;
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

            $this->size++;
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

            $this->size--;
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
}



// Usage
$singlyLinkedListObject = new SinglyLinkedList();
echo '<pre>', var_dump($singlyLinkedListObject), '</pre>';

/*
    $singlyLinkedListObject->insertAtBeginning('First');
    echo '<pre>', var_dump($singlyLinkedListObject), '</pre>';

    $singlyLinkedListObject->insertAtBeginning('Second');
    echo '<pre>', var_dump($singlyLinkedListObject), '</pre>';

    $singlyLinkedListObject->insertAtBeginning('Third');
    echo '<pre>', var_dump($singlyLinkedListObject), '</pre>';

    $singlyLinkedListObject->insertAtEnd('Eventual');
    echo '<pre>', var_dump($singlyLinkedListObject), '</pre>';

    $singlyLinkedListObject->deleteFromBeginning();
    echo '<pre>', var_dump($singlyLinkedListObject), '</pre>';

    $singlyLinkedListObject->deleteFromEnd();
    echo '<pre>', var_dump($singlyLinkedListObject), '</pre>';
*/

echo '<pre>', var_dump($singlyLinkedListObject->getSize()), '</pre>';

$singlyLinkedListObject->insertAtPosition('first (ZEROTH) insertion', 0);
echo '<pre>', var_dump($singlyLinkedListObject), '</pre>';
$singlyLinkedListObject->insertAtPosition('second insertion', 1);
echo '<pre>', var_dump($singlyLinkedListObject), '</pre>';
$singlyLinkedListObject->insertAtPosition('third insertion', 2);
echo '<pre>', var_dump($singlyLinkedListObject), '</pre>';
$singlyLinkedListObject->insertAtPosition('bad insertion', 5);
echo '<pre>', var_dump($singlyLinkedListObject), '</pre>';
$singlyLinkedListObject->insertAtPosition('POSITION ONE 1 INSERTION', 1);
echo '<pre>', var_dump($singlyLinkedListObject), '</pre>';

$singlyLinkedListObject->deleteAtPosition(1);
echo '<pre>', var_dump($singlyLinkedListObject), '</pre>';

echo '<pre>', var_dump($singlyLinkedListObject->getElementAtPosition(2)), '</pre>';

echo '<pre>', var_dump($singlyLinkedListObject->search('second insertion')), '</pre>';
echo '<pre>', var_dump($singlyLinkedListObject->search('something doesn\'t exit!')), '</pre>';

$singlyLinkedListObject->display();