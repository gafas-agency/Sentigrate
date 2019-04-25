<?php

global $contentblock;

if(!empty($blocks = get_field('content_blocks'))){
  
  foreach($blocks as $block){
    $contentblock = $block;
    get_template_part('views/blocks/'.$block['acf_fc_layout']);  
  }  

}

?>