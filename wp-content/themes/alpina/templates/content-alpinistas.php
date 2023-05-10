<?php global $info; ?>
<section id="alpinistas">
	<article>
		<div class="container">
			<?php  
				$args = array(
					'post_type'				 => 'alpinistas',
					'posts_per_page'         => 1,
				);
			
				$my_query = new WP_Query( $args );
				
				while($my_query->have_posts()) : $my_query->the_post(); 
				$titulo_principal = get_field('titulo_principal');
				$titulo_secundario = get_field('titulo_secundario');
				$texto_principal = get_field('texto_principal');
				$texto_secundario = get_field('texto_secundario');
				$imagem_principal = get_field('imagem_principal');
				$imagem_secundaria = get_field('imagem_secundaria');
				$selo = get_field('selo');
				$texto_botao = get_field('texto_botao');
				$link_botao = get_field('link_botao');
			?>
			<div class="row principal">
				<div class="col-md-6 col-12 div-imagem">
					<figure>
						<img src="<?php echo $imagem_principal; ?>" class="img-responsive">
					</figure>
					<?php if($selo):?>
						<div class="selo">
							<figure>
								<img src="<?php echo $selo; ?>" class="img-responsive">
							</figure>
						</div>
					<?php endif ?>
				</div>
				<div class="col-md-6 col-12 div-conteudo-principal">
					<div class="titulo-principal">
						<h2><?php echo $titulo_principal; ?></h2>
					</div>
					<div class="conteudo">
						<?php echo $texto_principal; ?>
					</div>
				</div>
			</div>
			<div class="row secundario">
				<div class="col-md-6 col-12 div-conteudo-secundario">
					<div class="titulo-secundario">
						<h2><?php echo $titulo_secundario; ?></h2>
					</div>
					<div class="conteudo">
						<?php echo $texto_secundario; ?>
					</div>
					<?php if($texto_botao):?>
						<div class="botao">
							<a href="<?php echo $link_botao;?>" class="primary-button"><?php echo $texto_botao;?></a>
						</div>
					<?php endif ?>
				</div>
				<div class="col-md-6 col-12 div-imagem">
					<figure>
						<img src="<?php echo $imagem_secundaria; ?>" class="img-responsive">
					</figure>
				</div>
			</div>
			<?php endwhile; ?>
		</div>
	</article>
</section>