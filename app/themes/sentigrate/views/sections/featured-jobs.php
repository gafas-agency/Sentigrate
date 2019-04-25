<?php


$content = '';
$tab = '';


if(!empty($data = get_field('jobs_tab')))
  $tab = nr_tab($data,'left');


$tmp = '';
 
if(!empty($data = get_field('jobs_title')))
  $tmp .= '<h2>'.$data.'</h2>';

if(!empty($data = get_field('jobs_description')))
  $tmp .= '<div class="content">'.$data.'</div>';
  

$slider = '';

$args = array('post_type'=>'job','post_status'=>'publish','fields'=>'ids','posts_per_page'=>-1,'nopaging'=>true,'orderby'=>'menu_order','order'=>'ASC','ignore_sticky_posts'=>1,'fields'=>'ids','no_found_rows'=>true);
add_filter('posts_groupby','__return_false');
$data = get_posts($args);
remove_filter('posts_groupby','__return_false' );

if(!empty($data)){
  
  $button = '<span class="button transition-backgroundcolor">'.nr_svgicon('next').'</span>';
  
	foreach($data as $item)
		$slider .= '<div class="tile"><a href="'.get_the_permalink($item).'"><h3>'.get_the_title($item).'</h3><div class="content"><p>'.get_field('job_summary',$item).'</p></div></a>'.$button.'</div>';		
  
  if(!empty($tmp))
    $tmp .= '<div class="tiles jobs-slider flex flex-nowrap flex-justify-between flex-align-stretch flex-wrap">'.$slider.'</div>';
    
}	


if(!empty($tmp))
  $content .= '<div class="block-text flex flex-justify-center flex-column flex-align-center flex-direction-column"><div class="inner-jobs">'.$tmp.'</div></div>';


if(!empty($image = get_field('jobs_background'))){
  $n = nr_image_url($image);			
  $content .= '<div class="block-image"><div class="image lazy-retina" data-src="'.$n.'"><div class="image-spacer"></div></div></div>';         
}


if(!empty($content)):

  $content = '<div class="columns columns-2 flex flex-justify-start flex-align-stretch">'.$content.'</div>';

 
?>
<section class="section-featured-jobs">
  <div class="container"> 
    <?=$tab?>
    <?=$content?>
  </div>
</section>
<?php endif; ?>