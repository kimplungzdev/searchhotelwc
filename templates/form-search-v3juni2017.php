<form class="form-inline" method="get" action="<?=$_SERVER['REQUEST_URI']?>">
	
	<div class="form-group">
		<label for="exampleInputName2">Tanggal Awal</label>
		<input type="text" class="form-control" name="tgl-mulai" id="tgl-mulai" >
	</div>
	
	<div class="form-group">
		<label for="exampleInputEmail2">Tanggal Akhir</label>
		<input type="text" class="form-control" name="tgl-akhir" id="tgl-akhir">
	</div>

	<button type="button" class="btn btn-default" id="cari">Cari</button>

	<?php
	foreach ( $items as $item ) {
		echo $item->ID . '<br>'; 
	}
global $product;
$GLOBALS['product'] = wc_get_product( 30 );
echo apply_filters( 'woocommerce_loop_add_to_cart_link',
	sprintf( '<a rel="nofollow" href="%s" data-quantity="%s" data-product_id="%s" data-product_sku="%s" class="%s">%s</a>',
		esc_url( $product->add_to_cart_url() ),
		esc_attr( isset( $quantity ) ? $quantity : 1 ),
		esc_attr( $product->id ),
		esc_attr( $product->get_sku() ),
		esc_attr( isset( $class ) ? $class : 'button' ),
		esc_html( $product->add_to_cart_text() )
	),
$product );

echo get_the_post_thumbnail(9 , 'shop_catalog' );
//echo wc_placeholder_img( 'shop_catalog' );
	?>


</form>



<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.0/css/bootstrap-datepicker.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.0/css/bootstrap-datepicker.css.map" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.0/js/bootstrap-datepicker.js"></script>
