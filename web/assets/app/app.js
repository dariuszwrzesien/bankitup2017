(function ($) {
    // sigin
    $('#page-login .form-signin').submit(function (event) {
        var form = $(this);

        $.post(form.attr('action'), form.serialize(), function() {
            window.location.href = '/login';
        }).fail(function() {
            $('#page-login .form-signin .alert').show();
        });

        event.preventDefault();
    });
})(jQuery);