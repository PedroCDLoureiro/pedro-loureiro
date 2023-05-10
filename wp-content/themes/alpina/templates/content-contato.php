<?php global $info; ?>
<section id="contato">	
	<article>
		<div class="container">
			<div class="row">
				<div class="col-lg-6 col-12 div-contato">
					<h2>Já pensou em fazer parte do <strong>nosso time de Alpinistas?</strong></h2>
					<form id="form">
						<input type="hidden" name="para" placeholder="para" value="<?php echo $info['email']; ?>">
						<input type="hidden" name="assunto" placeholder="assunto" value="Formulário de contato">
						<label for="">Nome</label>
						<input type="text" required="require" name="nome" placeholder="Seu nome completo">
						<label for="">E-mail</label>
						<input type="email" required="require" name="email" placeholder="E-mail">
						<label for="">Telefone</label>
						<input type="text" required="require" name="telefone" placeholder="Telefone" class="celular">
						<label for="">Mensagem</label>
						<textarea required="require" name="mensagem" rows="8" placeholder="Mensagem"></textarea>
						<label class="file-button" for="arquivos">
							Anexar currículo 
							<img src="<?php echo WP_TEMPLATE?>/image/seta.svg">
						</label>
						<input id="arquivos" required="require" type="file" name="arquivos[]" multiple placeholder="Arquivos">
						<input class="submit-button" type="submit" value="Quero ser um alpinista">
					</form>
				</div>
			</div>
		</div>
	</article>
</section>