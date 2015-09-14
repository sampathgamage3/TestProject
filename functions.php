<?php




add_theme_support( 'post-thumbnails' ); 

add_action( 'init', 'register_my_menus' );

function register_my_menus() {
    register_nav_menus(
    array(
    'main_menu' => __( 'Main Menu' ) 
    )
    );
}

  // custom post_type
    add_action( 'init', 'create_posttype' );
  
    function create_posttype() {
        
        register_post_type('newspress', array(
        'label' => 'News',
        'public' => true,
        'taxonomies' => array(''),
        'show_ui' => true,
        'capability_type' => 'post',
        'hierarchical' => false,
        'rewrite' => array('slug' => 'newspress'),
        'query_var' => true,
        'supports' => array(
        'title',
        'editor',
        'revisions',
        'thumbnail',
        'page-attributes',)
        ) );
         register_post_type('pressrelease', array(
        'label' => 'Press Release',
        'public' => true,
        'taxonomies' => array(''),
        'show_ui' => true,
        'capability_type' => 'post',
        'hierarchical' => false,
        'rewrite' => array('slug' => 'pressrelease'),
        'query_var' => true,
        'supports' => array(
        'title',
        'editor',
        'revisions',
        'thumbnail',
        'page-attributes',)
        ) );
        register_post_type('team', array(
        'label' => 'Team Members',
        'public' => true,
        'taxonomies' => array(''),
        'show_ui' => true,
        'capability_type' => 'post',
        'hierarchical' => false,
        'rewrite' => array('slug' => 'team'),
        'query_var' => true,
        'supports' => array(
        'title',
        'editor',
        'revisions',
        'thumbnail',
        'page-attributes',)
        ) );
         register_post_type('webcast', array(
        'label' => 'Webcast Videos',
        'public' => true,
        'taxonomies' => array(''),
        'show_ui' => true,
        'capability_type' => 'post',
        'hierarchical' => false,
        'rewrite' => array('slug' => 'webcast'),
        'query_var' => true,
        'supports' => array(
        'title',
        'editor',
        'revisions',
        'thumbnail',
        'page-attributes',)
        ) );
    }

    
    function create_my_taxonomies() {
	 
	register_taxonomy(
	'Team Types',
	 'team',
	 array(
            "hierarchical" => true,
            "label" => "Team Types",
            "singular_label" => "team types",
            'update_count_callback' => '_update_post_term_count',
            'query_var' => true,
            'rewrite' => array( 
                   'slug' => 'team',
                    'with_front' => true 
                    ),
             'public' => true,
             'show_ui' => true,
             'show_admin_column' => true,
             'show_tagcloud' => true,
             '_builtin' => false,
             'show_in_nav_menus' => false)
	  );
	 
}

 function removequoats($content){
        $content = str_replace('"','&quot' , $content);
        $content = str_replace("'",'&#039' , $content);
        return $content;
    }

add_action('init', 'create_my_taxonomies', 0);


// Theme featured image meta 
function theme_featured_image_meta( $content ) {
        global $post;
        $type = get_post_type($post->ID);
        if($type=="team"){
        $text = __( "Individual Image size in Team should be 98x98 .", 'textdomain' );
        $id = 'hide_featured_image';
        $value = esc_attr( get_post_meta( $post->ID, $id, true ) );
        $label = '<label for="' . $id . '" class="selectit">' . $text .'</label>';
        
        
        return $content .= $label;
        }else {
          return $content ;   
        }
    }

    
    // remove core updates
    
    add_action('after_setup_theme','remove_core_updates');
	function remove_core_updates()
	{
	 if(! current_user_can('update_core')){return;}
	 add_action('init', create_function('$a',"remove_action( 'init', 'wp_version_check' );"),2);
	 add_filter('pre_option_update_core','__return_null');
	 add_filter('pre_site_transient_update_core','__return_null');
	}
	
	remove_action('load-update-core.php','wp_update_plugins');
	add_filter('pre_site_transient_update_plugins','__return_null');
	
	 
	
	add_filter('pre_site_transient_update_core','remove_core_updates');
	add_filter('pre_site_transient_update_plugins','remove_core_updates');
	add_filter('pre_site_transient_update_themes','remove_core_updates');
	

