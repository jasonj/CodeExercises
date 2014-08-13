/*
 * Exercises to do in-place reversals of strings, first letter by letter, then word by word
 */
#include <stdio.h>
#include <string.h>

// reverse string letter by letter, so "a quick brown" becomes "nworb kciuq a"
void reverseString(char str[]) {
	unsigned int i, j, temp;
	size_t len = strlen(str);

	for (i = 0, j = len - 1; i < j; i++, j--) {
		// store left letter in temp
		temp = str[i];
		// left letter is replaced with right
		str[i] = str[j];
		// right letter is replaced by temp
		str[j] = temp;
	}
}

// reverse string word for word, so "a quick brown" becomes "brown quick a"
void reverseWords(char str[]) {
	unsigned int i, m, n, temp;
	unsigned int k = 0;
	size_t len = strlen(str);

	// init our offsets array to a size of the string length
	int so[len];

	// reverse string first
	reverseString(str);

	// find all spaces in string, and store their offsets
	for (i = 0; i < len; i++) {
		// if current char is a space, log its location
		if (str[i] == ' ') {
			// postincrement the var inline
			so[k++] = i;
		}
	}

	// reverse each word, using space offsets as our guides
	for (i = 0; i <= k; i++) {
		//get start offset for this word
		m = (i == 0) ? 0 : so[i-1] + 1;
		// get end offset for this word
		// add one iteration to the end to account for last word
		n = (i == k) ? len-1 : so[i]-1;
		// swap each letter in word
		for (; m < n; m++, n--) {
			temp = str[m];
			str[m] = str[n];
			str[n] = temp;
		}
	}
}

int main(int argc, char *argv[]) {

	// verify we have 1 or more arguments
	if (argc == 1 || argc > 2) {
		printf("You need exactly 1 argument, such as a quoted string \"A quick brown fox...\"\n");
		return 1;
	}

	// reverse the string
	reverseString(argv[1]);

	printf("Reversed string: \"%s\"\n", argv[1]);

	// reverse it back :)
	reverseString(argv[1]);

	// reverse the words
	reverseWords(argv[1]);

	printf("Reversed words: \"%s\"\n", argv[1]);

	return 0;
}

