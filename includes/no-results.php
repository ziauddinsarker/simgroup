<div class="entry not-found">
<!--If no results are found-->
	<h1><?php esc_html_e('No Results Found','eStore'); ?></h1>
	<p><?php esc_html_e('The page you requested could not be found. Try refining your search, or use the navigation above to locate the post.','eStore'); ?></p>
	
	
	<form method="get" id="searchform-notfound" action="<?php echo esc_url( home_url( '/' ) ); ?>/">
	    <div class="notfound-search">
	        <input type="text" value="<?php echo esc_attr( get_search_query() ); ?>" name="s" id="s" />
	        <input type="submit" id="searchsubmit" value="<?php esc_attr_e('Search','eStore'); ?>" />
	    </div>
	</form>
</div>
<!--End if no results are found-->