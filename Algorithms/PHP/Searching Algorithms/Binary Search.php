<?php
// Note: This algorithm requires the data to be already sorted (from left to right ascendingly) beforehand!

// Binary Search algorithm
// Time Complexity: O(log n)
// Space Complexity: O(1)


function binarySearch($target, array $array): int|false { // The function returns the 'index' of the target
    $left_index = 0;
    $right_index = count($array) - 1; // last array index/key = array length/size - 1

    while ($left_index <= $right_index) {
        $mid_index = floor (($left_index + $right_index) / 2);
        // echo $mid_index . '<br>';

        if ($array[$mid_index] == $target) {
            return $mid_index; // Target found. Return its index!
        } elseif ($array[$mid_index] > $target) {
            $right_index = $mid_index - 1;
            // echo $right_index . '<br>';
        } else { // If $array[$mid_index] < $target
            $left_index = $mid_index + 1;
            // echo $left_index . '<br>';
        }
    }


    return false; // target not found in the array
}


// TODO: Implement binarySearch using 'Recursion'
function binarySearchRecursion() {
    
}



$sortedArray = [1, 3, 5, 7, 9, 11, 13];
$targetElement = 13;
echo '<pre>', var_dump(binarySearch($targetElement, $sortedArray)), '</pre>'; // binarySearch() function returns the 'index' of the target
echo '<pre>', var_dump(binarySearchRecursion($targetElement, $sortedArray)), '</pre>'; // binarySearch() function returns the 'index' of the target