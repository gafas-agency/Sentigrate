<?php


global $pagetype;

$class = '';
$content = '';


if($pagetype == 'about')
  $class = ' section-featured-articles-white';


$args = array('post_type'=>'article','post_status'=>'publish','posts_per_page'=>3,'orderby'=>'date','order'=>'DESC','ignore_sticky_posts'=>1,'fields'=>'ids','no_found_rows'=>true);
add_filter('posts_groupby','__return_false');
$data = get_posts($args);
remove_filter('posts_groupby','__return_false' );
if(!empty($data)){
	
  $articles = '';
	$labels = array('news'=>nr_string('news','option'), 'event'=>nr_string('event','option'), 'press'=>nr_string('press','option'));
	
	foreach($data as $item){
    $label = '<span class="label">'.$labels[''.get_field('hero_label',$item).''].'</span>';   
    $title = '<h3>'.get_the_title($item).'</h3>';
    $description = '<p>'.get_field('article_summary',$item).'</p>';     
    $link = '<a class="button button-icon" href="'.get_the_permalink($item).'">'.nr_string('read_article').'<span>'.nr_svgicon('next').'</span></a>';
    $articles .= '<li class="column"><div class="content">'.$label.$title.$description.'</div>'.$link.'</li>';      
	}
  
  $morebutton = '<li class="column extra-news-button"><a href="'.get_the_permalink(NR_PID_NEWS).'" class="button button-solid button-icon button-white-transparent">'.nr_string('view_more_news').'<span>'.nr_svgicon('next').'</span></a></li>';
	$content .= '<ul class="columns flex flex-direction-row flex-wrap flex-justify-between flex-align-stretch">'.$articles.$morebutton.'</ul>';
	  
}	


if(!empty($content)):
  
  $title = '<h2>'.nr_string('from_the_blog').'</h2>';
  $link = '<a class="button button-next" href="'.get_the_permalink(NR_PID_NEWS).'">'.nr_string('view_more_news').'<span>'.nr_svgicon('next').'</span></a>';
  
  if($pagetype == 'about')
    $content = '<div class="row row-header flex flex-direction-row flex-wrap flex-justify-center flex-align-center">'.$title.'</div>'.$content.'<div class="row row-footer flex flex-direction-row flex-wrap flex-justify-center flex-align-center">'.$link.'</div>';
  else 
    $content = '<div class="row row-header flex flex-direction-row flex-wrap flex-justify-between flex-align-center padding-left-cg-1 padding-right-cg-1">'.$title.$link.'</div>'.$content;
  
   
?>
<section class="section-featured-articles<?=$class?>">
  <div class="container padding-left-s padding-right-s"> 
    <?=$content?>
  </div>
</section>
<?php endif; ?>