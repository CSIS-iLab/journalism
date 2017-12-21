/**
 * File testimonals.js.
 *
 * Handles toggling the navigation menu for small screens and enables TAB key
 * navigation support for dropdown menus.
 */

(function($) {
    // vars for testimonials carousel
    //   console.log("hey");

   viewFunc()
    var $txtcarousel = $('#testimonial-list');
    var txtcount = $txtcarousel.children().length;
    $('.button-prev').on('click', function() {

        var $last = $('#testimonial-list li:last');
        $last.remove();
        $('#testimonial-list li:first').before($last);
            viewFunc()

    });
    $('.button-next').on('click', function() {
        var $first = $('#testimonial-list li:first');

        $first.remove();
        $('#testimonial-list li:last').after($first);
       viewFunc()

    });
    function viewFunc() {
        $('#testimonial-list li').each(function() {
            var position = $(this).index();
            $(this).attr('data-count', position);
            $this = $(this);

            if (position > 2) {
                $(this).addClass('hide-item')
            } else if (position <= 2) {
                $(this).removeClass('hide-item')
            }

            if ((position == 2) || (position != 0)) {
                $(this).addClass('fade-item');
            } else if ((position != 2) || (position != 0)) {
                $(this).removeClass('fade-item')
            }
        });

    }
})(jQuery);