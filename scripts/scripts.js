(function(){

    $('#js-go-to-form').click(function(event){
        event.preventDefault();
        var $target = $(event.target);
        $(window).scrollTo('#barkground-form', 900);
    });


    $('#js-send-form').click(function(event){

        var $target = $(event.target);
        var $form = $('#js-form');
        var emailResponse;

        $target.button('loading');

        emailResponse = $.ajax({
            'type': 'POST',
            'url': 'sender.php',
            'data': $form.serialize()
        });

        $.when(emailResponse)
            .done(function(data){

            if(data === 'true'){
                $('#js-thx-modal').modal('show');
                $target.addClass('btn-success');
                $target.html('Success!');
            }else{
                $target.addClass('btn-danger');
                $target.html('There was an error. Please try again :-(');

                setTimeout(function(){
                    $target.button('reset');
                }, 5000);

            }
        })
            .fail(function(){
                $target.addClass('btn-danger');
                $target.html('There was an error. Please try again :-(');

                setTimeout(function(){
                    $target.button('reset');
                }, 5000);
            });


    });

    $(window).scroll(function(){
        if($(window).scrollTop() >= 100){
            $('#js-header').addClass('is-small');
        }else{
            $('#js-header').removeClass('is-small');
        }
    });


})(window);