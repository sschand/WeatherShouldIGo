<!DOCTYPE html>
<html>
<head>
  <link rel="shortcut icon" type="image/x-icon" href="/weathers.ico" />
	<title>Weather should I go?</title>
	<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="/assets/css/skeleton.css">
	<link rel="stylesheet" type="text/css" href="/assets/css/style.css">
  <link rel="stylesheet" type="text/css" href="/assets/css/mytrips.css">

	<script src="/assets/jquery.min.js" type="text/javascript"></script>
	<script src="/assets/map.js"></script>
</head>
<body>

	<nav class="navbar navbar-fixed-top">
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
          <div id="navbar" class="collapse navbar-collapse navbar-right ">
  	        <ul class="nav navbar-nav">
  	          <li class=" hidden">
  	            <a href="#page-top"></a>
  	          </li>
              <li class="page-scroll"><a href="/main">Home <i class="fa fa-home" aria-hidden="true"></i></a></li>
              <li class="page-scroll"><a href="/trip">#MyTrips <i class="fa fa-suitcase" aria-hidden="true"></i></a></li>

	            <li class="page-scroll"><a href="/login/logoff">Log out <i class="fa fa-power-off" aria-hidden="true"></i></a></li>

	          </ul>
	        </div><!--/.nav-collapse -->
	      </div>
	    </nav>

      <div class="container">


        <div class="row">
          <div class="col-md-6 col-md-offset-3">

            <h5 class="list">Create an event for #<?= $this->session->userdata('city_name')?></h5>
            <div class="form-event">
              <form action="/trip/create_trip" method="post" class="form-horizontal">
                <div class="form-group">
                  <textarea name="description" class="form-control" rows="4" placeholder="write a description for your event"></textarea>
                </div>
                <div class="form-group">
                  <span class="event-date">Pick a Date</span>
                   <input type="date" name ="start_date" class="form-control pickDateNewEvent" id="inputEmail3">
                </div>
                <input type=Submit value="Create a Trip" id="eventbtn">
             </form>
            </div>
         </div>
      </div>



        </div>




      </div>


<script src="/assets/nav.js"></script>
</body>
</html>
