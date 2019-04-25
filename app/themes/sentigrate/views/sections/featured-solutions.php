<?php


$content = '';
$tab = '';


if(!empty($data = get_field('solutions_tab')))
  $tab = nr_tab($data,'left white');


if(!empty($data = nr_get_solutions())){
	
	$sidebar = '';
	$slides = '';
  $count = 1;
  $next = '<span class="next">'.nr_svgicon('next').'</span>';
	$label = nr_string('more_about','option');
	
	foreach($data as $item){
  	
  	$active = ($count == 1) ? ' class="active"' : '';
	  
	  $title = get_the_title($item);
	  $icon = '<span class="graphic transition-bg-border">'.nr_svgicon(nr_anchor($title)).'</span>';            
    $sidebar .= '<li><a'.$active.' href="'.get_the_permalink($item).'" data-target="'.($count-1).'">'.$icon.'<h3>'.$title.'</h3><div class="content"><p class="transition-color">'.get_field('solution_summary',$item).'</p></div>'.$next.'</a></li>';    
        
    if(!empty($data = get_field('hero_video',$item))){
    	$background = '<div class="background background-video" data-video="'.$data.'"></div>';	
    }	
    else if(!empty($img = get_field('hero_background',$item))){
    	$n = nr_image_url($img);		
    	$background = '<div class="background lazy-retina" data-src="'.$n.'"></div>';	
    }	
    
    $keywords = '';
    if(!empty($_data = get_field('solution_keywords',$item))){
      foreach($_data as $keyword)
        $keywords .= '<li>'.$keyword['keyword'].'</li>';
      $keywords = '<ul class="keywords flex flex-direction-row flex-justify-between flex-align-center">'.$keywords.'</ul>';
    }    
    
    $slides .= '<div class="slide flex flex-direction-column flex-justify-end flex-align-center">'.$background.'<span class="counter">0'.$count.'</span><div class="content">'.$keywords.'<a class="button button-icon" href="'.get_the_permalink($item).'">'.$label.' '.$title.'<span>'.nr_svgicon('next').'</span></a></div></div>';     
 
 
    $count++;
	}
	  
}	


$content .= '<div class="column column-list padding-left-s-c-1"><ul class="solutions-list">'.$sidebar.'</ul></div>';		
$content .= '<div class="column column-slides"><div class="slides">'.$slides.'</div></div>';   


if(!empty($content)) 
  $content = '<div class="columns columns-2 flex flex-justify-start flex-align-stretch list-slider">'.$content.'</div>'; 

 
?>
<section class="section-featured-solutions">
  <div class="container"> 
    <?=$tab?>
    <?=$content?>
  </div>
</section>