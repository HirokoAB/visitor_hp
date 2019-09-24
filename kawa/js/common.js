// =======================================
//
//	spmenu
//
// =======================================
$(function(){
	$(".menu_btn_wrap").on("click", function() {

		if (!$("#nav_wrap").hasClass('toggle')) {
			$('#overlay').show();
			$("#nav_wrap").css('z-index', '998');
		}

        $("#nav_wrap").toggleClass("toggle");
		$("nav").toggleClass("toggle");
        $(".menu_btn").toggleClass("active");

		$("nav").bind("oTransitionEnd mozTransitionEnd webkitTransitionEnd transitionend", function(){

			if ($("#nav_wrap").hasClass('toggle')) {
				$('#overlay').show();
				$("#nav_wrap").css('z-index', '998');
			}
			else {
				$('#overlay').hide();
				$("#nav_wrap").css('z-index', '-10');
			}
		});
    });

	$('body').append('<div id="overlay"></div>');
	$('#overlay').css({
		'display': 'none',
		'position': 'fixed',
		'top': 0,
		'left': 0,
		'width': '100%',
		'height': '100%',
		'z-index': 997,
		'background-color': '#000',
		'opacity': 0.0
	});
	$('#overlay').on('click', function(){
		$('#overlay').hide();
		$(".menu_btn_wrap").click();
	});

	// スムーススクロール
	$('a[href^="#"]').on('click', function(){
		var speed = 500;
		var href = $(this).attr("href");
		var target = $(href == "#" || href == "" ? 'html' : href);
		var position = target.offset().top;
		$("html, body").animate({scrollTop:position}, speed, "swing");
		return false;
	});

});


$(window).on('load resize', function(){
	$("#nav_wrap").css('z-index', '-10');
	$("#nav_wrap").removeClass("toggle");
	$("nav").removeClass("toggle");
	$(".menu_btn").removeClass("active");
});


// =======================================
//
//  URLパラメーターを取得し配列に格納
//
// =======================================
var arg = new Object;
var pair = location.search.substring(1).split('&');
for(var i=0; pair[i]; i++) {
    var kv = pair[i].split('=');
    arg[kv[0]] = kv[1];
}

// =======================================
//
//  改行コードを改行タグに変換
//
// =======================================
function nl2br(str) {
	str = str.replace(/\r\n/g, "\n");
	str = str.replace(/(\n|\r)/g, "<br />");
	return str;
}

// =======================================
//
//  colorbox
//
// =======================================
$(function(){
	if ($('.colorbox').get(0)) {
		$('.colorbox').colorbox({
			'fixed': true,
			'iframe': true,
			'innerWidth': '80%',
			'innerHeight': '80%'
		});
	}
});
