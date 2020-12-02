<?php

$lines = file(__DIR__.'/day1-input.txt');

foreach ($lines as $line1) {
    // Take this one and add each other line
    foreach ($lines as $line2) {

        if ((int)$line1 + (int)$line2 == 2020) {
            echo trim($line1).' * '.trim($line2)." => ".((int)$line1*(int)$line2)."\n";
        }

    }
}
