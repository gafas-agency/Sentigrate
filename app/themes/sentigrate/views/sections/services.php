<?php


$content = '';


$tmp = '';

if(!empty($data = get_field('services_label')))
  $tmp .= nr_title_label_dots($data);

if(!empty($data = get_field('services_title')))
  $tmp .= '<h2 class="title-section">'.$data.'</h2>';
  
if(!empty($data = get_field('services_description')))
  $tmp .= '<div class="content">'.$data.'</div>';

if(!empty($data = get_field('services_button')))
  $tmp .= nr_button($data['title'],$data['url'],'button-solid button-green',$data['target']);

$content .= '<div class="column column-text">'.$tmp.'</div>';   


if(!empty($data = get_field('services_subjects'))){
	$tmp = '';
	foreach($data as $item)
    $tmp .= '<li><span class="graphic">'.nr_svgicon(nr_anchor($item['title'])).'</span><h3>'.$item['title'].'</h3><div class="content"><p>'.$item['description'].'</p></div></li>';    
	
	if(!empty($tmp))
	  $content .= '<div class="column column-tiles"><ul class="services">'.$tmp.'</ul></div>';		

}	

if(!empty($content)) 
  $content = '<div class="columns columns-2 flex flex-justify-between flex-align-start padding-left-cg-1 padding-right-c-1">'.$content.'</div>'; 

 
?>
<section class="section-services">
  <div class="container padding-left-s padding-right-s"> 
    <?=$content?>
  </div>
</section>