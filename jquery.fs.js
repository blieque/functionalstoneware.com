/* functional stoneware
 * javascript (w/jQuery)
 * written by blieque mariguan
 * licensed under GPL v2 */

// variables
var formStatus;

// init
function init() {
}
function formSvg(d,s) {							// data, status
	if (d != 0) {									// error in form
		for (var i = 1; i < 4; i++) {					// make inputs red
			$("form *").eq(i - 1).addClass("e");			// add error class to imput(s)
		}
		d = 1;
	}
	if (formStatus || formStatus == 0) {			// if box ticked/crossed before
		var path = formStatus ? "#r" : "#g",			// path id
			dal = d ? 38 : 27;					// dash-array limit
		$(path).animate({opacity:0},100,function(){
			$(path).css({"stroke-dasharray":"0 " + dal,"opacity":1});
			formSvgFrame(d);
		});
	} else {
		formSvgFrame(d);
	}
}
function formSvgFrame(d) {						// svg (0 or not)
	var count = 1,									// counter
		dal = d ? 27 : 38,							// dash-array limit
		path = d ? "#r" : "#g",						// path id (red or green)
		anim = setInterval(function(){				// interval to draw 
			$(path).css("stroke-dasharray",count + " " + dal);
			if (count >= dal) {
				clearInterval(anim);
			}
			count += 5;
		},25);
	formStatus = d;
}

// jQ call
$(function(){
	$("[type='submit']").click(function(){
		$.post("contact","a=s&" + $("form").serialize(),formSvg);
	});
	$(".e").focus(function(){
		$(this).removeClass("e");
	});
});