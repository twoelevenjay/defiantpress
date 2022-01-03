jQuery(document).ready(function($){
	$('#defiantpress a').on('click',function(e){
		e.preventDefault();
		$('#defiantpress-modal' ).dialog();
	});
});
