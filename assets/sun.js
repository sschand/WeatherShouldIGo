$(document).ready(function(){
    $('body').append('<img class="morningSun" src="/assets/images/origWeather/sun.png" style="height: 200px; position: absolute; left: -300px; top: 30%; z-index: 5000">');
    $('body').append('<div class="coverForLoad" style="position: absolute; top: 0; left: 0; width: 100vw; height: 100vw; z-index: 3000; background: rgba(180,180,180,0.3)"></div>')
            .queue(function() {
                $('.morningSun').animate({left:'100%'}, 3000, function() {
                    $('.morningSun').hide();
                })
                .delay(0)
                .queue(function(){
                    $('.coverForLoad').hide();
                });
            })
    $('nav').css('backgroundColor', 'rgba(180, 180, 180, 0.76)');
})
