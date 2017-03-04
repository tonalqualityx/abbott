$(document).foundation()
$(document).ready(function() {
	$('.revealer-box').click(function() {
		var reveal_target = $('.revealer-box').data('target');
		$('#' + reveal_target).toggleClass('hide');
		console.log(reveal_target);
	});
	$('#toggle-nav').click(function() {
		$('#nav').toggleClass('revealer');
	});
});
