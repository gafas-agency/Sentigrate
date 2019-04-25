<?php


$content = '';
global $contentblock;

$count = 0;
$items = array('one','two');
foreach($items as $item){
  
  if(!empty($image = $contentblock['image_'.$item])){
    
    $label = '';
    if(!empty($label = $contentblock['label_'.$item]))
      $label = '<span class="block-label">'.$label.'</span>';

    $n = nr_image_url($image);			
    $ratio = nr_image_ratio($image);	       
    $content .= '<div class="image">'.$label.'<div class="img" style="padding-top: '.$ratio.'"><div class="lazy-retina" data-src="'.$n.'"></div></div></div>';       
    
    $count++;  
  }
  
}

$sectionclass = ($count == 1) ? ' section-block-image-single' : ' section-block-image-double';
$containerclass = ($count == 1) ? '' : ' flex flex-row flex-nowrap';


if(!empty($content)):

?>
<section class="section-block section-block-image<?=$sectionclass?>">
  <div class="container<?=$containerclass?>">
    <?=$content?>    
  </div>
</section>
<?php endif; ?>