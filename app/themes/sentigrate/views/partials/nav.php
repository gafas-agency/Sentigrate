<?php


global $pagetype;

$args = array('post_type'=>'case','post_status'=>'publish','posts_per_page'=>5,'nopaging'=>true,'orderby'=>'menu_order','order'=>'ASC', 'ignore_sticky_posts'=>1,'fields'=>'ids','no_found_rows'=>true);
add_filter('posts_groupby','__return_false');
$cases = get_posts($args);
remove_filter('posts_groupby','__return_false' );
$counterNav = 0;
$counter=0;
$content = '';
$navcontent= '';
$sliderthumbs = '';
$arraySubNav = [];
$rows='';
$subNavItems= '';
$hasSubnav= '';
$subNavActive= '';
$page_url = site_url().$_SERVER["REQUEST_URI"];
$content .= '<a href="'.get_home_url().'" class="logo">'.file_get_contents(NR_THEME_URL.'/images/logo.svg').'</a>';
//<img src="'. get_template_directory_uri() . '/images/logo.svg"/>
if( have_rows('navigation_sections', 372)){
	if(!empty($data = get_field('navigation_sections', 372))){
	    while( have_rows('navigation_sections', 372) ) : the_row(); 
	    		if(!empty($navItems= get_sub_field('section_items', 372))):	

				$navSectionTitle= get_sub_field('section_title', 372); 
				$navSectionDescription= get_sub_field('section_description', 372);

				foreach ($navItems as $navItem) {
					if(strpos($page_url, $navItem['section_item_link']) !== false){
						$subNavActive = $navItem['section_item_link'];
					}
					$subNavItems .= '<div class="subnav-item"><a href="' . $navItem['section_item_link'] . '"><h4>'. $navItem['section_item_title'] . '<svg class="icon icon-next"><use xlink:href="' . get_site_url() . '/app/themes/sentigrate/images/icons.svg#icon-next"></use></svg></h4><p>' . $navItem['section_item_description'] . '</p></a></div>';
				} 

	    		$navArrayItem = "<div id='subnav-" . $counter . "' class='subnav container flex flex-justify-between flex-align-center'><div class='column'><h3>" . $navSectionTitle . "</h3><p>" . $navSectionDescription . "</p></div><div class='column flex flex-wrap'>" . $subNavItems . "</div></div>";
	    		
	    		array_push($arraySubNav, $navArrayItem);
					
				$counter++;
			endif;
		endwhile;

		$menu = '';
		foreach($data as $item){
			if(!empty($arraySubNav[$counterNav])): $arraySubNavItem = $arraySubNav[$counterNav]; $hasSubnav = 'hasSubnav'; else: $arraySubNavItem =''; $hasSubnav= ''; endif;
			if($hasSubnav != '' && $subNavActive == $page_url): $item['section_url'] = $subNavActive; endif;
			$activeClass = '';
			if($item['section_url'] !== '') {$activeClass = nr_active($item['section_url']);}
			$menu .= '<li><a class="' . $hasSubnav .' '. $activeClass . '" href="'.$item['section_url'].'" data-target="' . $counterNav . '">'.$item['section_title'].'</a>' . $arraySubNavItem . '</li>';
			$counterNav++;										
		}
		
		if(!empty($menu))
		  $content .= '<nav><ul class="menu flex flex-justify-end flex-align-start">'.$menu.'</ul></nav>';
			
	}
}


$content .='<div class="trigger-wrap"><button id="trigger-nav"><span><span></span><span></span><span></span><span></span></span></button></div><a id="extra-nav-button" class="nav-contact" href="'.get_the_permalink(NR_PID_CONTACT).'">'.get_the_title(NR_PID_CONTACT).'</a>';


$class = ($pagetype == 'about') ? ' class="solid"' : ''; 
	
