<?php

/*  Copyright 2012  Anders Vinther  (email : anders@wpsecuritychecklist.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA

*/

 

 
add_action( 'admin_init' , 'wpls2_options_init' );
add_action( 'admin_menu' , 'wpls2_options_add_page');


//remove outstanding data
function remove_outstanding(){
global $wpls2_options, $current_user;
	$known = get_option( $wpls2_options['whitelist'] );
	// Remove oustanding data.
	foreach($known as $field=>$topVal){
		foreach($topVal as $key=>$val){
			if($val['activated']==1){
					$arr[$field][$key]['date_requested']=$val['date_requested'];
					$arr[$field][$key]['activated']=$val['activated'];
					$arr[$field][$key]['ipkey']=$val['ipkey'];
					$arr[$field][$key]['date_activated']=$val['date_activated'];
				
			}
		}
	}
	update_option( $wpls2_options['whitelist'] , $arr );
}

//Remove whitlisted ip.
function remove_whitlisted_ip(){
global $wpls2_options, $current_user;
	
	$user = $current_user->user_login;
	$ip = $_SERVER['REMOTE_ADDR'];
	$known[ $user ][ $ip ]['date_requested'] = date(WPLS2_DATE_FORMAT);
	$known[ $user ][ $ip ]['date_activated'] = date(WPLS2_DATE_FORMAT);
	$known[ $user ][ $ip ]['activated'] = true;
	update_option( $wpls2_options['whitelist'] , $known );

}

// Init plugin options to white list our options
function wpls2_options_init(){
	register_setting( 'wploginsecurity2_options', 'wploginsecurity2', 'wpls2_options_validate');
}

// Add menu page
function wpls2_options_add_page() {
	add_options_page('WP Login Security 2 Options', 'WP Login Security 2', 'manage_options', 'wploginsecurity2', 'wpls2_options_do_page');
}

// Draw the menu page itself
function wpls2_options_do_page() {
	global $wpls2_options;
		if(isset($_POST['outstanding'])){
			remove_outstanding();
		}
		if(isset($_POST['whitelist'])){
			remove_whitlisted_ip();
		}
	?>
	<div class="wrap">
		<div class="icon32" id="icon-users"></div>
		<h2>WP Login Security 2</h2>
		<p>WP Login Security 2 allows each user to maintain a whitelist of IP addresses allowed to login to the site.</p>
		<form method="post" action="options.php">
			<?php settings_fields('wploginsecurity2_options'); ?>
			<?php $options = get_option('wploginsecurity2'); ?>
			<table class="form-table">
				<tr valign="top">
					<th scope="row">
						Enable WP Login Security 2?
					</th>
					<td>
						<input name="wploginsecurity2[enabled]" type="checkbox" value="1" <?php checked('1', $options['enabled']); ?> />
					</td>
				</tr>
				<tr valign="top">
					<th scope="row">
						Notify Both Blog Admin & User?
					</th>
					<td>
						<input name="wploginsecurity2[notify_both]" type="checkbox" value="1" "<?php checked('1', $options['notify_both']); ?>" />
					</td>
				</tr>
			</table>
			<p class="submit">
				<input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
			</p>
		</form>
		<div><div style="float:left;"><h3>Whitelisted IP Addresses</h3></div><div style="float:left; margin-left:47px; padding-top:10px;"> 
		<form method="post" action="">
			
		<input type="submit" value="Clear List" name="whitelist" class="button-primary" /></form></div>
		<div style='clear:both'></div>
		</div>
		<?php $whitelist = get_option($wpls2_options['whitelist']); ?>
		<table class="widefat">
			<thead>
			<tr>
				<th>Username</th>
				<th>IP Address</th>
				<th>Date Activated</th>
			</tr>
			</thead>
			<tfoot>
			<tr>
				<th>Username</th>
				<th>IP Address</th>
				<th>Date Activated</th>
			</tr>
			</tfoot>
			<tbody>
			<?php
				foreach ($whitelist as $user => $arr1) { foreach ($arr1 as $ip => $arr2) {
					if ($arr2['activated'] == true) {
						echo "<tr><td>$user</td><td>$ip</td>";
						echo "<td>{$arr2['date_activated']}</td></tr>";
					}
				}}
			?>
			</tbody>
		</table>
		<div><div style="float:left;"><h3>Outstanding IP Activations</h3></div><div style="float:left; margin-left:40px; padding-top:10px;"> 
		<form method="post" action="">
			
		<input type="submit" value="Clear List" name="outstanding" class="button-primary" /></form></div>
		<div style='clear:both'></div>
		</div>
		<table class="widefat">
			<thead>
			<tr>
				<th>Username</th>
				<th>IP Address</th>
				<th>Request Date</th>
				<th>Activation Key</th>
			</tr>
			</thead>
			<tfoot>
			<tr>
				<th>Username</th>
				<th>IP Address</th>
				<th>Request Date</th>
				<th>Activation Key</th>
			</tr>
			</tfoot>
			<tbody>

			<?php
				foreach ($whitelist as $user => $arr1) { foreach ($arr1 as $ip => $arr2) { if ($arr2['activated'] == false) {
						echo "<tr><td>$user</td><td>$ip</td><td>{$arr2['date_requested']}</td><td>{$arr2['ipkey']}</td></tr>";
				}}}
			?>

			</tbody>
		</table>
		<h3>About WP Login Security</h3>
		<div style="width: 1000px; text-align: center; margin: 0 auto;">
			<a href="http://www.wpsecuritychecklist.com/"><img src="<?php echo plugins_url( 'logo.png', __FILE__ ); ?>" alt="Wordpress Security Checklist" /></a>
			<span style="display: block;">This plugin is maintained by <a href="http://www.wpsecuritychecklist.com/">The Wordpress Security Checklist</a>.</span>
			<span style="display: block;">Visit our site to get your FREE copy of our WordPress Security Checklist!</span>
		</div>
		
	</div>
	<?php
}

// Sanitize and validate input. Accepts an array, return a sanitized array.
function wpls2_options_validate($input) {
	// Both options values are checkboxes: 0 (False) or 1 (True)
	$input['enabled'] = ( $input['enabled'] == 1 ? 1 : 0 );
	$input['notify_both'] = ( $input['notify_both'] == 1 ? 1 : 0 );
	return $input;
}


