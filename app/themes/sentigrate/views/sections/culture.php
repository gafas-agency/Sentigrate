<?php


$content = '';
$tab = '';


if(!empty($data = get_field('culture_tab')))
  $tab = nr_tab($data,'right');


$tmp = '';
 
if(!empty($data = get_field('culture_title')))
  $tmp .= '<h2>'.$data.'</h2>';

if(!empty($data = get_field('culture_description')))
  $tmp .= '<div class="content">'.$data.'</div>';
  
if(!empty($tmp)) 
  $content .= '<div class="row row-header flex flex-nowrap flex-justify-between flex-align-top">'.$tmp.'</div>';  



$slider = '';

if(!empty($data = get_field('culture_images'))){
    
	foreach($data as $item){
	
	  $n = nr_image_url($item);			
    $image = ' data-src="'.$n.'"';         
		$slider .= '<div class="tile"><div class="image lazy-retina"'.$image.'></div></div>';		
  
  }
  
  if(!empty($slider))
    $content .= '<div class="row row-slider"><div class="tiles culture-slider flex flex-nowrap flex-justify-start flex-align-stretch">'.$slider.'</div></div>';
    
}	


if(!empty($content)):


?>
<section class="section-culture">
  <div class="container padding-left-s padding-right-s"> 
    <?=$tab?>
    <?=$content?>
  </div>
</section>
<?php endif; ?>