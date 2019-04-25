<?php


$content = '';
$background = '';


if(!empty($data = get_field('hero_video'))){
	  		
	$background = '<div class="background background-video overlay-blue overlay-bottom-gradient" data-video="'.$data.'"></div>';	

}	
else if(!empty($img = get_field('hero_background'))){
  
	$n = nr_image_url($img);		
	$background = '<div class="background lazy-retina" data-src="'.$n.'"></div>';	

}	


$tmp = '';

if(empty($tmp = get_field('hero_title')))
  $tmp = get_the_title();
  
$content .= '<h1 class="title-page">'.$tmp.'</h1>';


$tmp = '';


$args = array('post_type'=>'article','post_status'=>'publish','posts_per_page'=>5,'orderby'=>'date','order'=>'DESC','ignore_sticky_posts'=>1,'fields'=>'ids','no_found_rows'=>true);
add_filter('posts_groupby','__return_false');
$data = get_posts($args);
remove_filter('posts_groupby','__return_false' );
if(!empty($data)){
	
  $articles = '';
  $count = 1;
	$labels = array('news'=>nr_string('news','option'), 'event'=>nr_string('event','option'), 'press'=>nr_string('press','option'));
	
	foreach($data as $item){
  	
  	$class = ($count == 2) ? ' tile-wide' : '';
	  
	  
    $image = '';
    $img = '';
    if($count == 2){
      $img = get_field('hero_background',$item);      
    }
    else {
      $img = get_field('article_thumbnail',$item);
      if(empty($img))
        $img = get_field('hero_background',$item);       
    }
    if(!empty($img)){
    	$n = nr_image_url($img);		
      $image = '<div class="background lazy-retina" data-src="'.$n.'"></div>';	
    }	
       
    $title = '<h3>'.get_the_title($item).'</h3>';
    $description = '<p>'.get_field('article_summary',$item).'</p>';     
    $label = '<span class="label">'.$labels[''.get_field('hero_label',$item).''].'</span>';
        
    $articles .= '<li class="tile'.$class.'"><span>'.$image.'<a href="'.get_the_permalink($item).'"><span><span><span class="flex flex-direction-column flex-justify-between flex-align-start">'.$label.'<div class="content">'.$title.$description.'</div></span></span></span></a></span></li>';     
 
 
    $count++;
	}
	
	$content .= '<ul class="tiles flex flex-direction-row flex-wrap flex-justify-start flex-align-start">'.$articles.'</ul>';
	  
}	

   
?>
<section class="section-news">
  <?=$background?>
  <div class="container"> 
    <?=$content?>
  </div>
</section>