<?php


$content = '';
$background = '';
$backbutton = '';


if(!empty($img = get_field('hero_background'))){
  
	$n = nr_image_url($img);		
	$background = '<div class="background lazy-retina overlay-grey" data-src="'.$n.'"></div>';	

}


$content .= '<span class="label">'.nr_string(get_field('hero_label'),'option').'</span>';
$content .= '<h1 class="title-page">'.get_the_title().'</h1>';
$content .= '<p class="date">'.get_the_date('j M Y').'</p>'; 
$content = '<div class="row row-header">'.$content.'</div>';


$backbutton .= '<a href="'.get_the_permalink(NR_PID_NEWS).'" class="backlink button button-icon button-icon-large button-icon-left"><span>'.nr_svgicon('previous').'</span>'.nr_string('all_news').'</a>';

   
?>
<section class="section-hero section-hero-article flex flex-direction-column">
  <?=$background?>
  <div class="container flex flex-direction-column flex-justify-center flex-align-center padding-left-s padding-right-s">
    <span class="flex flex-direction-column flex-justify-center flex-align-center">   
     <?=$content?>
    </span>
  </div>
  <?=$backbutton?>
</section>


<?php


$content = '';


if(!empty($blocks = get_field('content_blocks'))){
  
  foreach($blocks as $block){
    
    
    if($block['acf_fc_layout'] == 'introduction'){
      
      $content.= '<div class="introduction">'.$block['introduction'].'</div>';
      
    }
    else if($block['acf_fc_layout'] == 'text'){
      
      $content.= $block['text'];
      
    }
    else if($block['acf_fc_layout'] == 'image'){

      if(!empty($data = $block['image'])){      
        $n = nr_image_url($data);			
        $ratio = nr_image_ratio($data);	       
        $content .= '<div class="image"><div class="img" style="padding-top: '.$ratio.'"><img class="lazy-retina" src="'.nr_image_placeholder().'" data-src="'.$n.'"></div></div>';
      }		
     
    }
    else if($block['acf_fc_layout'] == 'video'){
      
      if(!empty($mp4 = $block['mp4']) && !empty($still = $block['still'])){ 
        $content .= '<div class="videobox"><div><div><video poster="'.$still.'" class="videoplayer" playsinline controls><source src="'.$mp4.'" type="video/mp4"></video></div></div></div>';
      } 
          
    }	  
    
  } 
  
}

if(!empty($content)):
   
?>
<section class="section-article">
     <?=$content?>
</section>
<?php endif; ?>