<?php
	get_header();
	echo "<main>";
	get_template_part('templates/content-banner');
	get_template_part('templates/content-solucoes');
	get_template_part('templates/content-alpinistas');
	get_template_part('templates/content-clientes');
	get_template_part('templates/content-contato');
	echo "</main>";
	get_footer();
?>