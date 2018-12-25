$('.menu a').append(' <i class="fas fa-chevron-right"></i>');

$('.menu button').click(function (el) {
	el.preventDefault();
	$('.menu div').removeClass('show');
	$(this).next().toggleClass('show');

});