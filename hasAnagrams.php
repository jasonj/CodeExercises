<?php
/**
 * Given an array of string, determine if any of the strings are anagrams of 
 * each other.  Return should be a boolean, true if anagrams are found, false 
 * if not.
 * 
 */

function hasAnagrams($stringsArray) {
	// keep a hash of the ordered words
	$stringsOrderedHash = array();

	foreach ($stringsArray as $word) {
		// skip blanks
		if (!$word) {
			continue;
		}

		// lowercase the word, as anagrams should match regardless of case
		$word = strtolower($word);

		// convert word to array
		$wordArray = str_split($word);

		// sort resultant letters
		sort($wordArray);

		$wordSorted = implode($wordArray);
		
		// if key exists, has anagrams
		if (isset($stringsOrderedHash[$wordSorted])) {
			return true;
		}

		// add to hash as key to allow index lookup
		$stringsOrderedHash[$wordSorted] = 1;
	}

	// ran out of words to check, so no anagrams
	return false;
}


echo (hasAnagrams(array("bag", "bat", "tab")) ? "true" : "false") . "\n";# true
echo (hasAnagrams(array("gab", "bat", "laf")) ? "true" : "false") . "\n";# false