(function(){

    $('#js-go-to-form').click(function(event){
        event.preventDefault();
        var $target = $(event.target);
        $(window).scrollTo('#barkground-form', 900);
    });


    $('#js-send-form').click(function(){
        $('#js-thx-modal').modal('show');
    });

    $(window).scroll(function(){
        if($(window).scrollTop() >= 100){
            $('#js-header').addClass('is-small');
        }else{
            $('#js-header').removeClass('is-small');
        }
    });


})(window);