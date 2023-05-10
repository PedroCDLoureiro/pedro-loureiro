<?php
if($_SERVER['REQUEST_METHOD'] == "POST"){
    include 'mail/PHPMailerAutoload.php';

    $error          = array();
    $arquivos       = array();

    if(isset($_FILES['arquivo'])){
        foreach ($_FILES['arquivo']['name'] as $key => $arquivo_name) {
            if ($arquivo_name) {
                $arquivos[$arquivo_name]['file_name'] = $_FILES['arquivo']['name'][$key];
                $arquivos[$arquivo_name]['file_size'] = $_FILES['arquivo']['size'][$key];
                $arquivos[$arquivo_name]['file_tmp'] = $_FILES['arquivo']['tmp_name'][$key];
                $arquivos[$arquivo_name]['file_ext'] = strtolower(end(explode('.',$_FILES['arquivo']['name'][$key])));
                 
                $expensions= array("jpeg","jpg","png","pdf");
                 
                if(in_array($arquivos[$arquivo_name]['file_ext'], $expensions) === false){
                   $error[] = "Tipo de arquivo não permitido";
                }
                 
                if($arquivos[$arquivo_name]['file_size'] > 2097152) {
                   $error[] = 'Arquivo deve ser menor que 2MB';
                }
                
                if(empty($error)) {
                    move_uploaded_file($arquivos[$arquivo_name]['file_tmp'], "uploads/".$arquivo_name);
                }else{
                    return json_encode(array(
                        'erros'     => $error,
                        'status'    => 'erro',
                    ));
                }
            }
        }
    }
    // echo json_encode(array(
    //     'mensagem' => $_POST,
    //     'codigo'   => 'sucesso'
    // ));
    // return false;
    
    $conteudo = '<div style="border-top: 1px solid #ccc;">';
    foreach ($_POST as $key => $value) {
        if($key != 'para' && $key != '' && $key != 'assunto' && $key != 'undefined' && $key != 'arquivo' && $key != 'arquivo[]' && $key != 'arquivos' && $key != 'arquivos[]'){
            $conteudo .= '<div style="border: 1px solid #ccc; border-top: none; display: flex; flex-wrap: wrap;     align-items: center;">'.
                            '<div style="padding: 15px; border-right: 1px solid #ccc; width: 20%;"><strong>'.$value['label'].'</strong></div>'.
                            '<div style="padding: 15px; flex: 1;">'.$value['value'].'</div>'.
                        '</div>';
        }
    }
    $conteudo .= '</div>';

    $mail           = new PHPMailer;
    $mail->isSMTP();
    $mail->isHTML(true);
    $mail->CharSet  = 'UTF-8';
    $mail->Host     = 'mail.site.com.br';
    $mail->SMTPAuth = true;
    $mail->Username = 'site@site.com.br';
    $mail->Password = '#site#';
    $mail->Port     = 587;
    $mail->setFrom($_POST['email']['value'], $_POST['nome']['value']);
    $mail->addAddress($_POST['para']['value'], '');
    foreach ($arquivos as $key => $arquivo) {
        $mail->addAttachment("uploads/".$arquivo['file_name']);
    }
    $mail->Subject = $_POST['assunto']['value'];
    $mail->Body    = $conteudo;

    // Gather post data.
    $post_email = array(
        'post_title'    => $_POST['email']['value'],
        'post_content'  => $conteudo,
        'post_status'   => 'publish',
        'post_type'     => 'emails__',
    );
     
    // Insert the post into the database.
    $post_return = wp_insert_post(array('post_title'=>'random', 'post_type'=>'custom_post', 'post_content'=>'demo text'));
    echo $post_return;
    echo json_encode(array(
        'mensagem' => 'Ocorreu problemas ao enviar mensagem.',
        'codigo'   => 'erro'
    ));
    return false;

    $mail->send();
    if(!$mail->send()) {
        echo json_encode(array(
            'mensagem' => 'Ocorreu problemas ao enviar mensagem.',
            'codigo'   => 'erro'
        ));
        return false;
    } else {

        echo json_encode(array(
            'mensagem' => 'Mensagem enviada com sucesso',
            'codigo'   => 'sucesso'
        ));
        return false;
    }
}
?>