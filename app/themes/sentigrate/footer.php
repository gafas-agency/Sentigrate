<?php
	

$content = '';	
$background = '';


$background = '';
if(!empty($img = get_field('footer_background','option'))){
	/*
	$s = nr_image_url($img,'small');
	$m = nr_image_url($img,'medium');			
	$l = nr_image_url($img,'large');
	$xl = nr_image_url($img,'extralarge');
	*/
	
	$n = nr_image_url($img);
		
	$background = '<div class="background lazy-retina" data-src="'.$n.'"></div>';	
}			



$tmp = '';

if(!empty($data = get_field('footer_cta_title','option')))
  $tmp .= '<h6>'.nr_remove_p_tags($data).'</h6>';

if(!empty($data = get_field('footer_cta_subtitle','option')))
  $tmp .= $data;	

if(!empty($tmp))
  $tmp = '<div>'.$tmp.'</div>';

if(!empty($data = get_field('footer_cta_button','option')))
  $tmp .= '<div>'.nr_button($data['title'],$data['url'],'button-solid button-white-transparent',$data['target']).'</div>';

if(!empty($tmp))
  $content .= '<div class="cta"><div class="container flex flex-justify-between flex-align-start padding-left-s-cg-1 padding-right-s-cg-1">'.$tmp.'</div></div>';


$tmp = '';

$tmp .= '<a href="'.home_url().'" class="logo margin-left-g-1">'.file_get_contents(NR_THEME_URL.'/images/logo.svg').'</a>';

if( have_rows('navigation_sections', 372)){
	if(!empty($data = get_field('navigation_sections', 372))){
		
		//array_pop($data);
		
		$menu = '';
		
		for($x = 0; $x < 4; $x++){
			$menu .= '<li><a class="transition-color" href="'.$data[$x]['section_url'].'">'.$data[$x]['section_title'].'</a></li>';											
		}
		
		if(!empty($menu)){
		  $tmp .= '<nav><ul class="flex flex-justify-between flex-align-start">'.$menu.'</ul></nav>';
		}
			
	}
}

if(!empty($data = get_field('contact_socialmedia_items',NR_PID_CONTACT))){
  
  $items = '';
  
  foreach($data as $item)  
    $items .= '<li><a class="transition-opacity" href="'.$item['link'].'" target="_blank" rel="noopener">'.nr_svgicon($item['network']).'</a></li>';
    
  if(!empty($items)) 
    $tmp .= '<ul class="socialmedia flex flex-justify-end flex-align-start margin-left-g-1">'.$items.'</ul>';

}

if(!empty($tmp))
  $content .= '<div class="menu"><div class="container flex flex-justify-between flex-align-center padding-left-s padding-right-s">'.$tmp.'</div></div>';
  	
?>	
	<footer>
      <?=$background?>
      <?=$content?>	
	</footer>	
	
	<?php wp_footer(); ?>
	
 </body>
</html>