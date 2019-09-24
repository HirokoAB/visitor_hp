$(function() {

	// ---------------------------------------------------
	// 画面遷移
	// ---------------------------------------------------
	var transition = function() {
		$('#loader').fadeIn(100);
	};
	$('form').on('submit', function() {
		transition();
	});
	$(window).on('beforeunload', function() {
		transition();
    });

	// ---------------------------------------------------
	// tippy
	// https://atomiks.github.io/tippyjs/
	// ---------------------------------------------------
	$('[title]').each(function(){
		$(this).attr({
			'data-tippy'            : 'true',
			'data-tippy-trigger'    : 'mouseenter focus',
			'data-tippy-placement'  : 'top',
			'data-tippy-hideonclick': 'false',
			'data-tippy-arrow'      : 'true',
			'data-tippy-size'       : 'large'
		});
	});
	tippy('[data-tippy=true]');

	// ---------------------------------------------------
	// colorbox
	// ---------------------------------------------------
	$('.colorbox').colorbox({
		iframe: true,
		width: '80%',
		height: '90%',
		opacity: 0.6,
		onClosed: function() {
			document.activeElement.blur();
		}
    });

	// ---------------------------------------------------
	// dataTable
	// ---------------------------------------------------
	$('.dataTables').DataTable({
		lengthMenu   : [10, 20, 30, 40, 50, 100, 300],
		displayLength: 20,
		stateSave    : true,
		searching    : false,
		responsive   : false,
		pagingType   : 'full_numbers',
		bAutoWidth   : false,
		order        : [],
		columnDefs: [{
			orderable: false,
			targets  : 'no_order'
		}],
		language     : {
			sLengthMenu : '_MENU_ 件ずつ表示',
			sInfo       : ' 全 _TOTAL_ 件中 _START_ ～ _END_ 件目を表示',
			sInfoPostFix: '',
			oPaginate   : {
				sFirst   : '最初',
				sPrevious: '前',
				sNext    : '次',
				sLast    : '最後'
			}
		}
    });

	// ---------------------------------------------------
	// datetimepicker
	// ---------------------------------------------------
	$.datetimepicker.setLocale('ja');
	$('.datetimepicker').each(function() {
		var obj = $(this);
		obj.datetimepicker({
			closeOnDateSelect: false,
			format: 'Y/m/d H:i',
			defaultTime: '00:00',
			validateOnBlur: false,
			onShow: function(ct) {
				if (obj.data('datemax')) {
					var max = $('#' + obj.data('datemax').replace('[', '\\\[').replace(']', '\\\]')).val();
					this.setOptions({
						maxDate: max ? max : false
					});
				}
				if (obj.data('datemin')) {
					var min = $('#' + obj.data('datemin').replace('[', '\\\[').replace(']', '\\\]')).val();
					this.setOptions({
						minDate: min ? min : false
					});
				}
			}
		});
	});

	// ---------------------------------------------------
	// datepicker
	// ---------------------------------------------------
	$('.datepicker').each(function() {
		var obj = $(this);
		obj.datetimepicker({
			closeOnDateSelect: true,
			format: 'Y/m/d',
			timepicker: false,
			validateOnBlur: false,
			onShow: function(ct) {
				if (obj.data('datemax')) {
					var max = $('#' + obj.data('datemax').replace('[', '\\\[').replace(']', '\\\]')).val();
					this.setOptions({
						maxDate: max ? max : false
					});
				}
				if (obj.data('datemin')) {
					var min = $('#' + obj.data('datemin').replace('[', '\\\[').replace(']', '\\\]')).val();
					this.setOptions({
						minDate: min ? min : false
					});
				}
			}
		});
	});

	// ---------------------------------------------------
	// timepicker
	// ---------------------------------------------------
	$('.timepicker').each(function() {
		$(this).datetimepicker({
			format        : 'H:i',
			defaultTime   : '00:00',
			datepicker    : false,
			validateOnBlur: false
		});
    });

	// ---------------------------------------------------
	// side-menu
	// ---------------------------------------------------
	var $obj = $('#side-menu').find('a.active');
	$obj.next('ul').removeClass('collapse').addClass('in').attr('aria-expanded', 'true');
    $obj.closest('li').addClass('active');

	// ---------------------------------------------------
	// error
	// ---------------------------------------------------
	$('form').find('.error').each(function() {
		if ('' != $(this).html()) {
			$(this).prepend('<i class="fa fa-warning fa-fw"></i>').closest('td').addClass('has-error');
		}
    });

	// ---------------------------------------------------
	// basename
	// ---------------------------------------------------
	function basename(path) {
		return path.split('/').pop();
	}

	// ---------------------------------------------------
	// download
	// ---------------------------------------------------
	$('.download').on('click', function(e){
		var path = $(this).attr('href');
        $(e.target).attr({
            download: basename(path),
            href:  path
        });
	});

	// ---------------------------------------------------
	// modal
	// ---------------------------------------------------
	$('form').find('button[type=button]').each(function(i) {
		var id = 'form' + (i + 1);
		$(this).closest('form').attr({
			'id': id,
			'novalidate': 'novalidate'
		});
		$(this).attr({
			'data-form': '#' + id,
		});
	});
	$('[data-modal]').each(function() {
		$(this).attr({
			'data-toggle'  : 'modal',
			'data-target'  : '#modal',
			'data-backdrop': 'static'
		});
		var target = $(this).data('target');
		if (typeof target !== 'undefined' && target !== false) {
			$(this).attr({
				'data-href': $(this).attr('href'),
				'href'     : '#'
			});
		}
	});
	$('.modal').on('hidden.bs.modal', function(e) {
		$('.modal-execution').remove();
		$('[data-toggle=modal]').each(function() {
			$(this).after($(this).clone(true)).remove();
		});
	});
	$('.modal').on('show.bs.modal', function(e) {
		var target = $(e.relatedTarget).data('target');
		var message = $(e.relatedTarget).data('modal');
		$(target).find('.modal-body').html(message);
		var copy = $(e.relatedTarget).clone(true);
		copy.removeData('toggle data-target');
		copy.removeClass('btn-block btn-lg btn-sm btn-xs');
		copy.addClass('modal-execution');
		copy.attr('href', copy.data('href'));
		copy.removeAttr('data-toggle');
		var form = $(copy.data('form'));
		copy.on('click', function() {
			form.append('<input type="hidden" name="' + copy.attr('name') + '" value="' + copy.attr('value') + '" />');
			form.submit();
		});
		$(this).find('.modal-footer').append(copy);
    });

	// ---------------------------------------------------
	// image-control
	// ---------------------------------------------------
	$('.image-control').each(function() {
		var $preview = $(this).find('.image-preview');
		var $select  = $(this).find('.image-select');
		var $delete  = $(this).find('.image-delete');
		var $hidden  = $(this).find('.image-hidden');
		var upload   = $select.data('upload');
		var $link    = $preview.find('a');
		var $image   = $preview.find('img');
		$image.css({
			'max-width' : '100%',
			'max-height': '100px'
		});

		if ('' == $image.attr('src')) {
			$preview.hide();
			$delete.attr('disabled', 'disabled');
		} else {
			$delete.removeAttr('disabled');
		}

		// colorbox形式（IE10以下非対応）
		$select.on('click', function() {
			window.KCFinder = {
				callBack: function(data) {
					$.colorbox.close();
					window.KCFinder = {};
					$delete.removeAttr('disabled');
					data = decodeURI(data);
					var file = data.replace(upload, '');
					var path = upload + file;
					$link.attr('href', path);
					$image.attr({
						'src': path,
						'alt': file
					});
					$hidden.val(file);
					$preview.hide();
					$image.on('load', function() {
						$preview.slideDown(200);
					});
				}
			};
		});
		$delete.on('click', function() {
			$preview.slideUp(200, function() {
				$delete.attr('disabled', 'disabled');
				$preview.hide();
				$image.attr({
					'src': '',
					'alt': ''
				});
				$link.attr('href', '');
				$hidden.val('');
			});
			return false;
		});
    });

	// ---------------------------------------------------
	// file-control
	// ---------------------------------------------------
	$('.file-control').each(function() {
		var $preview = $(this).find('.file-preview');
		var $select  = $(this).find('.file-select');
		var $delete  = $(this).find('.file-delete');
		var $hidden  = $(this).find('.file-hidden');
		var upload   = $select.data('upload');
		var $link    = $preview.find('a');

		if ('' == $.trim($link.text())) {
			$preview.hide();
			$delete.attr('disabled', 'disabled');
		} else {
			$delete.removeAttr('disabled');
		}

		// colorbox形式（IE10以下非対応）
		$select.on('click', function() {
			window.KCFinder = {
				callBack: function(data) {
					$.colorbox.close();
					window.KCFinder = {};
					$delete.removeAttr('disabled');
					data = decodeURI(data);
					var file = data.replace(upload, '');
					var path = upload + file;
					$link.attr('href', path).text(path);
					$hidden.val(file);
					$preview.show();
				}
			};
		});
		$delete.on('click', function() {
			$delete.attr('disabled', 'disabled');
			$preview.hide();
			$link.text('').attr('href', '');
			$hidden.val('');
			return false;
		});
    });

	// ---------------------------------------------------
	// フォームをクリア
	// ---------------------------------------------------
	$('input.form-clear').each(function() {
		$(this).val('');
	});
});

