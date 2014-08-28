/* FUNCTIONAL STONEWARE
 * JAVASCRIPT (w/JQUERY) */

// variables
var menuOpen = 0;

// init
function init() {
}
function menuCtl(onlyIf) {
	if (onlyIf == menuOpen || onlyIf == undefined) {
		if (menuOpen) {
			// $("#wrap>*").animate({opacity:1},250);
			$("#side>a").animate({left:"0em"},10000,function(){
				// $("#side,#content").animate({left:0},250);
				// menuOpen = 0;
			});
		} else {
			// $("#wrap>*").animate({opacity:.75},250);
			$("#side").animate({left:"16em"},250);
			$("#content").animate({left:"3em"},250,function(){
				$("#side>a").animate({left:"-4em"},250);
				menuOpen = 1;
			});
		}
	}
}

// menu at left

// jquery
$(function(){
	init();

	// click events
	$("#side a").click(function(){
		menuCtl();
	});
	$("#content").click(function(){
		menuCtl(1);
	});

	// keyboard events
	$("body").keydown(function(e){
		if (e.which == 77) {
			menuCtl();
		}
	})
});