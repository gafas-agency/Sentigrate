/*
 * copyright 2019 Nice & Robust bvba - https://niceandrobust.be
 *
 */
  

$.nr = $.nr || { };
   
/* document ready... and go! */
 
$(function(){
	
	svg4everybody();
			
	// cache some elements
	$.nr.window = $(window);
	$.nr.themeUrl = $('body').attr('data-theme-url');
	$.nr.pageType = $('body').attr('data-page-type');
	$.nr.windowWidth = getWindowWidth();
	$.nr.scrollOffset = 90;
	$.nr.scrollDelay = 0;
	$.nr.scrollLock = false;	
	$.nr.scrollSticky = 100;
	$.nr.lazyLoad = { };
		
	$.nr.window.on( 'resize', function() { $.nr.windowWidth =  getWindowWidth(); setScrollOffset(); });

	setTimeout(function(){ $('body').addClass('loaded'); }, 240);
	
	setScrollOffset();

  stickyHeader();

	initLazyLoad();
	
	//initScrollMagic();
	
	initAnchors();
	
	initHeroVideo();
	
	initArticleVideos();
	
	toggleMenu();

	toggleSubMenu();
	
	//initForm();
	
	blockSlider();
	
	mobileCasesSlider();

	casesSlider();
	
	featuredCasesSlider();
	
	listSlider();
	
	testimonialsSlider();
	
	jobsSlider();
	
	cultureSlider();
	
});

/* END document ready... and go! */


function cultureSlider(){
	
	var _sliders = $('.culture-slider');
	
	if(_sliders.length > 0 ){   	
  	
  	_sliders.each(function(index){
  			    			  
  		var _slideshow = $(this);
  		var _parent = _slideshow.parent();
  		  
  		var _prev = '<button class="slick-prev slick-arrow" aria-label="Previous" type="button"><svg class="icon icon-previous"><use xlink:href="'+$.nr.themeUrl+'/images/icons.svg#icon-previous"></use></svg></button>';
  		var _next = '<button class="slick-next slick-arrow" aria-label="Next" type="button"><svg class="icon icon-next"><use xlink:href="'+$.nr.themeUrl+'/images/icons.svg#icon-next"></use></svg></button>';
  		  
      _slideshow.slick({slidesToShow: 1, slidesToScroll: 1, pauseOnFocus: true, accessibility:false, arrows:true, appendArrows: _parent, dots: false, infinite: false, swipe:true, speed:400, fade:false, draggable:false, autoplay:false, prevArrow:_prev, nextArrow:_next});	  						 
     
     }); 
	
	}		
	
}

function jobsSlider(){
	
	var _sliders = $('.jobs-slider');
	
	if(_sliders.length > 0 ){   	
  	
  	_sliders.each(function(index){
  			    			  
  		var _slideshow = $(this);
  		  
  		var _prev = '<button class="slick-prev slick-arrow" id="prev_button" aria-label="Previous" type="button"><svg class="icon icon-previous"><use xlink:href="'+$.nr.themeUrl+'/images/icons.svg#icon-previous"></use></svg></button>';
  		var _next = '<button class="slick-next slick-arrow" id="next_button" aria-label="Next" type="button"><svg class="icon icon-next"><use xlink:href="'+$.nr.themeUrl+'/images/icons.svg#icon-next"></use></svg></button>';
  		  
      _slideshow.slick({slidesToShow: 1, slidesToScroll: 1, pauseOnFocus: true, accessibility:false, arrows:true, dots: false, infinite: false, swipe:true, speed:400, fade:false, draggable:true, autoplay:false, prevArrow:_prev, nextArrow:_next});	  						 
     
     }); 
	
	}		

	/* Featured jobs slider custom button functions */
	var slick_track = document.querySelectorAll(".slick-track");
	var margin = 0;
	var step = 0;
	var currentSlide = 1;
	var currentPosition = 0;
	var transition = "transform 400ms ease 0s";

	function translate(){
		return "translate3d(" + currentPosition +"px, 0px,0)";
	}
	function setProps(){
		if (window.innerWidth < 768) margin = 10; else margin = 40; 
		step = document.querySelector(".tile").clientWidth + margin;
	}
	function setPosition(){
		currentPosition = (currentSlide-1) * -step;
		$(slick_track[4]).css("transform", translate);
		$(slick_track[4]).css("transition", transition);
	}

	function prev_job(){
		setProps();
		if(currentSlide>1){
			currentSlide-=1;
		}
		setPosition();
	}

	function next_job(){
		setProps();
		if (currentSlide < document.querySelectorAll(".tile").length){
			currentSlide+=1;
		}
		setPosition();
	}

	window.onresize = function(event) {
		setProps();
		setPosition();
		console.log(currentSlide + "  " + currentPosition + "  " + step);
	}

	/* remove old event listeners and add new function */
	var old_prev_button = document.getElementById("prev_button");
	old_prev_button.parentNode.replaceChild(old_prev_button.cloneNode(true), old_prev_button);
	document.getElementById("prev_button").addEventListener("click", prev_job);

	var old_next_button = document.getElementById("next_button");
	old_next_button.parentNode.replaceChild(old_next_button.cloneNode(true), old_next_button);
	document.getElementById("next_button").addEventListener("click", next_job);
	
}


