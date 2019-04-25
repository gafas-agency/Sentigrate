<?php


$content = '';
global $contentblock;


$tmp = '';

if(!empty($contentblock['title'])){
  
  $icon = (!empty($contentblock['icon'])) ? '<span>'.nr_svgicon($contentblock['icon']).'</span>' : '';

  $content .= '<div class="block-title"><h2 class="title">'.$icon.$contentblock['title'].'</h2></div>';    
  
}


if(!empty($contentblock['text'])){  
  $content .= '<div class="block-text">'.$contentblock['text'].'</div>';
}


if(!empty($content)):

  $content = '<div class="columns flex flex-justify-between flex-align-start">'.$content.'</div>';

?>
<section class="section-block section-block-title-text">
  <div class="container padding-left-s-cg-1 padding-right-s-cg-1">
    <?=$content?>    
  </div>
</section>
<?php endif; ?>