<?php
/**
 * Prevent caching of js & css files - increase number after changing one of the files 
 *
 */

define('NR_VERSION', '55');	


/**
 * File Security Check
 *
 */
 
if(!defined('ABSPATH')){ exit; }	
//if($_SERVER['REQUEST_URI'] != '/admin/' && $_SERVER['REQUEST_URI'] != '/admin' && !is_admin() && !in_array($GLOBALS['pagenow'], array('wp-login.php','wp-register.php')) && !is_user_logged_in()){ exit; }


/**
 * Sets up theme defaults and registers support for various features.
 *
 */ 
 
function nr_setup() {
	
	//NR_SITE_URL
	define('NR_THEME_URL', get_template_directory_uri());
	
	// ID's of the main pages
	define('NR_PID_HOME',	   2);
	define('NR_PID_ABOUT',	 26);
	define('NR_PID_CONTACT', 3);
  define('NR_PID_JOBS',	   34);
  define('NR_PID_NEWS',	   167);
  define('NR_PID_CASES',	 33);
  	
 	// add menu
	register_nav_menus(array('main'=>'main'));
	 	
	// add imagesizes
	
	//add_image_size('thumb_n', 220, 220, true);
	//add_image_size('thumb_r', 440, 440, true);
	
	//add_image_size('extrasmall', 450, 900);
	//add_image_size('small', 600, 1200);
	//add_image_size('smallplus', 660, 1320);
	// medium : 1200, 2400
	//add_image_size('mediumplus', 1320, 2640);
	// large : 1440, 2880
	//add_image_size('extralarge', 2880, 3000);	
	
  if(function_exists('acf_add_options_page')) { acf_add_options_page(array('page_title'=>'Common Parts','menu_title'=>'Common Parts','common-parts'=>'settings','capability'=>'edit_posts','redirect'=>false)); }	

}
add_action( 'after_setup_theme', 'nr_setup' );


/**
 * define the page type
 *
 */
 
function nr_set_pagetype(){
		
	if(!is_admin() && $_SERVER['REQUEST_URI'] != '/admin/' && $_SERVER['REQUEST_URI'] != '/admin'){
	
		global $post;
		global $pagetype;
		
		$pagetype = false;
					
		if(is_front_page()){
			
			$pagetype = 'home';
			
		}
		else if(is_page()){
						
			$pagetypes = array(NR_PID_HOME=>'home',NR_PID_CONTACT=>'contact',NR_PID_JOBS=>'jobs',NR_PID_ABOUT=>'about',NR_PID_NEWS=>'news',NR_PID_CASES=>'cases');
			if(array_key_exists($post->ID,$pagetypes))
			  $pagetype = $pagetypes[''.$post->ID.''];	
			else if(get_post_meta($post->ID,'_wp_page_template',true) == 'template-solution.php')
				$pagetype = 'solution'; 
			else if(get_post_meta($post->ID,'_wp_page_template',true) == 'template-custompage.php')
				$pagetype = 'custompage'; 			
		}
		else if(is_single()){
								
			$pagetype = $post->post_type;
		
		}
		else if(is_category() || is_tag() || is_author() || is_search() || is_attachment()){
		
			$pagetype = 'redirect';
		
		}
		
		if($pagetype == 'post' || $pagetype == 'redirect'){							
			header("HTTP/1.1 301 Moved Permanently");
			header("Location: ".get_home_url());
			exit();
 
		}
	}
	
}
add_action('wp', 'nr_set_pagetype');	

/**
 *	custom post types
 *
 */

function nr_custom_post_type_labels($single, $plural) {
$labels = array('name' => _x(ucfirst($plural), 'post type general name'),'singular_name' => _x(ucfirst($single), 'post type singular name'),'add_new' => _x('Add New', $single),'add_new_item' => __('Add '.$single),'edit_item' => __('Edit '.$single),'new_item' => __('New '.$single),'view_item' => __('View '.$single),'search_items' => __('Search '.$plural), 'not_found' =>  __('Nothing found'), 'not_found_in_trash' => __('Nothing found in Trash'), 'parent_item_colon' => '');
return $labels;
}

