/*
 * Front-end JavaScript for Functional Stoneware
 * @author    Blieque Mariguan <himself [at] blieque.co.uk>
 * @copyright licensed under GPL v3
 *
 * https://github.com/blieque/functionalstoneware.com
 * https://gnu.org/licenses/gpl.html
 *
 */

// variables

var formFirstSubmit = true,
	basketOpen		= false,
	basket			= [],
	intIds 			= [],
	lastData;

// functions

function formSubmit(d, s) {	// data, status

	// if no error(s) in form
	if (d == '0') {

		$('input,textarea').delay(500)					// wait a bit
						   .animate({opacity:0}, 500,	// fade fields out
						   	function() {				// clear fields
								$('input,textarea').val('');					
						   	});
		$('input,textarea').delay(200)					// wait a bit (less)
						   .animate({opacity:1},500);	// fade back in

		setTimeout(function(){
			// fade submit button out over 100ms
			$('form path').animate({opacity:0}, 1000, function(){
				// dash-array
				$('form path').css('stroke-dasharray','0 40');
				setTimeout(function(){
					// opacity reset
					$('form path').css('opacity','1');
				}, 500)
			});
		},5000);

	// if error(s) in form
	} else {

		// create array for use in for loop
		var c = [
			/1/.test(d) ? 'e' : '',
			/2/.test(d) ? 'e' : '',
			/3/.test(d) ? 'e' : ''
		];

		// clear old red borders on inputs
		$('.e').removeClass('e');

		// make inputs red
		for (var i = 0; i < 3; i++) {
			// add error class to input(s)
			$('form *').eq(i).addClass(c[i]);
		}

	}

	// if the form has been submitted before
	if (!formFirstSubmit) {

		// fade submit button out over 100ms
		$('form path').animate({opacity:0}, 100, function(){
			// dash-array
			$('form path').css('stroke-dasharray','0 40');
			setTimeout(function(){
				// opacity reset
				$('form path').css('opacity','1');
				// call svg function
				formSvg(d);
			}, 500)
		});

	} else {

		// call svg function
		formSvg(d);

		formFirstSubmit = false;

	}

}

function formSvg(d) { // which svg; 0 or 1?

	success  = d == '0';

	var dal  = success ? 38 : 27,     // dash-array limit
		path = success ? '#g' : '#r'; // path id (red or green)

	// change stroke dash lengths
	$(path).css('stroke-dasharray', dal + ' 40');

}

function formatPrice(inCents) {

	priceDiv = inCents / 100;
	price    = priceDiv.toString();

	lengthInt = inCents.toString().length;
	lengthDiv = price.length;

	if (lengthDiv == lengthInt - 2) {
		price += ".00";
	} else if (lengthDiv == lengthInt) {
		price += "0";
	}

	return '$' + price;

}

function toggleBasket(e) {

	target = $(e.target);

	// close basket
	if (basketOpen &&
		target.is('#sb>div,#sb>div a,#sb>div ul,#sb>div li') === false) {

		$('#sb div').slideUp(200);
		opening = false;

	// open basket
	} else if(target.is('#sb>a,#sb>a>svg,#sb>a>svg>path,#sb>a>span')) {

		$('#sb div').slideDown(200);
		opening = true;

	} else {
		return;
	}

	i = 0;
	elem = $('#sb>a path');
	vals = [[12, 2, 12, 2], [2, 12, 2, -2]]; // up arrow, down arrow
	to = opening ? vals[1] : vals[0];
	from = opening ? vals[0] : vals[1];

	intIds.push(setInterval(function(){

		from[0] += to[3];
		from[1] -= to[3];
		from[2] += to[3];

		elem.attr('d', 'M2 ' + from[0] +
					   'L12 ' + from[1] +
					   'L22 ' + from[2]);

		if (from[2] == to[2]) {
			intIds.forEach(clearInterval);
			intIds = [];
		}

		i++;

	}, 71)); // 24 fps
	
	basketOpen = !basketOpen;

}

function proceed() {

}

function addToBasket() {

	// get id of item
	var split  = location.pathname.split('/'),
		itemId = parseInt(split[split.length - 1], 10);

	$.get(location.origin + '/data', {id: itemId}, function(d) {

		data   = JSON.parse(d);
		name   = data[0];
		price  = data[1];
		priceF = formatPrice(price);

	});

}

function updateBasket() {

}

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
