<?php


$content = '';


$tmp = '';

if(!empty($data = get_field('partners_testimonials'))){
  	
  $count = 1;	
  	
	foreach($data as $item){
	  	  
	  $_tmp = '';
	  
	  $image = '';
	  if(!empty($item['background'])){
  	  
  	  $logo ='';
  	  if(!empty($item['logo'])){
  	    $n = nr_image_url($item['logo']);		
        $logo = '<div class="logo lazy-retina" data-src="'.$n.'"></div>';
      }  
  	  
  	  
  	  $n = nr_image_url($item['background']);		
  	  $image = '<div class="lazy-retina" data-src="'.$n.'">'.$logo.'</div>';
  	}  
  	
  	$_tmp .= '<div class="block-image">'.$image.'<span class="quote">'.nr_svgicon('quote').'</span></div>';
  	  
  	
  	$text = '';
  	
	  if(!empty($item['description']))
  	  $text .= '<div class="content"><p>'.$item['description'].'</p></div>';

	  if(!empty($item['author']))
  	  $text .= '<p class="author">'.$item['author'].'</p>';  	
  	
  	$_tmp .= '<div class="block-text"><span class="quote">'.nr_svgicon('quote').'</span>'.$text.'</div>';   	  
  	
  	  
    $tmp .= '<div class="slide">'.$_tmp.'</div>';   
        
    $count++;
    
  } 
	  
  if(!empty($tmp))
	  $tmp = '<div class="testimonials testimonials-slider flex flex-justify-stretch flex-align-start flex-wrap">'.$tmp.'</div>';	 
		  
}

$content .= '<div class="column column-testimonials">'.$tmp.'</div>'; 


$tmp = '';

if(!empty($data = get_field('partners_title')))
  $tmp .= '<h2 class="title-section">'.$data.'</h2>';
  
if(!empty($data = get_field('partners_description')))
  $tmp .= '<div class="content">'.$data.'</div>';

if(!empty($data = get_field('partners_logos'))){
	$_tmp = '';
	foreach($data as $item){
	  if(!empty($item['image'])){
  	  $n = nr_image_url($item['image']);		
      $_tmp .= '<li><span class="lazy-retina" data-src="'.$n.'"></span></li>';  
	  } 
	}
	if(!empty($tmp))
	  $tmp .= '<ul class="logos flex flex-justify-stretch flex-align-start flex-wrap">'.$_tmp.'</ul>';		
}	

if(!empty($data = get_field('partners_button')))
  $tmp .= '<div>'.nr_button($data['title'],$data['url'],'button-solid button-blue',$data['target']).'</div>';

$content .= '<div class="column column-text"><div class="content-wrap">'.$tmp.'</div></div>';   


if(!empty($content)) 
  $content = '<div class="columns columns-2 flex flex-justify-between flex-align-start">'.$content.'</div>'; 

 
?>
<section class="section-featured-partners">
  <div class="container padding-left-s-cg-1 padding-right-s-cg-1"> 
    <?=$content?>
  </div>
</section>