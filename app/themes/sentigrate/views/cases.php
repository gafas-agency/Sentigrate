<?php


$content = '';
  
  
$args = array('post_type'=>'case','post_status'=>'publish','posts_per_page'=>-1,'nopaging'=>true,'orderby'=>'menu_order','order'=>'ASC', 'ignore_sticky_posts'=>1,'fields'=>'ids','no_found_rows'=>true);
add_filter('posts_groupby','__return_false');
$cases = get_posts($args);
remove_filter('posts_groupby','__return_false' );
if(!empty($cases)){
    
  $count = 0;
  $sliderbg = '';
  $sliderthumbs = '';
  
  $button = nr_string('view_case');
  
  foreach($cases as $case){
     
    $bg_tmp = '';
    $thumbs_tmp = '';
    $background = '';
    
    $link = get_the_permalink($case);
    
    if(!empty($img = get_field('hero_background',$case))){
      $n = nr_image_url($img);		
	    $background = ' data-src="'.$n.'"';	
	    $thumbs_tmp .= '<div class="image"><div class="lazy-retina"'.$background.'></div></div>';	    
    }	
        
    if(!empty($data = get_field('excerpt_label',$case)))
      $bg_tmp .= nr_title_label_dots($data);
    
    if(!empty($data = get_the_title($case))){
      $bg_tmp .= '<h2 class="title-section">'.$data.'</h2>';
      $thumbs_tmp .= '<p class="title">'.$data.'</p>';
    }  
      
    if(!empty($data = get_field('excerpt_summary',$case)))
      $bg_tmp .= '<div class="content"><p>'.$data.'</p></div>';
    
    $bg_tmp .= nr_button($button,$link,'button-solid button-green');
            
    if(!empty($bg_tmp)){
      $bg_tmp = '<div class="slide lazy-retina"'.$background.'><div class="container padding-left-s-cg-2 flex flex-direction-column flex-justify-center flex-align-start"><div class="row">'.$bg_tmp.'</div></div></div>';
       $sliderbg .= $bg_tmp;
    }        
    
    if(!empty($thumbs_tmp)){
      $thumbs_tmp = '<div class="slide"><a href="'.$link.'" data-target="'.$count.'">'.$thumbs_tmp.'</a></div>';
      $sliderthumbs .= $thumbs_tmp;
      $count++;
    }
    
  }  
  
  if(!empty($sliderbg) && !empty($sliderthumbs))
    $content .= '<div class="slider-backgrounds"><div><div class="slides">'.$sliderbg.'</div></div></div><div class="slider-thumbnails"><div class="container padding-left-s"><div class="slides">'.$sliderthumbs.'</div></div></div>'; 

}


if(!empty($content)):

?>
<section class="section-cases">
  <?=$content?>  
</section> 
<?php endif; ?>
 