(function( $ ) {

	$(document).ready(function(){
		$('#hamburger').click(function(e){
			e.preventDefault();
			$('body').toggleClass('showNav');
		});

		window.scrollInterval = window.setInterval(function(){
			if(window.scrollY > window.innerHeight){
				$('body:not(.small-height-header)').addClass('small-height-header');
			}else{
				$('body.small-height-header').removeClass('small-height-header');
			}
		}, 100);
		if($('header#masthead').length || $('.productHeaderBlock').length){
			window.headerBlockScrollInterval = window.setInterval(function(){
				if(window.scrollY <  window.innerHeight){
					$('header#masthead:not(.over-headerblock)').addClass('over-headerblock');
				}
				if(window.scrollY >= window.innerHeight){
					$('header#masthead.over-headerblock').removeClass('over-headerblock');
				}
			}, 100);
		}

		$('.expander').click(function(e){
			e.preventDefault();
			$(this).parent().toggleClass('expanded');
		});

		$('.menu-toggle').click(function(e){
			e.preventDefault();
			$('#site-navigation').toggleClass('expanded');
		});

		$('.projects-block .slider-nav button').click(function(e){
			e.preventDefault();
			let s = $(this).parents('.projects-block').scrollLeft();
			if($(this).hasClass('left')){
				s -= $(window).width() / 3;
			}else{
				s += $(window).width() / 3;
			}
			$(this).parents('.projects-block').scrollLeft(s);
		});




		$('.productHeaderBlock .image-col').click(function(e){
			e.preventDefault();
			if(!$('.image-popup').length){
				createImagePopup();
			}
			$('body').addClass('showOverlay');

			let imageIndex = $(e.target).parent().index();
			let imageHeight = $('.image-popup .image-col figure:first-child').outerHeight();
			let scrollPos = imageIndex * imageHeight;

			$('.image-popup .image-col').scrollTop(scrollPos);
		});

		$(document).on('keyup', function(e){
			if($('body').hasClass('showOverlay') && e.key === 'Escape'){
				$('body').removeClass('showOverlay');
			}
		});

		function createImagePopup(){
			let popup = $('<div />')
				.addClass('image-popup')
				.appendTo($('body'));
			$('h1.wp-block-post-title').clone().appendTo(popup);
			$('.productHeaderBlock .image-col').clone().appendTo(popup);
			
			let closeBtn = $('<button />').text('Close').addClass('close-button').click(function(e){
				e.preventDefault();
				$('body').removeClass('showOverlay');
			}).appendTo(popup);

			let scrollBtn = $('<button />').text('Click to scroll').addClass('scroll-button').click(function(e){
				e.preventDefault();
				let currScroll = popup.find('.image-col').scrollTop();
				let imageHeight = popup.find('.image-col figure:first-child').outerHeight();
				popup.find('.image-col').scrollTop(currScroll + imageHeight);
			}).appendTo(popup);

			popup.find('.image-col').click(function(e){
				$(this).toggleClass('contain');
			});
		}

		var variationPrice;
		$( '.single_variation_wrap' ).on( 'show_variation', function( event, variation ) {
			console.log('show_variation');
			variationPrice = variation.display_regular_price;
			add_addons_to_wc_variation_price();
		});

		$('.variations_form .addon-quantity').change(function(e){
			e.preventDefault();
			add_addons_to_wc_variation_price();
		});

		$('.variations_form .sizes_input input').change(function(e){
			e.preventDefault();
			add_addons_to_wc_variation_price();
		});

		function add_addons_to_wc_variation_price(){
			let newPrice = variationPrice;

			// first we need to calculate the unit price
			if($('.sizes_input').length){
				let width = parseFloat($('.sizes_input input[name="cutting_variables[width]"]').val());
				let height = parseFloat($('.sizes_input input[name="cutting_variables[height]"]').val());
				let cutting_fee = parseFloat($('.sizes_input input[name="cutting_variables[cutting_fee]"]').val());
				if(isNaN(width)){
					width = 1;
				}
				if(isNaN(height)){
					height = 1;
				}
				newPrice = cutting_fee + (width * height * variationPrice);
			}

			// then we add the addons
			$('.addon input.addon-quantity').each(function(){
				let quantity = $(this).val();
				let price = $(this).data('price');
				newPrice += (price * quantity);
			});

			let currencySymbol = $('.woocommerce-variation-price .price .woocommerce-Price-amount bdi .woocommerce-Price-currencySymbol').clone();
			//formattedPrice = newPrice.toFixed(2).replace('.', ',');
			formattedPrice = newPrice.toLocaleString(
					wcSettings.locale.siteLocale.replace('_', '-'), 
					{style: 'decimal', minimumFractionDigits: 2, maximumFractionDigits: 2}
				)
				.replaceAll('\xa0', wcSettings.currency.thousandSeparator);
			$('.woocommerce-variation-price .price .woocommerce-Price-amount bdi').text(' ' + formattedPrice + ' ');
			
			if(wcSettings.currency.symbolPosition == 'left' || wcSettings.currency.symbolPosition == 'left_space'){
				$('.woocommerce-variation-price .price .woocommerce-Price-amount bdi').prepend(currencySymbol);
			}else if(wcSettings.currency.symbolPosition == 'right' || wcSettings.currency.symbolPosition == 'right_space'){
				$('.woocommerce-variation-price .price .woocommerce-Price-amount bdi').append(currencySymbol);
			}
		}


		/*
		function gtag() { dataLayer.push(arguments); }
		$('#cn-accept-cookie').click(function(e){
			console.log('clicker');
			window.dataLayer = window.dataLayer || [];
			

			gtag('consent', 'update', {
					        'ad_storage': 'granted',
					        'analytics_storage': 'granted',
					        'functionality_storage': 'granted',
					        'personalization_storage': 'granted',
					        'security_storage': 'granted',
					    });
			dataLayer.push({'event': 'consent_given_in_popup'});
		});
		*/
	});

})(jQuery);