<?php
// Merge Sort algorithm
// Time Complexity: O(n*log n) or T(n) = 2T(n/2) + O(n)    // n log n (i.e. logarithmic) because it encompasses division by 2 (N.B. Just like Bubble Sort!)
// Space Complexity: O(n)    // Non In-Place algorithm, which means it requires much memory
// Divide and Conquer algorithm (Divide: the unsorted array into two halves & Conquer: Recursively sort each of the halves)
// Note: The mergeSortRecursive_2(), mergeSortIterative_2() and merge_2() function are the most prevalent common implementations on the Internet!



// Recursive 1 Approach/Solution (Recursion) - Top-Down Merge Sort
function mergeSortRecursive_1(array $array) {
    $array_length = count($array);
    
    // Recursion Base Case/ Stopping Case / Terminating Case
    if ($array_length <= 1) {
        return $array; // Important Note: Here the 'return' doesn't get us out of the function immediately but gets us out of last function instance in the Call Stack, that's because the mergeSortRecursive_1() function is called recursively (i.e. functions inside functions)
    }



    $middle_index = (int) ($array_length / 2); // (int) is Type Casting from float to integer in case of odd array length producing a float (e.g.    7 / 2 = 3.5 becomes 3    )    // array index/key = array length/size - 1    // If the length of the array is 1 or less, it's already sorted, so we return the array as is
    // echo $middle_index . '<br>';

    // Cut the array into two halves
    $left_array_half  = array_slice($array, 0, $middle_index); // Extract the array from the beginning till the its half
    $right_array_half = array_slice($array, $middle_index);    // Extract the array from its half to its end

    // echo '<pre>', var_dump($left_array_half), '</pre>';
    // echo '<pre>', var_dump($right_array_half), '</pre>';
    // exit;

    // Recursively call mergeSortRecursive_1() on both $left and $right halves (Recursion)
    $left_array_half  = mergeSortRecursive_1($left_array_half); // Call mergeSortRecursive_1() recursively on the $left_array_half FIRST till it's exhausted and merged (i.e. merge() function is called) ...
    $right_array_half = mergeSortRecursive_1($right_array_half); // Afterwards, call mergeSortRecursive_1() recursively on the $right_array_half SECONDLY till it's exhausted and merged (i.e. merge() function is called) ...
    // ... Then call merge() on both the $left_array_half and right_array_half

    // echo '<pre>', var_dump($left_array_half), '</pre>';
    // echo '<pre>', var_dump($right_array_half), '</pre>';
    // exit;

    return merge_1($left_array_half, $right_array_half);
}

// Time Complexity of merging is Linear O(n), and it's the cause of that the Space Complexity is O(n)
function merge_1(array $leftArray, array $rightArray): array { // This function ascendingly sorts/arranges numbers inside arrays then merges them (e.g.    merge([12], [11, 13])    results in/returns    [11, 12, 13]    )
    $leftArrayLength  = count($leftArray);
    $rightArrayLength = count($rightArray);

    $sortedMergedArray = [];
    $leftArrayIndex  = 0; // Reset to 0 zero with every new/fresh merge() function call
    $rightArrayIndex = 0; // Reset to 0 zero with every new/fresh merge() function call


    while ($leftArrayIndex < $leftArrayLength && $rightArrayIndex < $rightArrayLength) {
        if ($leftArray[$leftArrayIndex] <= $rightArray[$rightArrayIndex]) {
            $sortedMergedArray[] = $leftArray[$leftArrayIndex]; // Append element (array_push())

            $leftArrayIndex++;
        } else {
            $sortedMergedArray[] = $rightArray[$rightArrayIndex]; // Append element (array_push())

            $rightArrayIndex++;
        }
    }



    // Handle Remaining Elements: Based on the fact that both the left array and right array are already sorted, and in case that the lengths of the right and left arrays are not equal i.e. there's a shorter/longer array than the other, copy over the elements (append) of the longer array that can't be compared as is (Example:    $leftArray = [11, 19, 20] and $rightArray = [17, 18]    )
    while ($leftArrayIndex < $leftArrayLength) {
        $sortedMergedArray[] = $leftArray[$leftArrayIndex]; // Append element (array_push())
        $leftArrayIndex++;
    }

    // Handle Remaining Elements: Based on the fact that both the left array and right array are already sorted, and in case that the lengths of the right and left arrays are not equal i.e. there's a shorter/longer array than the other, copy over the elements (append) of the longer array that can't be compared as is (Example:    $leftArray = [11, 19, 20] and $rightArray = [17, 18]    )
    while ($rightArrayIndex < $rightArrayLength) {
        $sortedMergedArray[] = $rightArray[$rightArrayIndex]; // Append element (array_push())
        $rightArrayIndex++;
    }



    return $sortedMergedArray;
}



