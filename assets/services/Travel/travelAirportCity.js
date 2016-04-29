$(document).ready(function() {

	//Geolocation
	if (navigator.geolocation) {

	    navigator.geolocation.getCurrentPosition(function(user)
	    {
		    var xlat = user.coords.latitude;
		    var xlon = user.coords.longitude;

		    var url="http://api.openweathermap.org/data/2.5/weather?lat="+xlat+"&lon="+xlon+"&appid=a77c8cad8b4334e38b44ef4d1ecf0272";

		    $.get(url, function(res){

		    	console.log(res.name);
				var originCity = res.name;

				$('.getAirport').click(function() {
					// $.post('/getAirport', {data: 1},function(response, status) {
					// 	alert();
					// })
					$.ajax({
						type: 'POST',
						url: '/getAirport/'+this.data,
						data: originCity,
						success: function(data){
							var goto = '/getAirport/'+this.data
							window.location.href = goto;
						}
					})
				})

		    }, 'json')


			// End of getting location
		})
	}
})
