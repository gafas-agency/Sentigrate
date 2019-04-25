<?php


$content = '';
global $contentblock;


if(!empty($contentblock['label']))
  $content .= '<span class="block-label">'.$contentblock['label'].'</span>';

if(!empty($mp4 = $contentblock['mp4']) && !empty($still = $contentblock['still'])){
  $n = nr_image_url($still);
  $content = '<div class="videobox">'.$content.'<div><div><video poster="'.$n.'" class="videoplayer" playsinline controls><source src="'.$mp4.'" type="video/mp4"></video></div></div></div>';
}
//  $content = '<div class="videobox">'.$content.'<div><div><video poster="'.$still.'" class="videoplayer" playsinline controls><source src="" type="video/mp4"></video></div></div></div>';

if(empty($mp4 = $contentblock['mp4']) && !empty($link = $contentblock['video_link']) && !empty($still = $contentblock['still'])){
  $n = nr_image_url($still);
  $ratio = nr_image_ratio($still);
  $imageMarkup = '<div class="lazy-retina" data-src="'.$n.'"></div>';
  $url = '<a href="' . $link . '" target="blank">' . $imageMarkup . '</a>';
  $content .= '<div class="image"><div class="img" style="padding-top: '.$ratio.'">' . $url . '</div></div>'; 
}

if(!empty($content)):

?>
<section class="section-block section-block-video">
  <div class="container">
    <?=$content?>    
  </div>
</section>
<?php endif; ?>