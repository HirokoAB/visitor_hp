/***************** Waypoints ******************/

$(document).ready(function() {
//	$('.hmenu').waypoint(function() {
//		$('.wp1').addClass('animated fadeInUp');
//          $(".hmenu").addClass("navbar-fixed-top");
//		  $(".hmenu .logo").addClass('animated fadeIn block');
//          $(".contents").addClass("menu-padding");
//	});
	$('.wp-fiu1').waypoint(function() {
		$('.wp-fiu1').addClass('animated fadeInUp');
	}, {
		offset: '75%'
	});
	$('.wp-fiu2').waypoint(function() {
		$('.wp-fiu2').addClass('animated fadeInUp');
	}, {
		offset: '75%'
	});
	$('.wp-fiu3').waypoint(function() {
		$('.wp-fiu3').addClass('animated fadeInUp');
	}, {
		offset: '75%'
	});
	$('.wp-fiu4').waypoint(function() {
		$('.wp-fiu4').addClass('animated fadeInUp');
	}, {
		offset: '75%'
	});
	$('.wp-fiu5').waypoint(function() {
		$('.wp-fiu5').addClass('animated fadeInUp');
	}, {
		offset: '75%'
	});
	$('.wp-fiu6').waypoint(function() {
		$('.wp-fiu6').addClass('animated fadeInUp');
	}, {
		offset: '75%'
	});
	$('.wp-fiu7').waypoint(function() {
		$('.wp-fiu7').addClass('animated fadeInUp');
	}, {
		offset: '75%'
	});
	$('.wp-fiu8').waypoint(function() {
		$('.wp-fiu8').addClass('animated fadeInUp');
	}, {
		offset: '75%'
	});
	
	
	$('.wp-fid1').waypoint(function() {
		$('.wp-fid1').addClass('animated fadeInDown');
	}, {
		offset: '75%'
	});
	$('.wp-fid2').waypoint(function() {
		$('.wp-fid2').addClass('animated fadeInDown');
	}, {
		offset: '75%'
	});
	$('.wp-fid3').waypoint(function() {
		$('.wp-fid3').addClass('animated fadeInDown');
	}, {
		offset: '75%'
	});
	$('.wp-fid4').waypoint(function() {
		$('.wp-fid4').addClass('animated fadeInDown');
	}, {
		offset: '75%'
	});
	$('.wp-fid5').waypoint(function() {
		$('.wp-fid5').addClass('animated fadeInDown');
	}, {
		offset: '75%'
	});
	
	
	$('.wp-fil1').waypoint(function() {
		$('..wp-fil1').addClass('animated fadeInLeft');
	}, {
		offset: '55%'
	});
	$('.wp-fil2').waypoint(function() {
		$('.wp-fil2').addClass('animated fadeInLeft');
	}, {
		offset: '55%'
	});
	$('.wp-fil3').waypoint(function() {
		$('.wp-fil3').addClass('animated fadeInLeft');
	}, {
		offset: '55%'
	});
	$('.wp-fil4').waypoint(function() {
		$('.wp-fil4').addClass('animated fadeInLeft');
	}, {
		offset: '55%'
	});
	$('.wp-fil5').waypoint(function() {
		$('.wp-fil5').addClass('animated fadeInLeft');
	}, {
		offset: '55%'
	});
	
	$('.wp-fir1').waypoint(function() {
		$('.wp-fir1').addClass('animated fadeInRight');
	}, {
		offset: '55%'
	});
	$('.wp-fir2').waypoint(function() {
		$('.wp-fir2').addClass('animated fadeInRight');
	}, {
		offset: '55%'
	});
	$('.wp-fir3').waypoint(function() {
		$('.wp-fir3').addClass('animated fadeInRight');
	}, {
		offset: '55%'
	});
	
	
});

/***************** Slide-In Nav ******************/

//	$(window).load(function() {
//
//	$('.nav_slide_button').click(function() {
//		$('.pull').slideToggle();
//	});
//
//});

/***************** Smooth Scrolling ******************/

