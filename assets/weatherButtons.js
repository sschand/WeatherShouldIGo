$('.w').click(function() {
    $(this).addClass('selectButton');
    $(this).sibling().removeClass('selectButton');
    console.log('something');
})
