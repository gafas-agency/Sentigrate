<?php

$class = '';
$content = '';
$background = '';


if(!empty($type = get_field('background_type'))){

  if($type == 'image'){
    
    if(!empty($img = get_field('hero_background'))){
      $n = nr_image_url($img);		
      $background = '<div class="background lazy-retina overlay-black" data-src="'.$n.'"></div>';	
    }	
    
  }
  else if($type == 'video'){
  
  
    if(!empty($data = get_field('hero_video'))){
	  		
	    $background = '<div class="background background-video overlay-blue overlay-bottom-gradient" data-video="'.$data.'"></div>';	

    }	
  

  }
  else{
    
    $class = ' section-hero-custompage-solid';
    
  }


}


$tmp = '';
if(!empty($data = get_field('hero_label')))
    $tmp .= nr_title_label_dots($data);
if(!empty($data = get_field('hero_title')))
    $tmp .= $data;  
if(!empty($tmp))
  $content .= '<h1 class="title-page">'.$tmp.'</h1>';
  
if(!empty($data = get_field('hero_description')))
  $content .= '<p>'.$data.'</p>'; 
  
if(!empty($content)){   
  $content = '<div class="row row-header padding-left-cg-2">'.$content.'</div>';
 
} 
  
?>
<section class="section-hero section-hero-full section-hero-custompage flex flex-direction-column<?=$class?>">
  <?=$background?>
  <div class="container flex flex-direction-column flex-justify-center flex-align-start padding-right-s padding-left-s"> 
    <?=$content?>
  </div>
</section>