<?php
// Note: This algorithm requires the data to be already sorted (from left to right ascendingly) beforehand!
// Binary Search algorithm
// Time Complexity: O(log n)    // log n because it includes division by 2 (binary! i.e. two!) (N.B. Just like Merge Sort!)
// Space Complexity: O(1)    // In-place



// Binary Search using 'Iteration' 'Iterative Approach' 'Non-recursive'
function binarySearchIterative($target, array $array): int|false { // The function returns the 'index' of the target
    $left_index = 0;
    $right_index = count($array) - 1; 

    while ($left_index <= $right_index) {
        $middle_index = floor(($left_index + $right_index) / 2); // Dividing by two / 2 denotes the 'binary' word in 'Binary Search', and also indicated the logarithmic relationship between the Input Size and the Time taken to search the array (Time Complexity Big O Notation)
        // echo $middle_index . '<br>';

        if ($array[$middle_index] == $target) {
            return $middle_index; // Target found. Return its index!
        } elseif ($array[$middle_index] > $target) {
            $right_index = $middle_index - 1;
            // echo $right_index . '<br>';
        } else { // If $array[$middle_index] < $target
            $left_index = $middle_index + 1;
            // echo $left_index . '<br>';
        }
    }


    return false; // target not found in the array
}


$sortedArray = [1, 3, 5, 7, 9, 11, 13];
$targetElement = 13;
echo '<pre>Iterative Approach:<br>', var_dump(binarySearchIterative($targetElement, $sortedArray)), '</pre>'; // binarySearchIterative() function returns the 'index' of the target



/**********************************************************************************************************************************************/



// Binary Search using 'Recursion' 'Recursive Approach'
function binarySearchRecursive($target, array $array, $left_index, $right_index): int|false { // The function returns the 'index' of the target
    // We start with the Base Case/Stopping Case/Terminating Case
    if ($left_index > $right_index) { // instead of the while loop in the 'Iterative' approach
        return false; // target not found in the array
    }

    $middle_index = floor(($left_index + $right_index) / 2); // Dividing by two / 2 denotes the 'binary' word in 'Binary Search', and also indicated the logarithmic relationship between the Input Size and the Time taken to search the array (Time Complexity Big O Notation)

    if ($array[$middle_index] == $target) {
        // echo $middle_index . '<br>';
        return $middle_index; // Target found. Return its index!
    } elseif ($array[$middle_index] > $target) {
        // echo $right_index . '<br>';
        return binarySearchRecursive($target, $array, $left_index, $middle_index - 1);
    } else { // If $array[$middle_index] < $target
        // echo $left_index . '<br>';
        return binarySearchRecursive($target, $array, $middle_index + 1, $right_index);
    }
}


$sortedArray = [1, 3, 5, 7, 9, 11, 13];
$targetElement = 13;
echo '<pre>Recursive Approach:<br>', var_dump(binarySearchRecursive($targetElement, $sortedArray, 0, count($sortedArray) - 1)), '</pre>'; // binarySearchRecursive() function returns the 'index' of the target    