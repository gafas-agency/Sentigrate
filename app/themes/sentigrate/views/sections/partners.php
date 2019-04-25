<?php


$content = '';
$tab = '';


if(!empty($data = get_field('partners_tab')))
  $tab = nr_tab($data,'left');


$tmp = '';

if(!empty($data = get_field('partners_title')))
  $tmp .= '<h2 class="title-section">'.$data.'</h2>';
  
if(!empty($data = get_field('partners_description')))
  $tmp .= '<div class="content">'.$data.'</div>';

if(!empty($data = get_field('partners_cta')))
  $tmp .= '<p class="cta">'.$data.'</p>';

if(!empty($data = get_field('partners_button')))
  $tmp .= '<div>'.nr_button($data['title'],$data['url'],'button-solid button-green',$data['target']).'</div>';

$content .= '<div class="column column-text">'.$tmp.'</div>';   


if(!empty($data = get_field('partners_logos'))){
	
	$tmp = '';
	
	foreach($data as $item){
	  
	  if(!empty($item['image'])){
  	  $n = nr_image_url($item['image']);		
      $tmp .= '<li><span class="lazy-retina" data-src="'.$n.'"></span></li>';  

	  } 
  
	}
	
	if(!empty($tmp))
	  $content .= '<div class="column column-partners"><ul class="logos flex flex-justify-stretch flex-align-start flex-wrap">'.$tmp.'</ul></div>';		

}	


if(!empty($content)) 
  $content = '<div class="columns columns-2 flex flex-justify-start flex-align-start">'.$content.'</div>'; 

 
?>
<section class="section-partners">
  <div class="container padding-left-s-cg-1 padding-right-s-cg-1"> 
    <?=$tab?>
    <?=$content?>
  </div>
</section>