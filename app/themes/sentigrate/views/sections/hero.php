<?php


global $pagetype;

$submenu = '';
$content = '';
$background = '';


$classes = array('home'=>'overlay-blue overlay-bottom-gradient','contact'=>'overlay-blue overlay-bottom-gradient','solution'=>'overlay-blue overlay-bottom-gradient','jobs'=>'overlay-black','case'=>'overlay-black');
$class = (array_key_exists($pagetype,$classes)) ? ' '.$classes[''.$pagetype.''] : '';

if(!empty($data = get_field('hero_video'))){
	  		
	$background = '<div class="background background-video'.$class.'" data-video="'.$data.'"></div>';	

}	
else if(!empty($img = get_field('hero_background'))){
  
	$n = nr_image_url($img);		
	$background = '<div class="background lazy-retina'.$class.'" data-src="'.$n.'"></div>';	

}	


if($pagetype == 'solution'){
  
  if(!empty($data = nr_get_solutions())){
    
    $tmp = '';
    
    foreach($data as $item){
    	$active = ($item == $post->ID) ? ' active' : '';     
      $tmp .= '<li><a class="transition-opacity'.$active.'"'.$active.' href="'.get_the_permalink($item).'">'.get_the_title($item).'</a></li>';          
	  }
	  
	  if(!empty($tmp))
	    $submenu = '<ul class="submenu">'.$tmp.'</ul>';   
    
  }
     
}


$tmp = '';

if($pagetype == 'case'){
  $tmp .= nr_title_label_dots(get_the_title());
  if(!empty($data = get_field('hero_description')))
    $tmp .= $data;
}
else {
  if($pagetype == 'solution')
    $tmp .= '<span class="graphic">'.nr_svgicon(nr_anchor(get_the_title())).'</span>';
  if(!empty($data = get_field('hero_label')))
    $tmp .= nr_title_label_dots($data);
  if(!empty($data = get_field('hero_title')))
    $tmp .= $data;
  else   
    $tmp .= get_the_title();
}
if(!empty($tmp))
  $content .= '<h1 class="title-page">'.$tmp.'</h1>';
  
if($pagetype != 'case' && !empty($data = get_field('hero_description')))
  $content .= '<p>'.$data.'</p>';
  
if(!empty($content)){
  $class = ($pagetype == 'home' || $pagetype == 'about') ? 'padding-left-cg-1' : 'padding-left-cg-2';
  
  $sphere = ($pagetype == 'home') ? '<span class="sphere"></span>' : '';
   
  $content = '<div class="row row-header '.$class.'">'.$content.$sphere.'</div>';
 
} 
 
 
$classes = array('contact'=>'','jobs'=>'with-tab','about'=>'with-tab','home'=>'with-tab','case'=>'with-tab');
$class = (array_key_exists($pagetype,$classes)) ? ' '.$classes[''.$pagetype.''] : '';

$tab = '';
if($pagetype == 'case' && !empty($data = nr_string('explore_the_case')))
  $tab = nr_tab($data,'left bottom');

?>
<section class="section-hero section-hero-full section-hero-<?=$pagetype?> flex flex-direction-column">
  <?=$background?>
  <?=$submenu?>
  <div class="container flex flex-direction-column flex-justify-center flex-align-start padding-right-s padding-left-s<?=$class?>"> 
    <?=$content?>
  </div>
  <?=$tab?>
</section>