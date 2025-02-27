(function ($) {

	$.fn.serializeArrayAll = function () {
		var rCRLF = /\r?\n/g;
		return this.map(function () {
			return this.elements ? jQuery.makeArray(this.elements) : this;
		}).map(function (i, elem) {
			var val = jQuery(this).val();
			if (val == null) {
				return val == null;
				//next 2 lines of code look if it is a checkbox and set the value to blank
				//if it is unchecked
			} else if (this.type == "checkbox" && this.checked === false) {
				return {name: this.name, value: this.checked ? this.value : ''}
				//next lines are kept from default jQuery implementation and
				//default to all checkboxes = on
			} else if (this.type === 'radio') {
				if (this.checked) {
		    		return {name: this.name, value: this.checked ? this.value : ''};
				}
			} else {
				return jQuery.isArray(val) ?
					jQuery.map(val, function (val, i) {
						return {name: elem.name, value: val.replace(rCRLF, "\r\n")};
					}) :
					{name: elem.name, value: val.replace(rCRLF, "\r\n")};
			}
		}).get();
	};


	$(document).on('click', '.single_add_to_cart_button:not(.disabled)', function (e) {

		var $thisbutton = $(this),
		$form = $thisbutton.closest('form.cart'),
		//quantity = $form.find('input[name=quantity]').val() || 1,
		//product_id = $form.find('input[name=variation_id]').val() || $thisbutton.val(),
		data = $form.find('input:not([name="product_id"]):not([disabled]), select, button, textarea').serializeArrayAll() || 0;

		$.each(data, function (i, item) {
			if (item.name == 'add-to-cart') {
				item.name = 'product_id';
				item.value = $form.find('input[name=variation_id]').val() || $thisbutton.val();
			}
		});

		e.preventDefault();

		$(document.body).trigger('adding_to_cart', [$thisbutton, data]);

		$.ajax({
			type: 'POST',
			url: woocommerce_params.wc_ajax_url.toString().replace('%%endpoint%%', 'add_to_cart'),
			data: data,
			beforeSend: function (response) {
				$thisbutton.removeClass('added').addClass('loading');
			},
			complete: function (response) {
				$thisbutton.addClass('added').removeClass('loading');
			},
			success: function (response) {

				if (response.error && response.product_url) {
					window.location = response.product_url;
					return;
				}

				$(document.body).trigger('added_to_cart', [response.fragments, response.cart_hash, $thisbutton]);
			},
		});

		return false;

	});


	$(document).on('added_to_cart', function(e){
		refreshCartCount();
	});
	$(document).on('removed_from_cart', function(e){
		refreshCartCount();
	});

	$(document).on('click', '.cart-btn, .cart-toggle', function(e){
		e.preventDefault();
		$('.widget_shopping_cart').toggleClass('open');
		$('#site-navigation').removeClass('expanded');
	});
	$(document).on('click', '.widget_shopping_cart button.close-btn, .menu-toggle', function(e){
		e.preventDefault();
		$('.widget_shopping_cart').removeClass('open');
	});

	$(document).on('ready wc_fragment_refresh', function(){
		loadCart();
		refreshCartCount();
	});

	function loadCart(){
		$.ajax({
			type: 'POST',
			url: woocommerce_params.ajax_url.toString(),
			data: {
				action: 'norhage_load_cart'
			},
			beforeSend: function (response) {
				//$thisbutton.removeClass('added').addClass('loading');
			},
			complete: function (response) {
				//$thisbutton.addClass('added').removeClass('loading');
			},
			success: function (response) {
				$('.widget_shopping_cart .widget_shopping_cart_content').html(response.html);
			}
		})
	}

	function refreshCartCount(){
		$.ajax({
			type: 'POST',
			url: woocommerce_params.ajax_url.toString(),
			data: {
				action: 'cart_count'
			},
			beforeSend: function (response) {
				//$thisbutton.removeClass('added').addClass('loading');
			},
			complete: function (response) {
				//$thisbutton.addClass('added').removeClass('loading');
			},
			success: function (response) {

				if (response.error && response.product_url) {
					window.location = response.product_url;
					return;
				}
				
				if(parseInt(response.cart_count) === 0){
					$('.cart-btn .item-count, .cart-toggle .item-count').text('')	;
				}else{
					$('.cart-btn .item-count, .cart-toggle .item-count').text(response.cart_count);
				}

			},
		});
	};

	function updateCart(itemKey, newQty) {
        var data = {
            action: 'woocommerce_update_cart_item',
            cart_item_key: itemKey,
            new_qty: newQty
        };

        // Add class to cart to indicate loading
        $('.widget_shopping_cart_content').addClass('updating-cart');

        $.ajax({
            type: 'POST',
            url: woocommerce_params.ajax_url.toString(),
            data: data,
            success: function(response) {
               // Trigger a fragment refresh to update cart content
               $(document.body).trigger('wc_fragment_refresh');

               // Remove the updating class
               $('.widget_shopping_cart_content').removeClass('updating-cart');
            },
            error: function() {
               // Remove the updating class in case of error as well
               $('.widget_shopping_cart_content').removeClass('updating-cart');
            }
        });
    }
   
	
	$(document).on('change', '.woocommerce-mini-cart .qty.text', function() {
		clearTimeout(window.cartTimeout);

		var cart_item_key = $(this).attr('name').match(/\[(.*?)\]/)[1];
		var new_qty = $(this).val();

		window.cartTimeout = setTimeout(function(){
			updateCart(cart_item_key, new_qty);
		}, 500, cart_item_key, new_qty);
	});

	
	/**
	 * Shipping calc stuff
	 * */
	$(document).on(
		'click', 
		'.norhage-shipping-calculator-button', 
		toggleShippingCalculator
	);

	$( document ).on(
		'submit',
		'form.norhage-shipping-calculator',
		submitShippingCalculator
	);

	function toggleShippingCalculator(e){
		e.preventDefault();
		$( '.norhage-shipping-calculator .shipping-calculator-form' ).slideToggle( 'slow' );
	}

	function submitShippingCalculator(e){
		e.preventDefault();

		var $form = $( e.currentTarget );

		//block( $form );

		// Make call to actual form post URL.
		$.ajax( {
			type: $form.attr( 'method' ),
			url: $form.attr( 'action' ),
			data: $form.serialize(),
			dataType: 'html',
			success: function ( response ) {
				$('.shipping-costs-container').html(response);
				//update_wc_div( response );
			},
			complete: function () {
				//toggleShippingCalculator(e);
				//unblock( $form );
				//unblock( $( 'div.cart_totals' ) );
			},
		} );
	}

})(jQuery);

