<?php global $shortname; ?>
	<script type="text/javascript" src="<?php echo get_template_directory_uri();?>/js/jquery.cycle.all.min.js"></script>
	<script type="text/javascript" src="<?php echo get_template_directory_uri();?>/js/jquery.easing.1.3.js"></script>
	<script type="text/javascript" src="<?php echo get_template_directory_uri();?>/js/superfish.js"></script>
	<script type="text/javascript">
	//<![CDATA[
		jQuery.noConflict();

		jQuery('ul#top-menu').superfish({
			delay:       300,                            // one second delay on mouseout
			animation:   {'marginLeft':'0px',opacity:'show'},  // fade-in and slide-down animation
			speed:       'fast',                          // faster animation speed
			onBeforeShow: function(){ this.css('marginLeft','20px'); },
			autoArrows:  true,                           // disable generation of arrow mark-up
			dropShadows: false                            // disable drop shadows
		}).find('li ul').prepend('<li class="top"><span class="menu-top"></span></li>').find('li:eq(1)').addClass('second');

		jQuery('ul#secondary-menu').superfish({
			delay:       300,                            // one second delay on mouseout
			animation:   {opacity:'show',height:'show'},  // fade-in and slide-down animation
			speed:       'fast',                          // faster animation speed
			autoArrows:  true,                           // disable generation of arrow mark-up
			dropShadows: false                            // disable drop shadows
		});

		et_search_bar();

		<?php if (get_option($shortname.'_disable_toptier') == 'on') echo('jQuery("ul.nav > li > ul").prev("a").attr("href","#");'); ?>

		<!---- et_switcher plugin v1.4 ---->
		(function($)
		{
			$.fn.et_switcher = function(options)
			{
				var defaults =
				{
				   slides: '>div',
				   activeClass: 'active',
				   linksNav: '',
				   findParent: true, //use parent elements in defining lengths
				   lengthElement: 'li', //parent element, used only if findParent is set to true
				   useArrows: false,
				   arrowLeft: 'prevlink',
				   arrowRight: 'nextlink',
				   auto: false,
				   autoSpeed: 5000
				};

				var options = $.extend(defaults, options);

				return this.each(function()
				{
					var slidesContainer = jQuery(this);
					slidesContainer.find(options.slides).hide().end().find(options.slides).filter(':first').css('display','block');

					if (options.linksNav != '') {
						var linkSwitcher = jQuery(options.linksNav);

						linkSwitcher.click(function(){
							var targetElement;

							if (options.findParent) targetElement = jQuery(this).parent();
							else targetElement = jQuery(this);

							if (targetElement.hasClass('active')) return false;

							/* 	targetElement.siblings().removeClass('active').end().addClass('active');
								var ordernum = targetElement.prevAll(options.lengthElement).length;
								slidesContainer.find(options.slides).filter(':visible').hide()
									.end().end().find(options.slides).filter(':eq('+ordernum+')').stop().fadeIn(700);
							*/

							targetElement.siblings('.active').animate({marginTop: '-18px'},500,function(){
								jQuery(this).removeClass('active');

							});
							targetElement.animate({marginTop: '6px'},500,function(){
								jQuery(this).addClass('active');

							});
							var ordernum = targetElement.prevAll(options.lengthElement).length;

							slidesContainer.find(options.slides).filter(':visible').hide().end().end().find(options.slides).filter(':eq('+ordernum+')').stop().fadeIn(700);

							if (typeof interval != 'undefined') {
								clearInterval(interval);
								auto_rotate();
							};

							return false;
						});
					};

					jQuery('#'+options.arrowRight+', #'+options.arrowLeft).click(function(){

						var slideActive = slidesContainer.find(options.slides).filter(":visible"),
							nextSlide = slideActive.next(),
							prevSlide = slideActive.prev();

						if (jQuery(this).attr("id") == options.arrowRight) {
							if (nextSlide.length) {
								var ordernum = nextSlide.prevAll().length;
							} else { var ordernum = 0; }
						};

						if (jQuery(this).attr("id") == options.arrowLeft) {
							if (prevSlide.length) {
								var ordernum = prevSlide.prevAll().length;
							} else { var ordernum = slidesContainer.find(options.slides).length-1; }
						};

						slidesContainer.find(options.slides).filter(':visible').hide().end().end().find(options.slides).filter(':eq('+ordernum+')').stop().fadeIn(700);

						if (typeof interval != 'undefined') {
							clearInterval(interval);
							auto_rotate();
						};

						return false;
					});

					if (options.auto) {
						auto_rotate();
					};

					function auto_rotate(){
						interval = setInterval(function(){
							var slideActive = slidesContainer.find(options.slides).filter(":visible"),
								nextSlide = slideActive.next();

							if (nextSlide.length) {
								var ordernum = nextSlide.prevAll().length;
							} else { var ordernum = 0; }

							if (options.linksNav === '')
								jQuery('#'+options.arrowRight).trigger("click");
							else
								linkSwitcher.filter(':eq('+ordernum+')').trigger("click");
						},options.autoSpeed);
					};
				});
			}
		})(jQuery);

		var $featuredArea = jQuery('#featured #slides');

		jQuery(window).load( function(){
			if ($featuredArea.length) {
				$featuredArea.css( 'backgroundImage', 'none' );
				$featuredArea.et_switcher({
					linksNav: '#switcher a',
					<?php if (get_option($shortname . '_slider_auto') == 'on') { ?>
						auto: true,
						autoSpeed: <?php echo esc_js(get_option($shortname . '_slider_autospeed')); ?>,
					<?php } else { ?>
						auto: false,
					<?php } ?>
					findParent: true,
					lengthElement: 'div'
				});
			};
		} );


		var $slider_content = jQuery('#scroller #items');
		if ($slider_content.length) {
			$slider_content.cycle({
				fx: 'scrollHorz',
				timeout: 0,
				speed: 700,
				cleartypeNoBg: true,
				next:   'a#right-arrow',
				prev:   'a#left-arrow'
			});
		};

		var $featured = jQuery('#product-slider'),
			$featured_content = jQuery('#product-slides'),
			$controller = jQuery('#product-thumbs'),
			$slider_control_tab = $controller.find('a');
		if ($featured_content.length) {
			$featured_content.cycle({
				fx: 'fade',
				timeout: 0,
				speed: 700,
				cleartypeNoBg: true
			});

			var ordernum;

			function gonext(this_element){
				$controller.find("a.active").removeClass('active');

				this_element.addClass('active');

				ordernum = this_element.attr("rel");
				$featured_content.cycle(ordernum-1);

				if (typeof interval != 'undefined') {
					clearInterval(interval);
					auto_rotate();
				};
			}

			$slider_control_tab.click(function(){
				gonext(jQuery(this));
				return false;
			});
		};


		<!---- Search Bar Improvements ---->
		function et_search_bar(){
			var $searchform = jQuery('#header #searchform1'),
				$searchinput = $searchform.find("input#searchinput"),
				searchvalue = $searchinput.val();

			$searchinput.focus(function(){
				if (jQuery(this).val() === searchvalue) jQuery(this).val("");
			}).blur(function(){
				if (jQuery(this).val() === "") jQuery(this).val(searchvalue);
			});
		};
	//]]>
	</script>