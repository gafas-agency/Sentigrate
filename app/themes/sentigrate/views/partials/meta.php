<?php


$sitename = get_option('blogname');
$tagline = get_option('blogdescription');


$title = get_field('meta_title');

if(empty($title)) 
  if(is_front_page())
    $title = $tagline; 
  else 
    $title = trim(wp_title('',false));  

$title = ucfirst($title).' | '.$sitename;

	
$description = get_field('meta_description');
if(empty($description)) $description = get_field('meta_description','option');
$shortdescription = get_field('meta_short_description');
if(empty($shortdescription)) $shortdescription = $description;


$image = get_field('meta_image');
if(empty($image))
  $image = get_field('meta_image','option');


?><meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta charset="UTF-8">
<title><?=$title?></title>
<meta property="og:url" content="<?=NR_SITE_URL.$_SERVER["REQUEST_URI"]?>">
<meta property="og:type" content="website">
<meta property="og:title" content="<?=$title?>">
<meta property="og:image" content="<?=$image?>">
<meta property="og:description" content="<?=$description?>">
<meta property="og:site_name" content="<?=$sitename?>">
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="<?=$title?>">
<meta name="twitter:description" content="<?=$shortdescription?>">
<meta name="twitter:image" content="<?=$image?>">	
<meta name="description" content="<?=$description?>" />
<meta itemprop="name" content="<?=$title?>">
<meta itemprop="description" content="<?=$description?>">
<meta itemprop="image" content="<?=$image?>">
<link rel="apple-touch-icon" sizes="57x57" href="<?=NR_THEME_URL?>/images/icons/apple-touch-icon-57x57.png">
<link rel="apple-touch-icon" sizes="60x60" href="<?=NR_THEME_URL?>/images/icons/apple-touch-icon-60x60.png">
<link rel="apple-touch-icon" sizes="72x72" href="<?=NR_THEME_URL?>/images/icons/apple-touch-icon-72x72.png">
<link rel="apple-touch-icon" sizes="76x76" href="<?=NR_THEME_URL?>/images/icons/apple-touch-icon-76x76.png">
<link rel="apple-touch-icon" sizes="114x114" href="<?=NR_THEME_URL?>/images/icons/apple-touch-icon-114x114.png">
<link rel="apple-touch-icon" sizes="120x120" href="<?=NR_THEME_URL?>/images/icons/apple-touch-icon-120x120.png">
<link rel="apple-touch-icon" sizes="144x144" href="<?=NR_THEME_URL?>/images/icons/apple-touch-icon-144x144.png">
<link rel="apple-touch-icon" sizes="152x152" href="<?=NR_THEME_URL?>/images/icons/apple-touch-icon-152x152.png">
<link rel="apple-touch-icon" sizes="180x180" href="<?=NR_THEME_URL?>/images/icons/apple-touch-icon-180x180.png">
<link rel="icon" type="image/png" href="<?=NR_THEME_URL?>/images/icons/favicon-16x16.png" sizes="16x16">
<link rel="icon" type="image/png" href="<?=NR_THEME_URL?>/images/icons/favicon-32x32.png" sizes="32x32">
<link rel="icon" type="image/png" href="<?=NR_THEME_URL?>/images/icons/favicon-96x96.png" sizes="96x96">
<link rel="icon" type="image/png" href="<?=NR_THEME_URL?>/images/icons/android-chrome-192x192.png" sizes="192x192">
<meta name="msapplication-square70x70logo" content="<?=NR_THEME_URL?>/images/icons/smalltile.png">
<meta name="msapplication-square150x150logo" content="<?=NR_THEME_URL?>/images/icons/mediumtile.png">
<meta name="msapplication-wide310x150logo" content="<?=NR_THEME_URL?>/images/icons/widetile.png">
<meta name="msapplication-square310x310logo" content="<?=NR_THEME_URL?>/images/icons/largetile.png">
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1">
<meta content="telephone=no" name="format-detection">