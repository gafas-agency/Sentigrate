<?php

global $pagetype;

?><!DOCTYPE html>
<html lang="en">
<head>
<?php get_template_part('views/partials/meta'); ?>	
<?php wp_head()?>
</head>

 <body class="page-<?=$pagetype?>" data-page-type="<?=$pagetype?>" data-theme-url="<?=NR_THEME_URL?>">
  
  <?php get_template_part('views/partials/nav'); ?>