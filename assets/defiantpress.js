jQuery(document).ready(function ($) {
	$(".click-to-view").on("click", function (e) {
		e.preventDefault();
		$("#defiantpress-modal").dialog({
			overlay: {
				opacity: 0.5
			}
		});
		$(".defiantpress-tutorial").remove();
		$("body").removeClass("tutorial-open");
	});
	$(".click-to-view-tutorial").on("click", function (e) {
		e.preventDefault();
		$("#defiantpress-modal").dialog('close');
		tutorial();
	});
	$("body").on("click", ".click-to-close", function (e) {
		e.preventDefault();
		$(".defiantpress-tutorial").remove();
		$("body").removeClass("tutorial-open");
	});
	$("body").on("click", ".click-to-dismiss", function (e) {
		e.preventDefault();
		$.ajax({
			type: "GET",
			dataType: "json",
			url: defiantpress.ajax,
			data: {
				action: "dismiss_tutorial"
			},
			success: function (response) {
				console.log("tutorial dismissed");
			}
		});
		$(".defiantpress-tutorial").remove();
		$("body").removeClass("tutorial-open");
	});
	var tutorial = function () {
		$("body").addClass("tutorial-open");
		$("body").append('<div class="defiantpress-tutorial"><div class="one"></div><div class="two"></div><div class="three"></div><div class="four"></div></div>');
		$("body").append('<div class="defiantpress-tutorial"><div class="message">Click on the team member\'s name to view thier details. Click <a class="click-to-close" href="/click-to-close">close</a> to close this tutorial. Click <a class="click-to-dismiss" href="/click-to-dismiss">dismiss</a> to prevent this tutorial from showing again.</div></div>');
		var padding = 10;
		var defiantpressLink = $("#defiantpress").first();
		var one = $(".one").last();
		var two = $(".two").last();
		var three = $(".three").last();
		var four = $(".four").last();
		var message = $(".message").last();
		var linkOffset = defiantpressLink.offset();
		var viewportWidth = $(window).width();
		var viewportHeight = $(window).height();
		one.css({
			right: viewportWidth - linkOffset.left + padding,
			bottom: viewportHeight - linkOffset.top - defiantpressLink.outerHeight() - padding
		});
		two.css({
			left: linkOffset.left - padding,
			bottom: viewportHeight - linkOffset.top + padding
		});
		three.css({
			top: linkOffset.top - padding,
			left: linkOffset.left + defiantpressLink.outerWidth() + padding
		});
		four.css({
			top: linkOffset.top + defiantpressLink.outerHeight() + padding,
			right: viewportWidth - linkOffset.left - defiantpressLink.outerWidth() - padding
		});
		message.css({
			top: linkOffset.top + defiantpressLink.outerHeight() + padding,
			left: linkOffset.left - message.outerWidth() - padding
		});
	};
	if (defiantpress.viewed === "unviewed") {
		tutorial();
	}
});