function testimonialsSlider(){
	
	var _sliders = $('.testimonials-slider');
	
	if(_sliders.length > 0){   	
  	
  	_sliders.each(function(index){
		  
		  var _slideshow = $(this);
		  		  
		  _slideshow.on('beforeChange', function(event, slick, currentSlide, nextSlide){ });							
      _slideshow.slick({slidesToShow: 1, slidesToScroll: 1, pauseOnFocus: true, accessibility:false, arrows:false, dots: true, infinite: true, swipe:true, speed:1000, fade:true, draggable:false, autoplay:false});	  						
	 
	  });	
	}		
}


function featuredCasesSlider(){
	
	var _sliders = $('.featured-cases-slider');
	
	if(_sliders.length > 0){   	
  	
  	_sliders.each(function(index){
		  
		  var _slideshow = $(this);
		  
		  var _prev = '<button class="slick-prev slick-arrow" aria-label="Previous" type="button"><svg class="icon icon-previous"><use xlink:href="'+$.nr.themeUrl+'/images/icons.svg#icon-previous"></use></svg></button>';
		  var _next = '<button class="slick-next slick-arrow" aria-label="Next" type="button"><svg class="icon icon-next"><use xlink:href="'+$.nr.themeUrl+'/images/icons.svg#icon-next"></use></svg></button>';
		  var _counter = _slideshow .parent().find('.slick-counter-current');
		  
		  _slideshow.on('beforeChange', function(event, slick, currentSlide, nextSlide){ 
  		  _counter.fadeOut(250, function(){
          _counter.text(parseInt(nextSlide)+1);
          _counter.fadeIn(250);
        }); 		  
  		});							
    
      _slideshow.slick({slidesToShow: 1, slidesToScroll: 1, pauseOnFocus: true, accessibility:false, arrows:true, dots: false, infinite: true, swipe:true, speed:500, fade:true, draggable:false, autoplay:false, prevArrow:_prev, nextArrow:_next});	  						
	  
	  });	
	}		
}


function listSlider(){
	
	var _sliders = $('.list-slider');
	
	if(_sliders.length > 0){   	
  	
  	_sliders.each(function(index){
		  
		  var _slideshow = $(this).find('.slides');  
		  var _triggers = $(this).find('.solutions-list li a');
			
			var _videos = _slideshow.find('.background-video');
			if(_videos.length > 0){
  			  			
  			_videos.each(function(index){
          var _video = $(this);
          _video.append('<video class="video-bg" autoplay muted playsinline loop poster="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw=="><source src="'+_video.attr('data-video')+'" type="video/mp4"></video>');	        
        });
  		}	
							  
		  _slideshow.on('beforeChange', function(event, slick, currentSlide, nextSlide){ });							
      _slideshow.slick({slidesToShow: 1, slidesToScroll: 1, pauseOnFocus: true, accessibility:false, arrows:false, dots: false, infinite: true, swipe:true, speed:500, fade:true, draggable:false, autoplay:false});	  						
      
      _triggers.on('click', function(){
        
        var _trigger = $(this);
        
        if(!_trigger.hasClass('active')){
          _triggers.removeClass('active');
          _trigger.addClass('active');
          _slideshow.slick('slickGoTo', parseInt(_trigger.attr('data-target')));
        }
        
        return false;
                
      });      
	  
	  });	
	}		
}


