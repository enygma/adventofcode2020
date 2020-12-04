<?php

require_once __DIR__.'/vendor/autoload.php';
/*
byr (Birth Year)
iyr (Issue Year)
eyr (Expiration Year)
hgt (Height)
hcl (Hair Color)
ecl (Eye Color)
pid (Passport ID)
cid (Country ID) <-- optional
*/

$contents = file_get_contents(__DIR__.'/day4-input.txt');
$passports = explode("\n\n", $contents);

##### Part 1 #############
$valid = 0;
foreach ($passports as $p) {
    // Check to see if all required fields are there (cid is optional)
    if (
        strpos($p, 'byr:') !== false &&
        strpos($p, 'iyr:') !== false &&
        strpos($p, 'eyr:') !== false &&
        strpos($p, 'hgt:') !== false &&
        strpos($p, 'hcl:') !== false &&
        strpos($p, 'ecl:') !== false &&
        strpos($p, 'pid:') !== false 
    ) {
        $valid++;
    }
}
echo 'P1 VALID: '.$valid."\n";

##### Part 2 #############

$v = new Validate();
$valid = 0;

foreach ($passports as $passport) {
    if ($v->check($passport) == true) {
        $valid++;
    }
}
echo 'P2 VALID: '.$valid."\n";


class Validate
{
    public function check($passport)
    {
        $result = false;

        $p = $this->parsePassport($passport);
        $required = ['byr', 'iyr', 'hgt', 'eyr', 'hcl', 'ecl', 'pid'];

        $eval = [];
        foreach ($required as $req) {
            if (!isset($p[$req])) {
                $eval[$req] = false;
                continue;
            }
            $method = 'verify_'.$req;
            $eval[$req] = $this->$method($p[$req]);
        }

        // See if there are any "false", if so it failed
        return (array_search(false, $eval) == false) ? true : false;
    }

    private function parsePassport($passport)
    {
        $results = [];
        $passport = explode(' ', str_replace("\n", ' ', $passport));

        foreach ($passport as $line) {
            if (empty($line)) {
                continue;
            }
            $parts = explode(':', trim($line));
            $results[$parts[0]] = $parts[1];
        }

        return $results;
    }

    ######## --- Verify functions ---- ########
    private function verify_hgt($input)
    {
        $result = preg_match('/([0-9]+)([cm|in]{2})/', $input, $match);

        // Format mismatch
        if ($result !== 1) {
            return false;
        }
        $height = (int)$match[1];

        if ($match[2] == 'cm') {
            // least 150 and at most 193
            return ($height < 150 || $height > 193) ? false : true;
        } elseif ($match[2] == 'in') {
            // least 59 and at most 76
            return ($height < 59 || $height > 76) ? false : true;
        }
        return false;
    }

    private function verify_hcl($input)
    {
        return (preg_match('/^\#[a-f0-9]{6}$/', trim($input)) == 0) ? false : true;
    }

    private function verify_ecl($input)
    {
        $allowed = ['amb','blu','brn','gry','grn','hzl','oth'];
        return (in_array($input, $allowed));
    }

    private function verify_pid($input)
    {
        return (preg_match('/^[0-9]{9}$/', $input) == 0) ? false : true;
    }

    private function verify_byr($input)
    {
        $input = (int)$input;
        return ($input < 1920 || $input > 2002) ? false : true;
    }

    private function verify_iyr($input)
    {
        $input = (int)$input;
        return ($input < 2010 || $input > 2020) ? false : true;
    }

    private function verify_eyr($input)
    {
        $input = (int)$input;
        return ($input < 2020 || $input > 2030) ? false : true;
    }
}
