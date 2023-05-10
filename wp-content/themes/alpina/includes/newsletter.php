<?php 
    //////////////////////////////////////////////////
    ############## newsletter__
    //////////////////////////////////////////////////
    add_action( 'init', 'newsletter__' );
    function newsletter__() {
        $labels = array(
            'name'              => __( 'Newsletter' ),
            'singular_name'     => __( 'Newsletter' ),        
        );
        $post = array(
            'labels'            => $labels,
            'supports'          => array('title', 'editor'),
            'capability_type'   => 'post',
            'public'            => true,
            'has_archive'       => false,        
        );
    
        register_post_type( 'newsletter__', $post);
    }

    //////////////////////////////////////////////////
    ############## assinantes__
    //////////////////////////////////////////////////
    
    add_action( 'init', 'assinantes__' );
    function assinantes__() {
        $labels = array(
            'name'              => __( 'Assinantes' ),
            'singular_name'     => __( 'Assinantes' ),        
        );
    
        $post = array(
            'labels'            => $labels,
            'supports'          => array('title'),
            'capability_type'   => 'post',
            'public'            => true,
            'has_archive'       => false,        
        );
    
        register_post_type( 'assinantes__', $post);
    }

    if( function_exists('acf_add_local_field_group') ):
        acf_add_local_field_group(array(
            'key' => 'group_assinantes',
            'title' => 'Email',
            'fields' => array(
                array(
                    'key' => 'field_email_assinante',
                    'label' => 'Email',
                    'name' => 'email',
                    'type' => 'text',
                    'formatting' => 'html',
                ),
            ),
            'location' => array(
                array(
                    array(
                        'param' => 'post_type',
                        'operator' => '==',
                        'value' => 'assinantes__',
                    ),
                ),
            ),
            'menu_order' => 0,
            'position' => 'normal',
            'style' => 'seamless',
            'label_placement' => 'top',
            'instruction_placement' => 'label',
            'active' => true,
        ));

        acf_add_local_field_group(array(
            'key' => 'group_newsletter',
            'title' => 'Email',
            'fields' => array(
                array(
                    'key' => 'field_assunto',
                    'label' => 'Assunto',
                    'name' => 'assunto',
                    'type' => 'text',
                    'formatting' => 'html',
                    'required' => 1,
                ),
                array(
                    'key' => 'field_emails',
                    'label' => 'Emails',
                    'name' => 'emails',
                    'type' => 'relationship',
                    'formatting' => 'html',
                    'post_type' => 'assinantes__',
                    'filters' => array('search'),
                    'elements' => array(),
                    'min' => 1,
                    'return_format' => 'object',
                ),
            ),
            'location' => array(
                array(
                    array(
                        'param' => 'post_type',
                        'operator' => '==',
                        'value' => 'newsletter__',
                    ),
                ),
            ),
            'menu_order' => 0,
            'position' => 'acf_after_title',
            'style' => 'seamless',
            'label_placement' => 'top',
            'instruction_placement' => 'label',
            'active' => true,
        ));
    endif;

    // modifica o content type do email pra html
    add_filter( 'wp_mail_content_type','wpse27856_set_content_type2' );
    function wpse27856_set_content_type2(){
        return "text/html";
    }

    // add função de email em ajax 
    add_action( 'wp_ajax_post_assinante', 'post_assinante' );
    add_action( 'wp_ajax_nopriv_post_assinante', 'post_assinante' );

    function post_assinante(){
        $post_atributes = array(
            'post_title' => $_POST['Nome'],
            'post_type' => 'assinantes__',
            'comment_status' => 'closed',
            'ping_status' => 'closed',
            'post_content' => '',
            'post_status' => 'private',
            'post_author' => 1,
            'menu_order' => 0
        );
        $resposta_post = wp_insert_post($post_atributes);

        if($resposta_post) {
            update_field('field_email_assinante', $_POST['E-mail'], $resposta_post);
        }
        if($resposta_post) {
            echo json_encode(array(
                'mensagem' => 'Cadastro realizado com sucesso',
                'codigo'   => 'sucesso',
                'post'   => $resposta_post,
            ));
        } else {
            echo json_encode(array(
                'mensagem' => 'Ocorreu problemas ao cadastrar.',
                'codigo'   => 'erro'
            ));
        }
        die();
    }

    // function FunctionName(){
    //     $conteudo = '<div style="border-top: 1px solid #ccc;">';
    //     foreach ($_POST as $key => $value) {
    //         if($key != 'para' && $key != '' && $key != 'action' && $key != 'assunto' && $key != 'undefined' && $key != 'arquivo' && $key != 'arquivo[]' && $key != 'arquivos' && $key != 'arquivos[]'){
    //             $conteudo .= '<div style="border: 1px solid #ccc; border-top: none; display: flex; flex-wrap: wrap;     align-items: center;">'.
    //                             '<div style="padding: 15px; border-right: 1px solid #ccc; width: 20%;"><strong>'.$key.'</strong></div>'.
    //                             '<div style="padding: 15px; flex: 1;">'.$value.'</div>'.
    //                         '</div>';
    //         }
    //     }
    //     $conteudo .= '</div>';

    //     $to      = $_POST['para'];
    //     $subject = $_POST['assunto'];
    //     $email = $_POST['Email'];

    //     $headers = 'From: '. $email . "\r\n" .
    //         'Reply-To: ' . $email . "\r\n";

    //     $resposta_email = wp_mail($to, $subject, $conteudo, $headers, $attachments);
    //     if($resposta_email) {
    //         echo json_encode(array(
    //             'mensagem' => 'Mensagem enviada com sucesso',
    //             'codigo'   => 'sucesso'
    //         ));
    //     } else {
    //         echo json_encode(array(
    //             'mensagem' => 'Ocorreu problemas ao enviar mensagem.',
    //             'codigo'   => 'erro'
    //         ));
    //     }
    // }
    add_action( 'save_post', 'check_news_newsletter', 10, 3 );
    function check_news_newsletter( $post_id, $post, $update) {
        if ($post->post_type == 'newsletter__') {
            if ($post->post_status == 'publish' && get_field('field_emails', $post->ID) && $post->post_content != '') {
                foreach (get_field('field_emails', $post->ID) as $key => $assinantes) {
                    $emails[] =  get_field('field_email_assinante', $assinantes->ID);
                }
                $subject =  get_field('field_assunto', $post->ID);
                $conteudo = $post->post_content;
                $headers = 'From: no-reply@site.com.br';
                $resposta_email = wp_mail($emails, $subject, $conteudo, $headers);
            }
            return $resposta_email;
        }
    }

    // add_action( 'transition_post_status', 'check_change_sta', 10, 3 );
    // function check_change_sta( $new, $old, $post ) {
    //     if (( $post->post_type == 'newsletter__' ) ) {
    //         if ( ( 'draft' === $old || 'auto-draft' === $old ) && $new === 'publish' ) {
                
    //         }
    //     }
    // }
?>