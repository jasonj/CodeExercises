<?php

/**
 * Given the following hashmap for numeric to alpha translation of a telephone keypad: 
 * 
 * NSDictionary* dict = @{@2: @[@"A", @"B", @"C"], 
 * @3: @[@"D", @"E", @"F"], 
 * @4: @[@"G", @"H", @"I"], 
 * @5: @[@"J", @"K", @"L"], 
 * @6: @[@"M", @"N", @"O"], 
 * @7: @[@"P", @"Q", @"R", @"S"], 
 * @8: @[@"T", @"U", @"V"], 
 * @9: @[@"W", @"X", @"Y", @"Z"]}; 
 * 
 * Write a method that takes a phone number as input and returns all possible 
 * letter combinations for that phone number.
 * 
 * (Adapted to PHP)
 */

function phoneToText($phoneNumber) {
	// storage for our found words
	$foundWords = array();
	
	// cast number / digits to a string, then to an array
	$phoneDigits = str_split((string)$phoneNumber);

	// loop over each digit
	foreach ($phoneDigits as $digit) {
		processDigit($digit, $foundWords);
	}

	return $foundWords;
}

function processDigit($digit, &$foundWords) {
	// hash of phone digits to characters (adapted from NSDictionary)
	static $numToCharHash = array(
		2 => array('a', 'b', 'c'),
		3 => array('d', 'e', 'f'),
		4 => array('g', 'h', 'i'),
		5 => array('j', 'k', 'l'),
		6 => array('m', 'n', 'o'), 
		7 => array('p', 'q', 'r', 's'),
		8 => array('t', 'u', 'v'),
		9 => array('w', 'x', 'y', 'z')
	);

	// return if digit has no characters (case 0 and 1)
	if (!isset($numToCharHash[$digit])) {
		return;
	}

	// if we have no existing entries, add current characters and return
	if (count($foundWords) == 0) {
		$foundWords = $numToCharHash[$digit];
		return;
	}

	// append the first char to each word
	for ($j = 0, $wordsLen = count($foundWords); $j < $wordsLen; $j++) {
		$t = $foundWords[$j];
		// first, append the existing entry with the first char
		$foundWords[$j] .= $numToCharHash[$digit][0];
		
		// add new entries for the other chars
		for ($i = 1, $charCount = count($numToCharHash[$digit]); $i < $charCount; $i++) {
			$foundWords[] = $t . $numToCharHash[$digit][$i];
		}
	}

	return;
}

print_r(phoneToText(6059297791));