$('document').ready(function() {

    $('#menu li').mouseover(function() {
        $('ul', this).show();
    });

    $('#menu li').mouseout(function() {
        $('ul', this).hide();
    });

});
