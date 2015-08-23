/*
 * Front-end (contact form) JavaScript for Functional Stoneware
 * @author    Blieque Mariguan <himself@blieque.co.uk>
 * @copyright MIT license
 *
 * https://github.com/blieque/functionalstoneware.com
 *
 */

// variables

var formFirstSubmit = true;

// functions

function formSubmit(d, s) {    // data, status

    // if no error(s) in form
    if (d == '0') {

        $('input,textarea').delay(500)                    // wait a bit
                           .animate({opacity:0}, 500,    // fade fields out
                            function() {                // clear fields
                                $('input,textarea').val('');                    
                            });
        $('input,textarea').delay(200)                    // wait a bit (less)
                           .animate({opacity:1},500);    // fade back in

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

    success = d == '0';

    var dal  = success ? 38 : 27,     // dash-array limit
        path = success ? '#g' : '#r'; // path id (red or green)

    // change stroke dash lengths
    $(path).css('stroke-dasharray', dal + ' 40');

}

$(function(){

    $('input,textarea').focus(function(){
        $(this).removeClass('e');
    });

    $('#fs').click(function(){
        $.post('contact', 'action=submit&' + $('form').serialize(), formSubmit);
    });

});
