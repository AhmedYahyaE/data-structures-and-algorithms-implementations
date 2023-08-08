<?php
// Insertion Sort algorithm
// Time Complexity: O(n^2)
// Space Complexity: O(1)

/*
// FIRST: MY OWN IMPLEMENTATION (which is a little different the prevailing implementation of the algorithm)
// Passing By Value
function insertionSort(array $array): array {
    $array_length = count($array);

    for ($i = 1; $i < $array_length; $i++) {
        $current_value = $array[$i];

        while ($i >= 1 && $current_value < $array[$i - 1]) { // is the same as:    while ($i > 0 && $current_value < $array[$i - 1]) {
            // echo $i . '<br>';
            $array[$i] = $array[$i - 1];
            $i--; // is the same as:    $i = $i - 1;    is the same as:    $i -=1;
        }

        $array[$i] = $current_value;
    }


    return $array;
}
*/


/*
// MY OWN IMPLEMENTATION (which is a little different the prevailing implementation of the algorithm)
// Passing By Reference: The same but with passing the argument By Reference (i.e. passing in the reference of an argument to the corresponding parameter of the called function) and removing the return statement and removing the function return type
function insertionSort(array &$array): void {
    $array_length = count($array);

    for ($i = 1; $i < $array_length; $i++) {
        $current_value = $array[$i];

        while ($i >= 1 && $current_value < $array[$i - 1]) { // is the same as:    while ($i > 0 && $current_value < $array[$i - 1]) {
            // echo $i . '<br>';
            $array[$i] = $array[$i - 1];
            $i--; // is the same as:    $i = $i - 1;    is the same as:    $i -=1;
        }

        $array[$i] = $current_value;
    }


    // return $array; // No return statement (Passing By Reference)
}
*/




// SECOND: The prevailing implementation of the algorithm
// Passing By Value
function insertionSort(array $array): array {
    $array_length = count($array);

    for ($i = 1; $i < $array_length; $i++) {
        $current_value        = $array[$i];
        $previous_value_index = $i - 1; // $j = $i - 1;

        while ($previous_value_index >= 0 && $current_value < $array[$previous_value_index]) {
            $array[$previous_value_index + 1] = $array[$previous_value_index];
            $previous_value_index--; // is the same as:    $previous_value_index = $previous_value_index - 1;    is the same as:    $previous_value_index -=1;
            // echo $previous_value_index . '<br>';
        }

        // echo $previous_value_index . '<br>';
        $array[$previous_value_index + 1] = $current_value; // + 1 is because the $previous_value_index has been decreased by -1 in the last iteration inside the while loop just before breaking out of the loop
    }
    

    return $array;
}



/*
// SECOND: The prevailing implementation of the algorithm
// Passing By Reference: The same but with passing the argument By Reference (i.e. passing in the reference of an argument to the corresponding parameter of the called function) and removing the return statement and removing the function return type
function insertionSort(array &$array): void {
    $array_length = count($array);

    for ($i = 1; $i < $array_length; $i++) {
        $current_value        = $array[$i];
        $previous_value_index = $i - 1; // $j = $i - 1;

        while ($previous_value_index >= 0 && $current_value < $array[$previous_value_index]) {
            $array[$previous_value_index + 1] = $array[$previous_value_index];
            $previous_value_index--; // is the same as:    $previous_value_index = $previous_value_index - 1;    is the same as:    $previous_value_index -=1;
            // echo $previous_value_index . '<br>';
        }

        // echo $previous_value_index . '<br>';
        $array[$previous_value_index + 1] = $current_value;
    }
}
*/



// Using Passing by Value (a copy of the original array)
echo '<pre>', var_dump(insertionSort([60, 90, 20, 10, 50, 2])), '</pre>'; // [2, 10, 20, 50, 60, 90]
// echo '<pre>', print_r(insertionSort([60, 90, 20, 10, 50, 2])), '</pre>';  // [2, 10, 20, 50, 60, 90]


/*
// Using passing by Reference (in case of passing by Reference, you must pass a VARIABLE to the function, not an actual array)
$to_be_sorted_array = [60, 90, 20, 10, 50, 2];
insertionSort($to_be_sorted_array); // [2, 10, 20, 50, 60, 90]
echo '<pre>', var_dump($to_be_sorted_array), '</pre>';  // [2, 10, 20, 50, 60, 90]
echo '<pre>', print_r($to_be_sorted_array), '</pre>';  // [2, 10, 20, 50, 60, 90]
*/