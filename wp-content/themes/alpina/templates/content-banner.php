<section id="banner">	
	<article>
		<div class="wrapper wrapper-slider">
			<?php  
				$args = array(
					'post_type'				 => 'slider',
					'posts_per_page'         => -1,
				);
			
				$my_query = new WP_Query( $args );
			
				while($my_query->have_posts()) : $my_query->the_post(); 
			?>
				<div class="item">
					<div class="container container-banner">
						<div class="row row-banner">
							<div class="col-md-6 col-12 content-slider">
								<div class="content">
									<div class="titulo">
										<?php the_content();?>
									</div>
									<div class="subtitulo">
										<?php the_field('subtitulo');?>
									</div>
									<div class="botao">
										<a href="<?php the_field('link_do_botao');?>">
											<?php the_field('texto_do_botao');?>
											<img src="<?php echo WP_TEMPLATE?>/image/seta.svg">
										</a>
									</div>
								</div>
							</div>
							<div class="col-12 div-imagem">
								<img src="<?php the_post_thumbnail_url(); ?>" class="img-responsive">
							</div>
						</div>
					</div>
					<div class="img-slider">
						<img src="<?php the_post_thumbnail_url(); ?>" alt="">
					</div>
				</div>
			<?php endwhile; ?>
		</div>
	</article>
</section>