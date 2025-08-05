jQuery(document).ready(function($) {
    $('.faq-question').on('click', function() {
        const answer = $(this).next('.faq-answer');
        const expanded = $(this).attr('aria-expanded') === 'true';
        $('.faq-question').attr('aria-expanded', 'false');
        $('.faq-answer').slideUp().attr('hidden', true);

        if (!expanded) {
            $(this).attr('aria-expanded', 'true');
            answer.slideDown().removeAttr('hidden');
        }
    });
});
