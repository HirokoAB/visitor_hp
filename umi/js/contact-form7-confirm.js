/*
 * Copyright (c) 2012 takashi shinohara
 * this Library is licensed. http://aulta.jp/library/
 * http://aulta.jp/library/wordpress/contactForm7Confirm.html
 * last update: 2012-02-15, 0.0.1.

 */


jQuery(document).ready(function(){
	
	var option = {
		pages : [
			{
				'path' : ['/umi/info/'],
				'button' : {
					'areaClassName' : 'submit-button',	//	<p class="submit-button">[submit "送信する"]</p>
					'confirm' : '<input class="button-confirm" type="button" value="確認画面へ" />',	//	html
					'rewrite' : '<input class="button-rewrite" type="button" value="修正する" />'	//	html
				},
			}
		],
		 validates : {
		 	required : {
		 		before : '',
		 		after : 'が入力されていません'
		 	},
		 	email : {
		 		match : /^[a-zA-Z0-9.!#$%&'*+\/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/,
		 		before : '',
		 		after : 'が正しい形式ではありません'
		 	}
		 }
	};
	
	var flg = false;
	for(var i in option.pages){
		var page = option.pages[i];
		for(var j in page.path){
			var path = page.path[j];
			if (path == document.location.pathname){
				flg = true;
				option.page = page;
				break;
			}
		}
	}

	if ( ! flg) return;

	function min(date, format) {
 
    format = format.replace(/YYYY/, date.getFullYear());
    format = format.replace(/MM/, date.getMonth() + 1);
    format = format.replace(/DD/, date.getDate());
 
    return format;
	}

	var date_min = $(this).find('#day,#signature-date,#guardian-date');
		date_min.attr('min',(min(new Date(),'YYYY-MM-DD')));

	//記述雨を残すための記述
	jQuery('form.wpcf7-form')
	.each(function(){
		
		jQuery(this).find('.wpcf7-form-control-wrap')
		.each(function(){
			
			var child = jQuery(this).children(0);
			if (child.hasClass('wpcf7-text' && 'contact-address')){
				jQuery('.address > input').addClass('p-region p-locality p-street-address p-extended-address');
			}else if(child.hasClass('wpcf7-text' && 'contact-postalcode')){
				jQuery('.postal-code > input').addClass('p-postal-code');
			};	
			if (child.hasClass('wpcf7-text')){
				jQuery(this)
				.after(
					jQuery('<span>').addClass('wpcf7-form-control-wrap-confirm')
				);
				child
				.change(function(){
					jQuery(this).parent().next().text(
						jQuery(this).val()
					);
				})
				.change()
				;
				var address = $(this);
				// console.log('これがアドレスのThis=%o',address);
			} else if (child.get(0).tagName.toLowerCase() == 'textarea'){
				jQuery(this)
				.after(
					jQuery('<span>').addClass('wpcf7-form-control-wrap-confirm')
				);
				child
				.change(function(){
					jQuery(this).parent().next().html(
						jQuery('<span>').text(jQuery(this).val()).html().replace(/\n/g, '<br />')
					);
				})
				.change()
				;
				
			} else if (child.hasClass('wpcf7-number')){
				jQuery(this)
				.after(
					jQuery('<span>').addClass('wpcf7-form-control-wrap-confirm')
				);
				child
				.change(function(){
					jQuery(this).parent().next().text(
						jQuery(this).val()
					);
				})
				.change()
				;
			} else if (child.hasClass('wpcf7-select')){
				jQuery(this)
				.after(
					jQuery('<span>').addClass('wpcf7-form-control-wrap-confirm')
				);
				child
				.change(function(){
					jQuery(this).parent().next().text(
						jQuery(this).find('option[value="' + jQuery(this).val() + '"]').text()
					);
				})
				.change()
				;
			} if (child.hasClass('wpcf7-radio')){
				jQuery(this).addClass('wpcf7-validates-as-required');
				jQuery(this)
				.after(
					jQuery('<span>').addClass('wpcf7-form-control-wrap-confirm')
				);
				child.find('input[type="radio"]')
				.change(function(){
					jQuery(this).parents('.wpcf7-form-control-wrap').find('input[type="radio"]')
					.each(function(){
						if (this.checked){
							jQuery(this).parents('.wpcf7-form-control-wrap').next().text(
								jQuery(this).parent().text()
							);
						}
					});
				})
				.change()
				;
			} if (child.hasClass('wpcf7-checkbox')){
				jQuery(this)
				.after(
					jQuery('<span>').addClass('wpcf7-form-control-wrap-confirm')
				);
				child.find('input[type="checkbox"]')
				.change(function(){
					var a = [];
					jQuery(this).parents('.wpcf7-form-control-wrap').find('input[type="checkbox"]')
					.each(function(){
						if (this.checked){
							a.push(jQuery('<span>').text(jQuery(this).parent().text()).html());
						}
					});
					jQuery(this).parents('.wpcf7-form-control-wrap').next().html(
						a.join('<br />')
					);
				})
				.change()
				;
			}
			if (child.hasClass('wpcf7-date')){
				jQuery(this)
				.children().attr('max','9999-12-31');
				jQuery(this)
				.after(
					jQuery('<span>').addClass('wpcf7-form-control-wrap-confirm')
				);
				child
				.change(function(){
					jQuery(this).parent().next().text(
						jQuery(this).val()
					);
				})
				.change()
				;
			}
			
		});


		
		jQuery(function(){jQuery(this).find('.wpcf7-content')
			.each(function(){
			    var con = jQuery(this).children(0);
		if (con.hasClass('.wpcf7-content')){
			
			jQuery(this)
				.after(
					jQuery('<span>').addClass('wpcf7-form-control-wrap-confirm')
				);
				child
				.change(function(){
					jQuery(this).parent().next().html(
						jQuery('<span>').text(jQuery(this).val()).html().replace(/\n/g, '<br />')
					);
				})
				.change()
				;


			jQuery(con)
			 .after(
			 	jQuery('<span>').addClass('wpcf7-form-control-wrap'))
			 con
			 .change(function(){
			 	jQuery(con).parent().next().text(
		 		jQuery(con).val()
				);
				 })
			 .change()
			 ;
			 }
		})
	});

		
		jQuery('.wrap_error')
		.prepend(
			jQuery('<ul>').addClass('error-messages').hide()
		);
		
		jQuery(this).find('.' + option.page.button.areaClassName)
		.addClass('buttons-area');

		jQuery(this).find('.buttons-area')
		.prepend(
			option.page.button.rewrite
		)
		.after(
			jQuery('<p>')
			.addClass('buttons-area-confirm')
			.html(option.page.button.confirm)
		);
		 var ermsg = this;

		// console.log('ermsgの中身=%o' , ermsg);
		
		jQuery(this).addClass('wpcf7-form-mode-edit');
		jQuery(this).addClass('h-adr');
		jQuery('.h-adr').prepend(
			jQuery('<span>').addClass('p-country-name').text('Japan').css('display','none')
		);
		jQuery(this).find('.wpcf7-form-control-wrap-confirm').hide();
		jQuery(this).find('.wpcf7-form-control-wrap').show();
		jQuery(this).find('.buttons-area').hide();
		jQuery(this).find('.buttons-area-confirm').show();
		
		jQuery(this).submit(function(){
			jQuery(this).find('.buttons-area input[type="submit"]').hide();
		});
		
		jQuery(this).find('.buttons-area .button-rewrite')
		.click(function(){
			var form = jQuery(this).parents('form.wpcf7-form');
			form.addClass('wpcf7-form-mode-edit').removeClass('wpcf7-form-mode-confirm');
			form.find('.buttons-area input[type="submit"]').show();
			form.find('.wpcf7-response-output').empty().removeClass('wpcf7-mail-sent-ok');
			form.find('.wpcf7-form-control-wrap-confirm').hide();
			form.find('.wpcf7-form-control-wrap').show();
			form.find('.buttons-area').hide();
			form.find('.buttons-area-confirm').show();
			jQuery('html,body').animate({ scrollTop: form.offset().top - 30}, 'slow', null);
			return false;
		})
		;
		
		jQuery(this).find('.buttons-area-confirm .button-confirm')
		.click(function(){
			var form = jQuery(this).parents('form.wpcf7-form')
				, error = form.find('ul.error-messages');
			error.empty();
			form.find('dl').removeClass('error');
			form.find('.wpcf7-form-control-wrap')
			.each(function(){
				var child = jQuery(this).children(0)
				, title = child.parents('dl').find('dt').text();
				// ,length = child.parents('dl').find('dt').length;
				 //    console.log(child.parents('dl').find('dt'));
					 // console.log('これがchildの中身=%o' , child);
					// console.log('これがタイトルの個数=%o' , title.length);
					// console.log('これがdtの散るどれ=%o',child);
				if (title.length == 0){
					title = child.parents('p').find('.title' ,'<br>').text();
				}

				if (child.hasClass('wpcf7-text')){
					if (child.hasClass('wpcf7-validates-as-required') && child.val().length == 0){
						 error.append(jQuery('<li>').text(option.validates.required.before + title + option.validates.required.after));
						jQuery(this).addClass('error');
						// console.log('これがテキストのThis=%o',this);
					}

				} else if (child.hasClass('wpcf7-validates-as-email') && ( ! child.val().match(option.validates.email.match))){
						 error.append(jQuery('<li>').text(option.validates.email.before + title + option.validates.email.after));
						jQuery(this).addClass('error');
				
				} else if (child.get(0).tagName.toLowerCase() == 'textarea'){
					if (child.hasClass('wpcf7-validates-as-required') && child.val().length == 0){
						 error.append(jQuery('<li>').text(option.validates.required.before + title + option.validates.required.after));
						jQuery(this).addClass('error');
					}

				} else if (child.hasClass('wpcf7-number')){
					if (child.hasClass('wpcf7-validates-as-required') && child.val().length == 0){
						 error.append(jQuery('<li>').text(option.validates.required.before + title + option.validates.required.after));
						jQuery(this).addClass('error');
					}
				} else if (child.hasClass('wpcf7-select')){
					if (child.hasClass('wpcf7-validates-as-required') && (( ! child.val()) || child.val().length == 0 || child.val() == '選択してください')){
						 error.append(jQuery('<li>').text(option.validates.required.before + title + option.validates.required.after));
						jQuery(this).addClass('error');
					}
				} else if (child.hasClass('wpcf7-radio')){
					if (child.hasClass('wpcf7-validates-as-required')){
						var flg = false;
						jQuery(this).find('input[type="radio"]')
						.each(function(){
							if (this.checked){
								flg = true;
								return;
							}
						});
						if ( ! flg){
							 error.append(jQuery('<li>').text(option.validates.required.before + title + option.validates.required.after));
							jQuery(this).addClass('error');
						}
					}
				} else if (child.hasClass('wpcf7-checkbox')){
					if (child.hasClass('wpcf7-validates-as-required')){
						var flg = false;
						jQuery(this).find('input[type="checkbox"]')
						.each(function(){
							if (this.checked){
								flg = true;
								return;
							}
						});
						if ( ! flg){
							 error.append(jQuery('<li>').text(option.validates.required.before + title + option.validates.required.after));
							jQuery(this).addClass('error');
						}
					}
				}


			});

			if(error.children().length > 0){
				error.empty();
				error.text('赤く色がついている入力事項をご確認ください');
				error.show();
			} else {
				form.addClass('wpcf7-form-mode-confirm').removeClass('wpcf7-form-mode-edit');
				form.find('.wpcf7-form-control-wrap').hide();
				form.find('.wpcf7-form-control-wrap-confirm').show();
				form.find('.buttons-area-confirm').hide();
				form.find('.buttons-area').show();
			}

			if(form.find('.buttons-area')){
				$('.buttons-area').wrap($('<div>').addClass('wrap_button'));
			}

			console.log('エラー下部errorの中身=%o' , form);

			jQuery('html,body').animate({ scrollTop: form.offset().top - 80}, 'slow', null);
			return false;
		});
		
	});
	
 });



jQuery(document).ready(function(){
  jQuery('.wpcf7-submit').click(function(e) {
    $('html,body').animate({scrollTop: $('form').offset().top - 80}, 'slow', null);
    //$('html,body').animate({scrollTop: position}, 700);
    $('.button-rewrite').hide();
  });
});





