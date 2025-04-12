<?php
// Binary Search Tree (BST) Definition: Binary Search Tree (BST) is a binary tree data structure with the property that each node has at most two child nodes, referred to as the left child and the right child. Additionally, for any node in the tree, all nodes in its left subtree have values less than the node, and all nodes in its right subtree have values greater than the node. This property allows for efficient searching, insertion, and deletion of elements in the tree. A Binary Search Tree is a binary tree where, for each node: the left subtree contains only nodes with values less than the node's value, the right subtree contains only nodes with values greater than the node's value, and the left and right subtrees are also binary search trees.
// General Rule:    Number of Edges = Number of Nodes - 1
// Purpose: The primary purpose of a Binary Search Tree is to provide efficient searching, insertion, and deletion of elements. The tree structure allows for logarithmic time complexity for these operations, making it suitable for applications where fast search and retrieval are crucial.

/*
    Operations and Their Complexities:
        1) Search (find):
            - Time Complexity: O(log n) on average (when the tree is balanced).
            - Space Complexity: O(1).
        
        2) Insertion:
            - Time Complexity: O(log n) on average (when the tree is balanced).
            - Space Complexity: O(1).

        3) Deletion:
            - Time Complexity: O(log n) on average (when the tree is balanced).
            - Space Complexity: O(1).
*/

/*
    Real Use Cases:
        Binary Search Trees are commonly used in scenarios where efficient search, insertion, and deletion operations are required. Some real-world applications include:
            1) Database Indexing: BSTs are used to build indexes for quick data retrieval in databases.
            2) Symbol Tables in Compilers: BSTs are used to implement symbol tables, where identifiers and their associated information need to be quickly looked up.
            3) File Systems: BSTs can be used to implement file systems where quick search and retrieval of files based on names or paths are necessary.
*/



// Implementation
class TreeNode {
    public $nodeValue;
    public ?self $left;
    public ?self $right;


    public function __construct($value) {
        $this->nodeValue = $value;
        $this->left      = null;
        $this->right     = null;
    }
}



class BinaryTree {
    public ?TreeNode $root;



    public function __construct() {
        $this->root = null;
    }



    public function insert($insertionValue) {
        $this->root = $this->insertRecursive($this->root, $insertionValue);
    }

    private function insertRecursive($node, $insertionValue) { // Note: This recursion function is best explained and clarified using Debugging (Xdebug)!
        // Recursion Base Case / Stopping Case / Terminating Case: Create a new node for the leaf node (doesn't have children)
        if ($node === null) {
            return new TreeNode($insertionValue);
        }


        if ($insertionValue < $node->nodeValue) {
            $node->left = $this->insertRecursive($node->left, $insertionValue);
        } elseif ($insertionValue > $node->nodeValue) {
            $node->right = $this->insertRecursive($node->right, $insertionValue);
        }


        // echo '<pre>', var_dump($node), '</pre>';
        return $node; // We must use    return $node    in order to be able to move out one step (frame) up at a time in the call stack while recursion (to get out of the current call of the call stack of the function to the parent/outer function call) (When a function returns a value, it essentially completes its execution at that level and allows control to move back to the calling function in the call stack.) (Without the 'return' statement, the recursive calls would be made, but the results wouldn't be propagated back through the call stack.)
    }



    public function search($searchValue) {
        return $this->searchRecursive($this->root, $searchValue);
    }

    private function searchRecursive($node, $searchValue) {
        // Recursion Base Case / Stopping Case / Terminating Case: 
        if ($node === null || $searchValue === $node->nodeValue) { //    $node === null    means that the search has reached a leaf node (or an empty subtree). In this case, either the value being searched for is not present in the tree, or the tree is empty.
            return $node;
        }


        if ($searchValue < $node->nodeValue) {
            return $this->searchRecursive($node->left, $searchValue);  // We use the 'return' statement to be able to move out one step (frame) up at a time in the call stack while recursion (to get out of the current call of the call stack of the function to the parent/outer function call) (When a function returns a value, it essentially completes its execution at that level and allows control to move back to the calling function in the call stack.) (Without the 'return' statement, the recursive calls would be made, but the results wouldn't be propagated back through the call stack.)
        } else {
            return $this->searchRecursive($node->right, $searchValue); // We use the 'return' statement to be able to move out one step (frame) up at a time in the call stack while recursion (to get out of the current call of the call stack of the function to the parent/outer function call) (When a function returns a value, it essentially completes its execution at that level and allows control to move back to the calling function in the call stack.) (Without the 'return' statement, the recursive calls would be made, but the results wouldn't be propagated back through the call stack.)
        }

        /*
            Note: The mandatory use of the 'return' statements in recursive functions:
                - When a recursive function makes a call to itself, the return statement ensures that the result of the recursive call is returned to the caller of the current function.
                - Without the return statement, the result of the recursive call would be computed but not passed back to the caller, leading to incorrect behavior.
                - The return statements play a role in terminating the recursive calls when the base case is met. When the base case is satisfied (e.g., $node === null or $searchValue === $node->nodeValue), the return statement stops the recursion and returns the result to the caller.
                - Without the return statements, the recursive calls would continue indefinitely, and the base case would not have the intended effect of stopping the recursion.
                - The return statements also control the flow of execution by determining which value or result is propagated to the calling function. This is essential for preserving the correct result through each level of recursion.
        */
    }
}


// Usage
$binaryTreeObject = new BinaryTree();
// echo '<pre>', var_dump($binaryTreeObject), '</pre>';

echo '<pre>', var_dump($binaryTreeObject->insert(5)), '</pre>';
echo '<pre>', var_dump($binaryTreeObject->insert(20)), '</pre>';
echo '<pre>', var_dump($binaryTreeObject->insert(1)), '</pre>';
echo '<pre>', var_dump($binaryTreeObject->insert(15)), '</pre>';
echo '<pre>', var_dump($binaryTreeObject->insert(9)), '</pre>';
echo '<pre>', var_dump($binaryTreeObject->insert(11)), '</pre>';

// echo '<pre>', var_dump($binaryTreeObject), '</pre>';



echo '<pre>', var_dump($binaryTreeObject->search(15)), '</pre>';
echo '<pre>', var_dump($binaryTreeObject->search(754654)), '</pre>';