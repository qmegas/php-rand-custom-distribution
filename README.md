Random number generator with custom distribution
==============
Standard PHP functions like `rand` or `mt_rand` generate random numbers with normal distribution, however sometimes it 
required to generate random numbers with different distribution, for example (binomial distribution)[https://en.wikipedia.org/wiki/Binomial_distribution].


Installation
------------
```bash
composer require qmegas/php-rand-custom-distribution
```

Requirements
------------
PHP >= 7.0

Simple Example
--------------
```php
$generator = new \Qmegas\RandomGenerator(50, 150, function(float $i) {
	return $i * 100;
});
echo $generator->getNumber();
```
Class constractor receives 3 arguments: low-high bounds of generated numbers and distribution function.
Distribution function receives float argument between 0 and 1 and should return some integer value >= 0, see additional examples for better understanding.

Some Additional Examples
--------------
<table>
	<tr>
		<td>Normal Distribution</td>
		<td>
```php
$generator = new \Qmegas\RandomGenerator(1, $max, function() {
	return 1;
});
```
		</td>
	</tr>
	<tr>
		<td><img src="./images/1.jpg"></td>
		<td>
```php
$generator = new \Qmegas\RandomGenerator(1, $max, function(float $i) {
	return $i * 100;
});
```
		</td>
	</tr>
</table>