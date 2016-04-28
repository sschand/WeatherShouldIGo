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
    // $('body').append('<img class="morningSun" src="/assets/images/origWeather/sun.png" style="height: 200px; position: absolute; left: -300px; top: 30%; z-index: 5000">');
    // $('body').append('<div class="coverForLoad" style="position: absolute; top: 0; left: 0; width: 100vw; height: 100vw; z-index: 3000; background: rgba(180,180,180,0.3)"></div>')
    //         .queue(function() {
    //             $('.morningSun').animate({left:'100%'}, 3000, function() {
    //                 $('.morningSun').hide();
    //             })
    //             .delay(0)
    //             .queue(function(){
    //                 $('.coverForLoad').hide();
    //             });
    //         })
    // $('nav').css('backgroundColor', 'rgba(180, 180, 180, 0.76)');
    $('nav.navbar.navbar-custom.navbar-fixed-top').css('backgroundColor', 'rgba(180,180,180,0.0)');

    // Validate password and confirm password
    var password = document.getElementById("password"), confirm_password = document.getElementById("confirm_password");

    function validatePassword(){
        if(password.value != confirm_password.value) {
          confirm_password.setCustomValidity("Passwords Don't Match");
        } else {
          confirm_password.setCustomValidity('');
        }
    }

    //Error in New Event page (cannot set property 'onchange' of null on password.onchange)
    password.onchange = validatePassword;
    confirm_password.onkeyup = validatePassword;

    //LOGIN
    $("#login_form").on('submit', function(e){
          e.preventDefault();

          var user = $('#email_login').val();
          var password = $('#password_login').val();

          $.get('/login/validate_user/'+user+'/'+password, function(res) {
              if(res!= 'User and email correct'){
                  $("#myModalLogin .modal-body .error").html('<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>'+res+'</strong></div>');
              }else{
                  $("#myModalLogin .modal-body .error").html('');
                  location.reload();
              }
          });
    });

    // $(document).on("click",".plan a",function(e) {
    //     e.preventDefault();
    //     var user = <?php echo json_encode($this->session->userdata('user_id')) ?>;
    //     console.log(user);

    //     alert("Must be logged in to plan a trip!");
    // });

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
                // var cityPos = {lat: res.list[i].coord.lat , lng: res.list[i].coord.lon}
                // var typeofthing = res.list[i].weather[0].main;

                var cityUrl = "http://api.openweathermap.org/data/2.5/forecast/daily?q="+res.list[i].name+
                              "&units=imperial&cnt=7&appid=a77c8cad8b4334e38b44ef4d1ecf0272";

                // console.log(cityUrl);

                $.get(cityUrl, function(countryCheck){

                    var cityPos = {lat: countryCheck.city.coord.lat , lng: countryCheck.city.coord.lon}
                    var typeofthing = countryCheck.list[0].weather[0].main;

                    if(countryCheck.city.country == 'US'){

                        var marker = new google.maps.Marker({
                            position: cityPos,
                            map: null,
                            title: countryCheck.city.name,
                            type: typeofthing,
                            icon: icons[typeofthing],
                            forecast: countryCheck.list
                        });

                        //Adds an event listener to each of the markers so clicking works
                        marker.addListener('click', function() {
                            var dayName = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];

                            var name = this.title;
                            var type = this.type;
                            $('.details').html('<h4>'+name+'</h4>');
                            $('.deets').css('borderBottom', '1px solid rgba(136, 136, 136, 0.76)');
                            $('.deets').css('borderTop', '1px solid rgba(136, 136, 136, 0.76)');
                            $('.deets').css('background', 'rgba(180, 180, 180, 0.1)');

                            $('.deets').html('');
                            console.log(this);

                            for (var j = 0; j < this.forecast.length; j++) {
                                var d = new Date(0);
                                d.setUTCSeconds(this.forecast[j].dt);

                                var day = d.getDay();
                                var date = d.getDate();

                                var deets = '<div class="split">';
                                    deets += '<h4>'+dayName[day]+'</h4>';
                                    deets += '<h5>'+date+'</h5>';
                                    deets += '<div class="deetsImgs">';
                                        +this.forecast[j].weather[0].main;
                                        if (this.forecast[j].weather[0].main == "Clear") {
                                            deets += '<img src="/assets/images/sun1.png">';
                                        } else if (this.forecast[j].weather[0].main == "Clouds") {
                                            deets += '<img src="/assets/images/cloud.png">';
                                        } else if (this.forecast[j].weather[0].main == "Rain") {
                                            deets += '<img src="/assets/images/rain.png">';
                                        } else if (this.forecast[j].weather[0].main == "Drizzle") {
                                            deets += '<img src="/assets/images/drizzle.png">';
                                        } else if (this.forecast[j].weather[0].main == "Snow") {
                                            deets += '<img src="/assets/images/snow.png">';
                                        } else if (this.forecast[j].weather[0].main == "Fog") {
                                            deets += '<img src="/assets/images/fog.png">';
                                        } else {
                                            deets += this.forecast[j].weather[0].main;
                                        }
                                    deets += '</div>';
                                    deets += '<p>Min: '+Math.round(this.forecast[j].temp.min)+'&deg<br />';
                                    deets += 'Max: '+Math.round(this.forecast[j].temp.max)+'&deg;</p>';
                                deets += '</div>';

                                var splitSize = $('.deets').width()/7;
                                $('.split').css('width', splitSize);
                                $('.deets').append(deets);
                            }

                            //Gets the Instagram pictures (function on the bottom)
                            getInstagram(name, type);

                            // console.log(this.forecast);
                            // console.log('smoking is bad');
                        })
                        //Push them all into one array
                        markers.push(marker);

                    }

                }, 'json');


                //How to show and remove (but not from the array)
                // markers[0].setMap(null); Removes marker at markers[0]
                // markers[0].setMap(map); Adds marker at markers[0]
            }

            console.log('Done with initial city loading');

            $(document).on('click', '.w', function(event) {
                var weatherToMatch = this.value;

                if (weatherToMatch == 'All Weather') {
                    for (var i = 0; i < markers.length; i++) {
                        markers[i].setMap(map);
                    }
                    // Reset City Details, forecast, trip button, and images
                    $("#images").html('');
                    $(".trip").html('');
                    $(".details").html('<!-- Name of the City --><h4 class="name"></h4>');
                    $(".spec_det").html('<div class="deets twelve columns" style="width: 100%"></div>');

                } else {
                    if (weatherToMatch == 'sun') {
                        weatherToMatch = 'Clear';
                    }
                    for (var i = 0; i < markers.length; i++) {
                        // console.log(this);
                        if (weatherToMatch == markers[i].type) {
                            markers[i].setMap(map);
                            // console.log(markers[i]);
                        } else {
                            markers[i].setMap(null);
                        }
                    }
                }

                // markers[0].setMap(map);
                // console.log(this.value);
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

    // this will be shown while user is waiting for response
    $('#loading').html("<img src='assets/images/loading.gif'>");
    $('#images').html("");

    $.post('https://api.instagram.com/v1/tags/'+name+weather+'/media/recent?callback=?&count=300&access_token=2205178294.324cf62.a569c4db3a394908bfa806cfafae2397', $(this).serialize(), function(res) {
        var images_string = "";
        var weatherType = weather;

        //$('h3.list').html("List of people going to "+name);
        $('.trip').html('<span class="plan"><a href="/Login/logged/'+name+'">Plan a Trip?<i class="fa fa-plane" aria-hidden="true"></i></a></span>');
        $('.span').click(function(){

        })

        if(res.data.length > 0){
            for (var i = 0; i < res.data.length; i++) {
                  if(!(res.data[i].tags.includes('selfie'))){
                    images_string +='<img src='+res.data[i].images.low_resolution.url+'>';
                }
            }
            if(images_string.length < 1){
                images_string += "<h2>No images found :(</h2>";
            }
        }else{
            images_string += "<h2>No images found :(</h2>";
        }

        // remove loading image
        $('#loading').html("");
        $('#images').html(images_string);
    }, 'json');
}
