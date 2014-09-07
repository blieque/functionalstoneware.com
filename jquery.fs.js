/* functional stoneware
 * javascript (w/jQuery)
 * written by blieque mariguan
 * licensed under GPL v2 */

// variables
var formStatus;

// functions
function formSubmit(d,s) {							// data, status
	console.log(d);
	if (d != 0) {									// error in form
		console.log("d donna equal zero");
		var c = [										// array depending on errors for use in for loop
			/1/.test(d) ? "e" : "",
			/2/.test(d) ? "e" : "",
			/3/.test(d) ? "e" : ""
		];
		console.log(c,d);
		console.log("removin' class 'e'", d);
		$(".e").removeClass("e");						// clear old red borders on inputs
		for (var i = 0; i < 3; i++) {					// make inputs red
			$("form *").eq(i).addClass(c[i]);				// add error class to input(s)
		}
	}
	if (formStatus || formStatus == 0) {			// if box ticked/crossed before
		var dal = formStatus ? 27 : 38;					// dash-array limit
		$("form path").animate({opacity:0},100,function(){	// fade out over 100ms
			$("form path").css({"stroke-dasharray":"0 40","opacity":1});	// dash-array and opacity reset 
			formSvg(d);										// call svg function
		});
	} else {
		formSvg(d);										// call svg function
	}
	formStatus = d ? 0 : 1;							// update last form result variable
}
function formSvg(d) {							// svg (0 or 1)
	var dal = d ? 27 : 38,							// dash-array limit
		path = d ? "#r" : "#g";						// path id (red or green)
	$(path).css("stroke-dasharray",dal + " 40");	// progess the stroke/move to next frame
}

// jQ call
$(function(){
	$("[type='submit']").click(function(){
		$.post("contact","a=s&" + $("form").serialize(),formSubmit);
	});
	$(".e").focus(function(){
		$(this).removeClass("e");
	});
});