function nr_custom_post_types() {
		
	// case
	$args = array(
		'labels' => nr_custom_post_type_labels('case','cases'),
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'query_var' => true,
		'exclude_from_search' => false,
		'rewrite' => array( 'slug' => 'use-cases', 'with_front' => false ),
		'capability_type' => 'page',
		'hierarchical' => false,
		'menu_position' => 20,
		'menu_icon' => 'dashicons-portfolio',
		'supports' => array('title', 'page-attributes'),
		'has_archive' => false
	  );
	register_post_type('case',$args);
		
	// article
	$args = array(
		'labels' => nr_custom_post_type_labels('article','articles'),
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'query_var' => true,
		'exclude_from_search' => false,
		'rewrite' => array( 'slug' => 'news', 'with_front' => false ),
		'capability_type' => 'page',
		'hierarchical' => false,
		'menu_position' => 21,
		'menu_icon' => 'dashicons-format-aside',
		'supports' => array('title'),
		'has_archive' => false
	  );
	register_post_type('article',$args);
		
	// job
	$args = array(
		'labels' => nr_custom_post_type_labels('job','jobs'),
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'query_var' => true,
		'exclude_from_search' => false,
		'rewrite' => array( 'slug' => 'careers', 'with_front' => false ),
		'capability_type' => 'page',
		'hierarchical' => false,
		'menu_position' => 21,
		'menu_icon' => 'dashicons-id-alt',
		'supports' => array('title', 'page-attributes'),
		'has_archive' => false
	  );
	register_post_type('job',$args);

	// nav
	$args = array(
		'labels' => nr_custom_post_type_labels('navigation-item','navigations'),
		'public' => true,
		'publicly_queryable' => false,
		'show_ui' => true,
		'query_var' => true,
		'exclude_from_search' => true,
		'rewrite' => false,
		'capability_type' => 'page',
		'hierarchical' => false,
		'menu_position' => 22,
		'menu_icon' => 'dashicons-editor-justify',
		'supports' => array('title', 'page-attributes'),
		'has_archive' => false
	  );
	register_post_type('navigation',$args);

}
add_action( 'init', 'nr_custom_post_types' );



/**
 * helper functions
 *
 */

function nr_dump($obj) { echo('<pre>'); print_r($obj); echo('</pre>'); } 

function nr_string($string){ return get_field('str_'.$string,'option'); }

function nr_svgicon($icon){	return '<svg class="icon icon-'.$icon.'"><use xlink:href="'.NR_THEME_URL.'/images/icons.svg#icon-'.$icon.'"></use></svg>'; }

function nr_image_placeholder(){ return 'data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw=='; }

function nr_anchor($title){ return strtolower(sanitize_file_name($title)); }

function nr_remove_p_tags($data){ return str_replace(array('<p>','</p>'),'', $data); }

function nr_title_label_dots($label,$class=''){ $class = (!empty($class)) ? ' '.$class : '' ; return  '<span class="title-label with-dots'.$class.'"><span><span class="dots"></span>'.$label.'</span></span>'; }

function nr_tab($label,$align){ 
  $anchor = nr_anchor($label);
  $tab = '<div class="tab tab-'.$align.'" id="'.$anchor.'"><a href="#'.$anchor.'" class="tab-trigger flex flex-justify-between flex-align-center padding-left-c-1 padding-right-c-1"><p>'.$label.'</p>'.nr_svgicon('arrow-down').'</a></div>';
  return $tab;
}

function nr_button($label,$link,$class,$target='',$icon=''){
	$class = (!empty($class)) ? ' '.$class : '';
	$target = (!empty($target)) ? ' target="_blank" rel="noopener"' : '';
	$icon = (!empty($icon)) ? nr_svgicon($icon) : '';
		
	$button = '<a href="'.$link.'" class="button'.$class.'"'.$target.'>'.$label.'</a>';
	return $button;
}

function nr_active($item_url){
	$page_url = site_url().$_SERVER["REQUEST_URI"];
	if($item_url == get_home_url().'/'){	
		if($item_url == $page_url) return ' active';
	}
	else {
		$strpos = strpos($page_url, $item_url);
		if($strpos !== false && $strpos == 0) return ' active';
	}		
}

function nr_image_url($object,$size=false) {
	
	if($object == false) return false;
	
	if($size !== false && isset($object['sizes'][$size]) &&  $object['sizes'][$size] != ''){
		return $object['sizes'][$size];
	}
	else{
		return $object['url'];
	} 
			
}

function nr_image_ratio($object,$size=false) {
	
	if($object == false) return '';
	
	if($size !== false && isset($object['sizes'][$size]) &&  $object['sizes'][$size] != ''){
		return 100*$object['sizes'][$size.'-height']/$object['sizes'][$size.'-width'].'%';
	}
	else{
		return 100*$object['height']/$object['width'].'%';
	} 
}

