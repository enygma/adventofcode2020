<?php

/**
 * binary space partitioning
 * 
 * F = front
 * B = back
 * L = left
 * R = right
 * 
 * 0-7 -> F or B (rows, 0-127)
 */

// First 7 characters will be F or B
// Last 3 will be either L or R

function move($rows, $seats, $boardingPass) {

    for($i = 0; $i < strlen($boardingPass); $i++) {
        $char = strtoupper($boardingPass[$i]);
        // echo 'char: '.$char."\n";

        switch($char) {
            case 'F':
                // Divide in half, keep the front
                $ct = count($rows);
                $rows = array_slice($rows, 0, $ct/2);

                break;
            case 'B':
                // Divide in half, keep the back
                $ct = count($rows);
                $rows = array_slice($rows, $ct/2);

                break;
            case 'L':
                // Divide in half, keep the left
                $ct = count($seats);
                $seats = array_slice($seats, 0, $ct/2);

                break;
            case 'R':
                // Divide in half, keep the right
                $ct = count($seats);
                $seats = array_slice($seats, $ct/2);
                break;
            default:
                echo 'Broken!';
        }
    }
    return [
        'row' => $rows[0],
        'seat' => $seats[0],
        'seatId' => ((intval($rows[0])*8) + intval($seats[0]))
    ];
}

// ------------------------------

$lines = file(__DIR__.'/day5-input.txt');
$rows = range(0, 127);
$seats = range(0, 7);

### Part 1 ###########
$highest = 0;
foreach ($lines as $line) {
    $result = move($rows, $seats, trim($line));
    if ($result['seatId'] > $highest) {
        $highest = $result['seatId'];
    }
}
echo 'P1 -> HIGHEST: '.$highest."\n";


##### Part 2 ###########
$idList = [];
foreach ($lines as $line) {
    $result = move($rows, $seats, trim($line));
    $idList[] = $result['seatId'];
}
sort($idList);

// Loop through the array and see what the diff between them is
// If we find one that's more than 1, we found our gap!
foreach ($idList as $index => $id) {
    $current = intval($id);
    if (isset($idList[$index+1]) == false || isset($idList[$index-1]) == false) {
        continue;
    }
    $next = intval($idList[$index+1]);
    $prev = intval($idList[$index-1]);

    if ($next-$current == 2 || $current-$prev == 2) {
        echo 'P2 -> DIFF: ('.$current.') n->'.($next-$current)." p->".($current-$prev)."\n";
    }
}

echo "\n";
