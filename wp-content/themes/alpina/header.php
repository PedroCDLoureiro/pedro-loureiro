<!DOCTYPE html>
<html>
<head>
	<?php wp_head(); ?>
	<meta charset="utf-8">
	<?php the_css_config(); ?>
	<link rel="stylesheet" type="text/css" href="<?php echo WP_TEMPLATE ?>/style.css">
	<link rel="shortcut icon" type="image/png" href="<?php echo WP_TEMPLATE ?>/image/favicon.png">
	<meta name="robots" content="index, follow">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="theme-color" content="<?php echo get_css_config()['--primarycolor'] ?>">
	<meta name="msapplication-navbutton-color" content="<?php echo get_css_config()['--primarycolor'] ?>">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-status-bar-style" content="<?php echo get_css_config()['--primarycolor'] ?>">
	<title>Alpina Digital - Criação de Sites, E-commerces e Mkt Digital de Performance</title>
</head>
<body>
<div class="body-wrapper">
<?php global $info; ?>
<script>var info = <?php echo json_encode($info); ?>;</script>
<?php if (is_home()): ?>
	<h1 style="display: none !important;">
		<?php echo WP_NAME; ?>
	</h1>
<?php endif ?>
<header>
	<div class="wrapper header-wrapper">
		<div class="logo">
			<a href="<?php echo WP_URL ?>/">
				<img class="img-responsive" src="<?php echo WP_TEMPLATE ?>/image/logo-branco-alpina.png">
			</a>
		</div>
		<nav id="menu-desktop">
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
				<li class="menu-down">
					<a href="#">
						Soluções
						<i class="fal fa-angle-down"></i>
					</a>
					<div class="submenu">
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
								$thumbnail = get_the_post_thumbnail();
								$conteudo = get_the_content();
							?>
								<li>
								<a href="<?php echo $url_post;?>">
									<div class="top">
										<div class="item">
											<figure>
												<?php echo $thumbnail; ?>
											</figure>
											<?php echo $titulo; ?>
										</div>
										<div class="botao">
											<img src="<?php echo WP_TEMPLATE?>/image/seta.svg">
										</div>
									</div>
									<p><?php echo $conteudo; ?></p>
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
		<div class="proposta">
			<div class="idioma">
				<span>PT <i class="fal fa-angle-down"></i></span>
			</div>
			<div class="btn-proposta">
				<a href="<?php echo $info['solicitar_proposta']; ?>" class="primary-button">Solicitar proposta</a>
			</div>
		</div>
	</div>
	<?php get_template_part('templates/content-menu-lateral'); ?>
</header>