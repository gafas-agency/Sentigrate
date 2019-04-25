<?php


$content = '';
global $contentblock;


if(!empty($image = $contentblock['image'])){
  $n = nr_image_url($image);			
  $content .= '<div class="block-image"><div class="image lazy-retina" data-src="'.$n.'"><div class="image-spacer"></div></div></div>';         
}


$tmp = '';

if(!empty($contentblock['logo'])){
  $n = nr_image_url($contentblock['logo']);		  
  $ratio = nr_image_ratio($contentblock['logo']);	       
  $tmp .= '<div class="logo"><div class="img" style="padding-top: '.$ratio.'"><div class="lazy-retina" data-src="'.$n.'"></div></div></div>';         
}
  
if(!empty($contentblock['description']))
  $tmp .= '<div class="content">'.$contentblock['description'].'</div>';

if(!empty($contentblock['link'])){
  if(!empty($contentblock['link']['title']) && !empty($contentblock['link']['url'])){
    $target = (!empty($contentblock['link']['target'])) ? ' target="_blank" rel="noopener"' : '';
    $icon = (!empty($target)) ? '<span>'.nr_svgicon('external').'</span>' : '';
    $class = (!empty($target)) ? : '';
    $tmp .='<a href="'.$contentblock['link']['url'].'" class="button button-card-icon"'.$target.'>'.$contentblock['link']['title'].$icon.'</a>'; 
  }   
}  
  
if(!empty($tmp)){
  
  $label = '';
  if(!empty($contentblock['description']))
    $label = '<span class="label">'.$contentblock['label'].'</span>';  
  
  $content .= '<div class="block-text flex flex-justify-center flex-column flex-align-center">'.$label.'<div class="row">'.$tmp.'</div></div>';
  
}  


if(!empty($content)):

  $content = '<div class="columns columns-2 flex flex-justify-start flex-align-stretch">'.$content.'</div>';

?>
<section class="section-block section-block-image-card">
  <div class="container">
    <?=$content?>    
  </div>
</section>
<?php endif; ?>