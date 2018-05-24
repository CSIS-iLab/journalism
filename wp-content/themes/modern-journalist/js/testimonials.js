/**
 * Testimonials
 *
 */
(function($) {
		// vars for testimonials carousel
		//   console.log("hey");
		var setIntervalID = setInterval(function() {
			$("#testimonial-list ").fadeOut('fast', function() {
				console.log('fadeout');
				var $first = $('#testimonial-list li:first');
				$first.remove();
				$('#testimonial-list li:last').after($first);
				viewFunc();
				$('#testimonial-list').fadeIn('fast');
			});
		}, 800000);

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
				if ((position == 2) || (position == 0)) {
					$(this).addClass('fade-item');
					$(this).removeClass('center-item');
				} else if ((position != 2) || (position != 0)) {
					$(this).removeClass('fade-item')
					$(this).addClass('center-item');
				}

			});
		}

	

})(jQuery);