<?php
session_start();
date_default_timezone_set('America/Los_Angeles');

$this->session->set_userdata('userlat',0);
$this->session->set_userdata('userlon',0);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Practice</title>
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Mobile Specific Metas
    –––––––––––––––––––––––––––––––––––––––––––––––––– -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- FONT –––––––––––––––––––––––––––––––––––––––––––––––––– -->
    <link href="//fonts.googleapis.com/css?family=Raleway:400,300,600" rel="stylesheet" type="text/css">
    <!-- CSS –––––––––––––––––––––––––––––––––––––––––––––––––– -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/skeleton.css">

    <script src=http://code.jquery.com/jquery-2.2.3.min.js></script>

    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/userinfo/1.1.0/userinfo.min.js"></script>

    <style>

    #map{
        height: 500px;
        width: 100%;
    }
    .details {
        text-align: center;
        margin-top: 1em;
        /*border-bottom: 1px solid rgba(136, 136, 136, 0.76);*/
    }
    .four {
        margin: 0;
        padding: 1em;

    }
    .row {
        text-align: center;
    }
    .button {
        margin-top: 1em;
        float: right;
    }
    </style>

    <script>
    //https://airport.api.aero/airport/nearest/31.46273/-99.33304/?user_key=47b0e35381e6f8e41c97f5eb08e30661

    //Function for map initialization and getting weather by distance
    function initMap() {

            //Where map center is
            var myLatLng = {lat: 39.8282, lng: -98.5795};
            //SAN JOSE: lat: 37.34605, lng: -121.8878
            //CENTER OF US: lat: 39.8282, lng: 98.5795

            var map = new google.maps.Map(document.getElementById('map'), {
              zoom: 4,//8 for local view, 4 for national view
              center: myLatLng
            });

            var icons = {
              Snow: '/assets/images/snow.png',
              Clear: '/assets/images/sun1.png',
              Rain: '/assets/images/rain.png',
              Haze: '/assets/images/fog.png',
              Fog: '/assets/images/fog.png',
              Clouds: '/assets/images/cloud.png',

              //Need Mist: '/assets/images/mist.png'
              //Currently Placeholder
              Mist: '/assets/images/cloud.png',

              //Need Drizzle: '/assets/images/drizzle.png'
              //Currently Placeholder
              Drizzle: '/assets/images/rain.png',

              //Need Thunderstorm: '/assets/images/thunderstorm.png'
              //Currently Placeholder
              Thunderstorm: '/assets/images/rain.png'
            };



        $(document).ready(function(){
            //Hide the show cities button until submitted
            $('.button').hide();

            //On page load, focus on the input box
            $('#userradius').focus();

            //the value of userradius
            var userRad;

            //On submit of the input box for radius
            $('form').submit(function(){
                userRad = $('#userradius').val();

                // UserInfo.getInfo(function(data) {
                    // console.log(data);

                    // var userlat = data.position.latitude;
                    // var userlon = data.position.longitude;


                    //Need to provide X for .coords.latitude
                    if (navigator.geolocation) {
                        navigator.geolocation.getCurrentPosition(function(user) {
                            // console.log(user.coords.latitude);
                            xlat = user.coords.latitude;
                            // console.log(user.coords.longitude);
                            xlon = user.coords.longitude;

                    var userlat = xlat;
                    var userlon = xlon;
                    // console.log(x);

                    var lonleft = userlon-(userRad/50);
                    var latbottom =userlat+(userRad/70);
                    var lonright = userlon+(userRad/50);
                    var lattop = userlat-(userRad/70);

                    var url = "http://api.openweathermap.org/data/2.5/box/city?bbox="+
                               lonleft+','+latbottom+','+lonright+','+lattop+','+'6'
                               +"&cluster=yes&appid=a77c8cad8b4334e38b44ef4d1ecf0272";


                    $.get(url, function(res){

                        var html_str = '';

                        console.log(res);


                            for(var i = 0; i < res.list.length; i++){

                                if(res.list[i].weather[0].main != ''){

                                    if (res.list[i].coord.lat > 18.481872) {

                                        var cityPos = {lat: res.list[i].coord.lat , lng: res.list[i].coord.lon}

                                        var typeofthing = res.list[i].weather[0].main;

                                        var marker = new google.maps.Marker({
                                          position: cityPos,
                                          map: map,
                                          title: res.list[i].name,
                                          type: typeofthing,
                                          icon: icons[typeofthing]
                                        });

                                        marker.addListener('click', function() {
                                            var name = this.title;
                                            var type = this.type;

                                            $('.details').html('<h4>'+name+'</h4><p>'+type+'</p>');

                                            $('.details').css('borderBottom', '1px solid rgba(136, 136, 136, 0.76)');
                                        })

                                        html_str += "<div class='four columns'><h5>City: " + res.list[i].name + "</h5><p>Weather: " + res.list[i].weather[0].main + "</p></div>";
                                    }
                                }
                            }
                        //put the list of cities into cities.
                        $('.cities').html(html_str);

                    //End of Get
                    }, 'json');

                //End of getting location

                });
                } else {
                x.innerHTML = 'Geolocation is not supported by this browser.';
                }
                //Endof userdata
                // }, function(err) {
                  // the "err" object contains useful information in case of an error
                //   console.log(err);
                // });

                //Show some things on submitting
                $('.button').fadeIn();

                //Not reaching this x
                // console.log(x);

                //Prevent form from refreshing the page on submitting
                return false;
            })
        //End of Document Ready
        });
    //End of Init Map
    }
    </script>
</head>

<body>
    <div class="container">
        <!-- Input -->
        <div id=radiusbox>
            <form>
                <input type=text id=userradius>
                <input type=submit>
            </form>
        </div>

        <!-- Map -->
        <div id=map></div>

        <!-- Details: Name of city and also weather condition -->
        <div class="details">
            <!-- Name of the City -->
            <h4 class="name"></h4>
            <!-- Current Weather condition -->
            <div class="deets"></div>
        </div>
        <!-- Button to show list of cities -->
        <button type="button" class="button">Show Cities</button>

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

</body>
</html>
