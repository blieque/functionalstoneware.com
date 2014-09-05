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
	if (formStatus || formStatus == 0) {			// if box ticked/crossed before
		var path = formStatus ? "#g" : "#r",			// path id
			dal = d ? 38 : 27;							// dash-array limit
		$(path).animate({opacity:0},100,function(){
			$(path).css({"stroke-dasharray":"0 " + dal,"opacity":1})
			formSvgFrame(d)
		});
	} else {
		formSvgFrame(d);
	}
}
function formSvgFrame(d) {						// svg (s or e)
	var count = 1,									// counter
		dal = d ? 38 : 27,							// dash-array limit
		path = d ? "#g" : "#r",						// path id
		anim = setInterval(function(){					// interval to draw 
			$(path).css("stroke-dasharray",count + " " + dal);
			if (count >= dal) {
				clearInterval(anim);
			}
			count += 5;
		},25);
	formStatus = d ? 1 : 0;
	if (s) {

	}
}

// jQ call
$(function(){
	$("[type='submit']").click(function(){
		$.post("contact","a=s&" + $("form").serialize(),formSvg);
	});
});