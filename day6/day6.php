<?php

$content = file_get_contents(__DIR__.'/day6-input.txt');
$answers = explode("\n\n", $content);

##### Part 1 #######
$total = 0;

foreach ($answers as $a) {
    // For all of the lines, get the unique letters for the grouping
    $lines = explode("\n", trim($a));
    $letters = [];

    foreach ($lines as $l) {
        for ($i = 0; $i < strlen($l); $i++) {
            $char = $l[$i];
            if (in_array($char, $letters) == false) {
                $letters[] = $char;
            }
        }
    }
    $total += count($letters);
}
echo 'P1 TOTAL: '.$total."\n";

#### Part 2 ######
$all = [];
$total = 0;

foreach ($answers as $a) {
    $lines = explode("\n", trim($a));

    // Count the number of lines at the start
    $lc = count($lines);

    $letters = [];
    foreach ($lines as $l) {
        for ($i = 0; $i < strlen($l); $i++) {
            $char = $l[$i];
            if (isset($letters[$char]) == false) {
                $letters[$char] = 1;
            } else {
                $letters[$char]++;
            }
        }
    }

    // Find the letters with a count that equals the number of lines
    $letters = array_filter($letters, function($value) use ($lc) {
        return $value >= $lc;
    });
    $total += count($letters);
}
echo 'P2 TOTAL: '.$total."\n";
