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
        var selected = $('.selectButton').val();
        $('.w').click(function() {
            $(this).addClass('selectButton');
            $(this).siblings().removeClass('selectButton');
            console.log($(this).val());
            selected = $('.selectButton').val();
            if (selected == 'sun') {
                selected = 'Clear';
            }
        })



        //Hide the show cities button until submitted
        $('.button').hide();

        //On page load, focus on the input box
        $('#userradius').focus();

        //the value of userradius
        var userRad;

        //On submit of the input box for radius
        $('#radiusForm').submit(function(){
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

                            if(res.list[i].weather[0].main == selected){

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

                                        getInstagram(name, type);
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

///////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////

function getInstagram(name, weather) {
  name = name.split(" ");
  name = name.join('').toLowerCase();
  if(weather == "Clouds" || weather =="Clear"){
    weather = "sun";
  } else if(weather == "Haze" || weather == "Mist"){
    weather ="fog";
  } else if(weather == "Drizzle"){
    weather ="rain";
  }

  // name = "SanJose";
  // weather = "snow";
  console.log(name);
    // this will be shown while user is waiting for response
    $('#loading').html("<img src='assets/images/spinner.gif'>");
    $('#images').html("");
    $.post('https://api.instagram.com/v1/tags/'+name+weather+'/media/recent?callback=?&count=300&access_token=2205178294.324cf62.a569c4db3a394908bfa806cfafae2397', $(this).serialize(), function(res) {
        var images_string = "";
        var weatherType = weather;
        console.log('weather is '+weather);

        if(res.data.length > 0){
          console.log(res.data);
          // console.log(res.data[i].tags.length);
          for (var i = 0; i < res.data.length; i++) {

              // for (var i = 0; i < res.data[i].tags.length; i++) {
              console.log(res.data[i].tags);
              // if(res.data[i].tags.includes(weatherType)){
              //   console.log('yes!!');
                images_string +='<img src='+res.data[i].images.low_resolution.url+'>';

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

}
