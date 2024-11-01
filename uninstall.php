<?php

//if uninstall not called from WordPress exit
if ( !defined( 'WP_UNINSTALL_PLUGIN' ) )
	exit ();

	
delete_option('wploginsecurity2_ip_whitelist');
delete_option('wploginsecurity2');

?>