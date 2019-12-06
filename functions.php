/*
* Show donation subtotal when updating quantity
*/

add_action( 'woocommerce_after_add_to_cart_quantity', 'woocommerce_total_product_price', 35 );
function woocommerce_total_product_price() {
    global $woocommerce, $product;
    if ($product->is_type('variable')) {
	    echo sprintf('<div id="product_total_price" style="margin-bottom:20px;display:none;text-align:center;">%s %s</div>',__('Donation Subtotal:','woocommerce'),'<span class="price">'.$product->get_price().'</span>');
	    ?>
	        <script>
	            jQuery(function($){
	                var currency = '<?php echo get_woocommerce_currency_symbol(); ?>';
	 				jQuery('.variations .value select').on('change', function (){
	 					if($(this).val() == ''){
	 						jQuery('#product_total_price,#cart_total_price').hide();	
	 					} else {
	 						jQuery('#product_total_price,#cart_total_price').show();
	 						var qty = parseFloat(jQuery('[name=quantity]').val());
	 						if ($(this).val() > 0 && qty > 0) {
		                        var product_total =qty * parseFloat($(this).val());
		 
		                        jQuery('#product_total_price .price').html( currency + product_total.toFixed(2));
		                    }
	 					}
	 				});
	                jQuery('[name=quantity]').on('change', function(){
	                	jQuery('#product_total_price,#cart_total_price').show();
                    	var price = parseFloat(jQuery('.variations .value select').val());
	                    if (this.value > 0 && price > 0) {
	                        var product_total =price * parseFloat(this.value);
	 
	                        jQuery('#product_total_price .price').html( currency + product_total.toFixed(2));
	                    }
	                });
	            });
	        </script>
    <?php } 
}
