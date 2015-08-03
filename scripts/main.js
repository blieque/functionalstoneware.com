/*
 * Front-end JavaScript for Functional Stoneware
 * @author    Blieque Mariguan <himself@blieque.co.uk>
 * @copyright MIT license
 *
 * https://github.com/blieque/functionalstoneware.com
 *
 */

function init() {

	$('#sb div').slideUp(0);

}

// jQ call
$(function(){

	$('input,textarea').focus(function(){
		$(this).removeClass('e');
	});

	$('#fs').click(function(){
		$.post('contact', 'action=submit&' + $('form').serialize(), formSubmit);
	});

	$('#sb-p').click(proceed);

	$('#sip-a').click(addToBasket);

	$('body').click(toggleBasket);

	init();

});
