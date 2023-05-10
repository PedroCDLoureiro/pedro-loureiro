$(document).ready(function(){
    $('.data').mask('00/00/0000');
    $('.hora').mask('00:00');
    $('.data_hora').mask('00/00/0000 00:00');
    $('.cep').mask('00000-000');
    $('.cpf').mask('000.000.000-00', {
        reverse: true
    });
    $('.cnpj').mask('00.000.000/0000-00', {
        reverse: true
    });
    $('.dinheiro').mask("#.##0,00", {
        reverse: true
    });
    $('.porcentagem').mask('##0,00%', {
        reverse: true
    });
    $('.celular').mask('(00) 00000-0000');
    $('.telefone').mask('(00) 0000-0000');
    $('.telefone_celular').mask("(00) 0000-0000").focusout(function (event) {  
        var target, phone, element;  
        target = (event.currentTarget) ? event.currentTarget : event.srcElement;  
        phone = target.value.replace(/\D/g, '');
        element = $(target);  
        element.unmask();  
        if(phone.length > 10) {  
            element.mask('(00) 00000-000#');  
        } else {  
            element.mask('(00) 0000-0000#');  
        }  
    });
});