// Recursive 2 Approach/Solution (Recursion) - Top-Down Merge Sort - the most prevalent common implementation on the Internet
function mergeSortRecursive_2(&$array, $left_array_index, $right_array_index) {
    if ($left_array_index < $right_array_index) {
        $middle_index = $left_array_index + (int) (($right_array_index - $left_array_index) / 2); // (int) is Type Casting from float to integer in case of odd array length producing a float (e.g.    7 / 2 = 3.5 becomes 3    )    // array index/key = array length/size - 1    // If the length of the array is 1 or less, it's already sorted, so we return the array as is
 
        // Sort first and second halves
        mergeSortRecursive_2($array, $left_array_index, $middle_index);
        mergeSortRecursive_2($array, $middle_index + 1, $right_array_index); // $middle_index is the end index in the left array, so this means that the first index in the right array is the first element after the $middle_index
 
        merge_2($array, $left_array_index, $middle_index, $right_array_index);
    }
}

// Another merge() function implementation variation    // Time Complexity of merging is Linear O(n), and it's the cause of that the Space Complexity is O(n)
function merge_2(&$array, $leftArrayStartIndex, $middle_index, $rightArrayEndIndex) { // Passing By Reference
    $leftArrayLength  = $middle_index - $leftArrayStartIndex + 1; // $middle_index represents the end index of the left array     // $array_end_index represents the end index of the right array
    $rightArrayLength = $rightArrayEndIndex - $middle_index;

    // Form the two subarrays (the left array and the right array)
    $leftArray  = [];
    $rightArray = [];

    for ($leftArrayIndex = 0; $leftArrayIndex < $leftArrayLength; $leftArrayIndex++) {
        $leftArray[$leftArrayIndex] = $array[$leftArrayStartIndex + $leftArrayIndex];
    }

    for ($rightArrayIndex = 0; $rightArrayIndex < $rightArrayLength; $rightArrayIndex++) {
        $rightArray[$rightArrayIndex] = $array[($middle_index + 1) + $rightArrayIndex]; // $middle_index is the end index of the left array
    }



    // Compare the left array and the right array with each other
    $i = 0; // left subarray index
    $j = 0; // right subarray index
    $sortedMergedArrayIndex = $leftArrayStartIndex; // merged array $array index (the final resulting sorted array)

    while ($i < $leftArrayLength && $j < $rightArrayLength) {
        if ($leftArray[$i] <= $rightArray[$j]) {
            $array[$sortedMergedArrayIndex] = $leftArray[$i];
            $i++;
        } else {
            $array[$sortedMergedArrayIndex] = $rightArray[$j];
            $j++;
        }


        $sortedMergedArrayIndex++;
    }



    // Handle Remaining Elements: Based on the fact that both the left array and right array are already sorted, and in case that the lengths of the right and left arrays are not equal i.e. there's a shorter/longer array than the other, copy over the elements (append) of the longer array that can't be compared as is (Example:    $leftArray = [11, 19, 20] and $rightArray = [17, 18]    )
    while ($i < $leftArrayLength) { // if there are any remaining elements in the the left subarray
        $array[$sortedMergedArrayIndex] = $leftArray[$i];
        $i++;
        $sortedMergedArrayIndex++;
    }

    while ($j < $rightArrayLength) { // if there are any remaining elements in the the right subarray
        $array[$sortedMergedArrayIndex] = $rightArray[$j];
        $j++;
        $sortedMergedArrayIndex++;
    }
}



// Iterative (Non-recursive) Approach/Solution (loops) - Bottom-Up Merge Sort
function mergeSortIterative_1(array $array) {
    $array_length = count($array);

    for ($current_array_length = 1; $current_array_length < $array_length; $current_array_length = $current_array_length * 2) { // We'll start by assuming that the array length is 1 (the array lengths will be like 1, 2, 4, 8, 16, ...)    // We loop till the    array length/size - 1    only because in case the array length/size is odd, we'll leave the last element as is, since there's no need to sort it    // $current_array_length = $current_array_length * 2    is the same as:    $current_array_length *= 2
        for ($left_array_start_index = 0; $left_array_start_index < $array_length - $current_array_length; $left_array_start_index = $left_array_start_index + ($current_array_length * 2)) { //    $left_array_start_index = $left_array_start_index + ($current_array_length * 2)    is the same as    $left_array_start_index += $current_array_length * 2
            $left_array_end_index = $left_array_start_index + $current_array_length - 1;
            // echo '<b>$current_array_length</b> is <b>' . $current_array_length . '</b><br>';
            // echo '<b>$left_array_start_index</b> = <b>' . $left_array_start_index . '</b>, and <b>$left_array_end_index</b> is <b>' . $left_array_end_index . '</b><br>';
            // exit;

            $right_array_start_index = $left_array_start_index + $current_array_length;
            $right_array_end_index = min($left_array_start_index + ($current_array_length * 2) - 1, $array_length - 1); // Using the min() function: In case that the $right_array_end_index exceeds the original array length/size, We take the minimum of the two
            // echo '<b>$right_array_start_index</b> = <b>' . $right_array_start_index . '</b>, and <b>$right_array_end_index</b> is <b>' . $right_array_end_index . '</b><br>';

            // echo '<br><br>';


            $left_array_half = array_slice($array, $left_array_start_index, $left_array_end_index - $left_array_start_index + 1); // Check the difference between the behavior of array_slice() and array_splice() at the bottom of this file!
            // echo '<pre>', var_dump($left_array_half), '</pre>';
            // exit;
            $right_array_half = array_slice($array, $right_array_start_index, $right_array_end_index - $right_array_start_index + 1); // Check the difference between the behavior of array_slice() and array_splice() at the bottom of this file!
            // echo '<pre>', var_dump($right_array_half), '</pre>';
            // exit;

            $merged_sorted_array = merge_1($left_array_half, $right_array_half);
            // echo '<pre>', var_dump(count($merged_sorted_array)), '</pre>';
            // echo '<pre>', var_dump($merged_sorted_array), '</pre>';
            // exit;

            array_splice($array, $left_array_start_index, count($merged_sorted_array), $merged_sorted_array); // Check the difference between the behavior of array_slice() and array_splice() at the bottom of this file!
            // echo '<pre>', var_dump($array), '</pre>';
            // exit;
        }
    }


    return $array;
}



