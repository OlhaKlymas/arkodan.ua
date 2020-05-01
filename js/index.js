let myFullpage = new fullpage('#fullpage', {
      anchors: ['section0', 'section1', 'section2', 'section3', 'section4', 'section5', 'section6'],
      navigation: true,
      menu:'#menu',
      loopTop:true,

    onLeave: function(origin, destination, direction){
		var leavingSection = this;
			if (origin.index == 0 && direction == 'up'){
				// silentMoveTo('section0', 0);
				return false;
			}
			if (origin.index == 1 && direction == 'up'){
				document.getElementsByTagName("video")[0].play();
			}
			if(window.innerWidth>"820"){
				if(origin.index == 0 && direction =='down'){
					
					setTimeout(function() {
						$("header").css('height', '80px');
						$(".mini-logo").css('width', '140px');
						$(".mini-logo").css('margin', '5px 10px');
						$("nav").css('justify-content', 'center');						
						$(".earlier").css('margin-left', '0px');
						$(".now").css('margin-right', '0px');
					}, 800);
					$(".hide-block").hide(800);
				}

				else if(origin.index == 1 && direction == 'up'){
					setTimeout(function() {
						$("header").css('height', '185px');
						$(".mini-logo").css('width', '210px');
						$(".mini-logo").css('margin', '13px 13px 0px 27px');
						$("nav").css('justify-content', 'flex-end');						
						$(".earlier").css('margin-left', '-100%');
						$(".now").css('margin-right', '-100%');
					}, 800);
					$(".hide-block").show(800);
				}

				else if(origin.index == 1 && direction == 'up'){
						$(".earlier").css('margin-left', '-100%');
						$(".now").css('margin-right', '-100%');
				}

				else if(origin.index == 1 && direction == 'down'){				
						$(".earlier").css('margin-left', '-100%');
						$(".now").css('margin-right', '-100%');
				}
				
				else if(origin.index == 2 && direction == 'up'){				
						$(".earlier").css('margin-left', '0px');
						$(".now").css('margin-right', '0px');
				}

			}
		}
		

});

			function PopUpShow(){
				$("#popup1").show(500);
			}
			function PopUpHide(){
			    $("#popup1").hide(500);
			}
			function PopUpShowOffer(){
				$("#popupOffer").show(500);
			}
			function PopUpHideOffer(){
				$("#popupOffer").hide(500);
			}

			function PopUpHideStart(){
				$("#popup1").hide();
				$("#popupOffer").hide();
				$("#result_form").hide();
				$("#result_form_end").hide();
				$("#popupOffer").css('visibility', 'visible');
			}
			
			PopUpHideStart();

var elems = document.querySelectorAll('.technology-block');

if(window.innerWidth<"820"){
	var toolbarButtonHandler = function(e) {
	  var elem = e.currentTarget;
		if(!elem.classList.contains("active-min")){
		    elem.classList.add("active-min");
		    elem.classList.remove("technology-block");
		}
		  else {
		    elem.classList.remove("active-min");
		    elem.classList.add("technology-block")
		}
	};
	for(var i = 0; i < elems.length; i++) {
	  elems[i].addEventListener("click", toolbarButtonHandler);
	}
}
else {
	for(var i = 0; i < elems.length; i++) {
	  elems[i].classList.add("active-wide");
	}
}

$(window).on("load", function () {
	var sum=0;
	$('.banner-container li img').each(function(){
		sum += $(this).width();
	});
	$('.banner-container ul').width(sum);
});
$(function(){
	var winWidth = $(".banner-container").width();
	var ulWidthCount = 0;
	ulWidthCount = $('.banner-container li').length;
	$(".banner-container li").width(winWidth/ulWidthCount);
	$(".banner-container li").hover(function(){
		ulWidthCount = $('.banner-container li').length;
		var imgWidth = $(this).find("img").width();
		var bannerLi = winWidth - imgWidth;
		var remWidth = ulWidthCount - 1;
		var appWidth = bannerLi/remWidth;
		$(".banner-container li").stop(true, false).animate({width: appWidth},700);
		$(this).stop(true, false).animate({width: imgWidth},700);
		$(this).find("span.overlay-n").stop(true, false).fadeOut();
	}, function(){
		$(this).animate({width: winWidth/ulWidthCount},700);
		$(".banner-container li").animate({width:winWidth/ulWidthCount},700);
		$(this).find("span.overlay-n").fadeIn();
	});
});

function ImgHover() {
	$(".photo-wrap div img").click(
		function () {
			$('.photo-wrap div').removeClass('active-img').addClass('no-active-img');
			console.log('aaagaaaa');
			$(this).parent().removeClass('no-active-img').addClass('active-img');
			var indexImg = $(this).parent().index();
			for (var i = indexImg; i < $(".photo-wrap div").length; i++) {
				if (i > indexImg){
					$(".photo-wrap").children(i).removeClass('left').addClass('right');
				}
				else if(i < indexImg){
					$(".photo-wrap").children(i).removeClass('right').addClass('left');
				}
			}

		});
}
ImgHover();