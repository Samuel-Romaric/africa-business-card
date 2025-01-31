$(document).ready(function(){
    $('.alert').hide().fadeIn(300).delay(4800).animate({
        marginRight: "-100%"
    }, 300, "swing", function() {
        $(this).remove();
    });
});