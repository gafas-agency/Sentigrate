<?php


$content = '';


if(!empty($data = nr_get_solutions())){
	
	$tmp ='';
	
	foreach($data as $item){	
  	
  	if($item != $post->ID){
  	
      $image = '';
      if(!empty($data = get_field('hero_background',$item))){
        $n = nr_image_url($data);			
        $image = 'data-src="'.$n.'"';         
      }
      
      $text = '';
      if(!empty($data = get_the_title($item))){
        $text .= '<span class="graphic">'.nr_svgicon(nr_anchor($data)).'</span>'; 
        $text .= '<h3>'.$data.'</h3>';
      }  
      if(!empty($data = get_field('solution_summary',$item)))
        $text .= '<p>'.$data.'</p>';  
      
      if(!empty($text))    
        $tmp .= '<li class="column"><a class="lazy-retina" href="'.get_the_permalink($item).'"'.$image.'><div>'.$text.'</div></a></li>';

    }
    
	}
	
	if(!empty($tmp))
    $content = '<ul class="columns flex flex-justify-center flex-align-stretch">'.$tmp.'</ul>'; 
	
}	


if(!empty($content)): 

  $tmp = '';
    
  if(!empty($data = get_field('more_solutions_title'))){
    $label = '';
    if($label = get_field('more_solutions_label'))
      $label = nr_title_label_dots($label,'center');    
    $tmp .= '<h2>'.$label.$data.'</h2>';  
  }  
    
  if(!empty($data = get_field('more_solutions_description')))
    $tmp .= '<p>'.$data.'</p>';  
    
  if(!empty($tmp))
    $content = '<div class="row row-header">'.$tmp.'</div>'.$content;

 
?>
<section class="section-related-solutions">
  <div class="container"> 
    <?=$content?>
  </div>
</section>
<?php endif; ?>