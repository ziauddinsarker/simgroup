<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<head profile="http://gmpg.org/xfn/11">
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<title><?php elegant_titles(); ?></title>
<?php elegant_description(); ?>
<?php elegant_keywords(); ?>
<?php elegant_canonical(); ?>


<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">

<meta name="p:domain_verify" content="3676abd87b5f200a7736063e128598ab"/>

<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

<!--[if lt IE 7]>
	<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/ie6style.css" />
	<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/DD_belatedPNG_0.0.8a-min.js"></script>
	<script type="text/javascript">DD_belatedPNG.fix('img#logo');</script>
<![endif]-->
<!--[if IE 7]>
	<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/ie7style.css" />
<![endif]-->
<!--[if IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/ie8style.css" />
<![endif]-->

<script type="text/javascript">
	document.documentElement.className = 'js';
</script>
<!-- start Mixpanel --><script type="text/javascript">(function(f,b){if(!b.__SV){var a,e,i,g;window.mixpanel=b;b._i=[];b.init=function(a,e,d){function f(b,h){var a=h.split(".");2==a.length&&(b=b[a[0]],h=a[1]);b[h]=function(){b.push([h].concat(Array.prototype.slice.call(arguments,0)))}}var c=b;"undefined"!==typeof d?c=b[d]=[]:d="mixpanel";c.people=c.people||[];c.toString=function(b){var a="mixpanel";"mixpanel"!==d&&(a+="."+d);b||(a+=" (stub)");return a};c.people.toString=function(){return c.toString(1)+".people (stub)"};i="disable track track_pageview track_links track_forms register register_once alias unregister identify name_tag set_config people.set people.set_once people.increment people.append people.union people.track_charge people.clear_charges people.delete_user".split(" ");
for(g=0;g<i.length;g++)f(c,i[g]);b._i.push([a,e,d])};b.__SV=1.2;a=f.createElement("script");a.type="text/javascript";a.async=!0;a.src="undefined"!==typeof MIXPANEL_CUSTOM_LIB_URL?MIXPANEL_CUSTOM_LIB_URL:"//cdn.mxpnl.com/libs/mixpanel-2-latest.min.js";e=f.getElementsByTagName("script")[0];e.parentNode.insertBefore(a,e)}})(document,window.mixpanel||[]);
mixpanel.init("cdaca2e024dc9012ee8c3e0807a77fc1");</script><!-- end Mixpanel -->

<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>
<?php wp_head(); ?>
<script>
mixpanel.track('view page', {
'url': location.pathname
});
</script>
</head>
<?php $et_body_class = get_option('estore_cufon') == 'false' ? 'cufon-disabled' : 'cufon-enabled'; ?>
<body<?php if (is_home()) echo(' id="home"'); ?> <?php body_class( $et_body_class ); ?>>
	<div id="header">
		<div class="container clearfix">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php $logo = (get_option('estore_logo') <> '') ? get_option('estore_logo') : get_template_directory_uri().'/images/logo.png'; ?>
				<img src="<?php echo esc_attr( $logo ); ?>" alt="<?php echo esc_attr(get_bloginfo('name')); ?>" id="logo"/></a>

			<?php $menuClass = 'nav superfish clearfix';
			$menuID = 'top-menu';
			$primaryNav = '';
			if (function_exists('wp_nav_menu')) {
				$primaryNav = wp_nav_menu( array( 'theme_location' => 'primary-menu', 'container' => '', 'fallback_cb' => '', 'menu_class' => $menuClass, 'menu_id' => $menuID, 'echo' => false ) );
			};
			if ($primaryNav == '') { ?>
				<ul id="<?php echo esc_attr( $menuID ); ?>" class="<?php echo esc_attr( $menuClass ); ?>">
					<?php if (get_option('estore_swap_navbar') == 'false') { ?>
						<?php if (get_option('estore_home_link') == 'on') { ?>
							<li <?php if (is_home()) echo('class="current_page_item"') ?>><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e('Home','eStore') ?></a></li>
						<?php }; ?>

						<?php show_page_menu($menuClass,false,false); ?>
					<?php } else { ?>
						<?php show_categories_menu($menuClass,false); ?>
					<?php } ?>
				</ul> <!-- ul#nav -->
			<?php }
			else echo($primaryNav); ?>
			<div id="google_translate_element"></div><script type="text/javascript">
				function googleTranslateElementInit() {
				  new google.translate.TranslateElement({pageLanguage: 'en', includedLanguages: 'ar,bg,cs,da,de,en,es,et,fa,fi,fr,ga,it,iw,ja,ka,ko,la,ms,nl,no,pl,pt,ro,ru,sk,sv,tl,tr,uk,zh-CN,zh-TW', layout: google.translate.TranslateElement.InlineLayout.SIMPLE, gaTrack: true, gaId: 'UA-60224984-1'}, 'google_translate_element');
				}
			</script>
			<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
			<div id="social-bar">
							<a href="https://www.facebook.com/SIMURANonWovensLtd"><img src="<?php echo get_template_directory_uri(); ?>/images/facebook-icon.png" alt="Simura Nonwoven" width="39" height="33"></a>
			</div> 
			<div id="search-bar">
				<form method="get" id="searchform1" action="<?php echo esc_url( home_url( '/' ) ); ?>">
					<input type="text" value="<?php esc_attr_e('search this site...','eStore'); ?>" name="s" id="searchinput" />

					<input type="image" src="<?php echo get_template_directory_uri(); ?>/images/search-icon.png" id="searchsubmit" />
				</form>
			</div> <!-- #search-bar -->
			
		

			<div id="menu">
				<?php $menuClass = 'nav superfish clearfix';
				$menuID = 'secondary-menu';
				$secondaryNav = '';
				if (function_exists('wp_nav_menu')) {
					$secondaryNav = wp_nav_menu( array( 'theme_location' => 'secondary-menu', 'container' => '', 'fallback_cb' => '', 'menu_class' => $menuClass, 'menu_id' => $menuID, 'echo' => false, 'walker' => new description_walker() ) );
				};
				if ($secondaryNav == '') { ?>
					<ul id="<?php echo esc_attr( $menuID ); ?>" class="<?php echo esc_attr( $menuClass ); ?>">
						<?php if (get_option('estore_swap_navbar') == 'false') { ?>
							<?php show_categories_menu($menuClass,false); ?>
						<?php } else { ?>
							<?php if (get_option('estore_home_link') == 'on') { ?>
								<li <?php if (is_home()) echo('class="current_page_item"') ?>><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e('Home','eStore') ?></a></li>
							<?php }; ?>

							<?php show_page_menu($menuClass,false,false); ?>
						<?php } ?>
					</ul> <!-- end ul#nav -->
				<?php }
				else echo($secondaryNav); ?>
			</div> <!-- #menu -->

		</div> <!-- .container -->
	</div> <!-- #header -->

	<?php if (get_option('estore_featured') == 'on' && (is_home() || is_front_page())) get_template_part('includes/featured'); ?>

	<div id="content" <?php global $fullwidth; if ( is_page_template('page-full.php') || $fullwidth ) echo 'class="no_sidebar"'?>>
		<div class="container clearfix">