?>	
	<header<?=$class?>>
		<div class="container flex flex-justify-between flex-align-center padding-left-s">
			<?=$content?>
		</div>		
	</header>
	<?php
	$first_row_section_title= '';
	if( have_rows('navigation_sections', 372)):
		$rows = get_field('navigation_sections', 372); // get all the rows
		$first_row = $rows[0]; // get the first row
		$first_row_section_title = $first_row['section_title']; // get the sub field value 
	endif;
	?>
	<div class="mobile-menu">
		<div class="menu__inner">
			<div class="menu__close"> 
				<button class="button button--close js-menu-button-close">
					<div class="button__inner">
						<i class="icon icon--close">
							<svg width="12" height="12" viewBox="0 0 12 12" xmlns="http://www.w3.org/2000/svg">
								<path d="M7.414 6l3.536 3.536a1 1 0 1 1-1.414 1.414L6 7.414 2.464 10.95A1 1 0 1 1 1.05 9.536L4.586 6 1.05 2.464A1 1 0 0 1 2.464 1.05L6 4.586 9.536 1.05a1 1 0 0 1 1.414 1.414L7.414 6z" fill="#455260" fill-rule="evenodd"></path>
							</svg>
						</i>
					</div>
				</button>
			</div>
			<section class="menu-solution-list">
				<div class="menu__label"><?php echo $rows[0]['section_title']; ?></div>
			<ul>
				<?php  if(!empty($data = nr_get_solutions())){ 
					foreach($data as $item){
						$icon = '<span class="graphic transition-bg-border mobile-nav-icon">'.nr_svgicon(nr_anchor(get_the_title($item))).'</span>';
						echo "<li><a href='". get_the_permalink($item) . "'>". $icon . get_the_title($item) . "</a><span class='next'><svg class='icon icon-next'><use xlink:href='" . get_site_url() . "/app/themes/sentigrate/images/icons.svg#icon-next'></use></svg></span></li>";
					}
				} ?>
			</ul>
			</section>
			<?php
			$sliderthumbs = '';
			$count = 0;

			foreach($cases as $case){
				$link = get_the_permalink($case);
				$thumbs_tmp = '';
			    if(!empty($img = get_field('hero_background',$case))){
			    	$n = nr_image_url($img);		
					$background = ' data-src="'.$n.'"';
					 if(!empty($data = get_the_title($case))){
						$thumbs_tmp .= '<div class="image"><div class="lazy-retina"'.$background.'><p class="title">'.$data.'</p></div></div>';	
					}    
			    }
			    if(!empty($thumbs_tmp)){
			      $thumbs_tmp = '<div class="slide"><a href="'.$link.'">'.$thumbs_tmp.'</a></div>';
			      $sliderthumbs .= $thumbs_tmp;
			    }  
			}
			if(!empty($sliderthumbs)){
    			$navcontent .= '<div class="slider-thumbnails"><div class="container padding-left-s"><div class="mobile-slides">'.$sliderthumbs.'</div></div></div>'; 
			}
			if(!empty($navcontent)):?>
			<section class="section-cases">
			<?php if( have_rows('navigation_sections', 372)): ?>
			  <div class="menu__label"><?php echo $rows[1]['section_title']; ?></div>
			 <?php endif; ?>
			  <?=$navcontent?> 
			  <div class='overview-link'><a href="<?php echo $rows[1]['section_url'];?>">View all use cases <span class='next'><svg class='icon icon-next'><use xlink:href="<?php echo get_site_url();?>/app/themes/sentigrate/images/icons.svg#icon-next"></use></svg></span></a></div>
			</section> 
			<?php endif;?> 	
			<section class="menu-navigation-list">
				<ul class="mobile-nav">
					<?php
					if( have_rows('navigation_sections', 372)):
						//$rows = get_field('navigation_sections', 372); // get all the rows
					endif;
						for ($x = 2; $x < 4; $x++) {
						   echo "<li><a href='" . $rows[$x]['section_url'] . "'>" . $rows[$x]['section_title'] . "</a></li>";
						} 
					?>
				</ul>
			</section>
			<div class="menu-contact">
				<?php if( have_rows('navigation_sections', 372)):
						//$rows = get_field('navigation_sections', 372); // get all the rows
					endif; ?>
				<a href="<?php echo $rows[4]['section_url']; ?>"><?php echo $rows[4]['section_title']; ?></a>
			</div>
		</div>
	</div>
	<div class="site-overlay"></div>