<?php


$content = '';
global $contentblock;


if(!empty($contentblock['title']))
  $content .= '<h2 class="title">'.$contentblock['title'].'</h2>';

if(!empty($contentblock['description']))
  $content .= '<p class="introduction">'.$contentblock['description'].'</p>';

if(!empty($contentblock['items'])){
  
  $tmp = '';
  
  foreach($contentblock['items'] as $item){
    
    $_tmp = '';
    
    if(!empty($item['title']))
      $_tmp .= '<h3>'.$item['title'].'</h3>';
    
    if(!empty($item['description']))
      $_tmp .= '<div class="content"><p>'.$item['description'].'</p></div>';
    
    if(!empty($_tmp))
      $tmp .= '<li><div>'.$_tmp.'</div></li>';
    
  }
  
  if(!empty($tmp))
    $content .= '<ul class="tiles flex flex-wrap flex-justify-center flex-align-stretch padding-left-g-05 padding-right-g-05">'.$tmp.'</ul>';
  
}  


if(!empty($content)):

?>
<section class="section-block section-block-tiles">
  <div class="container padding-left-s-c-1 padding-right-s-c-1">
    <?=$content?>    
  </div>
</section>
<?php endif; ?>