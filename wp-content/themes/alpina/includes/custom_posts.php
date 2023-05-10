<?php
	
	//////////////////////////////////////////////////
	############## slider
	//////////////////////////////////////////////////

	add_action( 'init', 'slider' );
	function slider() {
		$labels = array(
			'name' 			=> __( 'Slider' ),
			'singular_name' => __( 'Slider' ),		
		);

		$post = array(
			'labels' 			=> $labels,
			'supports'	 		=> array('title', 'editor', 'thumbnail'),
			'capability_type'	=> 'post',
			'public' 			=> true,
			'has_archive' 		=> false,		
		);

		register_post_type( 'slider', $post);
	}
	
	//////////////////////////////////////////////////
	############## sobre
	//////////////////////////////////////////////////

	add_action( 'init', 'sobre' );
	function sobre() {
		$labels = array(
			'name' 			=> __( 'Sobre' ),
			'singular_name' => __( 'Sobre' ),		
		);

		$post = array(
			'labels' 			=> $labels,
			'supports'	 		=> array('title', 'editor'),
			'capability_type'	=> 'post',
			'public' 			=> true,
			'has_archive' 		=> false,		
		);

		register_post_type( 'sobre', $post);
	}
	
	//////////////////////////////////////////////////
	############## solucoes
	//////////////////////////////////////////////////

	add_action( 'init', 'solucoes' );
	function solucoes() {
		$labels = array(
			'name' 			=> __( 'Soluções' ),
			'singular_name' => __( 'Soluções' ),		
		);

		$post = array(
			'labels' 			=> $labels,
			'supports'	 		=> array('title', 'editor','thumbnail'),
			'capability_type'	=> 'post',
			'public' 			=> true,
			'has_archive' 		=> false,		
		);

		register_post_type( 'solucoes', $post);
	}
	
	//////////////////////////////////////////////////
	############## alpinistas
	//////////////////////////////////////////////////

	add_action( 'init', 'alpinistas' );
	function alpinistas() {
		$labels = array(
			'name' 			=> __( 'Alpinistas' ),
			'singular_name' => __( 'Alpinistas' ),		
		);

		$post = array(
			'labels' 			=> $labels,
			'supports'	 		=> array('title'),
			'capability_type'	=> 'post',
			'public' 			=> true,
			'has_archive' 		=> false,		
		);

		register_post_type( 'alpinistas', $post);
	}

	//////////////////////////////////////////////////
	############## clientes
	//////////////////////////////////////////////////

	add_action( 'init', 'clientes' );
	function clientes() {
		$labels = array(
			'name' 			=> __( 'Clientes' ),
			'singular_name' => __( 'Clientes' ),		
		);

		$post = array(
			'labels' 			=> $labels,
			'supports'	 		=> array('title', 'thumbnail'),
			'capability_type'	=> 'post',
			'public' 			=> true,
			'has_archive' 		=> false,		
		);

		register_post_type( 'clientes', $post);
	}

?>