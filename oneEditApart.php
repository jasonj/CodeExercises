<?php
/** 
 * Implement a function OneEditApart with the following signature: 
 * bool OneEditApart(string s1, string s2) 
 * 
 * OneEditApart("cat", "dog") = false 
 * OneEditApart("cat", "cats") = true 
 * OneEditApart("cat", "cut") = true 
 * OneEditApart("cat", "cast") = true 
 * OneEditApart("cat", "at") = true 
 * OneEditApart("cat", "acts") = false 
 * Edit is: insertion, removal, replacement 
 */

function OneEditApart($s1, $s2) {
	// only calc these once
	$s1Len = strlen($s1);
	$s2Len = strlen($s2);

	// 0 edits apart, return false
	if ($s1 == $s2) {
		return false;
	}

	// we want the shorter as the first param
	if ($s1Len > $s2Len) {
		return OneEditApart($s2, $s1);
	}

	// if lengths differ by more than 1, return false
	if ($s2Len - $s1Len > 1) {
		return false;
	}

	// keep current indexes of both words
	$s1i = $s2i = $edits = 0;

	while ($s1i < $s1Len && $s2i < $s2Len) {
		// break processing and return if we have achieved more than one edit
		if ($edits > 1) {
			return false;
		}

		// if letters match, next
		if ($s1[$s1i] == $s2[$s2i]) {
			$s1i++;
			$s2i++;
			continue;
		}

		// insert case
		if ($s1[$s1i] == $s2[$s2i + 1]) {
			$edits++;
			$s1i++;
			$s2i = $s2i + 2;
			continue;
		}

		// remove case
		if ($s1[$s1i + 1] == $s2[$s2i]) {
			$edits++;
			$s1i = $s1i + 2;
			$s2i++;
			continue;
		}

		// replace case
		$edits++;
		$s1i++;
		$s2i++;
	}

	// get index difference, as it will impact our remaining length calc
	$iDiff = $s2i - $s1i;

	// add any differences in word lengths minus previous diff to inserts
	$edits = $edits + ($s2Len - $s1Len - $iDiff);

	if ($edits == 1) {
		return true;
	}

	// more or less than 1
	return false;

}

echo (OneEditApart("cat", "dog") ? 'true' : 'false') . "\n";# = false 
echo (OneEditApart("cat", "cats") ? 'true' : 'false') . "\n";# = true 
echo (OneEditApart("cat", "cut") ? 'true' : 'false') . "\n";# = true 
echo (OneEditApart("cat", "cast") ? 'true' : 'false') . "\n";# = true 
echo (OneEditApart("cat", "at") ? 'true' : 'false') . "\n";# = true 
echo (OneEditApart("cat", "acts") ? 'true' : 'false') . "\n";# = false 
echo (OneEditApart("cat", "cast") ? 'true' : 'false') . "\n";# = true