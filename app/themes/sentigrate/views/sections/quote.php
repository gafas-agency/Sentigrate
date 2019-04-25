<?php


$content = '';
$background = '';


if(!empty($img = get_field('quote_background'))){
	$n = nr_image_url($img);		
	$background = '<div class="background lazy-retina overlay-blue" data-src="'.$n.'"></div>';	
}	

if(!empty($data = get_field('quote_message')))
  $content .= '<div class="row"><span class="quote">'.nr_svgicon('quote').'</span><h2>'.$data.'</h2></div>';

?>
<section class="section-quote flex flex-direction-column">
  <?=$background?>
  <div class="container flex flex-direction-column flex-justify-center flex-align-center padding-right-s padding-left-s"> 
    <?=$content?>
  </div>
</section>