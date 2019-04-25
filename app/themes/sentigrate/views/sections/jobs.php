<?php


$content = '';
$tab = '';


if(!empty($data = get_field('jobs_tab')))
  $tab = nr_tab($data,'right');


$tmp = '';

if(!empty($data = get_field('jobs_title')))
  $tmp .= '<h2 class="title-section">'.$data.'</h2>';
  
if(!empty($data = get_field('jobs_description')))
  $tmp .= '<div class="content">'.$data.'</div>';

$content .= '<div class="row row-header">'.$tmp.'</div>';  


$args = array('post_type'=>'job','post_status'=>'publish','fields'=>'ids','posts_per_page'=>-1,'nopaging'=>true,'orderby'=>'menu_order','order'=>'ASC','ignore_sticky_posts'=>1,'fields'=>'ids','no_found_rows'=>true);
add_filter('posts_groupby','__return_false');
$data = get_posts($args);
remove_filter('posts_groupby','__return_false' );

if(!empty($data)){
  
  $tmp = '';
  $button = '<span class="button transition-backgroundcolor">'.nr_svgicon('next').'</span>';
  
	foreach($data as $item)
		$tmp .= '<li class="tile"><a href="'.get_the_permalink($item).'"><h3>'.get_the_title($item).'</h3><div class="content"><p>'.get_field('job_summary',$item).'</p></div></a>'.$button.'</li>';		
  
  if(!empty($tmp))
    $content .= '<div class="row"><ul class="tiles tiles-separate flex flex-justify-between flex-align-stretch flex-wrap">'.$tmp.'</ul></div>';
    
}	
  
  
?>
<section class="section-jobs">
  <div class="container padding-left-s-cg-1 padding-right-s-cg-1"> 
    <?=$tab?>
    <?=$content?>
  </div>
</section>