function casesSlider(){
	
	var _sliderBackgrounds = $('.section-cases .slider-backgrounds');
  var _sliderThumbnails = $('.section-cases .slider-thumbnails');
	
	if(_sliderBackgrounds.length > 0 && _sliderThumbnails.length > 0){   	
  			    			  
		  var _slideshowBackgrounds = _sliderBackgrounds.find('.slides');
		  var _slideshowThumbnails = _sliderThumbnails.find('.slides');
		  var _triggers = _sliderThumbnails.find('.slide a');
		  
		  var _prev = '<button class="slick-prev slick-arrow" aria-label="Previous" type="button"><svg class="icon icon-previous"><use xlink:href="'+$.nr.themeUrl+'/images/icons.svg#icon-previous"></use></svg></button>';
		  var _next = '<button class="slick-next slick-arrow" aria-label="Next" type="button"><svg class="icon icon-next"><use xlink:href="'+$.nr.themeUrl+'/images/icons.svg#icon-next"></use></svg></button>';
		  
      _slideshowBackgrounds.slick({asNavFor: _slideshowThumbnails, slidesToShow: 1, slidesToScroll: 1, pauseOnFocus: false, accessibility:false, arrows:false, dots: false, infinite: false, swipe:false, speed:1000, fade:true, draggable:false, autoplay:false});
      _slideshowThumbnails.slick({asNavFor: _slideshowBackgrounds, variableWidth: true, slidesToScroll: 1, pauseOnFocus: false, accessibility:false, arrows:true, dots: false, infinite: false, swipe:true, speed:1000, fade:false, draggable:false, autoplay:false, prevArrow:_prev, nextArrow:_next});	  							  				
	
      _triggers.on('click', function(){
        
        var _trigger = $(this);
        
       // if(!_trigger.hasClass('active')){
        
        _slideshowThumbnails.slick('slickGoTo', parseInt(_trigger.attr('data-target')));
              
        return false;
                
      });   
	
	}		
	
}

function mobileCasesSlider(){
	
  var _sliderThumbnails = $('.slider-thumbnails');
	
	if(_sliderThumbnails.length > 0){   	
  			    			  
	 var _slideshowThumbnails = _sliderThumbnails.find('.mobile-slides');

     _slideshowThumbnails.slick({variableWidth: true, slidesToScroll: 1, pauseOnFocus: false, accessibility:false, arrows:true, dots: false, infinite: false, swipe:true, speed:1000, fade:false, draggable:true, autoplay:false, prevArrow:false, nextArrow:false});	  							  				
	
	}		
	
}


function blockSlider(){
	
	var _sliders = $('.block-slider');
	
	if(_sliders.length > 0){   	
  	
  	_sliders.each(function(index){
		  
		  var _slideshow = $(this).find('.slides');
		  
		  var _prev = '<button class="slick-prev slick-arrow" aria-label="Previous" type="button"><svg class="icon icon-previous"><use xlink:href="'+$.nr.themeUrl+'/images/icons.svg#icon-previous"></use></svg></button>';
		  var _next = '<button class="slick-next slick-arrow" aria-label="Next" type="button"><svg class="icon icon-next"><use xlink:href="'+$.nr.themeUrl+'/images/icons.svg#icon-next"></use></svg></button>';
		  
		  _slideshow.on('beforeChange', function(event, slick, currentSlide, nextSlide){ });							
      _slideshow.slick({slidesToShow: 1, slidesToScroll: 1, pauseOnFocus: true, accessibility:false, arrows:true, dots: true, infinite: true, swipe:true, speed:1000, fade:true, draggable:false, autoplay:false, prevArrow:_prev, nextArrow:_next});	  						
	  });	
	}		
}


