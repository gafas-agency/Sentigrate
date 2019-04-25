<?php

$tab = '';
$content = '';
global $contentblock;


if(!empty($contentblock['tab']))
  $tab = nr_tab($contentblock['tab'],'left');
  

$tmp = '';
 
if(!empty($slides = $contentblock['slides'])){
  
  foreach($slides as $slide){
    
    $_tmp = '';
    
    if(!empty($slide['number']))
      $_tmp .= '<h3>'.$slide['number'].'</h3>';
      
    if(!empty($slide['description']))
      $_tmp .= '<div class="content"><p>'.$slide['description'].'</p></div>';
    
    if(!empty($_tmp))
      $tmp .= '<div class="slide flex flex-direction-column flex-justify-center flex-align-center"><div class="row">'.$_tmp.'</div></div>';
    
  }  
  
  if(!empty($tmp))
  
  $content .= '<div class="block-slider"><div><div class="slides">'.$tmp.'</div></div></div>';
  
}  


if(!empty($contentblock['text']))  
  $content .= '<div class="block-text flex flex-justify-center flex-column flex-align-center"><div class="row"><div class="content">'.$contentblock['text'].'</div></div></div>';


if(!empty($content)):

  $content = '<div class="columns columns-2 flex flex-justify-start flex-align-stretch">'.$content.'</div>';

?>
<section class="section-block section-block-slider-text">
  <div class="container">
    <?=$tab?> 
    <?=$content?>    
  </div>
</section>
<?php endif; ?>