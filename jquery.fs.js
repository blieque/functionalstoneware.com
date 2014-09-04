/* functional stoneware
 * javascript (w/jQuery)
 * written by blieque mariguan
 * licensed under GPL v2 */

// variables
var _placehold;

// init
function init() {
}
function formTick(d,s) {						// data, status
	console.log(s);
	// svg animation yo
}

// jQ call
$(function(){
	$("[type='submit']").click(function(){
		$.post("contact","a=s&" + $("form").serialize(),formTick);
	});
});