function nr_get_solutions(){
$args = array('post_type'=>'page','post_status'=>'publish','posts_per_page'=>-1,'nopaging'=>true,'orderby'=>'menu_order','order'=>'ASC', 'ignore_sticky_posts'=>1,'fields'=>'ids','meta_key'=>'_wp_page_template', 'meta_value'=>'template-solution.php','no_found_rows'=>true);
add_filter('posts_groupby','__return_false');
$data = get_posts($args);
remove_filter('posts_groupby','__return_false' );
return $data;
}


/**
 * enqueue scripts and styles 
 *
 */

function nr_load_scripts() {

  wp_dequeue_style('wp-block-library');
  wp_dequeue_style('wp-block-library-theme');

	wp_enqueue_style('main', NR_THEME_URL.'/app.css', false, NR_VERSION);
	wp_enqueue_style('fonts', 'https://fast.fonts.net/t/1.css?apiType=css&projectid=e0897766-a751-4fd7-89ea-7081fe24868a', false,null);

	wp_deregister_script('jquery');
	wp_deregister_script('wp-embed');

	wp_register_script('jquery', NR_THEME_URL.'/js/jquery-3.3.1.min.js',null,null,true);  
	wp_enqueue_script('jquery');
									
	wp_register_script('plugins', NR_THEME_URL.'/js/plugins.js','jquery',NR_VERSION,true);  
	wp_enqueue_script('plugins');	
	
	wp_register_script('site', NR_THEME_URL.'/js/site.js',array('jquery','plugins'),NR_VERSION,true);  
	wp_enqueue_script('site');
			
}
add_action( 'wp_enqueue_scripts', 'nr_load_scripts' );


/**
 * customize wp-login 
 *
 */

function nr_login_logo() { $nr_login_logo = '<style type="text/css">h1 a { width: auto !important; background-image:url('.NR_THEME_URL.'/images/admin/logo.svg) !important; background-repeat: no-repeat; background-position: center center !important; background-size: 162px 40px !important; height: 40px !important; } .login #backtoblog a:focus, .login nav a:focus, .login h1 a:focus { -webkit-box-shadow: none; box-shadow: none; }</style>'; echo $nr_login_logo; }
add_action('login_head', 'nr_login_logo');

function nr_login_headerurl() { return NR_SITE_URL; }
add_filter('login_headerurl', 'nr_login_headerurl');

function nr_login_headertitle() { }
add_filter('login_headertitle', 'nr_login_headertitle');  

function nr_login_errors() { return 'Wrong credentials'; }     
add_filter('login_errors', 'nr_login_errors');




/**
 * Customize the admin area
 *
 */

function nr_rocket_for_editor($capability) { if(current_user_can('editor')) { return 'editor'; } return $capability; }
add_filter( 'rocket_capacity', 'nr_rocket_for_editor' );
 

add_filter('acf/settings/remove_wp_meta_box', '__return_true'); 

add_filter( 'tiny_mce_before_init', function( $settings ){
	$settings['block_formats'] = 'Paragraph=p;Subtitle=h2;';
	return $settings;
} ); 
 
