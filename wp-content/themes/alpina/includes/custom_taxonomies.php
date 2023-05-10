<?php
	##########################################
	//////////  categoria  ///////////
	#########################################
	add_action( 'init', 'categoria' );
	function categoria() {
	
		$taxonomy = array(
			'label' 		=> __( 'Categoria' ),
			'rewrite' 		=> array( 'slug' => 'categoria' ),
			'hierarchical' 	=> true
		);
	
		register_taxonomy('categoria','',$taxonomy);
	}

	##########################################
	//////////  categoria_de_produto  ///////////
	#########################################
	add_action( 'init', 'categoria_de_produto' );
	function categoria_de_produto() {
	
		$taxonomy = array(
			'label' 		=> __( 'Categoria de produtos' ),
			'rewrite' 		=> array( 'slug' => 'categoria_de_produto' ),
			'hierarchical' 	=> true
		);
	
		register_taxonomy('categoria_de_produto','',$taxonomy);
	}
?>