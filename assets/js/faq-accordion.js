jQuery(document).ready(function($) {
    $('.faq-question').on('click', function() {
        const $item = $(this).closest('.faq-item');
        $item.toggleClass('active');
        $item.find('.faq-answer').slideToggle(200);
        $item.siblings('.faq-item').removeClass('active').find('.faq-answer').slideUp(200);
    });
});
