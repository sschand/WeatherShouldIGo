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
    }



    </style>



    <script>

    function initMap() {

            var myLatLng = {lat: 37.34605, lng: -121.8878};

            var map = new google.maps.Map(document.getElementById('map'), {
              zoom: 8,
              center: myLatLng
            });

            var icons = {
              Snow: '/assets/images/snow.png',
              Clear: '/assets/images/sun.png',
              Rain: '/assets/images/rain.png',
              Haze: '/assets/images/fog.png',
              Fog: '/assets/images/fog.png',
              Clouds: '/assets/images/cloud.png'
            };
    


    $(document).ready(function(){

        

        var userRad;

        $('form').submit(function(){
            userRad = $('#userradius').val();

            UserInfo.getInfo(function(data) {
                
                var userlat = data.position.latitude;
                var userlon = data.position.longitude;

                var lonleft = userlon-(userRad/50);
                var latbottom =userlat+(userRad/70);
                var lonright = userlon+(userRad/50);
                var lattop = userlat-(userRad/70);

                console.log('In Userinfo');

                var url = "http://api.openweathermap.org/data/2.5/box/city?bbox="+
                           lonleft+','+latbottom+','+lonright+','+lattop+','+'6'
                           +"&cluster=yes&appid=a77c8cad8b4334e38b44ef4d1ecf0272";


                $.get(url, function(res){

                    var html_str = '';

                    console.log(res);


                        for(var i = 0; i < res.list.length; i++){

                            if(res.list[i].weather[0].main != ''){

                                var cityPos = {lat: res.list[i].coord.lat , lng: res.list[i].coord.lon}

                                var typeofthing = res.list[i].weather[0].main;

                                var marker = new google.maps.Marker({
                                  position: cityPos,
                                  map: map,
                                  title: res.list[i].name,
                                  // icon: icons[typeofthing]

                                });
                            
                                html_str += "<p>City: " + res.list[i].name + "</p><p>Weather: " + res.list[i].weather[0].main + "</p>";
                            }
                        }
                    

                    $('.cities').html(html_str);

                }, 'json');


            }, function(err) {
              // the "err" object contains useful information in case of an error
            });

        return false;
        })

    });

    }

    </script>


</head>
<body>
<div class="container">

<div id=radiusbox>

    <form>
        <input type=text id=userradius>
        <input type=submit>
    </form>

</div>



<div id=map></div>


<div class=cities>
</div>

</div>
    <script type="text/javascript">
    $('div').click(function(){
        console.log($(this));
    })

    </script>

    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD7vM_BGlGGOKxYmh7qMjb9NM1r8iLZHmc&callback=initMap">
    </script>


</body>
</html>
