<?php

class KONSEP_WC_Templates {

	public function get_templates_dir() {
		return KONSEP_PLUGIN_DIR . 'templates/';
	}

	public function get_templates_file()
	{
		return dirname( __FILE__ ).'/templates/';
	}

	public function get_theme_template_dir_name() {
		return apply_filters( 'konsep_theme_template_dir_name', 'affiliatewp' );
	}

	public function load_template( $_template_file, $require_once = true, $args = array() ) {
	    global $posts, $post, $wp_did_header, $wp_query, $wp_rewrite, $wpdb, $wp_version, $wp, $id, $comment, $user_ID;
	 
	    if ( is_array( $wp_query->query_vars ) ) {
	        extract( $wp_query->query_vars, EXTR_SKIP );
	    }
	 
	    if ( isset( $s ) ) {
	        $s = esc_attr( $s );
	    }

		if ( $args && is_array( $args ) ) {
			extract( $args );
		}
	 
	    if ( $require_once ) {
	        require_once( $_template_file );
	    } else {
	        require( $_template_file );
	    }
	}

	public function get_template_part( $slug, $args = array(), $load = true  ) {
		return $this->load_template( KONSEP_SEARCH_WC_TEMPLATE_DIR . $slug . '.php', $load, $args );
	}
}