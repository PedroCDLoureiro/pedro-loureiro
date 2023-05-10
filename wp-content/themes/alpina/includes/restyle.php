<?php 
    // Define as variaveis
    DEFINE('WP_URL', get_bloginfo('url'));
    DEFINE('WP_NAME', get_bloginfo('name'));
    DEFINE('WP_TEMPLATE', get_bloginfo('template_url'));
    DEFINE('WP_DESCRIPTION', get_bloginfo('description'));

    // remove opções do admin
    remove_action( 'wp_head', 'rsd_link' );
    remove_action( 'wp_head', 'wlwmanifest_link' );
    remove_action( 'wp_head', 'wp_generator' );
    add_filter('show_admin_bar', '__return_false');
    add_action('admin_menu','wp_hide_msg');
    function wp_hide_msg() {
        remove_action( 'admin_notices', 'update_nag', 3 );
    }
    add_action( 'admin_menu', 'custom_menu_page_removing' );
    function custom_menu_page_removing() {
        $current_user_ = wp_get_current_user();
        remove_menu_page( 'edit-comments.php' );
        remove_menu_page( 'edit.php' );
    }

    // add thumbnail para custom posts
    add_theme_support( 'post-thumbnails' );

    // add favicon no no admin e login
    add_action( 'admin_head', 'favicon4admin' );
    add_action( 'login_head', 'favicon4admin' );
    function favicon4admin() {
        echo '<link rel="Shortcut Icon" type="image/x-icon" href="' . get_bloginfo('template_directory') . '/image/favicon.png" />';
    }

    // add jqueri no admin
    add_action('admin_enqueue_scripts', 'varScript');
    if(is_admin()) {
        wp_enqueue_script('jquery-ui', get_template_directory_uri().'/admin/jquery-ui.min.js');
        wp_enqueue_style('jquery-ui-custom', get_template_directory_uri().'/admin/jquery-ui.min.css');
    }

    // troca logo do wp
    add_action('wp_before_admin_bar_render', 'rebranding_wordpress_logo' );
    function rebranding_wordpress_logo(){
        global $wp_admin_bar;
        //Remove o submeu padrão
        $wp_admin_bar->remove_menu('about');
        $wp_admin_bar->remove_menu('documentation');
        $wp_admin_bar->remove_menu('support-forums');
        $wp_admin_bar->remove_menu('feedback');
        $wp_admin_bar->remove_menu('wporg');
        //Altera a logo do wp
        $wp_admin_bar->add_menu(array(
            'id'    => 'wp-logo',
            'title' => '<img src="'.get_bloginfo('template_directory').'/admin/image/admin_logo.png" />',
            'href'  => __('http://www.alpina.digital'),
            'meta'  => array(
                'title' => __('Site'),
            ),
        ));
    }

    // habilita mais botões
    add_filter("mce_buttons", "enable_more_buttons");
    function enable_more_buttons($buttons) {
      $buttons[] = 'hr';
      $buttons[] = 'sup';

      return $buttons;
    }

    // add SUPORTE BOX
    add_action('wp_dashboard_setup', 'add_dashboard_widgets' );
    function add_dashboard_widgets() {
        wp_add_dashboard_widget('dashboard_suporte', 'Precisa de Ajuda?', 'dashboard_widget_function');
    }
    function dashboard_widget_function( $post, $callback_args ) {
        echo "Site";
    }

    // troca a footer do admin
    add_filter('admin_footer_text', 'alterar_footer');
    function alterar_footer (){
        echo '<span id="footer-thankyou">Desenvolvido por</span>';
    }

    // troca página do login
    add_action('login_enqueue_scripts', 'cutom_login_logo');
    function cutom_login_logo() {
        echo "<style type=\"text/css\">
                body.login div#login h1 a {
                background-image: url(" . get_bloginfo('template_directory') . "/admin/image/logo.png);
                width: 274px;
                background-size: 274px 63px;
            }</style>";
    }
    add_action('login_head', 'my_login_css');
    add_action('admin_enqueue_scripts', 'my_login_css');
    function my_login_css() {
        echo '<link rel="stylesheet" type="text/css" href="' . get_bloginfo('template_directory').'/admin/login.css">';
    }

    // ativa plugins
    run_activate_plugin( 'advanced-custom-fields/acf.php' );
    run_activate_plugin( 'acf-repeater/acf-repeater.php' );
    run_activate_plugin( 'adminimize/adminimize.php' );
    run_activate_plugin( 'tw-pagination/tw-pagination.php' );
    // run_activate_plugin( 'wp-mail-smtp/wp-mail-smtp.php' );
    run_activate_plugin( 'post-types-order/post-types-order.php' );
    function run_activate_plugin( $plugin ) {
        $current = get_option( 'active_plugins' );
        $plugin = plugin_basename( trim( $plugin ) );
        if ( !in_array( $plugin, $current ) ) {
            $current[] = $plugin;
            sort( $current );
            do_action( 'activate_plugin', trim( $plugin ) );
            update_option( 'active_plugins', $current );
            do_action( 'activate_' . trim( $plugin ) );
            do_action( 'activated_plugin', trim( $plugin) );
        }
        return null;
    }

    // Conta os views do post
    add_action( 'init', 'custom_session_start' );
    function custom_session_start() {
        if ( ! session_id() ) session_start();
    }
    add_action( 'get_header', 'custom_count_post_views' );
    function custom_count_post_views () {   
        if ( is_single() ) {
            global $post;
            if ( empty( $_SESSION[ 'custom_post_counter_' . $post->ID ] ) ) {
                $_SESSION[ 'custom_post_counter_' . $post->ID ] = true;
                $key = 'number_of_views';
                $key_value = get_post_meta( $post->ID, $key, true );
                if ( empty( $key_value ) ) {
                    $key_value = 1;
                    update_post_meta( $post->ID, $key, $key_value );
                } else {
                    $key_value += 1;
                    update_post_meta( $post->ID, $key, $key_value );
                }                    
            }
        }
        return;
    }

    // limita o conteudo 
    function conteudo($max=200){
        $content = get_the_content();
        $content = strip_shortcodes($content); 
        $content = preg_replace("/<img[^>]+\>/i", "", $content);     
        $content = apply_filters('the_content', $content);
        $content = strip_tags($content);
        $cont    = $content;
        $tok     = strtok($content,' ');
        $content = '';
        while($tok!==false && mb_strlen($content)<$max){
            if (mb_strlen($content)+mb_strlen($tok)<=$max){
                $content.=$tok.' ';
            }else{
                break;
            }
            $tok=strtok(' ');
        }
        if (mb_strlen(trim($cont)) > mb_strlen(trim($content))) {
            return trim($content).'[...]';
        }else{
            return trim($content);
        }
    }
?>