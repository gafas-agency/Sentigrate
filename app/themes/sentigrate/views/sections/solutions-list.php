<?php


$content = '';
$tab = '';


if(!empty($data = get_field('solutions_tab')))
  $tab = nr_tab($data,'left');


$tmp = '';

if(!empty($data = get_field('solutions_label')))
  $tmp .= nr_title_label_dots($data);

if(!empty($data = get_field('solutions_title')))
  $tmp .= '<h2 class="title-section">'.$data.'</h2>';
  
if(!empty($data = get_field('solutions_description')))
  $tmp .= '<div class="content">'.$data.'</div>';

$tmp.= '<a class="button button-next" href="'.get_the_permalink(NR_PID_CASES).'">View our use cases <span>'.nr_svgicon('next').'</span></a>';

$content .= '<div class="column column-text">'.$tmp.'</div>';


if(!empty($data = nr_get_solutions())){
	
	$tmp = '';
  $button = '<span class="next">'.nr_svgicon('next').'</span>';
	
	foreach($data as $item){
	  $title = get_the_title($item);
	  $icon = '<span class="graphic transition-bg-border">'.nr_svgicon(nr_anchor($title)).'</span>';            
    $tmp .= '<li><a href="'.get_the_permalink($item).'">'.$icon.'<h3>'.$title.'</h3><div class="content"><p class="transition-color">'.get_field('solution_summary',$item).'</p></div>'.$button.'</a></li>';    
	}
	
	if(!empty($tmp))
	  $content .= '<div class="column column-list"><ul class="solutions-list">'.$tmp.'</ul></div>';		

}	


if(!empty($content)) 
  $content = '<div class="columns columns-2 flex flex-justify-between flex-align-start padding-left-cg-1 padding-right-cg-1">'.$content.'</div>'; 

 
?>
<section class="section-solutions-list">
  <div class="container padding-left-s padding-right-s"> 
    <?=$tab?>
    <?=$content?>
  </div>
</section>