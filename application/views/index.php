<!DOCTYPE html>
<html>
<head>
	<link rel="shortcut icon" type="image/x-icon" href="/weathers.ico" />
	<title>Weather should I go?</title>
	<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

<!-- jQuery UI for color animations -->
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">
<!-- Bootstrap core JavaScript

================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script> -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
<!-- jQuery UI -->
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="/assets/css/skeleton.css">
	<link rel="stylesheet" type="text/css" href="/assets/css/style.css">
	<script src="/assets/jquery.min.js" type="text/javascript"></script>
	<!-- <script src="/assets/sun.js"></script> -->

	<script src="/assets/map.js"></script>
</head>
<body>

	<nav class="navbar navbar-custom navbar-fixed-top">
	    <div class="container">
	      <div class="navbar-header">
	        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
	          <span class="sr-only">Toggle navigation</span>
	           <span class="icon-bar"></span>
	           <span class="icon-bar"></span>
	           <span class="icon-bar"></span>
	         </button>
	        <a class="navbar-brand" href="/main">#Weather Should I go?</a>
	      </div>
	      <div id="navbar" class="collapse navbar-collapse navbar-right ">
	        <ul class="nav navbar-nav">
	          <li class=" hidden">
	            <a href="#page-top"></a>
	          </li>
	          <li class="page-scroll">
							<?php if($this->session->userdata('user_name')){
							 echo "<a href='#'>Welcome ".$this->session->userdata('user_name')."! <i class='fa fa-smile-o' aria-hidden='true'></i></a>";
						 } else {?>
	            <a href="#" data-toggle="modal" data-target="#myModalLogin">Login</a>
							<?php } ?>
	          </li>
						<li class="page-scroll">
							 <?php if($this->session->userdata('user_name')){
								echo "<a href='/trip'>My Trips <i class='fa fa-suitcase' aria-hidden='true'></i></a>";
							} ?>
	          </li>

	          <li class="page-scroll">
							<?php if($this->session->userdata('user_name')){
							 echo "<a href='/login/logoff'>Log Out <i class='fa fa-power-off' aria-hidden='true'></i></a>";
						 } else {?>
	            <a href="#" data-toggle="modal" data-target="#myModalRegister" >Register</a>
							<?php } ?>

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
						<div class="error"></div>
						<form action="/login/store_user_login" method="post" id="login_form">
							<input type="hidden" name="action" value="login">
							<div class="">
								<input class="col-md-10" id="email_login" name="email_login" type="email" placeholder="Email" required>

							</div>
							<div class="">
							<input class="col-md-10" id="password_login" name="password_login" type="password" placeholder="Password" required>

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
					<form id="register_form" class="form-horizontal" action="/login/store_user_register" method=post>
							<input type="hidden" name="action" value="register">
							<div >
								<input id="name" class="col-md-10" name ="name" type="text" placeholder="Full name" required>
							</div>
							<div >
								<input id="user_name" class="col-sm-10" name="user_name" type="text" placeholder="User name" required>
							</div>
							<div >
								<input id="email" class="col-sm-10" name="email" type="email" placeholder="Email" class=emailinput required>
							</div>
							<div >
								<input id="password" class="col-sm-10" name="password" type="password" placeholder="Password" minlength="8" required>
							</div>
							<div >
								<input id="confirm_password" class="col-sm-10" name="confirm_password" type="password" placeholder="Confirm Password" required >
							</div>
							<div >
								<input id="dob" class="col-sm-10" name="dob" type="text" onfocus="(this.type='date')" id="datepicker" placeholder="Date of Birth (must be at least 21 years)" required max="1995-04-29">  <!-- Date - for 21+ hard-coded for now  -->
							</div>
							<div >
								<input id="phone" class="col-sm-10" name="phone" type="tel" placeholder="ex : 15559995555" required maxlength="10">
							</div>
							<div class="">
								<input type="submit" class="btn btn-default" value="Register" id="regbtn" required>
							</div>
						</form>
					</div>

				</div><!-- /.modal-content -->
			</div><!-- /.modal-dialog -->
		</div><!-- /.modal -->

<div class="container">

	<?php if ($this->session->flashdata('success_register')){ ?>
	<div class="alert alert-success alert-dismissible" role="alert">
	  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	  <strong><?php echo $this->session->flashdata('success_register'); ?></strong>
	</div>
	<?php } ?>


	<?php if ($this->session->flashdata('loggedFail')){ ?>
	<div class="alert alert-danger alert-dismissible" role="alert">
	  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	  <strong><?php echo $this->session->flashdata('loggedFail'); ?></strong>
	</div>
	<?php } ?>


	<?php if ($this->session->flashdata('match')){ ?>
	<div class="alert alert-danger alert-dismissible" role="alert">
	  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	  <strong><?php echo $this->session->flashdata('match'); ?></strong>
	</div>
	<?php } ?>

	<?php if ($this->session->flashdata('login')){ ?>
	<div class="alert alert-danger alert-dismissible" role="alert">
	  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	  <strong><?php echo $this->session->flashdata('login'); ?></strong>
	</div>
	<?php } ?>
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
	</div>

	<div class="row spec_det">
		<div class="deets twelve columns" style="width: 100%"></div>
	</div>


	<!-- Cities that we have listed -->
	<!-- I don't think we need this anymore -->
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

	<div class="main container">

		<div id="results">
			<div id="loading"></div>
			<div class="trip"></div>
			<div id="images"></div>
		</div>
	</div>

	<script src="/assets/nav.js"></script>
</body>
</html>
