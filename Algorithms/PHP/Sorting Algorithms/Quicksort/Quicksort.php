<?php
// Quicksort algorithm
// Time Complexity: O(n^2)    // But O(n^2) is rarely encountered in practice due to various pivot selection strategies. On average, it has an O(n log n) time complexity
// Space Complexity: O(n)    // The space complexity of Quicksort is determined by the recursion depth and the extra space used for partitioning. In the average and best cases, the recursion depth is log n, and the space used for partitioning is O(log n). However, in the worst case (unbalanced partitioning), the recursion depth can be as high as n, resulting in O(n) space complexity.
// Divide and Conquer algorithm



function quicksortRecursive(&$array, $array_start_index, $array_end_index) { // Passing By Reference
    // Recursion Base Case / Stopping Case / Terminating Case
    if ($array_start_index < $array_end_index) {
        $partitioning_index = partition($array, $array_start_index, $array_end_index); // $partitioning_index is the $pivot
        // echo '<pre>', var_dump($array), '</pre>';
        // echo $partitioning_index . '<br>';
        // exit;

        quicksortRecursive($array, $array_start_index, $partitioning_index - 1); // the left  side of the $pivot
        quicksortRecursive($array, $partitioning_index + 1, $array_end_index);   // the right side of the $pivot
    }

    // This part is for testing purposes ONLY (to count the total number of function calls that happened in the Call Stack)
    static $counter = 0; // Attention: 'static' variable MUST be used here in order retain the variable value inside the recursive function calls!    // PHP Static Variables: https://www.php.net/manual/en/language.variables.scope.php#language.variables.scope.static:~:text=inside%20a%20function.-,Using%20static%20variables,-Another%20important%20feature    // Static variables with recursive functions: https://www.php.net/manual/en/language.variables.scope.php#language.variables.scope.static:~:text=Example%20%236%20Static%20variables%20with%20recursive%20functions
    echo 'This is my counter for the total function calls number in the Call Stack: <b>' . ++$counter . '</b><br>'; // N.B. Pre-Increment Operator must be used, not post-increment operator, in order for the $counter variable to be incremented BEFORE getting printed/echo-ed!
    // echo 'This is my counter for function calls number in the Call Stack: <b>' . $counter . '</b><br>'; // ... This is wrong! Doesn't Work! Gives wrong counting!
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

    for ($j = $arrayStartIndex; $j <= $arrayEndIndex - 1; $j++) { // is the same as:    for ($j = $arrayStartIndex; $j < $arrayEndIndex; $j ++) {    // Looping till before the $pivot    (    $pivot = $array[$arrayEndIndex];    )
        if ($array[$j] < $pivot) { // Increment & Swap
            $leftPointer++;
            swap($array[$j], $array[$leftPointer]); // is the same as:    swap($array[$leftPointer], $array[$j]);
            // swap($array[$leftPointer], $array[$j]); // is the same as:    swap($array[$j], $array[$leftPointer]);
        }
    }

    // echo $leftPointer + 1 . '<br>';
    // echo '</b>$array[$arrayEndIndex]</b> is <b>' . $array[$arrayEndIndex] . '</b> and <b>$pivot</b> is <b>' . $pivot . '</b><br><br>';


    // Finally swap the $pivot (i.e.    $array[$arrayEndIndex]    ) with the element just after the $leftPointer i.e.    $leftPointer + 1
    // swap($array[$leftPointer + 1], $pivot); // Wrong! Doesn't work!    // Note: Although    $pivot = $array[$arrayEndIndex];    , we can't use $pivot instead of $array[$arrayEndIndex] here (i.e.    swap($array[$leftPointer + 1], $pivot);    ), because we're swapping the two numbers inside an ARRAY (we can't use the $pivot variable because any variable is just a COPY from the original value)
    swap($array[$leftPointer + 1], $array[$arrayEndIndex]); // Note: Although    $pivot = $array[$arrayEndIndex];    , we can't use $pivot instead of $array[$arrayEndIndex] here (i.e.    swap($array[$leftPointer + 1], $pivot);    ), because we're swapping the two numbers inside an ARRAY (we can't use the $pivot variable because any variable is just a COPY from the original value)    // is the same as:    swap($array[$arrayEndIndex], $array[$leftPointer + 1]);
    // swap($array[$arrayEndIndex], $array[$leftPointer + 1]); // Note: Although    $pivot = $array[$arrayEndIndex];    , we can't use $pivot instead of $array[$arrayEndIndex] here (i.e.    swap($array[$leftPointer + 1], $pivot);    ), because we're swapping the two numbers inside an ARRAY (we can't use the $pivot variable because any variable is just a COPY from the original value)    // is the same as:    swap($array[$leftPointer + 1], $array[$arrayEndIndex]);

    
    // echo $leftPointer + 1 . '<br>';
    // exit;
    return $leftPointer + 1; // Return the new $pivot or $partitioning_index (Check the quicksortRecursive() function)
}