function initArticleVideos(){
	
	_url = $.nr.themeUrl+'/images/plyricons.svg';
		
	if($('.videoplayer').length > 0){		
		const players = Plyr.setup('.videoplayer', { iconUrl : _url, settings : [] });
	}
}



function setScrollOffset(){
	
	$.nr.scrollOffset = $('header').height(); 
	if($.nr.scrollOffset < 50) $.nr.scrollOffset = 50;

}


function initLazyLoad(){
	
	$.nr.lazyLoad.hero = new Blazy({ selector: '.lazy-hero', breakpoints:[{width: 400, src: 'data-src-xs'},{width: 600, src: 'data-src-s'},{width: 850, src: 'data-src-m'}, {width: 1440, src: 'data-src-l'}],	offset: 1500 });
	
	$.nr.lazyLoad.retina = new Blazy({ selector: '.lazy-retina', offset: 1500 });
				
}


function initHeroVideo(){	
	_element = $('.section-hero .background-video');
	if(_element.length > 0) { 
		_mp4 = _element.attr('data-video');
		_poster = 'data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==';
		_element.append('<video class="video-bg" autoplay muted playsinline loop poster="'+_poster+'"><source src="'+_mp4+'" type="video/mp4"></video>');	
		//$.nr.heroVideo = $('.video-bg');
	}
}


/* change the background color of the header */
function stickyHeader() {
	checkHeader();
	$(window).scroll(function() { checkHeader() } );	
}

function checkHeader(){	
	if ($(window).scrollTop() > $.nr.scrollSticky) $('body').addClass("sticky"); else $('body').removeClass("sticky"); 
}	


function initScrollMagic(){
	
	if($.nr.pageType == 'home'){
			
  	$.nr.triggerHook = 0.5;
  	
  	$.nr.controller = new ScrollMagic.Controller({ globalSceneOptions: { globalSceneOptions: { reverse: false } } });
  	$.nr.scenes = Array();
  	$.nr.slides = $('section');
  	
  	$.nr.slides.each(function() {
   
    	_scene = new ScrollMagic.Scene({
        	triggerElement: this,
        	triggerHook: $.nr.triggerHook,
        	duration: $(this).height()
    	})
    	.on('enter', function (event) {
	    	if(event.state == "DURING"){
		    	_currentSection = $(event.target.triggerElement());
		    	if($.nr.scrollLock == false & _currentSection.prop('nodeName') == 'SECTION'){
			    	_anchor = _currentSection.attr('data-id');   	
		    		$('nav a').removeClass('active');		    	
			    	if(_anchor != undefined)		    	
				    	$('nav a[data-hash="#'+_anchor+'"]').addClass('active');			    	
		    	}
		    }	    	
	    }).addTo($.nr.controller);
  		
  		$.nr.scenes.push(_scene);
  				
  	});
  
  }
  		
}

/* init anchors & hash detection */
function initAnchors(){
  
  $('.tab-trigger').on('click', function(){  		
  		_href = $(this).attr('href');
  		performScroll(_href);
      return false;
  });
  
  /*
  if($.nr.pageType == 'home'){
    	
  	$('nav a, .anchor-trigger').on('click', function(){  		
  		_href = $(this).attr('href');
  		_index = _href.indexOf("#");
  		if(_index != -1) {
  		  _hash = _href.substr(_index);  		  
  		  performScroll(_hash);
        return false;
  		}		
  	});
	
	}
	
	_current_hash = window.location.hash;
	if(_current_hash.length > 1 && _current_hash != '#'){	
		window.location.hash = '';
		_anchor = $(_current_hash);		
		if(_anchor.offset() != undefined){	
			performScroll(_anchor)
		}	
	}
	*/
			
}

