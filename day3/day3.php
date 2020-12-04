<?php

$lines = file(__DIR__.'/day3-input.txt');

####### Part 1 ########
// Repeat the line content to make sure they're equal to the full number of lines
// so we have enough to make it all the way down to the bottom
$numberOfLines = count($lines);
foreach($lines as $index => $line) {
    $line = trim($line);

    // Now fill, starting with an empty string, to make sure we have enough to go across
    $lines[$index] = str_pad('', $numberOfLines*10, $line);
}

// Write it out so we can see it
file_put_contents(__DIR__.'/day3-output.txt', implode("\n", $lines));

$adj = [
    // For Part 1
    // ['right' => 3, 'down' => 1, 'trees' => 0],

    // For Part 2
    ['right' => 1, 'down' => 1, 'trees' => 0],
    ['right' => 3, 'down' => 1, 'trees' => 0],
    ['right' => 5, 'down' => 1, 'trees' => 0],
    ['right' => 7, 'down' => 1, 'trees' => 0],
    ['right' => 1, 'down' => 2, 'trees' => 0],
];

foreach ($adj as $i => $a) {
    // Reset for the new adjustment
    $trees = 0;
    $pos = 0;
    $line = 0;

    // Loop until we run out of lines
    while($line < count($lines)) {
        $l = $lines[$line];
        if (substr($l, $pos, 1) == '#') { $trees++; }
        
        // Move
        $pos += $a['right'];
        $line += $a['down'];
    }

    // echo "Trees: ".$trees."\n";
    $adj[$i]['trees'] = $trees;
}

print_r($adj);

// For Part 2, multiply the number of trees together
$trees = array_column($adj, 'trees');
print_r($trees);

echo 'Product: '.array_product($trees)."\n";
