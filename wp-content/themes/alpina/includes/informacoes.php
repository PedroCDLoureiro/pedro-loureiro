<?php 
    //////////////////////////////////////////////////
    ############## info
    //////////////////////////////////////////////////
    
    add_action( 'init', 'info' );
    function info() {
        $labels = array(
            'name'              => __( 'Informações' ),
            'singular_name'     => __( 'Informações' ),        
        );
    
        $post = array(
            'labels'                => $labels,
            'supports'              => array('title'),
            'capability_type'       => 'post',
            'public'                => true,
            'has_archive'           => false,        
        );
    
        register_post_type( 'info', $post);
    }

    function get_info(){
        $query_info = new WP_Query(array('post_type'=> 'info','posts_per_page'=> 1));
        global $info;
        $info = [];
        while($query_info->have_posts()):
            $query_info->the_post();
            $info['telefone']           = get_field('telefone');
            $info['whatsapp']           = get_field('whatsapp');
            $info['instagram']          = get_field('instagram');
            $info['youtube']            = get_field('youtube');
            $info['linkedin']           = get_field('linkedin');
            $info['email']              = get_field('email');
            $info['solicitar_proposta'] = get_field('solicitar_proposta');
            $info['title']              = get_bloginfo('name');
            $info['site_url']           = get_bloginfo('url');
            $info['template_url']       = get_bloginfo('template_url');
        endwhile;
        wp_reset_query();
        return $info;
    }

    get_info();

    if( function_exists('acf_add_local_field_group') ):
        acf_add_local_field_group(array(
            'key' => 'group_info',
            'title' => 'Informações',
            'fields' => array(
                array(
                    'key' => 'field_info_telefone',
                    'label' => 'Telefone',
                    'name' => 'telefone',
                    'type' => 'text',
                    'formatting' => 'html',
                ),
                array(
                    'key' => 'field_info_whatsapp',
                    'label' => 'Whatsapp',
                    'name' => 'whatsapp',
                    'type' => 'text',
                    'formatting' => 'html',
                ),
                array(
                    'key' => 'field_info_instagram',
                    'label' => 'Instagram',
                    'name' => 'instagram',
                    'type' => 'text',
                    'formatting' => 'html',
                ),
                array(
                    'key' => 'field_info_youtube',
                    'label' => 'Youtube',
                    'name' => 'youtube',
                    'type' => 'text',
                    'formatting' => 'html',
                ),
                array (
                    'key' => 'field_info_linkedin',
                    'label' => 'Linkedin',
                    'name' => 'linkedin',
                    'type' => 'text',
                ),
                array(
                    'key' => 'field_info_email',
                    'label' => 'Email',
                    'name' => 'email',
                    'type' => 'text',
                    'formatting' => 'html',
                ),
                array(
                    'key' => 'field_info_solicitar_proposta',
                    'label' => 'Solicitar proposta',
                    'name' => 'solicitar_proposta',
                    'type' => 'text',
                    'formatting' => 'html',
                ),
            ),
            'location' => array(
                array(
                    array(
                        'param' => 'post_type',
                        'operator' => '==',
                        'value' => 'info',
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
    endif;
?>