$(function() {

	$('a[href*="#"]:not([href="#"])').click(function() {
		if (location.pathname.replace(/^\//, '') === this.pathname.replace(/^\//, '') && location.hostname === this.hostname) {

			var target = $(this.hash);
			target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
			if (target.length) {
				$('html,body').animate({
					scrollTop: target.offset().top
				}, 1000);
				return false;
			}
		}
	});

});

//$(function() {
//    var topBtn = $('#top');
//    topBtn.click(function () {
//        $('body,html').animate({
//            scrollTop: 0
//        }, 2000);
//        return false;
//    });
//});


//$(function(){
//   // #で始まるアンカーをクリックした場合に処理
//   $('a[href^="#"]').click(function() {
//      // スクロールの速度
//      var speed = 400; // ミリ秒
//      // アンカーの値取得
//      var href= $(this).attr("href");
//      // 移動先を取得
//      var target = $(href == "#" || href == "" ? 'html' : href);
//      // 移動先を数値で取得
//      var position = target.offset().top;
//      // スムーススクロール
//      $('body,html').animate({scrollTop:position}, speed, 'swing');
//      return false;
//   });
//});




/***************** sidemenu ******************/

$(document).ready(function() {
	$(".drawer").drawer();
});

$(document).ready(function() {
	$('.drawer-close').drawer('close');
});



//
//$(document).ready(function() {
//	var menu = $(".hmenu");
//	var origOffsetY = menu.offset().top;
//	function scroll() {
//		if ($(window).scrollTop() >= origOffsetY) {
//			$(".hmenu").addClass("navbar-fixed-top");
//			$(".hmenu .logo-in").addClass('animated fadeIn block');
//			$(".contents").addClass("menu-padding");
//		} else {
//			$(".hmenu").removeClass("navbar-fixed-top");
//			$(".contents").removeClass("menu-padding");
//		}
//	}
//	document.onscroll = scroll;
//});
//	

/***************** Nav Transformicon ******************/

//document.querySelector("#nav-toggle").addEventListener("click", function() {
//	this.classList.toggle("active");
//});

/***************** Overlays ******************/

$(document).ready(function(){
    if (Modernizr.touch) {
        // show the close overlay button
        $(".close-overlay").removeClass("hidden");
        // handle the adding of hover class when clicked
        $(".img").click(function(e){
            if (!$(this).hasClass("hover")) {
                $(this).addClass("hover");
            }
        });
        // handle the closing of the overlay
        $(".close-overlay").click(function(e){
            e.preventDefault();
            e.stopPropagation();
            if ($(this).closest(".img").hasClass("hover")) {
                $(this).closest(".img").removeClass("hover");
            }
        });
    } else {
        // handle the mouseenter functionality
        $(".img").mouseenter(function(){
            $(this).addClass("hover");
        })
        // handle the mouseleave functionality
        .mouseleave(function(){
            $(this).removeClass("hover");
        });
    }
});





$(function() {
	$('#submit').attr('disabled', 'disabled');
	
	$('#check').click(function() {
		if ($(this).prop('checked') == false) {
			$('#submit').attr('disabled', 'disabled');
		} else {
			$('#submit').removeAttr('disabled');
		}
	});
});



/***************** Flexsliders ******************/
//$(window).load(function() {
//$('.flexslider').flexslider({
//		animation: "fade",
//		directionNav: false,
//		controlNav: false,
//		touch: true,
//		pauseOnHover: false
//	});
//});

//$(window).load(function() {
//
//	$('#productsSlider').flexslider({
//		animation: "slide",
//		directionNav: false,
//		controlNav: true,
//		touch: true,
//		pauseOnHover: false,
//		start: function() {
//			$.waypoints('refresh');
//		}
//	});
//
//	$('#servicesSlider').flexslider({
//		animation: "slide",
//		directionNav: false,
//		controlNav: false,
//		touch: false,
//		pauseOnHover: false,
//		start: function() {
//			$.waypoints('refresh');
//		}
//	});
//
//	$('#infoSlider').flexslider({
//		animation: "slide",
//		directionNav: false,
//		controlNav: false,
//		touch: false,
//		pauseOnHover: false,
//		start: function() {
//			$.waypoints('refresh');
//		}
//	});
//
//});

