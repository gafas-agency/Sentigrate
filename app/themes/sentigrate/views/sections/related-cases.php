<?php


global $pagetype;


$class = '';
$content = '';
$items = array();


if($pagetype == 'solution'){
  
  $class = ' section-related-cases-white';
  
  $items = get_field('cases_items');
    
}
else if($pagetype == 'case'){
   
  $previous = get_previous_post();
  $next = get_next_post();
  
  if(empty($previous)){
    $args = array('post_type'=>'case','post_status'=>'publish','posts_per_page'=>1,'orderby'=>'menu_order','order'=>'DESC', 'ignore_sticky_posts'=>1,'fields'=>'ids','no_found_rows'=>true);
    add_filter('posts_groupby','__return_false');
    $previous = get_posts($args);
    remove_filter('posts_groupby','__return_false' );
    $items[] = $previous[0];
  }
  else {
    $items[] = $previous->ID;
  }
  
  if(empty($next)){
    $args = array('post_type'=>'case','post_status'=>'publish','posts_per_page'=>1,'orderby'=>'menu_order','order'=>'ASC', 'ignore_sticky_posts'=>1,'fields'=>'ids','no_found_rows'=>true);
    add_filter('posts_groupby','__return_false');
    $next = get_posts($args);
    remove_filter('posts_groupby','__return_false' );
    $items[] = $next[0];    
  } 
  else {
    $items[] = $next->ID;
  }  
  
}


if(!empty($items)){
    
  $tmp = '';
  $count = 1;
    
  foreach($items as $item){
    
    $label = '';
    if($pagetype == 'case')
      if($count == 1)
        $label = '<p class="label">'.nr_string('previous_case').'</p>';
      else if($count == 2)
        $label = '<p class="label">'.nr_string('next_case').'</p>';
      
    $image = '';
    if(!empty($data = get_field('hero_background',$item))){
      $n = nr_image_url($data);			
      $image = 'data-src="'.$n.'"';         
    }
    
    $text = '';
    if(!empty($data = get_the_title($item)))
      $text .= '<h3>'.$data.'</h3>';
    if(!empty($data = get_field('excerpt_summary',$item)))
      $text .= '<p>'.$data.'</p>';  
    
    if(!empty($text)){    
      $tmp .= '<li class="column">'.$label.'<a class="lazy-retina" href="'.get_the_permalink($item).'"'.$image.'><div>'.$text.'</div></a></li>';
      $count++;
    }       
  }
  
  if(!empty($tmp))   
    $content .= '<ul class="columns flex flex-justify-center flex-align-stretch">'.$tmp.'</ul>';
  
}


if(!empty($content)):

  if($pagetype == 'solution'){
        
    $tmp = '';
    
    if(!empty($data = get_field('cases_title')))
      $tmp .= '<h2>'.$data.'</h2>';  
    
    if(!empty($data = get_field('cases_description')))
      $tmp .= '<p>'.$data.'</p>';  
    
    if(!empty($tmp))
      $content = '<div class="row row-header">'.$tmp.'</div>'.$content;
    
  }

 
?>
<section class="section-related-cases<?=$class?>">
  <div class="container">
    <?=$content?>
  </div>
</section>
<?php endif; ?>