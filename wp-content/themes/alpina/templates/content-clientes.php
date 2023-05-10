<section id="clientes">	
	<article>
		<div class="texto">
			<span>Não é sobre chegar ao topo,<br>é sobre como e <strong>com quem você chega lá.</strong></span>
		</div>
		<div class="wrapper slider-clientes">
			<?php  
				$args = array(
					'post_type'				 => 'clientes',
					'posts_per_page'         => -1,
				);
			
				$my_query = new WP_Query( $args );
			
				while($my_query->have_posts()) : $my_query->the_post();
				$nome_cliente = get_the_title();
				$thumb_cliente = get_the_post_thumbnail_url();
				$url_cliente = get_field('url_cliente');
			?>
			<div class="item">
				<a href="<?php echo $url_cliente;?>" target="_blank">
					<img src="<?php echo $thumb_cliente; ?>" alt="<?php echo $nome_cliente; ?>">
				</a>
			</div>
			<?php endwhile; ?>
		</div>
	</article>
</section>