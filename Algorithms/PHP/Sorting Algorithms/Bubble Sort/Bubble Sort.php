<?php
// Bubble Sort algorithm
// Time Complexity: O(n^2)
// Space Complexity: O(1)
// It's called "Bubble" Sort because the largest number "bubbles" up to the far right end of the array
// It's called "Bubble" Sort because with every outer loop iteration, the largest number "bubbles" up to the far right side of the array
// The Sorted Array gets formed from the right side (end) of the array towards the left side (beginning)
// The last element after each pass becomes in its correct position
// The last element after each pass is in its correct position.



// Passing By Value
function bubbleSort(array $array): array {
    $array_last_index = count($array) - 1;

    for ($i = 0; $i < $array_last_index; $i++) { // loop till the next-to-last index of the array
        $is_swapped = false; // flag. Change it to 'false' with every outer loop iteration

        for ($j = 0; $j < $array_last_index - $i; $j++) { // Decrease -1 index from the right end of the array with every loop iteration
            if ($array[$j] > $array[$j + 1]) {
                // Swap elements
                $temporaryVariable = $array[$j]; // Temporary variable used for swapping
                $array[$j] = $array[$j + 1];
                $array[$j + 1] = $temporaryVariable;

                $is_swapped = true; // Chagne the $flag from 'false' to 'true'. Swapping happened/occured
            }
        }

        if ($is_swapped == false) { // If there're no elements have been swapped, the array has been sorted or it's already sorted in the first place (it's already sorted from the beginning)
            break; // break out of the loop
        }
    }


    return $array;
}



/*
// Passing By Reference: The same but with passing the argument By Reference (i.e. passing in the reference of an argument to the corresponding parameter of the called function) and removing the Return Statement and removing the function Return Type Declaration
function bubbleSort(array &$array) { // No Return Type Declaration
    $array_last_index = count($array) - 1;

    for ($i = 0; $i < $array_last_index; $i++) { // loop till the next-to-last index of the array
        $is_swapped = false; // flag

        for ($j = 0; $j < $array_last_index - $i; $j++) {
            if ($array[$j] > $array[$j + 1]) {
                // Swap elements
                $temporaryVariable = $array[$j]; // Temporary variable used for swapping
                $array[$j] = $array[$j + 1];
                $array[$j + 1] = $temporaryVariable;

                $is_swapped = true; // Swapping happened/occured
            }
        }


        if ($is_swapped == false) { // If no elements have been swapped, the array has been sorted or it's already sorted in the first place (it's already sorted from the beginning)
            break; // break out of the loop
        }
    }


    // return $array; // No return statement (Passing By Reference)
}
*/



// Passing By Value
echo '<pre>', var_dump(bubbleSort([64, 34, 25, 12, 22, 11, 90])), '</pre>';
echo '<pre>', print_r(bubbleSort([64, 34, 25, 12, 22, 11, 90])), '</pre>';



/*
// Passin By Reference
$toBeSortedArray = [64, 34, 25, 12, 22, 11, 90];
bubbleSort($toBeSortedArray);
echo '<pre>', var_dump($toBeSortedArray), '</pre>';
echo '<pre>', print_r($toBeSortedArray), '</pre>';
*/