<?php get_header(); ?>

<?php if (get_option('estore_scroller') == 'on') get_template_part('includes/scroller'); ?>
<!-- Modal -->


<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
	<div class="modal-content">
	
	  <div class="modal-body">		
		<h2>Thank you for visiting our website!</h2><br><br>
		<h5>What would best describe your purpose of visiting SIMURA Nonwovens?</h5><br>
		<h2>I AM A</h2><br>
		<div>
			<a href="#" id="visitor_buyer" data-dismiss="modal" aria-label="Close" onClick="_gaq.push(['_trackEvent', 'Pop Up', 'Buyer', 'Visitor is Buyer']);"></a>
			<a href="#" id="visitor_seller" data-dismiss="modal" aria-label="Close" onClick="_gaq.push(['_trackEvent', 'Pop Up', 'Seller', 'Visitor is Supplier']);" ></a>
			<a href="#" id="visitor_individual" data-dismiss="modal" aria-label="Close" onClick="_gaq.push(['_trackEvent', 'Pop Up', 'Individual', 'Visitor is Individual']);" ></a>
			<a href="#" id="visitor_others" data-dismiss="modal" aria-label="Close" onClick="_gaq.push(['_trackEvent', 'Pop Up', 'Others', 'Visitor is Others']);"></a>				
		</div>	
	  </div>
	</div>
  </div>
</div>


<!-- Modal -->
<div id="main-area">
	<div id="main-content" class="clearfix">
		<div id="left-column" class="left-col-home">
			<div class="border-blank"></div><h2>Nonwoven Bag</h2><div class="border-blank"></div>
				<?php get_template_part('includes/entry-non-woven'); ?>
			
			<div class="border-blank"></div><h2>Woven Tote Bag</h2><div class="border-blank"></div>
				<?php get_template_part('includes/entry-tote-bag'); ?>
			
			<div class="border-blank"></div><h2>Ladies Bag</h2><div class="border-blank"></div>
				<?php get_template_part('includes/entry-ladies-bag'); ?>
				
			
			
		</div> <!-- #left-column -->

		<?php get_sidebar(); ?>

<?php get_footer(); ?>