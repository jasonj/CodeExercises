# Given n stairs, how many number of ways can you climb if u use either 1 or 2 at a time?

# fib is f(n) = f(n-1) + f(n-2)
def stairCombInOneOrTwoStepsAtATime(steps):
	if steps == 0:
		return 0

	# init our n-1 and n-2 vars
	prev = 1
	curr = 1

	# iterate steps, setting current as the sum of the previous 2 vars
	for x in range(1, steps):
		temp = curr
		curr = curr + prev
		prev = temp

	return curr

for y in range(30):
	print "%d:%d" % (y, stairCombInOneOrTwoStepsAtATime(y))

