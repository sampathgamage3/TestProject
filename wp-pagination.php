<?php

// get pages 
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

//query
$args = array('post_type' => 'news', 'order' => 'ASC', 'posts_per_page' => 1000, 'paged' => $paged,);
$query = new WP_Query($args);
 while ($query->have_posts()) {
    $query->the_post();           
 }
 
 // call to pagination function
 template_paginations($the_query, get_query_var('page'));
 
 //function pagination
 function template_paginations($query,$paged){
 global $wp_rewrite;
    echo paginate_links( array(
        'base'      => str_replace('99999', '%#%', esc_url(get_pagenum_link( 99999 ))),
        'format'    => $wp_rewrite->using_permalinks() ? 'page/%#%' : '/?paged=%#%',
        'current'   => max(1, $paged),
        'mid_size'  => 1,
        'total'     => $query->max_num_pages,
        'prev_text' => '< PREVIOUS',
        'next_text' => 'NEXT >',
        'type'      => 'list'
    ) );
}

?>