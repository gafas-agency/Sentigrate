<?php


$content = '';
$backbutton = '';

$tmp = '';
$tmp .= nr_title_label_dots(nr_string('job_opening'),'center');
$tmp .= get_the_title();
if(!empty($tmp)){
  $content .= '<h1 class="title-page">'.$tmp.'</h1>';
  $content = '<div class="row row-header">'.$content.'</div>';
} 

$backbutton .= '<a href="'.get_the_permalink(NR_PID_JOBS).'" class="backlink button button-icon button-icon-large button-icon-left"><span>'.nr_svgicon('previous').'</span>'.get_the_title(NR_PID_JOBS).'</a>';


?>
<section class="section-hero section-hero-job flex flex-direction-column">
  <div class="container flex flex-direction-column flex-justify-center flex-align-center padding-left-s padding-right-s">
    <span class="flex flex-direction-column flex-justify-center flex-align-center">   
     <?=$content?>
    </span>
  </div>
  <?=$backbutton?>
</section>


<?php


$content = '';


if(!empty($data = get_field('job_introduction')))
  $content .= '<div class="content content-introduction">'.$data.'</div>';
  
if(!empty($data = get_field('job_description')))
  $content .= '<div class="content">'.$data.'</div>';
  
   
?>
<section class="section-job">
  <div class="container padding-left-s padding-right-s"> 
    <?=$content?>
  </div>
</section>