// Another mergeSortIterative() and merge() functions implementation variation - Bottom-Up Merge Sort - the most prevalent common implementation on the Internet - minimal differences:
function mergeSortIterative_2(&$array) { // Passing By Reference
    $array_length = count($array);
            
    for ($currrent_array_length = 1; $currrent_array_length < $array_length; $currrent_array_length = $currrent_array_length * 2) {
        for ($left_array_start_index = 0; $left_array_start_index < $array_length - 1; $left_array_start_index = $left_array_start_index + ($currrent_array_length * 2)) { // We used    $array_length - 1    because the $middle_index (the left array end index) can never be the last index of the original array (because if so, how the right array would start and end!)
            $middle_index    = min($left_array_start_index + $currrent_array_length - 1      , $array_length - 1); // $middle_index represents the end index of the left array     // Using the min() function: In case that the $middle_index (which represents the left array end index) exceeds the original array length/size, We take the minimum of the two
            $array_end_index = min($left_array_start_index + ($currrent_array_length * 2) - 1, $array_length - 1); // $array_end_index represents the end index of the right array    // Using the min() function: In case that the $array_end_index (which represents the right array end index) exceeds the orignial array length/size, We take the minimum of the two

            echo '<b>$currrent_array_length</b> is <b>' . $currrent_array_length . '</b><br>';
            echo '<b>$left_array_start_index</b> is <b>' . $left_array_start_index . '</b>, and <b>$middle_index</b> is <b>' . $middle_index . '</b> and <b>$array_end_index</b> is <b>' . $array_end_index . '</b><br>';
            echo '<br><br>';
            // exit;

            /*
                Example: [12, 11, 13, 5, 6, 7]
                          0 , 1 , 2 , 3, 4, 5


                    $current_array_length = 1
                        [0][1]
                        [2][3]
                        [4][5]

                    $current_array_length = 2
                        [0, 1][2, 3]
                        [4, 5][5]

                    $current_array_length = 4
                        [0, 1, 2, 3][4, 5]
            */

            merge_2($array, $left_array_start_index, $middle_index, $array_end_index); // $middle_index represents the end index of the left array     // $array_end_index represents the end index of the right array
        }
    }
}



// Recursive 1 approach
// echo '<pre>', var_dump(mergeSortRecursive_1([12, 11, 13, 5, 6, 7])), '</pre>';
// echo '<pre>', print_r(mergeSortRecursive_1([12, 11, 13, 5, 6, 7])), '</pre>';



// Recursive 2 approach
$array = [12, 11, 13, 5, 6, 7]; // Unsorted array
$array_length     = count($array);
$array_last_index = $array_length - 1;
mergeSortRecursive_2($array, 0, $array_last_index);
echo '<pre>', var_dump($array), '</pre>'; // After sorting
// echo '<pre>', print_r($array), '</pre>';  // After sorting



// Iterative 1 (Non-recursive) approach
// echo '<pre>', var_dump(mergeSortIterative_1([12, 11, 13, 5, 6, 7])), '</pre>';
// echo '<pre>', print_r(mergeSortIterative_1([12, 11, 13, 5, 6, 7])), '</pre>';



// Iterative 2 (Non-recursive) approach (Passing By Reference)
// $array = [12, 11, 13, 5, 6, 7]; // Unsorted array
// mergeSortIterative_2($array);
// echo '<pre>', var_dump($array), '</pre>'; // After sorting
// echo '<pre>', print_r($array), '</pre>';  // After sorting



/*
// Note the difference in behavior between array_slice() and array_splice() functions!
// array_slice():
$array_slice = [5, 9, 2, 7, 3];
echo '<pre>', var_dump(array_slice($array_slice, 2)), '</pre>'; // array_slice() 'return'-s the sliced portion of the array
echo '<pre>', var_dump($array_slice), '</pre>'; // array_slice() doesn't change the original array

// array_splice():
$array_splice = [5, 9, 2, 7, 3];
echo '<pre>', var_dump(array_splice($array_splice, 2)), '</pre>'; // array_splice() 'return'-s the sliced portion of the array
echo '<pre>', var_dump($array_splice), '</pre>'; // array_splice() changes the original array
*/