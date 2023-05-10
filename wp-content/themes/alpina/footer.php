<?php wp_footer(); ?>
<?php global $info; ?>
<footer>
	<div class="container">
		<div class="top-footer">
			<div class="row">
				<div class="col-md-2 col-12 logo">
					<a href="<?php echo WP_URL;?>">
						<img src="<?php echo WP_TEMPLATE; ?>/image/logo-footer.png" alt="Alpina Digital">
					</a>
				</div>
				<div class="col-md-6 offset-md-4 col-12 midias">
					<ul>
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
									<i class="fab fa-linkedin"></i>
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
						<?php if ($info['youtube']): ?>
							<li>
								<a target="_blank" href="<?php echo $info['youtube'] ?>">
									<i class="fab fa-youtube"></i>
								</a>
							</li>
						<?php endif ?>
					</ul>
				</div>
			</div>
		</div>
		<div class="itens-footer">
			<div class="row">
				<div class="col-lg-2 col-6 navegacao">
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
						<li>
							<a href="<?php echo WP_URL ?>/solucoes">
								Soluções
							</a>
						</li>
						<li>
							<a href="<?php echo WP_URL ?>/tecnologia">
								Tecnologia
							</a>
						</li>
						<li>
							<a href="<?php echo WP_URL ?>/marketing-digital">
								Marketing Digital
							</a>
						</li>
						<li>
							<a href="<?php echo WP_URL ?>/cases">
								Cases
							</a>
						</li>
						<li>
							<a href="<?php echo WP_URL ?>/aprenda">
								Aprenda
							</a>
						</li>
						<li>
							<a href="<?php echo WP_URL ?>/contato">
								Contato
							</a>
						</li>
					</ul>
				</div>
				<div class="col-lg-2 col-6 navegacao">
					<ul>
						<li>
							<a href="<?php echo WP_URL ?>/suporte">
								Suporte
							</a>
						</li>
						<li>
							<a href="<?php echo WP_URL ?>/chamados">
								Chamados
							</a>
						</li>
						<li>
							<a href="mailto:<?php echo $info['email'] ?>">
								E-mail
							</a>
						</li>
						<li>
							<a href="<?php echo WP_URL ?>/chat-online">
								Chat Online
							</a>
						</li>
					</ul>
				</div>
				<div class="col-lg-3 col-md-6 col-12 atendimento">
					<h5>Atendimento</h5>
					<ul>
						<?php if ($info['whatsapp']): ?>
							<li>
								<a target="_blank" href="https://api.whatsapp.com/send?phone=55<?php echo preg_replace('/\D/', '', $info['whatsapp']); ?>">
									<i class="fab fa-whatsapp" style="font-family: 'Font Awesome 5 Brands'"></i>
									<?php echo $info['whatsapp']; ?>
								</a>
							</li>
						<?php endif ?>
						<?php if ($info['telefone']): ?>
							<li>
								<a href="tel:<?php echo $info['telefone']; ?>" target="_blank">
									<i class="fal fa-phone-alt"></i> <?php echo $info['telefone']; ?>
								</a>
							</li>
						<?php endif ?>
					</ul>
				</div>
				<div class="col-lg-5 col-md-6 col-12 newsletter">
					<h5>ALP NEWS</h5>
					<span>Assine nossa newsletter e receba insights sobre Tecnologia, Marketing e Negócios</span>
					<form id="form-newsletter">
						<input type="email" required="require" name="email" placeholder="E-mail">
						<button type="submit" class="submit-button">Quero receber os insights</button>
					</form>
				</div>
			</div>
		</div>
		<div class="bottom-footer">
			<div class="row">
				<div class="col-md-6 col-12">
					<p>Encarregado dos Dados</p>
					<p>Fabrício Raimondi</p>
					<p>privacidade@alpina.digital</p>
				</div>
				<div class="col-md-6 col-12 links">
					<a href="<?php echo WP_URL;?>/termos-de-uso">Termos de uso</a>
					<a href="<?php echo WP_URL;?>/politica-de-privacidade">Política de privacidade</a>
				</div>
			</div>
		</div>
	</div>
</footer>
<div class="script">
	<script type="text/javascript" src="<?php echo WP_TEMPLATE; ?>/bower_components/jquery/dist/jquery.min.js"></script>
	<script type="text/javascript" src="<?php echo WP_TEMPLATE; ?>/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="<?php echo WP_TEMPLATE; ?>/bower_components/font-awesome/js/fontawesome.min.js"></script>
	<script type="text/javascript" src="<?php echo WP_TEMPLATE; ?>/bower_components/lightgallery/dist/js/lightgallery.min.js"></script>
	<script type="text/javascript" src="<?php echo WP_TEMPLATE; ?>/bower_components/jquery-mask-plugin/dist/jquery.mask.min.js"></script>
	<script type="text/javascript" src="<?php echo WP_TEMPLATE; ?>/bower_components/slick-carousel/slick/slick.min.js"></script>
	<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCxZR4RVhKHJjgslQJN5sBZJWe9DdcdOT0&libraries=places"></script>
	<script src="https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js"></script>
	<script type="text/javascript" src="<?php echo WP_TEMPLATE; ?>/script.min.js"></script>
</div>
</div>
</body>
</html>