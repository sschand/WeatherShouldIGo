//https://airport.api.aero/airport/nearest/31.46273/-99.33304/?user_key=47b0e35381e6f8e41c97f5eb08e30661

//Geolocation
// if (navigator.geolocation) {
//
//     navigator.geolocation.getCurrentPosition(function(user) {
//     xlat = user.coords.latitude;
//     xlon = user.coords.longitude;
//End of getting location

// });
// } else {
// x.innerHTML = 'Geolocation is not supported by this browser.';
// }

$(document).ready(function() {
    //Hide the show cities button until submitted
    $('.button').hide();
    //On page load, focus on the input box
    $('#userradius').focus();
})
//Function for map initialization and getting weather by distance
function initMap() {
        //Where map center is
        var myLatLng = {lat: 39.8282, lng: -98.5795};
        //SAN JOSE: lat: 37.34605, lng: -121.8878
        //CENTER OF US: lat: 39.8282, lng: -98.5795
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 4,//8 for local view, 4 for national view
          center: myLatLng,
          draggable: false,
          zoomControl: false,
          scrollwheel: false,
          disableDoubleClickZoom: true
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
          Thunderstorm: '/assets/images/rain.png',
          //Need Dust: '/assets/images/dust.png'
          //Currently Placeholder
          Dust: '/assets/images/fog.png'
        };
        //long left, lat bot, long right, lat top for url + the 5th element
        var url = "http://api.openweathermap.org/data/2.5/box/city?bbox=-180,18,-67,50,6&cluster=yes&appid=a77c8cad8b4334e38b44ef4d1ecf0272";

        //Empty array for use for markers
        var markers = [];

        $.get(url, function(res){

            console.log(res);

            //Makes markers that don't show up on map
            for(var i = 0; i < res.list.length; i++){
                var cityPos = {lat: res.list[i].coord.lat , lng: res.list[i].coord.lon}
                var typeofthing = res.list[i].weather[0].main;
                var marker = new google.maps.Marker({
                  position: cityPos,
                  map: null,
                  title: res.list[i].name,
                  type: typeofthing,
                  icon: icons[typeofthing]
                });

                //Adds an event listener to each of the markers so clicking works
                marker.addListener('click', function() {
                    var name = this.title;
                    var type = this.type;
                    $('.details').html('<h4>'+name+'</h4><p>'+type+'</p>');
                    $('.details').css('borderBottom', '1px solid rgba(136, 136, 136, 0.76)');
                    //Gets the Instagram pictures (function on the bottom)
                    getInstagram(name, type);
                })
                //Push them all into one array
                markers.push(marker);

                //How to show and remove (but not from the array)
                // markers[0].setMap(null); Removes marker at markers[0]
                // markers[0].setMap(map); Adds marker at markers[0]
            }

            $(document).on('click', '.w', function(event) {
                var weatherToMatch = this.value;

                if (weatherToMatch == 'All Weather') {
                    for (var i = 0; i < markers.length; i++) {
                        markers[i].setMap(map);
                    }
                } else {
                    if (weatherToMatch == 'sun') {
                        weatherToMatch = 'Clear';
                    }
                    for (var i = 0; i < markers.length; i++) {
                        // console.log(this);
                        if (weatherToMatch == markers[i].type) {
                            markers[i].setMap(map);
                            console.log(markers[i]);
                        } else {
                            markers[i].setMap(null);
                        }
                    }
                }

                // markers[0].setMap(map);
                console.log(this.value);
            })

        //End of Get
        }, 'json');


    //Show some things on submitting
    $('.button').fadeIn();

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
        $('.trip').html('<span><a href="/Login">Plan a Trip?</a></span>')
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

    }, 'json');
}
