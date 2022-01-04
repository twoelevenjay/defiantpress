jQuery(document).ready(function($) {
	$("#defiantpress a").on("click", function(e) {
		e.preventDefault();
		$("#defiantpress-modal").dialog({
			overlay: {
				opacity: 0.5
			}
		});
		$('.defiantpress-tutorial').remove();
		$('body').removeClass('tutorial-open');
	});
	var tutorial = function() {
		$('body').append('<div class="defiantpress-tutorial"><div class="one"></div><div class="two"></div><div class="three"></div><div class="four"></div></div>');
		$('body').append('<div class="defiantpress-tutorial"><div class="message">Click on the team member\'s name to view thier details. Click <a href="#">dismiss</a> to prevent this tutorial from showing again.</div></div>');
		var padding = 10;
		var defiantpressLink = $( '#defiantpress' ).first();
		var one = $( '.one' ).last();
		var two = $( '.two' ).last();
		var three = $( '.three' ).last();
		var four = $( '.four' ).last();
		var message = $( '.message' ).last();
		var linkOffset = defiantpressLink.offset();
		console.log( 'left: ' + linkOffset.left + ', top: ' + linkOffset.top + 'width: ' + defiantpressLink.outerWidth() + ', height: ' + defiantpressLink.outerHeight() );
		var viewportWidth = $(window).width();
		var viewportHeight = $(window).height();
		one.css({
			right: (viewportWidth - linkOffset.left + padding),
			bottom: (viewportHeight - linkOffset.top - defiantpressLink.outerHeight() - padding)
		});
		two.css({
			left: (linkOffset.left - padding),
			bottom: (viewportHeight - linkOffset.top + padding)
		});
		three.css({
			top: (linkOffset.top - padding),
			left: (linkOffset.left + defiantpressLink.outerWidth() + padding)
		});
		four.css({
			top: (linkOffset.top + defiantpressLink.outerHeight() + padding),
			right: (viewportWidth - linkOffset.left - defiantpressLink.outerWidth() - padding)
		});
		message.css({
			top: (linkOffset.top + defiantpressLink.outerHeight() + padding),
			left: (linkOffset.left - message.outerWidth() - padding)
		});
		$('body').addClass('tutorial-open');
		console.log( 'width: ' + viewportWidth + ', height: ' + viewportHeight );
	}
	if (defiantpress.viewed === 'unviewed') {
		tutorial();
	}
});
