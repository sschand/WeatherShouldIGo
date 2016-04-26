<!DOCTYPE html>
<html>
<head>
	<link rel="shortcut icon" type="image/x-icon" href="/weathers.ico" />
	<title>Weather should I go?</title>
	<link rel="stylesheet" type="text/css" href="/assets/css/skeleton.css">
	<link rel="stylesheet" type="text/css" href="/assets/css/style.css">
	<script src="/assets/jquery.min.js" type="text/javascript"></script>
	<script src="/assets/map.js"></script>
</head>
<body>

<div class="container">
	<!-- Input -->
	<div id='radiusbox'>
		<form id="radiusForm">
			<input type=text id=userradius>
			<input type=submit>
		</form>
	</div>

	<!-- Map -->
	<div id='map'></div>

	<!-- Details: Name of city and also weather condition -->
	<div class="details">
		<!-- Name of the City -->
		<h4 class="name"></h4>
		<!-- Current Weather condition -->
		<div class="deets"></div>
	</div>
	<!-- Button to show list of cities -->
	<div class="row">
		<button type="button" class="button">Show Cities</button>
	</div>

	<!-- Cities that we have listed -->
	<div class='cities row'></div>
</div> <!--End of Container-->

<script type="text/javascript">
	$('.cities').slideToggle();

	var clicker = 0;

	$('.button').click(function() {
		if (clicker == 1) {
			$(this).text('Hide Cities');
		} else {
			$(this).text('Show Cities');
		}
		$('.cities').slideToggle();
		if (clicker == 1) {
			clicker = 0;
		} else {
			clicker = 1;
		}
	});
</script>

<script async defer
src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD7vM_BGlGGOKxYmh7qMjb9NM1r8iLZHmc&callback=initMap">
</script>

<!-- END OF MAP -->

<div class="other"></div>

<div class="main container">
	<h1>Weather should I go?</h1>
	<form action="/main/get_pics" method="post" id="instagram">
	    <div class="row">
	    	<div class="one columns">
	    		<label for="city">City: </label>
	    	</div>
	    	<div class="three columns">
	    		<input id="city" name="city" type="text">
	    	</div>

    		<div class="one columns">
    			<label for="weather">Weather: </label>
	    	</div>
	    	<div class="three columns">
	    		<input id="weather" name="weather" type="text">
	    	</div>
	    	<div class="four columns">
	    		<button type="submit" class="button-primary">Submit</button>
	    	</div>
	    </div>
	</form>
	<div id="results">
	<div id="loading"></div>
	<div id="images"></div>
</div>
</div>


<script>
	$(document).ready(function() {
	     $('#instagram').submit(function() {

			// this will be shown while user is waiting for response
			$('#loading').html("<img src='assets/images/spinner.gif'>");
			$('#images').html("");

			$.post($(this).attr('action'), $(this).serialize(), function(res) {
		    	var images_string = "";
		    	var weather = $('#weather').val();
		    	console.log('weather is '+weather);

		    	if(res.data.length > 0){
		    		console.log(res.data);
		    		// console.log(res.data[i].tags.length);
	    			for (var i = 0; i < res.data.length; i++) {

	    			  	// for (var i = 0; i < res.data[i].tags.length; i++) {
    			  		console.log(res.data[i].tags);
    			  		if(res.data[i].tags.includes(weather)){
    			  			console.log('yes!!');
    			  			images_string +='<img src='+res.data[i].images.low_resolution.url+'>';
    			  		}
			       	}
			       	if(images_string.length < 1){
			       		images_string += "NONE";
			       	}
		    	}else{
		    		images_string += "<h2>No images found :(</h2>";
		    	}

		       	// remove loading image
				$('#loading').html("");
				$('#images').html(images_string);
			    $('input').val('');
			}, 'json');

			// don't forget, without it the page will refresh
			return false;
		});
	});
</script>
</body>
</html>
