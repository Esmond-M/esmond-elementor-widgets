jQuery(document).ready(function($){
    $('.newsletter-form').on('submit', function(e){
        e.preventDefault();
        var form = $(this);
        var email = form.find('input[name="email"]').val();
        var response = form.find('.newsletter-response');
        response.text('Processing...');

        $.post(newsletterAjax.ajaxurl, {
            action: 'newsletter_signup',
            email: email
        }, function(res){
            if(res.success){
                response.text(res.data.message).css('color', 'green');
                form[0].reset();
            } else {
                response.text(res.data.message).css('color', 'red');
            }
        });
    });
});