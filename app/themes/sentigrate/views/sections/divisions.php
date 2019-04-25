<?php


$content = '';
$tab = '';


if(!empty($data = get_field('devisions_tab'))){
  $anchor = nr_anchor($data);
  $label = '<span class="title-label with-dots"><span><span class="dots"></span>'.$data.'</span></span>';
  $tab = '<div class="tab tab-left transparent padding-left-s-cg-1" id="'.$anchor.'"><a href="#'.$anchor.'" class="tab-trigger"><p class="flex flex-nowrap flex-justify-start flex-align-center">'.$label.nr_svgicon('arrow-down').'</p></a></div>';
}

if(!empty($data = get_field('divisions_items'))){
  
  $sphere = '<span class="sphere sphere-small"></span>';
  	
	foreach($data as $item){
  
    $content .= '<li>'.$sphere.'<h3>'.$item['name'].'</h3><p>'.$item['description'].'</p></li>';
  	
  }
  
  if(!empty($content))
    $content = '<ul class="grid grid-divisions flex flex-wrap flex-justify-start flex-align-stretch">'.$content.'</ul>';

}


?>
<section class="section-divisions">
  <div class="container padding-left-s padding-right-s">
    <?=$tab?> 
    <?=$content?>
  </div>
</section>