<?php


$content = '';
$tab = '';


if(!empty($data = get_field('benefits_tab')))
  $tab = nr_tab($data,'left');


$tmp = '';

if(!empty($data = get_field('benefits_image'))){
  
	$n = nr_image_url($data);			
	$ratio = nr_image_ratio($data);	
  $tmp = '<div class="img" style="padding-top: '.$ratio.'"><img class="lazy-retina" src="'.nr_image_placeholder().'" data-src="'.$n.'"></div>';			
				
}		
 
$content .= '<div class="column column-image padding-right-g-05">'.$tmp.'</div>';  
  

$tmp = '';

if(!empty($data = get_field('benefits_title')))
  $tmp .= '<h2 class="title-section">'.$data.'</h2>';
  
if(!empty($data = get_field('benefits_description')))
  $tmp .= '<div class="content">'.$data.'</div>';

$content .= '<div class="column column-text padding-left-c-1">'.$tmp.'</div>';  
  
  
if(!empty($content)) 
  $content = '<div class="columns columns-2 flex flex-justify-center flex-align-center padding-left-cg-1 padding-right-cg-1">'.$content.'</div>'; 
 
?>
<section class="section-benefits">
  <div class="container padding-left-s padding-right-s"> 
    <?=$tab?>
    <?=$content?>
  </div>
</section>