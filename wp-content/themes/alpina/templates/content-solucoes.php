<?php global $info; ?>
<section id="solucoes">
	<article>
		<div class="container">
			<div class="row">
				<div class="col-lg-4 col-12 titulo">
					<h2>SOLUÇÕES</h2>
				</div>
				<div class="col-lg-4 col-12 subtitulo">
					<h3>Nós queremos ser o seu parceiro estratégico. Saiba o que podemos fazer <b>pelo seu negócio!</b></h3>
				</div>
				<div class="col-lg-4 col-12 solicitar-proposta">
					<div class="botao">
						<a href="<?php echo $info['solicitar_proposta']; ?>">
							Solicitar proposta
							<img src="<?php echo WP_TEMPLATE?>/image/seta.svg">
						</a>
					</div>
					<div class="botao-mobile">
						<a href="<?php echo $info['solicitar_proposta']; ?>">
							Entrar em contato
							<img src="<?php echo WP_TEMPLATE?>/image/seta.svg">
						</a>
					</div>
				</div>
			</div>
			<div class="row row-cards">
				<?php  
					$args = array(
						'post_type'				 => 'solucoes',
						'posts_per_page'         => -1,
					);
				
					$my_query = new WP_Query( $args );
					
					while($my_query->have_posts()) : $my_query->the_post(); 
					$titulo = get_the_title();
					$url_post = get_post_permalink();
					$thumbnail = get_the_post_thumbnail();
					$conteudo = get_the_content();
				?>
				<div class="col-lg-6 col-12 card-solucao">
					<a href="<?php echo $url_post; ?>">
						<div class="conteudo">
							<div class="botao">
								<img src="<?php echo WP_TEMPLATE?>/image/seta.svg">
							</div>
							<div class="icone">
								<figure>
									<?php echo $thumbnail; ?>
								</figure>
							</div>
							<h2><?php echo $titulo; ?></h2>
							<p><?php echo $conteudo; ?></p>
						</div>
					</a>
				</div>
				<?php endwhile; ?>
			</div>
		</div>
	</article>
</section>