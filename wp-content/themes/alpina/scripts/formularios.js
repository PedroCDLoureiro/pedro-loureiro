const sendemail = ( formData ) => {
	formData.append('action', 'send_email');
	
	return $.ajax({
        url: info.site_url+"/wp-admin/admin-ajax.php",
        method: 'POST',
        data: formData,
        cache: false,
        contentType: false,
        processData: false
    });
}

$.fn.email = function() {
	return this.bind('submit', ( event ) => {
		event.preventDefault();
		var formData = new FormData();
		let dados = this[0].elements;
		let erros 	= false;
		
		this.find('input[type=submit]').attr('disabled','disable');
		this.append('<div class="div-spinner"><i class="loader-spinner fas fa-circle-notch fa-spin"></i></div>');
		this.find('.mensagem').remove();
		$('.obrigatorio').remove();
		
		let checkboxes = {};
		$.each(dados, (key, value) => {	
			if(!value.validity.valid){
				$(value).after('<p class="obrigatorio">Campo '+ $(value).attr('placeholder') +' inválido!</p>');
				erros = true;
			}else{
				if ($(value).attr('type') == 'file') {
					for (var i = 0; i < $(value)[0].files.length; i++) {
						formData.append('arquivos[]', $(value)[0].files[i]); 
					}
				}else if ($(value).attr('type') == 'checkbox') {
					if ($(value).is(':checked')) {
						if (checkboxes[$(value).attr('placeholder')] == undefined || checkboxes[$(value).attr('placeholder')] == '') {
							checkboxes[$(value).attr('placeholder')] = $(value).val();
						}else{
							checkboxes[$(value).attr('placeholder')] += ', ' + $(value).val();
						}
					}
				}else if ($(value).attr('type') == 'radio') {
					if ($(value).is(':checked')) {
						formData.append($(value).attr('placeholder'), $(value).val());
					}
				}else{
					formData.append($(value).attr('placeholder'), $(value).val());
				}
			}
		});
		$.each(checkboxes, (key, value) => {	
			formData.append(key, value);
		});
		if(erros){
			this.find('input[type=submit]').removeAttr('disabled');
			this.find('.loader-spinner').remove();
			return false;
		}else{
			try{
				sendemail(formData).then((data) => {
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
	$('#form').email();
	$('#form-newsletter').email();
});