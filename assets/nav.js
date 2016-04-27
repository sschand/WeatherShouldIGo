$(document).scroll(function() {
    if ($(window).scrollTop() > 40) {
        // console.log($(window).scrollTop());
        $('.navbar').css('backgroundColor', 'rgba(180, 180, 180, 0.60)');
        // console.log($('.navbar').css('backgroundColor'));
        // $( "#effect" ).animate({backgroundColor: "#aa0000"}, 1000 );
    } else {
    $('.navbar').css('backgroundColor', 'rgba(180, 180, 180, 0.0)');
    }
})
