<?php


$content = '';
global $contentblock;


if(!empty($image = $contentblock['image'])){
  $n = nr_image_url($image);			
  $ratio = nr_image_ratio($image);
  $imageMarkup= '<div class="lazy-retina" data-src="'.$n.'"></div>';
  $url= '';
  //if(!empty($link = $contentblock['image_link'])){$url = '<a href="' . $link . '" target="blank">' . $imageMarkup . '</a>';}else{ $url = $imageMarkup;}
  $url = $imageMarkup;
  $content .= '<div class="image"><div class="img" style="padding-top: '.$ratio.'">' . $url . '</div></div>';      
}


if(!empty($content)):

?>
<section class="section-block section-block-image section-block-image-single">
  <div class="container">
    <?=$content?>    
  </div>
</section>
<?php endif; ?>