/*
 * Front-end (shop) JavaScript for Functional Stoneware
 * @author    Blieque Mariguan <himself@blieque.co.uk>
 * @copyright MIT license
 *
 * https://github.com/blieque/functionalstoneware.com
 *
 */

// variables

var basketOpen = false,
    basket     = [],
    intervalId = null,
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

    // change button arrow

    // start messy animation code
    if (intervalId !== null) clearInterval(intervalId);

    var elem = $('#sb>a path'),
        // ~48 fps
        frameInterval = 21,
        // 13 frames => ~.26 seconds
        changePerFrame = .8;
        // invert the changePerFrame if required
        changePerFrame = opening ? changePerFrame *= -1 : changePerFrame,
        // up arrow, down arrow
        values = [12, 2],
        from = opening ? [values[0],values[1]] : [values[1],values[0]];

    intervalId = setInterval(function(){

        from[0] += changePerFrame;
        from[1] -= changePerFrame;

        elem.attr('d', 'M2 ' + from[0] +
                       'L12 ' + from[1] +
                       'L22 ' + from[0]);

        if (from[0] >= values[0] ||
            from[0] <= values[1]) {
            clearInterval(intervalId);
            intervalId = null;
        }

    }, frameInterval);
    // end messy animation code

    basketOpen = !basketOpen;

}

function proceed() {

}

function addToBasket() {

    // get id of item
    var split  = location.pathname.split('/'),
        itemId = parseInt(split[split.length - 1], 10);

    $.get(location.origin + '/data', {id: itemId}, function(data) {

        parsed = JSON.parse(data);
        name   = parsed[0];
        price  = parsed[1];
        priceF = formatPrice(price);

    });

}

function updateBasket() {

}

$(function(){

    $('#sb-p').click(proceed);

    $('#sip-a').click(addToBasket);

    $('body').click(toggleBasket);

});