function nr_acf_toolbars($toolbars){	
	$toolbars['Headings' ] = array();
	$toolbars['Headings' ][1] = array('formatselect','bold','italic','undo','redo','link','unlink','fullscreen');
	$toolbars['Headings with list' ] = array();
	$toolbars['Headings with list' ][1] = array('formatselect','bold','italic','bullist','undo','redo','link','unlink','fullscreen');
  $toolbars['Lists' ][1] = array('bold','italic','bullist','numlist','undo','redo','link','unlink','fullscreen');	
	$toolbars['Basic' ][1] = array('bold','italic','bullist','undo','redo','link','unlink','fullscreen');
	$toolbars['Minimal' ] = array();
	$toolbars['Minimal' ][1] = array('bold','italic','undo','redo','link','unlink','fullscreen');
	return $toolbars;
}
add_filter( 'acf/fields/wysiwyg/toolbars' , 'nr_acf_toolbars');

 
function nr_admin_css() {

    global $current_user;
	$nr_css = '<style type="text/css">';
	
	// remove some elements for normal users
	if($current_user->ID != 1 && $current_user->ID != 2 && $current_user->ID != 4) $nr_css .= '#toplevel_page_edit-post_type-acf, .update-nag, #pageparentdiv, #toplevel_page_edit-post_type-acf-field-group, #menu-tools, #wp-admin-bar-rocket-settings { display:none !important; }';
	
      
	// remove some admin bar buttons & change the footer	
    $nr_css .= '#wp-admin-bar-wp-logo, #wp-admin-bar-new-content, #wp-admin-bar-comments, #wp-admin-bar-updates, #contextual-help-link-wrap {display:none;} #footer p {padding:0px;} #header-logo { width:0px !important; } #wpfooter p {line-height:10px;} #wp-admin-bar-wp-logo, #wp-admin-bar-updates, #wp-admin-bar-comments, #wp-admin-bar-new-content, #dashboard_right_now .post-count { display:none !important; }';    
     
  // hide the standard body field & page attributes
  $nr_css .= '#postdivrich { display:none } ';  
  
  $nr_css .= '.imagify-settings.imagify-bulk .imagify-col.imagify-account-info-col, .imagify-rkt-notice, .imagify-notice.below-h2, .media_page_imagify-bulk-optimization #intercom-container, .imagify-title, .error.imagify-notice.below-h2, .imagify-section.imagify-section-positive {display:none !important;} ';
    
  // remove weak password option & add new page button
  $nr_css .= '.pw-weak { display: none !important; } '; 
     
    // wp rocket
	$nr_css .= '#wp-admin-bar-wp-rocket #wp-admin-bar-faq, #wp-admin-bar-wp-rocket #wp-admin-bar-support, #wp-admin-bar-wp-rocket #wp-admin-bar-docs, #wp-admin-bar-wp-rocket #wp-admin-bar-rocket-settings  {display:none;} #wp-admin-bar-wp-rocket > a {  width: 42px; white-space: nowrap; display: inline-block; overflow: hidden; text-indent: -100px; }	#wp-admin-bar-wp-rocket > a:after { display:block; position: absolute; top: 0; left: 10px; content:"Cache"; display:inline-block; margin: 0; text-indent: 0; float: left;}';
  
  // nested pages
  $nr_css .= '.nestedpages-listing-title .open-bulk-modal.page-title-action { display: none; } ';    
      
  // remove margin when no label is used   
  $nr_css .= '.nr-acf-label-hide > .acf-label { display: none; } ';   
    
  // hide some action buttons in the listing of items	
	$nr_css .= '#the-list .row-actions .edit_as_new_draft, #the-list .row-actions .trash, #the-list .row-actions .inline.hide-if-no-js, #the-list .row-actions .rocket_purge, #major-publishing-actions #duplicate-action, #major-publishing-actions #purge-action, #rocket_post_exclude, #xmlsf_section, #visibility.misc-pub-section.misc-pub-visibility { display: none !important } ';
    
  // add styling for message titles 
  $nr_css .= '.nr-acf-label-title > .acf-label { font-weight: 700; padding-bottom: 0 !important; text-transform: uppercase; }'; 
 
	// limit height of acf gallery
	$nr_css .= '.nr-gallery-small .acf-gallery { height: 220px !important }';
  
  // limit height of a acf wysiwyg: single row, tiny or small
  $nr_css .= '.nr-small-wysiwyg .acf-editor-wrap .mce-tinymce.mce-container iframe { max-height: 154px; min-height:auto; } ';
  $nr_css .= '.nr-tiny-wysiwyg .acf-editor-wrap .mce-tinymce.mce-container iframe { max-height: 80px; min-height:auto; } '; 
  $nr_css .= '.nr-tiny-wysiwyg { min-height: auto !important}' ;
  $nr_css .= '.nr-single-wysiwyg .acf-editor-wrap .mce-tinymce.mce-container iframe { max-height: 60px; min-height:auto; }'; 
  $nr_css .= '.nr-small-wysiwyg .acf-editor-wrap .mce-tinymce.mce-container.mce-fullscreen iframe, .nr-tiny-wysiwyg .acf-editor-wrap .mce-tinymce.mce-container.mce-fullscreen iframe { max-height: 5000px !important; }';    
    
  $nr_css .= '.nr-grid-focus { display: inline-block; width: 40px; height: 20px; margin: 4px 4px 4px 0; background-position: center center; background-size: 40px 20px; background-repeat: no-repeat; vertical-align: middle; } .nr-grid-focus-1 { background-image: url("'.NR_THEME_URL.'/images/admin/focus-01.svg"); } .nr-grid-focus-2 { background-image: url("'.NR_THEME_URL.'/images/admin/focus-02.svg"); } .nr-grid-focus-3 { background-image: url("'.NR_THEME_URL.'/images/admin/focus-03.svg"); } .nr-grid-focus-4 { background-image: url("'.NR_THEME_URL.'/images/admin/focus-04.svg"); } .nr-grid-focus-5 { background-image: url("'.NR_THEME_URL.'/images/admin/focus-05.svg"); } .nr-grid-focus-6 { background-image: url("'.NR_THEME_URL.'/images/admin/focus-06.svg"); } .nr-grid-focus-7 { background-image: url("'.NR_THEME_URL.'/images/admin/focus-07.svg"); } .nr-grid-focus-8 { background-image: url("'.NR_THEME_URL.'/images/admin/focus-08.svg"); } .nr-grid-focus-9 { background-image: url("'.NR_THEME_URL.'/images/admin/focus-09.svg"); }';   
    
  $nr_css .= '.nr-grid-color { display: inline-block; width: 20px; height: 20px; margin: 4px 4px 4px 0; vertical-align: middle; border: 1px solid #d4d4d4; box-sizing: border-box; }';
            
  // radiobuttons with custom svg icons
  $nr_css .= '.nr-ii { display: inline-block; width: 30px; height: 30px; margin: 6px 6px 6px 2px; fill: currentColor; vertical-align: middle; } '  ;    
     
  $nr_css .= '</style>';    
  echo $nr_css;
} 
add_filter('admin_head', 'nr_admin_css');

