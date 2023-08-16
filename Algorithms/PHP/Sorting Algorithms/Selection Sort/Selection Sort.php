<?php
// Selection Sort algorithm
// Time Complexity: O(n^2)
// Space Complexity: O(1)    // In-place
// The sorted array forms the left side of the array towards the right side of the array



// Passing By Value
function selectionSort(array $array): array {
    $array_length = count($array);
    $array_last_index = $array_length - 1;

    for ($i = 0; $i < $array_last_index; $i++) { // loop till the next-to-last index of the array (because we'll use the $j variable which is    $j = $i + 1    )
        $smallestNumberIndex = $i; // We suppose this!

        // Do a Linear Search / Sequential Search to determine the smallest number array index
        for ($j = $i + 1; $j < $array_length; $j++) { // Start from the 2nd index till the end of the array
            // echo $j . '<br>';
            if ($array[$j] < $array[$smallestNumberIndex]) {
                // echo $j . '<br>';
                $smallestNumberIndex = $j;
                // echo $smallestNumberIndex . '<br>';
            }
        }
        // exit;

        if ($smallestNumberIndex != $i) { // If the supposition/hypothesis we made at the beginning of the outer loop (i.e.    $smallestNumberIndex = $i;    ) has been CHANGED by the if condition inside the inner/nested loop, this means that there is some sorting to make 
            // Swap elements
            $temporaryVariable = $array[$i]; // Temporary variable used for swapping
            $array[$i] = $array[$smallestNumberIndex]; // Replace the leftmost number with the smallest number
            $array[$smallestNumberIndex] = $temporaryVariable; // Replace the smallest number with the leftmost number
        }
    }


    return $array;
}



/*
// Passing By Reference: The same but with passing the argument By Reference (i.e. passing in the reference of an argument to the corresponding parameter of the called function) and removing the Return Statement and removing the function Return Type Declaration
function selectionSort(array &$array) {
    $array_length = count($array);
    $array_last_index = $array_length - 1;

    for ($i = 0; $i < $array_last_index; $i++) { // loop till the next-to-last index of the array (because we'll use the $j variable which is    $j = $i + 1    )
        $smallestNumberIndex = $i; // We suppose this!

        // Do a Linear Search / Sequential Search to determine the array index of the smallest number
        for ($j = $i + 1; $j < $array_length; $j++) { // Start from the 2nd index till the end of the array
            // echo $j . '<br>';
            if ($array[$j] < $array[$smallestNumberIndex]) {
                // echo $j . '<br>';
                $smallestNumberIndex = $j;
                // echo $smallestNumberIndex . '<br>';
            }
        }
        // exit;

        if ($smallestNumberIndex != $i) { // If the supposition/hypothesis we made at the beginning of the outer loop (i.e.    $smallestNumberIndex = $i;    ) has been changed by the if condition in the nested/inner loop, this means that there is some sorting to make 
            // Swap elements
            $temporaryVariable = $array[$i]; // Temporary variable used for swapping
            $array[$i] = $array[$smallestNumberIndex]; // Replace the leftmost number with the smallest number
            $array[$smallestNumberIndex] = $temporaryVariable; // Replace the smallest number with the leftmost number
        }
    }


    // return $array; // No return statement (Passing By Reference)
}
*/



// Passing By Value
echo '<pre>', var_dump(selectionSort([64, 25, 12, 22, 11])), '</pre>';
echo '<pre>', print_r(selectionSort([64, 25, 12, 22, 11])), '</pre>';



/* 
// Passin By Reference
$toBeSortedArray = [64, 25, 12, 22, 11];
selectionSort($toBeSortedArray);
echo '<pre>', var_dump($toBeSortedArray), '</pre>';
echo '<pre>', print_r($toBeSortedArray), '</pre>';
*/