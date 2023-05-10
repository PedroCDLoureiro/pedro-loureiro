<?php
	function conteudo_for_metatag($content='', $max=100){
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

	add_action('wp_head', 'fb_opengraph', 5); 
	function fb_opengraph() {
	    global $post;
	    $img_src =  WP_TEMPLATE . '/image/logo-branco-alpina.png.png';
	    $excerpt = get_bloginfo('description');
	    $url = WP_URL;
	    $titulo = get_bloginfo('name');
	    if(is_single()) {
	        if(has_post_thumbnail($post->ID)) {
	            $img_src = wp_get_attachment_image_src(get_post_thumbnail_id( $post->ID ), 'full')[0];
	        }
	        $conteudo = conteudo_for_metatag($post->post_content);
	        if($conteudo != '') {
	            $excerpt = $conteudo;
	        }
	    	$titulo = get_the_title();
	    	$url = get_the_permalink();
		}
		echo '<meta property="og:title" content="'.$titulo.'"/>';
		echo '<meta property="og:type" content="website"/>';
		echo '<meta property="og:url" content="'.$url.'"/>';
		echo '<meta property="og:image" itemprop="image" content="'.$img_src.'"/>';
		echo '<meta property="og:image:width" content="256"/>';
		echo '<meta property="og:image:height" content="256"/>';
		echo '<meta property="og:updated_time" content="1440432930"/>';
		echo '<meta name="description" content="'.$excerpt.'">';
	}
?>