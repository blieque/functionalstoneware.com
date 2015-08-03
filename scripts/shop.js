/*
 * Front-end (shop) JavaScript for Functional Stoneware
 * @author    Blieque Mariguan <himself@blieque.co.uk>
 * @copyright MIT license
 *
 * https://github.com/blieque/functionalstoneware.com
 *
 */

// variables

var basketOpen		= false,
	basket			= [],
	intIds 			= [],
	lastData;

// functions

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
