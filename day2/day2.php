<?php

$lines = file(__DIR__.'/day2-input.txt');
$valid = 0;

/* This solves Part 1 */
echo "####### Part 1 #########\n";
foreach ($lines as $line) {
    $line = trim($line);

    // Parse out the line content
    preg_match('/([0-9]+)\-([0-9]+) ([a-z]+): (.+)/', $line, $matches);

    // Find the number of occurrences of the letter in $matches[3]
    $count = substr_count($matches[4], $matches[3]);
    $range = range($matches[1], $matches[2]);

    if (in_array($count, $range)) {
        // echo 'VALID: '.$matches[4]."\n";
        $valid++;
    }
}
echo 'FOUND VALID: '.$valid."\n";
echo "\n";

/* This solves Part 2 */
$valid = 0;

echo "####### Part 2 #########\n";
foreach ($lines as $line) {
    $line = trim($line);

    // Parse out the line content
    preg_match('/([0-9]+)\-([0-9]+) ([a-z]+): (.+)/', $line, $matches);
    $letters = str_split($matches[4],1);

    // Check the two locations, -1 to match the zero index PHP arrays
    $check1 = ($letters[(int)$matches[1]-1] == $matches[3]);
    $check2 = ($letters[(int)$matches[2]-1] == $matches[3]);

    if ( ($check1 == true && $check2 == false) || ($check1 == false && $check2 == true) ) {
        // echo "VALID: ".$matches[3].' ('.$matches[1].'-'.$matches[2].') => '.$matches[4]."\n";
        $valid++;
    }
}
echo 'FOUND VALID: '.$valid."\n";
