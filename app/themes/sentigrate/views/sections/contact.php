<?php


$content = '';



$tmp = '';

if(!empty($label = get_field('contact_phone_label')) && !empty($value = get_field('contact_phone_value')))
  $tmp .= '<li class="tile padding-left-cg-1"><h2 class="tile-label">'.$label.'</h2><p class="tile-text"><a class="transition-color" href="tel:'.str_replace(array('(0)',' '),'',$value).'">'.$value.'</a></p></li>';
  
if(!empty($label = get_field('contact_email_label')) && !empty($value = get_field('contact_email_value')))
  $tmp .= '<li class="tile padding-left-cg-1"><h2 class="tile-label">'.$label.'</h2><p class="tile-text"><a class="transition-color" href="mailto:'.$value.'">'.$value.'</a></p></li>';

if(!empty($label = get_field('contact_address_label')) && !empty($value = get_field('contact_address_value'))){

  if(!empty($link = get_field('contact_address_directions')))
    $value = '<a class="transition-color" href="'.$link.'" target="_blank" rel="noopener">'.$value.'</a>';       
    
  $tmp .= '<li class="tile padding-left-cg-1"><h2 class="tile-label">'.$label.'</h2><p class="tile-text">'.$value.'</p></li>'; 

}

if(!empty($label = get_field('contact_socialmedia_label')) && !empty($value = get_field('contact_socialmedia_items'))){
  
  $items = '';
  
  foreach($value as $item)  
    $items .= '<li><a class="transition-color" href="'.$item['link'].'" target="_blank" rel="noopener">'.nr_svgicon($item['network']).'</a></li>';
    
  if(!empty($items)) 
    $items = '<ul class="socialmedia flex flex-justify-start flex-align-start">'.$items.'</ul>';

  $tmp .= '<li class="tile padding-left-cg-1"><h2 class="tile-label">'.$label.'</h2>'.$items.'</li>'; 

}

  
if(!empty($tmp))
  $content = '<div class="row"><ul class="tiles tiles-combined flex flex-justify-start flex-align-stretch flex-wrap">'.$tmp.'</ul></div>';
 

?>
<section class="section-contact background-blue">
  <div class="container padding-left-s-cg-1 padding-right-s-cg-1"> 
    <?=$content?>
  </div>
</section>