<div id="btn-mobile">
	<div class="btn-mobile-box">
		<div class="btn-mobile-inner"></div>
	</div>
</div>
<div id="menu-lateral">
	<div class="bg"></div>
	<div class="menu-lateral-inner">
		<div class="logo">
			<figure>
				<img class="img-responsive" src="<?php echo WP_TEMPLATE ?>/image/logo-branco-alpina.png">
			</figure>
		</div>
		<nav id="menu-mobile">
			<ul>
				<li>
					<a href="<?php echo WP_URL ?>/">
						Início
					</a>
				</li>
				<li>
					<a href="<?php echo WP_URL ?>/sobre">
						Sobre
					</a>
				</li>
				<li class="menu-down-mobile">
					<a href="#">
						Soluções
						<i class="fal fa-angle-down"></i>
					</a>
					<div class="submenu-mobile">
						<ul>
							<?php  
								$args = array(
									'post_type'				 => 'solucoes',
									'posts_per_page'         => -1,
								);
							
								$my_query = new WP_Query( $args );
								
								while($my_query->have_posts()) : $my_query->the_post(); 
								$titulo = get_the_title();
								$url_post = get_post_permalink();
							?>
								<li>
								<a href="<?php echo $url_post;?>">
									<div class="top">
										<div class="item">
											<?php echo $titulo; ?>
										</div>
									</div>
								</a>
								</li>
							<?php endwhile; ?>
						</ul>
					</div>
				</li>
				<li>
					<a href="<?php echo WP_URL ?>/cases">
						Cases
					</a>
				</li>
				<li>
					<a href="<?php echo WP_URL ?>/contato">
						Contato
					</a>
				</li>
			</ul>
		</nav>
		<div class="midias">
			<?php global $info; ?>
			<ul>
				<?php if ($info['facebook']): ?>
					<li>
						<a target="_blank" href="<?php echo $info['facebook'] ?>">
							<i class="fab fa-facebook-f"></i>
						</a>
					</li>
				<?php endif ?>
				<?php if ($info['instagram']): ?>
					<li>
						<a target="_blank" href="<?php echo $info['instagram'] ?>">
							<i class="fab fa-instagram"></i>
						</a>
					</li>
				<?php endif ?>
				<?php if ($info['linkedin']): ?>
					<li>
						<a target="_blank" href="<?php echo $info['linkedin'] ?>">
							<i class="fab fa-linkedin-in"></i>
						</a>
					</li>
				<?php endif ?>
				<?php if ($info['whatsapp']): ?>
					<li>
						<a target="_blank" href="https://api.whatsapp.com/send?phone=55<?php echo preg_replace('/\D/', '', $info['whatsapp']); ?>">
							<i class="fab fa-whatsapp"></i>
						</a>
					</li>
				<?php endif ?>
			</ul>
		</div>
	</div>
</div>