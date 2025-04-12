<?php
// Tree (in general) Definition: A tree is a hierarchical data structure composed of nodes connected by edges. It is a widely used data structure in computer science for organizing and representing hierarchical relationships and is commonly employed in various algorithms and data storage systems.
// Binary Tree Definition: A binary tree is a hierarchical data structure composed of nodes, where each node has at most two children, referred to as the left child and the right child. The topmost node is called the root, and nodes with no children are called leaves. Binary trees are commonly used in computer science for organizing and efficiently retrieving data. A binary tree is either empty or consists of a root node, and two disjoint binary trees called the left and right subtrees.
// General Rule:    Number of Edges = Number of Nodes - 1

/*
    Types of Trees:
        1) Binary Tree:
            - Each node has at most two children.
            - Commonly used in binary search trees, expression trees, and Huffman trees.

        2) Binary Search Tree (BST):
            - A binary tree with the property that the left subtree of a node contains only nodes with keys less than the node's key, and the right subtree contains only nodes with keys greater than the node's key.
            - Efficient for searching, insertion, and deletion.

        3) Balanced Binary Tree:
            - A binary tree in which the depth of the left and right subtrees of every node differs by at most one.
            - Examples include AVL trees and Red-Black trees.
            - Maintains balance for efficient operations.

        4) B-Tree:
            - A self-balancing search tree structure that maintains sorted data and allows searches, insertions, and deletions in logarithmic time.
            - Commonly used in databases and file systems for indexing.

        5) Trie (Prefix Tree):
            - A tree-like data structure where each node represents a single character of a key.
            - Useful for storing and searching for words or strings efficiently.

        6) Heap:
            - A specialized tree-based data structure that satisfies the heap property.
            - Used in priority queues and heapsort algorithms.

        7) Quadtree:
            - A tree data structure in which each internal node has exactly four children: northwest, northeast, southwest, and southeast.
            - Commonly used in spatial indexing and image representation.

        8) Octree:
            - A tree data structure in which each internal node has exactly eight children.
            - Extends the concept of quadtrees to three-dimensional space.

        9) K-D Tree:
            - A space-partitioning data structure for organizing points in a k-dimensional space.
            - Useful for range searches and nearest neighbor searches.

        10) Expression Tree:
            - A binary tree used to represent expressions, where leaves are operands and internal nodes are operators.
            - Useful in compilers and expression evaluation.
*/

// Purpose: Binary trees are used to represent hierarchical relationships, such as family trees or organizational charts. They are also widely used in computer science for efficient searching, sorting, and retrieval operations.

/*
    Operations and Their Complexities:
        1) Insertion:
            - To insert a new node in a binary tree, we compare the value of the new node with the value of the current node.
            - If the new node's value is smaller, we go to the left subtree; if larger, we go to the right subtree.
            - We repeat this process until we find an empty spot to insert the new node.
            * Time Complexity : O(log n) in the average case for balanced trees, O(n) in the worst case for unbalanced trees.
            * Space Complexity: O(1) for the iterative approach, O(log n) for the recursive approach (due to the call stack in the average case).

        2) Deletion:
            - Deletion involves finding the node to be deleted, handling different cases (node with no children, one child, or two children), and rearranging the tree accordingly.
            * Time Complexity : O(log n) in the average case for balanced trees, O(n) in the worst case for unbalanced trees.
            * Space Complexity: O(1) for the iterative approach, O(log n) for the recursive approach (due to the call stack in the average case).

        3) Search:
            - Searching in a binary tree involves comparing the target value with the values of nodes and traversing either the left or right subtree based on the comparison.
            * Time Complexity : O(log n) in the average case for balanced trees, O(n) in the worst case for unbalanced trees.
            * Space Complexity: O(1) for the iterative approach, O(log n) for the recursive approach (due to the call stack in the average case).

        4) Traversal:
            - Binary trees can be traversed in different ways: in-order, pre-order, and post-order.
            * Time Complexity : O(n) for any traversal method.
            * Space Complexity: O(log n) for recursive methods (call stack depth), O(n) for iterative methods using additional data structures like stacks or queues.
*/

/*
    Real Use Cases:
        1) Database Indexing: Binary trees are used in database indexing structures like B-trees and AVL trees for efficient searching and retrieval of records.
        2) File Systems: File systems often use binary trees to store and organize file metadata for quick file retrieval.
        3) Expression Trees: In compilers, binary trees are used to represent expressions for efficient evaluation.
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