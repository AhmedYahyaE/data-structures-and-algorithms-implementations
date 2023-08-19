<?php
// Quicksort algorithm
// Time Complexity: O(n^2)    // But O(n^2) is rarely encountered in practice due to various pivot selection strategies. On average, it has an O(n log n) time complexity
// Space Complexity: O(n)    // The space complexity of Quicksort is determined by the recursion depth and the extra space used for partitioning. In the average and best cases, the recursion depth is log n, and the space used for partitioning is O(log n). However, in the worst case (unbalanced partitioning), the recursion depth can be as high as n, resulting in O(n) space complexity.
// Divide and Conquer algorithm



function quicksortRecursive(&$array, $array_start_index, $array_end_index) { // Passing By Reference
    // Recursion Base Case / Stopping Case / Terminating Case
    if ($array_start_index < $array_end_index) {
        $partitioning_index = partition($array, $array_start_index, $array_end_index); // $partitioning_index is the $pivot

        quicksortRecursive($array, $array_start_index, $partitioning_index - 1); // the left  side of the $pivot
        quicksortRecursive($array, $partitioning_index + 1, $array_end_index);   // the right side of the $pivot
    }
}


function swap(&$numberOne, &$numberTwo) { // Passing By Reference
    $temporaryVariable = $numberOne;
    $numberOne = $numberTwo;
    $numberTwo = $temporaryVariable;
}


function partition(&$array, $arrayStartIndex, $arrayEndIndex) { // Passing By Reference
    // Choose the pivot
    $pivot = $array[$arrayEndIndex];

    // We use two pointers/variables (not memory pointers!) to do the partitioning ($leftPointer and $j the normal loop variable)
    $leftPointer = $arrayStartIndex - 1; // $leftPointer initial value is -1    // $leftPointer starts with a value of -1 (0 - 1 = -1)

    for ($j = $arrayStartIndex; $j <= $arrayEndIndex - 1; $j++) {
        if ($array[$j] < $pivot) { // Increment & Swap
            $leftPointer++;
            swap($array[$j], $array[$leftPointer]);
        }
    }

    // Finally swap the $pivot (i.e.    $array[$arrayEndIndex]    ) with the element just after the $leftPointer i.e.    $leftPointer + 1
    swap($array[$leftPointer + 1], $array[$arrayEndIndex]);

    
    return $leftPointer + 1; // Return the new $pivot or $partitioning_index (Check the quicksortRecursive() function)
}



/**********************************************************************************************************************************************/



function quicksortIterative(&$array, $array_start_index, $array_end_index) { // Passing By Reference
    // Create an auxiliary 'Stack' Data Structure (NOTHING DIFFERENT THAN a PHP array i.e. it's just a simple PHP array that we keep appending values to it)
    $stackArray = array_fill(0, $array_end_index - $array_start_index + 1, 0); // The stack is fileed with 0 zeros

    // Initialize the top of the Stack (i.e. the top index)
    $top = -1;

    // Push the initial values of both the $array_start_index and $array_end_index onto the top of the Stack (i.e. append them to the PHP array)
    $stackArray[++$top] = $array_start_index;
    $stackArray[++$top] = $array_end_index;


    // Keep popping $array_start_index-es and $array_end_index-es off the Stack while it's not empty    // Here, we use the while loop in place of 'Recursion' in the quicksortRecursive() function in order to keep calling the partition() function
    while ($top >= 0) { // is the same as:    while ($top > -1) {
        // Remove the $array_start_index and $array_end_index from the PHP array (i.e. pop them off the Stack), but create variables of their values to use them later with the partition() function
        $array_end_index   = $stackArray[$top--];
        $array_start_index = $stackArray[$top--];

        $partitioning_index = partition($array, $array_start_index, $array_end_index); // $partitioning_index is the $pivot


        if ($partitioning_index - 1 > $array_start_index) { // If there are elements on the left side of the pivot ($partitioning_index), push the left side onto the top of the Stack (i.e. push the $array_start_index and $array_end_index of the left side)
            $stackArray[++$top] = $array_start_index;
            $stackArray[++$top] = $partitioning_index - 1;
        }

        if ($partitioning_index + 1 < $array_end_index) { // If there are elements on the right side of the pivot ($partitioning_index), push the right side onto the top of the Stack (i.e. push the $array_start_index and $array_end_index of the right side)
            $stackArray[++$top] = $partitioning_index + 1;
            $stackArray[++$top] = $array_end_index;
        }
    }
}



/**********************************************************************************************************************************************/



/*
// Recursive Approach (Passing By Reference)
$array = [4, 6, 9, 1, 2, 5]; // Unsorted array
$array_length     = count($array);
$array_last_index = $array_length - 1;
quicksortRecursive($array, 0, $array_last_index);
echo '<pre>', var_dump($array), '</pre>'; // After sorting
// echo '<pre>', print_r($array), '</pre>';  // After sorting
*/



// Iterative (Non-recursive) approach (Passing By Reference)
$array = [4, 6, 9, 1, 2, 5]; // Unsorted array
$array_length     = count($array);
$array_last_index = $array_length - 1;
quicksortIterative($array, 0, $array_last_index);
echo '<pre>', var_dump($array), '</pre>'; // After sorting
// echo '<pre>', print_r($array), '</pre>';  // After sorting