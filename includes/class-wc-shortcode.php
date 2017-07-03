<?php
class KONSEP_WC_Shortcode {
	
	public function __construct() 
	{
		add_shortcode( 'form-wc-search', array( $this, 'form_search' ) );
	}

	public function form_search()
	{
		global $woocommerce, $wpdb;

		$items = $wpdb->get_results( 
				'SELECT
						b.`ID`
					FROM
					(
						SELECT term_id 
						FROM wp_terms 
						WHERE name in ( "accommodation-booking", "booking" ) AND slug IN ( "accommodation-booking", "booking" )
					) a,
					wp_posts b,
					wp_term_relationships c
					WHERE
						a.term_id = c.term_taxonomy_id 
						AND b.`ID` = c.object_id' 

		);
		
		if ( !empty( $_POST['data_cari'] ) )
		{
			$data_hotel = $this->search_hotel( $_POST['data_cari'] );		
		}

		KONSEP_WC_Search()->templates->get_template_part( 'form-search', [ 'items' => $items, 'data_hotel' => $data_hotel ] );
		

	}

	public function search_hotel( $data_cari )
	{
		$new_data = '';
		$text = '';	
		for ($i=0; $i < count( $data_cari ) ; $i++) { 
			$new_data = explode( '###' , $data_cari[$i] );
			
			if (  $new_data[1] === 'SUCCESS' ) 
			{
				$text .= '<div class="col-md-3">';
				$text .= $this->call_url( $new_data[0] );
				if ( empty( get_the_post_thumbnail( $new_data[0] , 'shop_catalog' ) ) ) {
				 	$text .= wc_placeholder_img( 'shop_catalog' );
				} else {
					$text .= get_the_post_thumbnail( $new_data[0] , 'shop_catalog' );
				}
				$text .= '</div>';				
			}
			
		}
		return $text;
	}

	public function call_url( $id_product )
	{
		global $product;
		$GLOBALS['product'] = wc_get_product( $id_product );
		return apply_filters( 'woocommerce_loop_add_to_cart_link',
			sprintf( '<a rel="nofollow" href="%s" data-quantity="%s" data-product_id="%s" data-product_sku="%s" class="%s">%s</a>',
				esc_url( $product->add_to_cart_url() ),
				esc_attr( isset( $quantity ) ? $quantity : 1 ),
				esc_attr( $product->id ),
				esc_attr( $product->get_sku() ),
				esc_attr( isset( $class ) ? $class : 'button' ),
				esc_html( $product->add_to_cart_text() )
			),
		$product );
	}

}
new KONSEP_WC_Shortcode;