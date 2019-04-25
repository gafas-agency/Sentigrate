<?php

$content = '';
$tab = '';


if(!empty($data = get_field('cases_tab')))
  $tab = nr_tab($data,'left');


if(!empty($items = get_field('cases_items'))){
  
  $button = nr_string('view_case');
  
  $counter = 0;
  
  foreach($items as $item){
    
    $image = '';
    $text = '';
    
    if(!empty($data = get_field('hero_background',$item))){
      $n = nr_image_url($data);			
      $image .= '<div class="block-image"><div class="image lazy-retina" data-src="'.$n.'"><div class="image-spacer"></div></div></div>';         
    }
      
    
    if(!empty($data = get_field('excerpt_logo',$item))){
      $n = nr_image_url($data);		  
      $ratio = nr_image_ratio($data);	       
      $text .= '<div class="logo"><div class="img" style="padding-top: '.$ratio.'"><div class="lazy-retina" data-src="'.$n.'"></div></div></div>';         
    }   
    
    if(!empty($data = get_field('excerpt_summary',$item)))
      $text .= '<div class="content"><p>'.$data.'</p></div>';
          
    if(!empty($text)){
      
      $text .= '<a class="link" href="'.get_the_permalink($item).'">'.$button.'</a>';
      
      $text = '<div class="block-text flex flex-column flex-align-center"><div class="row">'.$text.'</div></div>';  
    }  
      
    if(!empty($image) && !empty($text)){   
      $content .= '<div class="columns columns-2 flex flex-justify-start flex-align-stretch">'.$image.$text.'</div>';
      $counter++;
    }  
  }
  
  if(!empty($content)){
   
    $counter = '<div class="slick-counter"><span class="slick-counter-current">1</span><span>/ '.$counter.'</span></div>';
    
    $content = '<div class="featured-cases-slider">'.$content.'</div>'.$counter;
  }
}


if(!empty($content)):

 
?>
<section class="section-featured-cases">
  <div class="container">
    <?=$tab?> 
    <?=$content?>
  </div>
</section>
<?php endif; ?>