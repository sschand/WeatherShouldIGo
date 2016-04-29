<?php


// Final expedia URL to shove all this shit into: https://www.expedia.com/Flights-Search?trip=oneway&leg1=from:Seattle,%20United%20States%20(SEA),to:Las%20Vegas,%20United%20States%20(LAS),departure:04/30/2016TANYT&passengers=children:0,adults:2,seniors:0&mode=search


$city = $data; // Replace this with city name passed in from trip planning form
$splitCity = explode(" ", $city);
$getCity = join("+" , $splitCity);	// Replaces any spaces with +'s for url


$html = @file_get_contents('http://www.travelmath.com/nearest-airport/' . "$getCity");

$test = explode("International airports near", $html);
$test3 = explode('"domestic-distance"', $test[1]);
$test4 = explode('(', $test3[0]);	// Explodes until $test4 is just array of things after an '('

// var_dump($test4);

for($i = 0; $i < count($test4); $i++)
{
		$testStr = $test4[$i][0] . $test4[$i][1] . $test4[$i][2];	// Check first 3 letters
		if(ctype_upper($testStr))
		{
			// Grab biggest airport
			$airportCode = $testStr;
			break;
		}
}
var_dump($airportCode);
?>

<!DOCTYPE html>
<html>
<head>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
	<script src="/assets/services/Travel/travelAirportCity.js"></script>
</head>
<body>
	<div class="getAirport">Get Airport</div>
	<?php
	//https://www.expedia.com/Flights-Search?trip=oneway&leg1=from:
				//SJC,to:LAS,
			//departure:
				//05/18/2016
				//TANYT
			//&passengers=
				//children:0,
				//adults:1,
				//seniors:0,
				//infantinlap:N
			//&mode=search
	?>
	<a href="
	<?=
	'https:www.expedia.com/Flights-Search?trip=oneway&leg1=from:'.$airportCode.',to:LAS,departure:05/18/2016TANYT&passengers=children:0,adults:1,seniors:0,infantinlap:N&mode=search'
	?>
	">SOMETHING HERE</a>
</body>
</html>