/**********************************************************************************************************************************************/



function quicksortIterative(&$array, $array_start_index, $array_end_index) { // Passing By Reference
    // Create an auxiliary 'Stack' Data Structure (NOTHING DIFFERENT THAN a PHP array i.e. it's just a simple PHP array that we keep appending values to it)
    $stackArray = array_fill(0, $array_end_index - $array_start_index + 1, 0); // The stack is fileed with 0 zeros
    // echo '<pre>', var_dump($stackArray), '</pre>';

    // Initialize the top of the Stack (i.e. the top index)
    $top = -1;

    // Push the initial values of both the $array_start_index and $array_end_index to the Stack
    $stackArray[++$top] = $array_start_index; // Note: Pre-Increment Operator MUST be used here, not post-increment operator!    $stackArray[$top++] = $array_start_index;    doesn't work!    // Append to the PHP array
    $stackArray[++$top] = $array_end_index;   // Note: Pre-Increment Operator MUST be used here, not post-increment operator!    $stackArray[$top++] = $array_end_index;      doesn't work!    // Append to the PHP array
    echo '<pre>', var_dump($stackArray), '</pre>';

    echo '<b>$top</b> index </b> is <b>' . $top . '</b><br>';

    // Keep popping $array_start_index-es and $array_end_index-es off the Stack while it's not empty    // Here, we use the while loop in place of 'Recursion' in the quicksortRecursive() function in order to keep calling the partition() function
    while ($top >= 0) { // is the same as:    while ($top > -1) {
        // Remove the $array_start_index and $array_end_index from the PHP array (i.e. pop them off the Stack), but create variables of their values to use them later with the partition() function
        $array_end_index   = $stackArray[$top--]; // Note: Post-Decrement Operator MUST be used here, not pre-decrement operator!    $stackArray[--$top];    doesn't work!    // Append to the PHP array
        $array_start_index = $stackArray[$top--]; // Note: Post-Decrement Operator MUST be used here, not pre-decrement operator!    $stackArray[--$top];    doesn't work!    // Append to the PHP array
        echo '<b>$top</b> index </b> is <b>' . $top . '</b><br>';
        echo '<pre>', var_dump($stackArray), '</pre>';
        exit;

        $partitioning_index = partition($array, $array_start_index, $array_end_index); // $partitioning_index is the $pivot
        // echo '<pre>', var_dump($array), '</pre>';
        // echo '<pre>', var_dump($stackArray), '</pre>';
        // echo $partitioning_index . '<br>';
        // exit;


        if ($partitioning_index - 1 > $array_start_index) { // If there are elements on the left side of the pivot ($partitioning_index), push the left side to the Stack (i.e. push the $array_start_index and $array_end_index of the left side)
            $stackArray[++$top] = $array_start_index;      // Note: Pre-Increment Operator MUST be used here, not post-increment operator!    $stackArray[$top++] = $array_start_index;    doesn't work!
            $stackArray[++$top] = $partitioning_index - 1; // Note: Pre-Increment Operator MUST be used here, not post-increment operator!    $stackArray[$top++] = $array_start_index;    doesn't work!
        }

        if ($partitioning_index + 1 < $array_end_index) { // If there are elements on the right side of the pivot ($partitioning_index), push the right side to the Stack (i.e. push the $array_start_index and $array_end_index of the right side)
            $stackArray[++$top] = $partitioning_index + 1; // Note: Pre-Increment Operator MUST be used here, not post-increment operator!    $stackArray[$top++] = $array_start_index;    doesn't work!
            $stackArray[++$top] = $array_end_index;        // Note: Pre-Increment Operator MUST be used here, not post-increment operator!    $stackArray[$top++] = $array_start_index;    doesn't work!
        }
    }

    echo '<b>$top</b> index </b> is <b>' . $top . '</b><br>';
    // echo '<pre>', var_dump($stackArray), '</pre>';
    // exit;
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
// echo '<pre>', var_dump($array), '</pre>'; // After sorting
// echo '<pre>', print_r($array), '</pre>';  // After sorting