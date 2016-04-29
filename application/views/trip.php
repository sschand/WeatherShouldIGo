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

    <!-- Navbar Starts Here -->
	<nav class="navbar navbar-fixed-top">
	      <div class="container">
	        <div class="navbar-header">
	          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
	            <span class="sr-only">Toggle navigation</span>
	            <span class="icon-bar"></span>
	            <span class="icon-bar"></span>
	            <span class="icon-bar"></span>
	          </button>

	          <a class="navbar-brand" href="#">#weather should i go?</a>
	        </div>
          <div id="navbar" class="collapse navbar-collapse navbar-right ">
  	        <ul class="nav navbar-nav">
  	          <li class=" hidden">
  	            <a href="#page-top"></a>
  	          </li>
              <li class="page-scroll"><a href="/main">Home <i class="fa fa-home" aria-hidden="true"></i></a></li>
              <li class="page-scroll" ><a href="#" id="add_friends" data-toggle="modal" data-target=".bs-example-modal-sm">Add Friends <i class="fa fa-plus" aria-hidden="true"></i></a></li>
	            <li class="page-scroll"><a href="/login/logoff">Log out <i class="fa fa-power-off" aria-hidden="true"></i></a></li>
	          </ul>
	        </div><!--/.nav-collapse -->
	      </div>
	</nav>
    <!-- Navbar Ends Here -->

    <!-- Modal starts Here -->
    <div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
      <div class="modal-dialog modal-sm">
        <div class="modal-content">

          <!-- Add Friend to Friend List -->
          <button type="button" class="close friends" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <p>Add friends by User Name</p>
          <form action="/trip/add_friend_to_list" method="post">
          <!-- <?php var_dump($usernames) ?> -->
              <select name="user_name" class="user_name u-full-width">
                    <?php foreach ($usernames as $username): ?>
                         <option id="<?=$username['user_id']?>" value="<?=$username['user_name']?>"><?=$username['user_name']?></option>
                    <?php endforeach; ?>
              </select>
            <!-- <input name="user_name" class="show-text" type =Text placeholder="user name"> -->
            <input type=Submit value="Add Friend">
          </form>
        </div>
      </div>
    </div>


    <?php var_dump($this->session->userdata('userCity')) ?>
    <!-- Start of Content -->
    <!-- Container starts here -->
    <div class="container">
        <!-- My Trips -->
        <div class="row">
          <div class="col-md-5">
            <div class="myTrips">
            <!-- My Trips -->
                <h4>My #Trips <i class="fa fa-suitcase" aria-hidden="true"></i></h4>
                <?php if(count($triplist)==0){?>
                   <p>
                    You have no trips yet!
                   </p>
                <?php } else {?>
                <ul class="list-group">
                  <?php foreach ($triplist as $trip): ?>
                    <li class="list-group-item">
                            <a class="myTripButton" href="/trip/getTripByid/<?=$trip['trip_id']?>">#<?= strtoupper($trip['city_name'])?></a><span class="badge"><?= count($this->session->userdata($trip['trip_id']));?></span>

                    </li>

                  <?php endforeach; ?>
                </ul>
                <?php } ?>
            </div>

            <div class="friendsTrips">
                <!-- Trips that friends are going to -->
                <h6>Trips that your friends are going</h6>
                <ul class="list-group">
                  <?php foreach ($friendTripList as $trip): ?>
                    <li class="list-group-item">
                      <a href="/trip/getTripByid/<?=$trip['trip_id']?>">#<?= strtoupper($trip['city_name'])?></a><span class="badge"><?= count($this->session->userdata($trip['trip_id']));?></span>
                    </li>
                  <?php endforeach; ?>
                </ul>
            </div>

        </div> <!-- End of col-md-5 Left Side -->

            <!-- If display_trip_id is a thing... -->
        <?php if($this->session->userdata('display_trip_id')):?>

            <!-- Trip Details -->
            <div class="col-md-5 col-md-offset-1">
              <h5>Trip Details <i class="fa fa-wpforms" aria-hidden="true"></i></h5>
              <p class="destination">TO: #<?= strtoupper($tripinfo[0]['city_name'])?></p>
              <span class="date">DATE: <?php $start_date = strtotime($tripinfo[0]['start_date']);
              $newformat = date('d M - Y',$start_date);
              $linkDate = date('m/d/Y', $start_date);
              echo $newformat;
               ?></span>
              <span class="date">DESCRIPTION: <?= $tripinfo[0]['description']?></span>
              <!-- FOR VADIM: trip flight link -->
              <span class="date"><a class="flightLink" target="_blank" href="<?= 'https:www.expedia.com/Flights-Search?trip=oneway&leg1=from:'.$this->session->userdata('userAirport').',to:'.$this->session->userdata('destinationAirport').',departure:'.$linkDate.'TANYT&passengers=children:0,adults:1,seniors:0,infantinlap:N&mode=search' ?>" title="">Check Flight Prices</a>
              </span>

              <!-- If Nobody is going to Trip... -->
              <?php if(count($tripinfo) == 0){
                echo "<p>You are going alone invite friends</p><a class='btn btn-default' href='/Trip/add_friend'>Invite Friends</a>";
              } else {?>
              <!-- /////Nobody Going on Trip///// -->

              <!-- Otherwise, we show the list of people going on the trip -->
              <table class="table">
                <tr>
                  <th class="goers">GOERS</th>
                  <th>ACTION</th>
                </tr>
                <!-- Shows users on the trip and gives access to Remove users from the Trip -->

                <!-- Check to see if current user is in the list of goers -->
                <?php $isInList = false; ?>
                <?php foreach ($tripinfo as $value): ?>
                    <?php if (in_array($this->session->userdata('user_name'), $value)){ ?>
                        <?php $isInList = true; ?>
                    <?php } ?>
                <?php endforeach; ?>
                <!-- ////////END -->


                <?php foreach ($tripinfo as $value): ?>
                  <tr>
                    <td><?=$value['user_name'];?></td>
                    <?php if ($isInList) { ?>
                    <td><a href="/trip/remove_friend/<?=$value['user_id'];?>">Remove</a></td>
                    <?php } else { ?>
                        <td>&nbsp;</td>
                    <?php } ?>
                  </tr>
                <?php endforeach; ?>

              </table>
              <?php } ?>
            <!-- /////Else///// -->

            <?php if($this->session->userdata('friends') && $isInList):?>
              <!-- Invite Friends to the trip -->
              <ul class="addFriend">
                <form action="/trip/add_friendToTrip" method="post">
                  <select name="friend_select" class="friend_select">
                    <?php foreach ($this->session->userdata('friends') as $friend): ?>
                         <option value="<?=$friend['user_id']?>"><?=$friend['user_name']?></option>
                    <?php endforeach; ?>
                  </select>
                  <input type=Submit value='Invite Friends' class="inviteFriends">
                </form>
             </ul>
               <!-- ////////Invite Friends to the trip//////// -->
           <?php endif; ?>

            </div> <!-- End of Trip Details -->

        <?php endif; ?>
        <!-- ////////If display_trip_id is a thing...//////// -->

        </div>
        <!-- ^ is the end of the row -->


    </div>
    <!-- End of Container -->

        <script type="text/javascript">
            $('li.list-group-item').click(function() {
                $('.addFriend').hide();
            })
            $('.addFriendButton').click(function() {
                $('.addFriend').show();
            })
        </script>
<script src="/assets/nav.js"></script>

</body>
</html>
