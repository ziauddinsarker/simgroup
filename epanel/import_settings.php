<?php
add_action( 'admin_enqueue_scripts', 'import_epanel_javascript' );
function import_epanel_javascript( $hook_suffix ) {
	if ( 'admin.php' == $hook_suffix && isset( $_GET['import'] ) && isset( $_GET['step'] ) && 'wordpress' == $_GET['import'] && '1' == $_GET['step'] )
		add_action( 'admin_head', 'admin_headhook' );
}

function admin_headhook(){ ?>
	<script type="text/javascript">
		jQuery(document).ready(function($){
			$("p.submit").before("<p><input type='checkbox' id='importepanel' name='importepanel' value='1' style='margin-right: 5px;'><label for='importepanel'>Replace ePanel settings with sample data values</label></p>");
		});
	</script>
<?php }

add_action('import_end','importend');
function importend(){
	global $wpdb, $shortname;

	#make custom fields image paths point to sampledata/sample_images folder
	$sample_images_postmeta = $wpdb->get_results(
		$wpdb->prepare( "SELECT meta_id, meta_value FROM $wpdb->postmeta WHERE meta_value REGEXP %s", 'http://et_sample_images.com' )
	);
	if ( $sample_images_postmeta ) {
		foreach ( $sample_images_postmeta as $postmeta ){
			$template_dir = get_template_directory_uri();
			if ( is_multisite() ){
				switch_to_blog(1);
				$main_siteurl = site_url();
				restore_current_blog();

				$template_dir = $main_siteurl . '/wp-content/themes/' . get_template();
			}
			preg_match( '/http:\/\/et_sample_images.com\/([^.]+).jpg/', $postmeta->meta_value, $matches );
			$image_path = $matches[1];

			$local_image = preg_replace( '/http:\/\/et_sample_images.com\/([^.]+).jpg/', $template_dir . '/sampledata/sample_images/$1.jpg', $postmeta->meta_value );

			$local_image = preg_replace( '/s:55:/', 's:' . strlen( $template_dir . '/sampledata/sample_images/' . $image_path . '.jpg' ) . ':', $local_image );

			$wpdb->update( $wpdb->postmeta, array( 'meta_value' => esc_url_raw( $local_image ) ), array( 'meta_id' => $postmeta->meta_id ), array( '%s' ) );
		}
	}

	if ( !isset($_POST['importepanel']) )
		return;

	$importOptions = 'YTo4Mjp7czowOiIiO047czoxOToiZXN0b3JlX2NvbG9yX3NjaGVtZSI7czo3OiJEZWZhdWx0IjtzOjE3OiJlc3RvcmVfZ3JhYl9pbWFnZSI7TjtzOjE1OiJlc3RvcmVfY3VyX3NpZ24iO3M6MToiJCI7czoxOToiZXN0b3JlX2NhdG51bV9wb3N0cyI7czoxOiI2IjtzOjIzOiJlc3RvcmVfYXJjaGl2ZW51bV9wb3N0cyI7czoxOiI1IjtzOjIyOiJlc3RvcmVfc2VhcmNobnVtX3Bvc3RzIjtzOjE6IjUiO3M6MTk6ImVzdG9yZV90YWdudW1fcG9zdHMiO3M6MToiNSI7czoxODoiZXN0b3JlX2RhdGVfZm9ybWF0IjtzOjY6Ik0gaiwgWSI7czoxODoiZXN0b3JlX3VzZV9leGNlcnB0IjtOO3M6MTI6ImVzdG9yZV9jdWZvbiI7czoyOiJvbiI7czoxNToiZXN0b3JlX3Njcm9sbGVyIjtzOjI6Im9uIjtzOjIxOiJlc3RvcmVfZGVhbHNfY2F0ZWdvcnkiO3M6NDoiQmxvZyI7czoyMToiZXN0b3JlX2RlYWxzX251bXBvc3RzIjtzOjE6IjUiO3M6MjE6ImVzdG9yZV9ob21lcGFnZV9wb3N0cyI7czoxOiI2IjtzOjIxOiJlc3RvcmVfZXhsY2F0c19yZWNlbnQiO047czoxNToiZXN0b3JlX2ZlYXR1cmVkIjtzOjI6Im9uIjtzOjE2OiJlc3RvcmVfZHVwbGljYXRlIjtOO3M6MTU6ImVzdG9yZV9mZWF0X2NhdCI7czo4OiJGZWF0dXJlZCI7czoxOToiZXN0b3JlX2ZlYXR1cmVkX251bSI7czoxOiIzIjtzOjE2OiJlc3RvcmVfdXNlX3BhZ2VzIjtOO3M6MTc6ImVzdG9yZV9mZWF0X3BhZ2VzIjtOO3M6MTg6ImVzdG9yZV9zbGlkZXJfYXV0byI7TjtzOjIzOiJlc3RvcmVfc2xpZGVyX2F1dG9zcGVlZCI7czo0OiI1MDAwIjtzOjE2OiJlc3RvcmVfbWVudXBhZ2VzIjtOO3M6MjM6ImVzdG9yZV9lbmFibGVfZHJvcGRvd25zIjtzOjI6Im9uIjtzOjE2OiJlc3RvcmVfaG9tZV9saW5rIjtzOjI6Im9uIjtzOjE3OiJlc3RvcmVfc29ydF9wYWdlcyI7czoxMDoicG9zdF90aXRsZSI7czoxNzoiZXN0b3JlX29yZGVyX3BhZ2UiO3M6MzoiYXNjIjtzOjI0OiJlc3RvcmVfdGllcnNfc2hvd25fcGFnZXMiO3M6MToiMyI7czoxNToiZXN0b3JlX21lbnVjYXRzIjthOjI6e2k6MDtzOjE6IjMiO2k6MTtzOjE6IjEiO31zOjM0OiJlc3RvcmVfZW5hYmxlX2Ryb3Bkb3duc19jYXRlZ29yaWVzIjtzOjI6Im9uIjtzOjIzOiJlc3RvcmVfY2F0ZWdvcmllc19lbXB0eSI7czoyOiJvbiI7czoyOToiZXN0b3JlX3RpZXJzX3Nob3duX2NhdGVnb3JpZXMiO3M6MToiMyI7czoxNToiZXN0b3JlX3NvcnRfY2F0IjtzOjQ6Im5hbWUiO3M6MTY6ImVzdG9yZV9vcmRlcl9jYXQiO3M6MzoiYXNjIjtzOjE4OiJlc3RvcmVfc3dhcF9uYXZiYXIiO047czoyMjoiZXN0b3JlX2Rpc2FibGVfdG9wdGllciI7TjtzOjE2OiJlc3RvcmVfcG9zdGluZm8yIjthOjI6e2k6MDtzOjQ6ImRhdGUiO2k6MTtzOjEwOiJjYXRlZ29yaWVzIjt9czoyMDoiZXN0b3JlX2N1c3RvbV9jb2xvcnMiO047czoxNjoiZXN0b3JlX2NoaWxkX2NzcyI7TjtzOjE5OiJlc3RvcmVfY2hpbGRfY3NzdXJsIjtzOjA6IiI7czoyMDoiZXN0b3JlX2NvbG9yX2JnY29sb3IiO3M6MDoiIjtzOjIxOiJlc3RvcmVfY29sb3JfbWFpbmZvbnQiO3M6MDoiIjtzOjIxOiJlc3RvcmVfY29sb3JfbWFpbmxpbmsiO3M6MDoiIjtzOjIxOiJlc3RvcmVfY29sb3JfcGFnZWxpbmsiO3M6MDoiIjtzOjI3OiJlc3RvcmVfY29sb3Jfc2lkZWJhcl90aXRsZXMiO3M6MDoiIjtzOjE5OiJlc3RvcmVfY29sb3JfZm9vdGVyIjtzOjA6IiI7czoyNToiZXN0b3JlX2NvbG9yX2Zvb3Rlcl9saW5rcyI7czowOiIiO3M6MjE6ImVzdG9yZV9zZW9faG9tZV90aXRsZSI7TjtzOjI3OiJlc3RvcmVfc2VvX2hvbWVfZGVzY3JpcHRpb24iO047czoyNDoiZXN0b3JlX3Nlb19ob21lX2tleXdvcmRzIjtOO3M6MjU6ImVzdG9yZV9zZW9faG9tZV9jYW5vbmljYWwiO047czoyNToiZXN0b3JlX3Nlb19ob21lX3RpdGxldGV4dCI7czowOiIiO3M6MzE6ImVzdG9yZV9zZW9faG9tZV9kZXNjcmlwdGlvbnRleHQiO3M6MDoiIjtzOjI4OiJlc3RvcmVfc2VvX2hvbWVfa2V5d29yZHN0ZXh0IjtzOjA6IiI7czoyMDoiZXN0b3JlX3Nlb19ob21lX3R5cGUiO3M6Mjc6IkJsb2dOYW1lIHwgQmxvZyBkZXNjcmlwdGlvbiI7czoyNDoiZXN0b3JlX3Nlb19ob21lX3NlcGFyYXRlIjtzOjM6IiB8ICI7czoyMzoiZXN0b3JlX3Nlb19zaW5nbGVfdGl0bGUiO047czoyOToiZXN0b3JlX3Nlb19zaW5nbGVfZGVzY3JpcHRpb24iO047czoyNjoiZXN0b3JlX3Nlb19zaW5nbGVfa2V5d29yZHMiO047czoyNzoiZXN0b3JlX3Nlb19zaW5nbGVfY2Fub25pY2FsIjtOO3M6Mjk6ImVzdG9yZV9zZW9fc2luZ2xlX2ZpZWxkX3RpdGxlIjtzOjk6InNlb190aXRsZSI7czozNToiZXN0b3JlX3Nlb19zaW5nbGVfZmllbGRfZGVzY3JpcHRpb24iO3M6MTU6InNlb19kZXNjcmlwdGlvbiI7czozMjoiZXN0b3JlX3Nlb19zaW5nbGVfZmllbGRfa2V5d29yZHMiO3M6MTI6InNlb19rZXl3b3JkcyI7czoyMjoiZXN0b3JlX3Nlb19zaW5nbGVfdHlwZSI7czoyMToiUG9zdCB0aXRsZSB8IEJsb2dOYW1lIjtzOjI2OiJlc3RvcmVfc2VvX3NpbmdsZV9zZXBhcmF0ZSI7czozOiIgfCAiO3M6MjY6ImVzdG9yZV9zZW9faW5kZXhfY2Fub25pY2FsIjtOO3M6Mjg6ImVzdG9yZV9zZW9faW5kZXhfZGVzY3JpcHRpb24iO047czoyMToiZXN0b3JlX3Nlb19pbmRleF90eXBlIjtzOjI0OiJDYXRlZ29yeSBuYW1lIHwgQmxvZ05hbWUiO3M6MjU6ImVzdG9yZV9zZW9faW5kZXhfc2VwYXJhdGUiO3M6MzoiIHwgIjtzOjMwOiJlc3RvcmVfaW50ZWdyYXRlX2hlYWRlcl9lbmFibGUiO3M6Mjoib24iO3M6Mjg6ImVzdG9yZV9pbnRlZ3JhdGVfYm9keV9lbmFibGUiO3M6Mjoib24iO3M6MzM6ImVzdG9yZV9pbnRlZ3JhdGVfc2luZ2xldG9wX2VuYWJsZSI7czoyOiJvbiI7czozNjoiZXN0b3JlX2ludGVncmF0ZV9zaW5nbGVib3R0b21fZW5hYmxlIjtzOjI6Im9uIjtzOjIzOiJlc3RvcmVfaW50ZWdyYXRpb25faGVhZCI7czowOiIiO3M6MjM6ImVzdG9yZV9pbnRlZ3JhdGlvbl9ib2R5IjtzOjA6IiI7czoyOToiZXN0b3JlX2ludGVncmF0aW9uX3NpbmdsZV90b3AiO3M6MDoiIjtzOjMyOiJlc3RvcmVfaW50ZWdyYXRpb25fc2luZ2xlX2JvdHRvbSI7czowOiIiO3M6MTc6ImVzdG9yZV80NjhfZW5hYmxlIjtOO3M6MTY6ImVzdG9yZV80NjhfaW1hZ2UiO3M6MDoiIjtzOjE0OiJlc3RvcmVfNDY4X3VybCI7czowOiIiO30=';

	/*global $options;

	foreach ($options as $value) {
		if( isset( $value['id'] ) ) {
			update_option( $value['id'], $value['std'] );
		}
	}*/

	$importedOptions = unserialize(base64_decode($importOptions));

	foreach ($importedOptions as $key=>$value) {
		if ($value != '') update_option( $key, $value );
	}

	update_option( $shortname . '_use_pages', 'false' );
} ?>