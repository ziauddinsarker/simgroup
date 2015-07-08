<?php $custom = get_post_custom( get_the_ID() );
$et_price = isset($custom["price"][0]) ? $custom["price"][0] : '';
if ($et_price <> '') $et_price = get_option('estore_cur_sign') . $et_price;
$et_description = isset($custom["description"][0]) ? $custom["description"][0] : '';
$et_band =  isset($custom["et_band"][0]) ? 'et_' . $custom["et_band"][0] : '';

$custom["thumbs"] = isset( $custom["thumbs"][0] ) ? unserialize($custom["thumbs"][0]) : '';

$thumb = '';
$width = 298;
$height = 130;
$classtext = '';
$titletext = get_the_title();

$thumbnail = get_thumbnail($width,$height,$classtext,$titletext,$titletext,true);
$thumb = $thumbnail["thumb"]; ?>

<?php if ($et_band <> '') { ?>
	<span class="band<?php echo(' '.esc_attr($et_band)); ?>"></span>
<?php }; ?>

<?php if ( ! empty( $custom["thumbs"] ) ) { ?>
	<div id="product-slider">
		<div id="product-slides">
			<?php for ($i = 0; $i <= count($custom["thumbs"])-1; $i++) { ?>
				<div class="item-slide">
    <a href="<?php echo esc_url($custom["thumbs"][$i]); ?>" rel="gallery" class="fancybox">
		<?php echo et_new_thumb_resize( et_multisite_thumbnail($custom["thumbs"][$i]), 298, 298 ); ?>
		<span class="overlay"></span>
   </a>
</div> <!-- .item-slide -->
			<?php }; ?>
		</div> <!-- #product-slides -->

		<?php if (count($custom["thumbs"]) > 1) { ?>
			<div id="product-thumbs">
				<?php for ($i = 0; $i <= count($custom["thumbs"])-1; $i++) { ?>
					<a href="#" <?php if($i==0) echo('class="active"'); if ($i==count($custom["thumbs"])-1) echo('class="last"') ?> rel="<?php echo($i+1); ?>">
						<?php echo et_new_thumb_resize( et_multisite_thumbnail($custom["thumbs"][$i]), 69, 69 ); ?>
						<span class="overlay"></span>
					</a>
				<?php }; ?>
			</div> <!-- #product-thumbs -->
		<?php }; ?>
	</div> <!-- #product-slider -->
<?php } else { ?>
<div id="product-slider">
	<div id="product-slides">
		<div class="item-slide">
			<?php $et_fullpath = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' ); ?>
			<a href="<?php echo esc_url( $et_fullpath[0] ); ?>" rel="gallery" class="fancybox">
				<?php the_post_thumbnail( 'et-single-product-thumb2' ); ?>
				<span class="overlay"></span>
			</a>
		</div> <!-- .item-slide -->
	</div> <!-- #product-slides -->
</div> <!-- #product-slider -->
<?php } ?>

<div class="product-info">
	<h1 class="title"><?php the_title(); ?></h1>
	<?php if (get_option('estore_postinfo2') ) { ?>
		<p class="post-meta"><?php esc_html_e('Added','eStore'); ?> <?php if (in_array('date', get_option('estore_postinfo2'))) { ?> <?php esc_html_e('on','eStore') ?> <?php the_time(get_option('estore_date_format')) ?><?php }; ?> <?php if (in_array('categories', get_option('estore_postinfo2'))) { ?> <?php esc_html_e('in','eStore'); ?> <?php the_category(', ') ?><?php }; ?></p>
	<?php }; ?>

	<div class="clearfix">
			<?php if ($et_price <> '') { ?>

			<span class="price-single"><span><?php echo esc_html($et_price); ?></span></span>
			<a href="#" class="addto-cart"><span><?php esc_html_e('Add to cart','eStore'); ?></span></a>
		<?php 
		
		}else{ ?>

			<a href="#Quote" class="quote-price"><span>Quote for Price</span></a> 

		<?php }; ?>			
	</div>

	<div class="description">
		<p><?php echo($et_description); ?></p>
	</div> <!-- .description -->

</div> <!-- #product-info -->

<div class="clear"></div>

<div class="hr"></div>
<?php echo do_shortcode ('[shareaholic app="share_buttons" id="16020692"]'); ?>

<h2><?php esc_html_e('Product Information','eStore'); ?></h2>
<?php the_content(); ?>
<!-- Price for quote-->
<div class="hr"></div>
<div id="Quote">
	<h1>Quote For Price</h1>
	<?php echo do_shortcode( '[contact-form-7 id="966" title="Price Quote"]' ); ?>
</div>
<div class="clear"></div>
<?php wp_link_pages(array('before' => '<p><strong>'.esc_html__('Pages','eStore').':</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
<?php edit_post_link(esc_html__('Edit this page','eStore')); ?>
<div class="hr"></div>
 <?php related_posts(); ?>

<?php $orig_post = $post;
global $post;
$tags = wp_get_post_tags( $post->ID );
if ($tags) {
	$tag_ids = array();

	foreach($tags as $individual_tag) $tag_ids[] = $individual_tag->term_id;
	$args=array(
		'tag__in' => $tag_ids,
		'post__not_in' => array( $post->ID ),
		'posts_per_page'=>4,
		'ignore_sticky_posts'=>1,
	);
	$my_query = new wp_query( $args );

	if( $my_query->have_posts() ) { ?>
		<div class="related">
			<h2><?php esc_html_e('Related Products','eStore'); ?></h2>
			<ul class="related-items clearfix">
				<?php $i=1; while( $my_query->have_posts() ) {
				$my_query->the_post(); ?>
					<?php $thumb = '';
					$width = 44;
					$height = 44;
					$classtext = '';
					$titletext = get_the_title();

					$thumbnail = get_thumbnail($width,$height,$classtext,$titletext,$titletext);
					$thumb = $thumbnail["thumb"]; ?>

					<li<?php if($i%2==0) echo(' class="second"'); ?>>
						<a href="<?php the_permalink(); ?>" class="clearfix">
							<?php if ($thumb <> '') print_thumbnail($thumb, $thumbnail["use_timthumb"], $titletext, $width, $height, $classtext); ?>
							<span><?php the_title(); ?></span>
						</a>
					</li>
					<?php $i++; ?>
				<?php } ?>
			</ul>
		</div>
	<?php }
}
$post = $orig_post;
wp_reset_query(); ?>