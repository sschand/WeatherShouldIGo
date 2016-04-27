<!DOCTYPE html>
<html>
<head>
	<link rel="shortcut icon" type="image/x-icon" href="/weathers.ico" />
	<title>Weather should I go?</title>
	<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">
<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
	<link rel="stylesheet" type="text/css" href="/assets/css/skeleton.css">
	<link rel="stylesheet" type="text/css" href="/assets/css/style.css">
	<script src="/assets/jquery.min.js" type="text/javascript"></script>
	<script src="/assets/map.js"></script>
</head>
<body>

	<nav class="navbar navbar-inverse navbar-custom navbar-fixed-top">
	    <div class="container">
	      <div class="navbar-header">
	        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
	          <span class="sr-only">Toggle navigation</span>
	           <span class="icon-bar"></span>
	           <span class="icon-bar"></span>
	           <span class="icon-bar"></span>
	         </button>
	        <a class="navbar-brand" href="index.html">Windstagra'm</a>
	      </div>
	      <div id="navbar" class="collapse navbar-collapse navbar-right ">
	        <ul class="nav navbar-nav">
	          <li class=" hidden">
	            <a href="#page-top"></a>
	          </li>
	          <li class="page-scroll">
	            <a href="#" data-toggle="modal" data-target="#myModalLogin">Login</a>
	          </li>
	          <li class="page-scroll">
	            <a href="#" data-toggle="modal" data-target="#myModalRegister" >Register</a>
	          </li>

	        </ul>
	      </div>
	    </div>
	  </nav>

		<!--  login modal-->
	  <div id="myModalLogin" class="modal fade" tabindex="-1" role="dialog">
	    <div class="modal-dialog">
	      <div class="modal-content login">
	        <div class="modal-header">
	          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	          <h4 class="modal-title">Login</h4>
	        </div>
	        <div class="modal-body">
	          <form action="/login/store_user_login" method=post id=loginform>
							<input type="hidden" name="action" value="login">
	              <div class="">
	                <input class="col-md-10" name="email_login" type="email" placeholder="Email">

	              </div>
	              <div class="">
	                  <input class="col-md-10" name="password_login" type="password" placeholder="Password">

	              </div>

	              <input type="Submit" class="btn btn-default" value=Login id=loginbtn>

	          </form>
	        </div>

	      </div><!-- /.modal-content -->
	    </div><!-- /.modal-dialog -->
	  </div><!-- /.modal -->
		<!--  Register modal-->
	  <div id="myModalRegister" class="modal fade" tabindex="-1" role="dialog">
	    <div class="modal-dialog">
	      <div class="modal-content">
	        <div class="modal-header">
	          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	          <h4 class="modal-title">Register</h4>
	        </div>
	        <div class="modal-body" >
	          <form class="form-horizontal" action="/login/store_user_register" method=post>
							 <input type="hidden" name="action" value="register">
	             <div >
	              <input class="col-md-10" name ="name" type="text" placeholder="Full Name">

	             </div>
	             <div >
	                <input class="col-sm-10" name="user_name" type="text" placeholder="User name">

	             </div>
	             <div >
	              <input class="col-sm-10" name="email" type="email" placeholder="Email" class=emailinput>

	             </div>
	             <div >
	                <input class="col-sm-10" name="password" type="password" placeholder="Password (8 char min)">

	             </div>
	             <div >
	              <input class="col-sm-10" name="confirm_password" type="password" placeholder="Confirm Password">

	             </div>
	             <div >
	                <input class="col-sm-10" name="dob" type="date" id="datepicker" placeholder="Date of Birth">

	             </div>
	             <div class="">
	                <input type="submit" class="btn btn-default" value="Register" id="regbtn">
	             </div>


	          </form>
	        </div>

	      </div><!-- /.modal-content -->
	    </div><!-- /.modal-dialog -->
	  </div><!-- /.modal -->

<div class="container">

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
					<input class="w6 w buttonSelect" type="submit" value="All Weather">
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


	<!-- Cities that we have listed -->
	<div class='cities row'></div>
</div> <!--End of Container-->

<script type="text/javascript">
	$('.cities').slideToggle();

	var clicker = 0;

	$('#showButton').click(function() {
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
	<div class="trip"></div>
	<div id="images"></div>

</div>
</div>


</body>
</html>
