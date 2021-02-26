<section id="sobre">
	<article>
		<div class="container">
			<?php  
				$args = array(
					'post_type'				 => 'sobre',
					'posts_per_page'         => 1,
				);
			
				$my_query = new WP_Query( $args );
			
				while($my_query->have_posts()) : $my_query->the_post(); 
			?>
			<div class="row">
				<div class="col-sm-4">
					<?php the_post_thumbnail('medium', array('class' => 'img-responsive')); ?>
				</div>
				<div class="col-sm-8">
					<h2><?php the_title(); ?></h2>
					<p><?php the_excerpt(); ?></p>
					<a class="primary-button" href="<?php echo WP_URL ?>/sobre">Veja mais</a>
				</div>
			</div>
			<?php endwhile; ?>
		</div>
	</article>
</section>