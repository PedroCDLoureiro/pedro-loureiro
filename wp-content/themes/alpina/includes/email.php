<?php 
    //////////////////////////////////////////////////
    ############## emails__
    //////////////////////////////////////////////////
    add_action( 'init', 'emails__' );
    function emails__() {
        $labels = array(
            'name'             => __( 'Emails' ),
            'singular_name' => __( 'Emails' ),        
        );
        $post = array(
            'labels'             => $labels,
            'supports'             => array('title', 'editor'),
            'capability_type'    => 'post',
            'public'             => true,
            'has_archive'         => false,        
        );
    
        register_post_type( 'emails__', $post);
    }

    // modifica o content type do email pra html
    add_filter( 'wp_mail_content_type','wpse27856_set_content_type' );
    function wpse27856_set_content_type(){
        return "text/html";
    }

    // add função de email em ajax 
    add_action( 'wp_ajax_send_email', 'post_email' );
    add_action( 'wp_ajax_nopriv_send_email', 'post_email' );
    function post_email(){
        $error      = array();
        $arquivos   = array();
        if(isset($_FILES)){
            foreach ($_FILES as $key => $file) {
                foreach ($file['name'] as $key2 => $arquivo_name) {
                    if ($arquivo_name) {
                        $arquivos[$arquivo_name]['file_name'] = $_FILES[$key]['name'][$key2];
                        $arquivos[$arquivo_name]['file_size'] = $_FILES[$key]['size'][$key2];
                        $arquivos[$arquivo_name]['file_tmp'] = $_FILES[$key]['tmp_name'][$key2];
                        $arquivos[$arquivo_name]['file_ext'] = strtolower(end(explode('.',$_FILES[$key]['name'][$key2])));
                         
                        $expensions= array("jpeg","jpg","png","pdf");
                         
                        if(in_array($arquivos[$arquivo_name]['file_ext'], $expensions) === false){
                           $error = "Tipo de arquivo não permitido";
                        }
                         
                        if($arquivos[$arquivo_name]['file_size'] > 2097152) {
                           $error = 'Arquivo deve ser menor que 2MB';
                        }
                        
                        if(empty($error)) {
                            move_uploaded_file($arquivos[$arquivo_name]['file_tmp'], WP_CONTENT_DIR . '/uploads/'.$arquivo_name);
                        }else{
                            return json_encode(array(
                                'mensagem'  => $error,
                                'status'    => 'erro',
                            ));
                        }
                    }
                }
            }
        }
        
        $conteudo = '<div style="border-top: 1px solid #ccc;">';
        foreach ($_POST as $key => $value) {
            if($key != 'para' && $key != '' && $key != 'action' && $key != 'assunto' && $key != 'undefined' && $key != 'arquivo' && $key != 'arquivo[]' && $key != 'arquivos' && $key != 'arquivos[]'){
                $conteudo .= '<div style="border: 1px solid #ccc; border-top: none; display: flex; flex-wrap: wrap;     align-items: center;">'.
                                '<div style="padding: 15px; border-right: 1px solid #ccc; width: 20%;"><strong>'.str_replace('_', ' ', $key).'</strong></div>'.
                                '<div style="padding: 15px; flex: 1;">'.$value.'</div>'.
                            '</div>';
            }
        }
        $conteudo .= '</div>';

        $to      = $_POST['para'];
        $subject = $_POST['assunto'];
        $email = $_POST['E-mail'];

        $headers = 'From: '. $email . "\r\n" .
            'Reply-To: ' . $email . "\r\n";

        $conteudo_com_imagens =  $conteudo;
        foreach ($arquivos as $key => $arquivo) {
            $attachments[] = WP_CONTENT_DIR . '/uploads/'.$arquivo['file_name'];
            $conteudo_com_imagens .= '<a href="'.WP_URL. '/wp-content/uploads/'.$arquivo['file_name'].'">'.$arquivo['file_name'].'</a><br>';
        }


        $post_atributes = array(
            'post_title' => $subject .' - '. $email,
            'post_type' => 'emails__',
            'comment_status' => 'closed',
            'ping_status' => 'closed',
            'post_content' => $conteudo_com_imagens,
            'post_status' => 'private',
            'post_author' => 1,
            'menu_order' => 0
        );
        $resposta_post = wp_insert_post($post_atributes);

        $resposta_email = wp_mail($to, $subject, $conteudo, $headers, $attachments);

        if($resposta_email) {
            echo json_encode(array(
                'mensagem' => 'Mensagem enviada com sucesso',
                'codigo'   => 'sucesso'
            ));
        } else {
            echo json_encode(array(
                'mensagem' => 'Ocorreu problemas ao enviar mensagem.',
                'codigo'   => 'erro'
            ));
        }
        die();
    }
?>