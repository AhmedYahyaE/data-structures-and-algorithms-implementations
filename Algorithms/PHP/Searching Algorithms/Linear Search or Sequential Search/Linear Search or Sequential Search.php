<?php
// Linear Search / Sequential Search Algorithm
// The Linear Search algorithm is best suited for small lists or when the list is not sorted (unsorted lists)
// Time Complexity: O(n)
// Space Complexity: O(1)    // In-place

function linearSearchOrSequentialSearch($target, $array) {
    $array_length = count($array);

    for ($i = 0; $i < $array_length; $i++) {
        if ($array[$i] == $target) {
            return $i; // $target found! Return its index
        }
    }


    return false; // $target not found
}



echo '<pre>', var_dump(linearSearchOrSequentialSearch(3, [10, 5, 3, 8, 2, 7])), '</pre>';