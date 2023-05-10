const sendeassinantes = ( formData ) => {
	formData.append('action', 'post_assinante');
	
	return $.ajax({
        url: info.site_url+"/wp-admin/admin-ajax.php",
        method: 'POST',
        data: formData,
        cache: false,
        contentType: false,
        processData: false
    });
}

$.fn.assinantes = function() {
	return this.bind('submit', ( event ) => {
		event.preventDefault();
		let formData = new FormData();
		let dados = this[0].elements;
		let erros 	= false;
		
		this.find('input[type=submit]').attr('disabled','disable');
		this.append('<i class="loader-spinner fas fa-circle-notch fa-spin"></i>');
		this.find('.mensagem').remove();
		
		$('.obrigatorio').remove();
		
		$.each(dados, (key, value) => {	
			if($.trim(value.value).length == 0){
				$(value).after('<p class="obrigatorio">Campo '+ $(value).attr('placeholder') +' obrigatório!</p>');
				erros = true;
			}else if(!value.validity.valid){
				$(value).after('<p class="obrigatorio">Campo '+ $(value).attr('placeholder') +' inválido!</p>');
				erros = true;
			}else{
				formData.append($(value).attr('placeholder'), $(value).val());
			}
		});
		
		if(erros){
			this.find('input[type=submit]').removeAttr('disabled');
			this.find('.loader-spinner').remove();
			return false;
		}else{
			try{
				sendeassinantes(formData).then((data) => {
					let resposta = JSON.parse( data );
					console.log(data);
					this.append('<p class="mensagem '+ resposta.codigo +'">'+ resposta.mensagem +'</p>');
					if( resposta.codigo == "sucesso" ){
						$.each(dados, (key, value) => {	
							if($(value).attr('type') != 'submit' && $(value).attr('type') != 'hidden'){
								$(value).val('');
							}
						});
					}
					this.find('input[type=submit]').removeAttr('disabled');
					this.find('.loader-spinner').remove();
				});
			} catch(e){
				console.log(e);
				this.find('input[type=submit]').removeAttr('disabled');
				this.find('.loader-spinner').remove();
			}
			return false;
		}
	});
}

$(document).ready(function() {
	$('#newsletter').assinantes();
});