function nr_admin_footer_text() { }
add_filter('admin_footer_text','nr_admin_footer_text');

function nr_admin_title($admin_title, $title) {	return $title.' - CMS '.get_bloginfo('name'); }
add_filter('admin_title', 'nr_admin_title', 10, 2);

function nr_howdy($wp_admin_bar){ global $current_user; $wp_admin_bar->add_node(array('id'=>'my-account','title'=> $current_user->display_name)); }
add_filter('admin_bar_menu', 'nr_howdy',25);

function nr_remove_columns($defaults) { unset($defaults['comments']); unset($defaults['date']); return $defaults; }
add_filter('manage_pages_columns', 'nr_remove_columns');

function nr_remove_media_columns($defaults) { unset($defaults['comments']); return $defaults; }
add_filter('manage_media_columns', 'nr_remove_media_columns');

function nr_footer_version() { return ''; }
add_filter( 'update_footer', 'nr_footer_version', 9999);

add_filter('the_generator', 'nr_the_generator'); function nr_the_generator() { return ''; }
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('admin_print_scripts', 'print_emoji_detection_script');
remove_action('wp_print_styles', 'print_emoji_styles');
remove_action('admin_print_styles', 'print_emoji_styles');
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'feed_links', 2 );
remove_action('wp_head', 'feed_links_extra', 3 );
remove_action('wp_head', 'start_post_rel_link', 10, 0 );
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0 );
remove_action('wp_head', 'rest_output_link_wp_head');
remove_action('wp_head', 'wp_oembed_add_discovery_links');
remove_action('template_redirect', 'rest_output_link_header', 11, 0 );
add_filter( 'emoji_svg_url', '__return_false' );


function nr_remove_menus(){
	
	global $current_user; 
	global $submenu;
		
	remove_menu_page('edit.php'); 
	remove_menu_page('edit-comments.php'); 
			
	// remove theme customize
	unset($submenu['themes.php'][6]);
	
	//remove media submenus
	remove_submenu_page('upload.php','media-new.php');
	
	//remove add new from submenu
	remove_submenu_page('edit.php?post_type=page','post-new.php?post_type=page');
	
	//remove plugins submenu
	remove_submenu_page('plugins.php','plugin-install.php');
			
	if($current_user->ID != 1 && $current_user->ID != 2 && $current_user->ID != 4){ 
		
		remove_menu_page('themes.php'); 
		remove_menu_page('users.php'); 
		remove_menu_page('options-general.php'); 
		remove_menu_page('tools.php');
		remove_menu_page('plugins.php');
				
		//remove update & home link
		remove_submenu_page('index.php','update-core.php');
		remove_submenu_page('index.php','index.php');

	}
	
}
add_action('admin_menu', 'nr_remove_menus',999);