<?php get_header(); ?>
<?php while (have_posts()) : the_post(); ?>
<section>
	<article class="single">
		<div class="wrapper">
			<h1 class="text-center title">
				<?php the_title(); ?>
			</h1>
		</div>
		<div class="container">
			<div class="row">
				<div class="col-md-6 offset-md-3 col-sm-12 col-12 text-center">
					<?php the_post_thumbnail(full, array('class' => 'img-responsive')); ?>
				</div>
				<div class="col-md-12 col-sm-12 col-12">
					<?php the_content(); ?>
				</div>
			</div>
		</div>
	</article>
</section>
<?php endwhile; ?>
<?php get_footer(); ?>