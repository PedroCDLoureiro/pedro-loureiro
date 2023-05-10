<?php 
	$pagina = $post->post_name;
	if ($post->post_type == 'page'){
		get_header();
		echo '<main>';
		get_template_part('pages/'.$pagina );
		echo '</main>';
		get_footer();
	}
?>