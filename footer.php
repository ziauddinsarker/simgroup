				</div> <!-- #main-content -->
			</div> <!-- #main-area -->
			<div id="main-area-bottom"></div>

			<div id="footer">
				<p id="copyright"><?php esc_html_e('Designed by ','eStore'); ?> <a href="http://simuranonwovens.com" title="Simura Nonwovens Ltd">Simura IT Team</a> | <?php esc_html_e('Powered by ','eStore'); ?> <a href="http://simuragroup.com">Simura Group</a></p>
			</div> <!-- #footer-->

		</div> <!-- .container -->
	</div> <!-- #content -->

	<?php get_template_part('includes/scripts'); ?>
	<?php wp_footer(); ?>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>	
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>	
	<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.cookie.js"></script>	
	
	<script>	
		$(document).ready(function(){
			if ($.cookie('modal') != 'shown')    {
				  $.cookie('modal', 'shown',{ expires: 7, path: '/' });
				  $('#myModal').modal('show');
			}	
	
		});	
	</script>

	<!-- ClickDesk Live Chat Service for websites -->
		<script type='text/javascript'>
		var _glc =_glc || []; _glc.push('all_ag9zfmNsaWNrZGVza2NoYXRyDwsSBXVzZXJzGInlsYUKDA');
		var glcpath = (('https:' == document.location.protocol) ? 'https://my.clickdesk.com/clickdesk-ui/browser/' : 
		'http://my.clickdesk.com/clickdesk-ui/browser/');
		var glcp = (('https:' == document.location.protocol) ? 'https://' : 'http://');
		var glcspt = document.createElement('script'); glcspt.type = 'text/javascript'; 
		glcspt.async = true; glcspt.src = glcpath + 'livechat-new.js';
		var s = document.getElementsByTagName('script')[0];s.parentNode.insertBefore(glcspt, s);
		</script>
	<!-- End of ClickDesk -->


	
	<!-- Piwik -->
	<script type="text/javascript">
	  var _paq = _paq || [];
	  _paq.push(['trackPageView']);
	  _paq.push(['enableLinkTracking']);
	  (function() {
		var u="//simuranonwovens.com/analytics/";
		_paq.push(['setTrackerUrl', u+'piwik.php']);
		_paq.push(['setSiteId', 2]);
		var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0];
		g.type='text/javascript'; g.async=true; g.defer=true; g.src=u+'piwik.js'; s.parentNode.insertBefore(g,s);
	  })();
	</script>
	<noscript><p><img src="//simuranonwovens.com/analytics/piwik.php?idsite=2" style="border:0;" alt="" /></p></noscript>
	<!-- End Piwik Code -->


	<script>
	  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

	  ga('create', 'UA-60224984-1', 'auto');
	  ga('require', 'linkid', 'linkid.js');
	  ga('require', 'displayfeatures');
	  ga('send', 'pageview');

	  
	  // Using jQuery Event API v1.3
		$('#visitor_buyer').on('click', function() {
		  ga('send', 'event', 'button', 'click', 'Buyer');
		});
		
		// Using jQuery Event API v1.3
		$('#visitor_seller').on('click', function() {
		  ga('send', 'event', 'button', 'click', 'Seller');
		});
		
		// Using jQuery Event API v1.3
		$('#visitor_individual').on('click', function() {
		  ga('send', 'event', 'button', 'click', 'Individual');
		});	
		
		// Using jQuery Event API v1.3
		$('#visitor_others').on('click', function() {
		  ga('send', 'event', 'button', 'click', 'Others');
		});
	  
	  
	</script>

</body>
</html>