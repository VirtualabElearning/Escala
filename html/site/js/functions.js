function setMenuActive(quel){
	   
   $(".menu-entry").removeClass("active");
   $("#menu"+quel).addClass("active");
   
}

/***************************************************
	  SELECT MENU ON SMALL DEVICES
***************************************************/
$(function() {
			var pull 		= $('#pull');
				menu 		= $('#primary-menu ul');
				menuHeight	= menu.height();

			$(pull).on('click', function(e) {
				e.preventDefault();
				menu.slideToggle();
			});

			$(window).resize(function(){
        		var w = $(window).width();
        		if(w > 479 && menu.is(':hidden')) {
        			menu.removeAttr('style');
        		}
				if(w > 719 && menu.is(':hidden')) {
        			menu.removeAttr('style');
        		}
    		});
		});


/***************************************************
	  IMAGES HOVER
***************************************************/

$(window).load(function() {
	$('.imglist img').each(function() {
		$(this).wrap('<div style="display:inline-block;width:' + this.width + 'px;height:' + this.height + 'px;">').clone().addClass('gotcolors').css({'position': 'absolute', 'opacity' : 0 }).insertBefore(this);
		this.src = grayscale(this.src);
	}).animate({opacity: 1}, 500);
});
	
$(document).ready(function() {
	$(".imglist a").hover(
		function() {
			$(this).find('.gotcolors').stop().animate({opacity: 1}, 200);
		}, 
		function() {
			$(this).find('.gotcolors').stop().animate({opacity: 0}, 500);
		}
	);
});
	
// http://net.tutsplus.com/tutorials/javascript-ajax/how-to-transition-an-image-from-bw-to-color-with-canvas/
function grayscale(src) {
	var supportsCanvas = !!document.createElement('canvas').getContext;
	if (supportsCanvas) {
		var canvas = document.createElement('canvas'), 
		context = canvas.getContext('2d'), 
		imageData, px, length, i = 0, gray, 
		img = new Image();
		
		img.src = src;
		canvas.width = img.width;
		canvas.height = img.height;
		context.drawImage(img, 0, 0);
			
		imageData = context.getImageData(0, 0, canvas.width, canvas.height);
		px = imageData.data;
		length = px.length;
		
		for (; i < length; i += 4) {
			gray = px[i] * .3 + px[i + 1] * .59 + px[i + 2] * .11;
			px[i] = px[i + 1] = px[i + 2] = gray;
		}
				
		context.putImageData(imageData, 0, 0);
		return canvas.toDataURL();
	} else {
		return src;
	}
}


/***************************************************
	  SLIDE DOWN BOX
***************************************************/


$(document).ready(function(){
	var w = $(window).width();
	if(w < 719) {
		$("#title-box-content1").addClass("effect-box1");
		$("#title-box-content2").addClass("effect-box2");
		$("#title-box-content3").addClass("effect-box3");
	}
	else if(w >= 719){
		$("#title-box-content1").removeClass("effect-box1");
		$("#title-box-content2").removeClass("effect-box2");
		$("#title-box-content3").removeClass("effect-box3");
	}

	$("#title-box1").click(function(){
		$(".effect-box1").slideToggle();
	});
	$("#title-box2").click(function(){
		$(".effect-box2").slideToggle();
	});
	$("#title-box3").click(function(){
		$(".effect-box3").slideToggle();
	});

});