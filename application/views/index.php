<!DOCTYPE html>
<html>
<head>
	<link rel="shortcut icon" type="image/x-icon" href="/weathers.ico" />
	<title>Weather should I go?</title>
	<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
	<link rel="stylesheet" type="text/css" href="/assets/css/skeleton.css">
	<link rel="stylesheet" type="text/css" href="/assets/css/style.css">
	<script src="/assets/jquery.min.js" type="text/javascript"></script>
	<script src="/assets/map.js"></script>
</head>
<body>

	<nav class="navbar navbar-inverse navbar-fixed-top">
	      <div class="container">
	        <div class="navbar-header">
	          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
	            <span class="sr-only">Toggle navigation</span>
	            <span class="icon-bar"></span>
	            <span class="icon-bar"></span>
	            <span class="icon-bar"></span>
	          </button>

	          <a class="navbar-brand" href="#">Windstagra'm</a>
	        </div>
	        <div id="navbar" class="navbar-collapse collapse">
	          <ul class="nav navbar-nav navbar-right">
	            <li><a href="#">Login</a></li>
	            <li><a href="#about">Register</a></li>

	          </ul>
	        </div><!--/.nav-collapse -->
	      </div>
	    </nav>


<div class="container">
	<!-- Input -->
	<div id='radiusbox'>
		<form id="radiusForm">
			<input type=text id=userradius>
			<input type=submit>
		</form>
	</div>


  <div class="weather">
  	<div class="row">
			<div class="col-md-6 col-md-offset-3">
				<div class="row">
						<input class="w1 w" type="submit" value="Snow">
						<input class="w2 w" type="submit" value="Rain">
						<input class="w3 w" type="submit" value="sun">
				</div>
				<div class="row">
					<input class="w4 w" type="submit" value="Drizzle">
					<input class="w5 w" type="submit" value="Fog">
					<input class="w6 w" type="submit" value="All Weather">
				</div>

					</div>
				</div>
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


<div class="main container">

	<div id="results">
	<div id="loading"></div>
	<div id="images"></div>
</div>
</div>


</body>
</html>
