<?php

require("simple_form_dom.php");

$city = "Dallas"; // Replace this with city name passed in from trip planning form
$splitCity = explode(" ", $city);
$getCity = join("+" , $splitCity);	// Replaces any spaces with +'s for url


$html = @file_get_contents('http://www.travelmath.com/nearest-airport/' . "$getCity");

$test = explode("International airports near", $html);
$test3 = explode('"domestic-distance"', $test[1]);
$test4 = explode('(', $test3[0]);	// Explodes until $test4 is just array of things after an '('

$count = 0;
$airportCodes = array();

for($i = 0; $i < count($test4); $i++)
{
		$testStr = $test4[$i][0] . $test4[$i][1] . $test4[$i][2];	// Check first 3 letters
		if(ctype_upper($testStr))
		{
			if($count < 3){							// Grab 3 biggest airports
				$airportCodes[] = $testStr;
				$count++;
			}
		}
}

var_dump($airportCodes);

?>