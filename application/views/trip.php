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
              <li class="page-scroll"><a href="/Main">Home</a></li>
	            <li class="page-scroll"><a href="/login/logoff">Log out</a></li>

	          </ul>
	        </div><!--/.nav-collapse -->
	      </div>
	    </nav>

      <div class="container">


        <div class="row">
          <div class="col-md-5">
            <h4>My #Trips</h4>
            <ul class="list-group">
              <?php foreach ($triplist as $trip): ?>
                <li class="list-group-item">
                  <a href="/Trip/getTripByid/<?=$trip['trip_id']?>">#<?= strtoupper($trip['city_name'])?></a><span class="badge">14</span>
                </li>

              <?php endforeach; ?>
            </ul>
            </div>
            <?php if($this->session->userdata('display_trip_id')){?>

            <div class="col-md-5 col-md-offset-1">
              <h5>Trip Details</h5>
              <p>
                Destination: #<?= strtoupper($tripinfo[0]['city_name'])?>
              </p>
              <p>
                Date: <?= $tripinfo[0]['start_date']?>
              </p>
              <p>
                Description: <?= $tripinfo[0]['description']?>
              </p>
              <?php if(count($tripinfo) == 0){

                echo "<p>You are going alone invite friends</p><a class='btn btn-default' href='/Trip/add_friend'>Invite Friends</a>";
              } else {?>
              <table class="table">
                <tr>
                  <th>Goers</th>
                  <th>Action</th>
                </tr>
                <?php foreach ($tripinfo as $value): ?>
                  <tr>

                    <td><?=$value['user_name'];?></td>
                    <td><a href="#">Remove</a></td>

                  </tr>

                <?php endforeach; ?>


              </table>
              <?php
              echo "<a href='/Trip/add_friend'><input type=Button value='Add Friends'></a>";
            } ?>

            <?php if($this->session->userdata('friends')){?>
            <ul>
               <?php foreach ($this->session->userdata('friends') as $friend): ?>
                    <li><?=$friend['user_name']?></li>
               <?php endforeach; ?>
           </ul>
           <?php } ?>
            </div>

            <?php } ?>



        </div>
        <div class="row">
          <div class="col-md-5">
            <h6>Trips that your friends are going</h6>
            <ul class="list-group">
              <?php foreach ($friendTripList as $trip): ?>
                <li class="list-group-item">
                  <a href="/Trip/getTripByid/<?=$trip['trip_id']?>">#<?= strtoupper($trip['city_name'])?></a><span class="badge">14</span>
                </li>

              <?php endforeach; ?>
            </ul>
          </div>

        </div>


        </div>






<script src="/assets/nav.js"></script>

</body>
</html>
