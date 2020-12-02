<?php

$lines = file(__DIR__.'/day1-input.txt');

/* Finds the solution for Part 1 */
echo "###### Part 1 ##########\n";
foreach ($lines as $line1) {
    // Take this one and add each other line
    foreach ($lines as $line2) {

        if ((int)$line1 + (int)$line2 == 2020) {
            echo trim($line1).' * '.trim($line2)." => ".((int)$line1*(int)$line2)."\n";
        }

    }
}
echo "\n";

/* Finds the solution for Part 2 */
echo "###### Part 2 ##########\n";
foreach ($lines as $line1) {
    foreach ($lines as $line2) {
        foreach ($lines as $line3) {
            if ((int)$line1 + (int)$line2 + (int)$line3 == 2020) {
                echo trim($line1).' * '.trim($line2)." * ".trim($line3)." => ".((int)$line1*(int)$line2*(int)$line3)."\n";
            }    
        }
    }
}