function performScroll(_anchor){
	$.nr.scrollLock = true;
	_target = $(_anchor).offset().top;
	$('html, body').delay($.nr.scrollDelay).animate({ scrollTop: _target-$.nr.scrollOffset }, 1000, function(){ $.nr.scrollLock = false; });	
}



/* toggle the mobile menu */
function toggleMenu(){

	$('#trigger-nav').click(function(){
		$('body').addClass('nav-active');
		$('body').addClass('no-scroll');
		return false;
	});
	
	$('.menu__close').click(function(){
		$('body').removeClass('nav-active');
		$('body').removeClass('no-scroll');
		return false;
	});

	$(window).scroll(function(){
		$('body').removeClass('subnav-active');
		$amountOfNavItems = $('header nav ul li a').length;

		for($x = 0; $x < $amountOfNavItems; $x++){
			$navClassesToRemove = 'subnav-active-' + $x ;
			$('body').removeClass($navClassesToRemove);
		}
	});
	
}


/* toggle submenu */

function toggleSubMenu(){

    $navClassesToRemove= 0;
    $amountOfNavItems= 0;
	$('header ul li > a').mouseover(function() {
		if($(this).hasClass('hasSubnav')){
			$('body').addClass('subnav-active');
			$amountOfNavItems = $('header nav ul li a').length;
			$navClassToAdd = "subnav-active-" + $(this).attr('data-target');

			for($x = 0; $x < $amountOfNavItems; $x++){
				$navClassesToRemove = 'subnav-active-' + $x ;
				$('body').removeClass($navClassesToRemove);
			}
			$('body').addClass($navClassToAdd);
			$('body').addClass("sticky");
			return false;
		}
		else {
			$('body').removeClass('subnav-active');
			for($x = 0; $x < $amountOfNavItems; $x++){
				$navClassesToRemove = 'subnav-active-' + $x ;
				$('body').removeClass($navClassesToRemove);
			}
			return false;
		}
		return false;
	});

	$('.site-overlay').mouseover(function(){
		$('body').removeClass('subnav-active');
		for($x = 0; $x < $amountOfNavItems; $x++){
			$navClassesToRemove = 'subnav-active-' + $x ;
			$('body').removeClass($navClassesToRemove);
		}
		return false;
	});

}

/* 
 *	Apply form
 *	
 */

function initForm(){	
	
	
	if($('.gform_wrapper').length > 0){
					
		$(document).bind('gform_post_render', function(){ 				
			enhanceCheckBoxes();	
			enhanceUploadFields();
			hideFormButton();	
    });
        
    $(document).bind('gform_confirmation_loaded', function(event, formId){
			dataLayer.push({'event': 'successfulApplication'});		
    });
  
  }
	
}

function hideFormButton(){
    $('.gform_button').on('click', function(){ $(this).addClass('disabled'); });
}

function enhanceUploadFields(){
	_uploadField = $('.ginput_container_fileupload');
	if(_uploadField.length > 0){
		_uploadField.each(function( index ) {
			_form = $('.section-apply');
			_label = $(this).find('.gfield_label')			
			_input = $(this).find('input');
			_btn = '<span></span><span>'+_form.attr('data-upload-button');
			_txt = _form.attr('data-upload-placeholder');
			_label.text(_txt);		
			_preview = $(this).find('.ginput_preview');
			if(_preview.length > 0) _txt = _preview.text();			
			_input.jfilestyle({input: true, placeholder:_txt, text: _btn, inputSize: "100%"});		
		});
	}
}

function enhanceCheckBoxes(){

	if($('.gf_custom_checkbox').length > 0){
				
		_switches = $(".gf_custom_checkbox input");
		
		_switches.each(function(index){
		
			if($(this).attr("checked") == "checked"){ $(this).parent().addClass('active'); }
			
			$(this).on('click', function(){
				if($(this).parent().hasClass('active'))
					$(this).parent().removeClass('active');
				else
					$(this).parent().addClass('active');				
			});
			
		});	
		
	}
}



/* cross-browser window width */
function getWindowWidth(){ return	window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth; }
