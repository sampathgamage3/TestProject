 
// if need row div in a loop and wrap in with divs
 <div class="row">  
    <?php $args = array(
                   "post_type" => "resources",
                   "posts_per_page" => -1,
                    "order" => 'DESC', 
           );


       $the_query = new WP_Query( $args );   
       $j = 1;
       if ( $the_query->have_posts() ):

       while($the_query->have_posts()): 
        if ($j % 4 == 0) {
           ?>
           </div>
           <div class="row">
               <?php
               $j = 1;
           }
           $j++; 
           endwhile;

       endif;
                   
       
                            
// category loop
       
    $args = array(
            'orderby'           => 'slug', 
            'order'             => 'DESC',
            'hide_empty'        => false,

    ); 
    $default_slug="";
    $selected_class="";
    $terms = get_terms( 'resourcestypes', $args ); 
    if ( ! empty( $terms ) && ! is_wp_error( $terms ) )
    {
            $i=1; 
            $selected_class="";
            foreach ( $terms as $term )
            {
                if($i==1){
                    $default_slug=$term->slug;
                }

                if($i==1 && $term_slug=="" ){
                    $selected_class ="selected-tab";
                }

                if($term_slug==$term->slug ){
                 $selected_class ="selected-tab";
                }
                echo '<li class="'.$selected_class.'"><a id="' . str_replace(' ','', $term->name) . '" class="select-tab" data-target="'.$i.'">' . $term->name . '</a></li>';
                    $i++;	
                    $selected_class="";
             }
    }
?>