// ---------------------------------------------------
// sleep
// ---------------------------------------------------
function sleep(sec) {
	var objDef = new $.Deferred;
	setTimeout(function () {
		objDef.resolve(sec);
	}, sec * 1000);
	return objDef.promise();
};

// ---------------------------------------------------
// cookieを設定
// ---------------------------------------------------
var setCookie = function(cookieName, value) {
	var cookie = cookieName + "=" + value + ";";
	document.cookie = cookie;
};

// ---------------------------------------------------
// cookieを取得
// ---------------------------------------------------
var getCookie = function(cookieName) {
	var l = cookieName.length + 1;
	var cookieAry = document.cookie.split("; ");
	var str = "";
	for (i = 0; i < cookieAry.length; i++) {
		if (cookieAry[i].substr(0, l) === cookieName + "=") {
			str = cookieAry[i].substr(l, cookieAry[i].length);
			break;
		}
	}
	return str;
};

// ---------------------------------------------------
// 画面表示（cookie利用可能判断）
// ---------------------------------------------------
setCookie('check_cookie', true);
$(window).on('load', function() {
	if (getCookie('check_cookie')) {
	    sleep(0.2).done(function () {
			$('#loader').fadeOut(800);
		});
	} else {
		$('.no_cookie').show();
	}
});