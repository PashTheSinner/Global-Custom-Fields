<?php
/**
 * Plugin Name: Global Custom Fields
 * Plugin URI: https://www.pashstratton.co.uk
 * Description: Shortcodes for essential repeated information such as phone number, mobile number and address etc. 
 * Version: 1.0
 * Author: Pash Stratton
 * Author URI: https://www.pashstratton.co.uk
 */



//Adding Options Page in Settings
add_action('admin_menu', 'add_gcf_interface');

function add_gcf_interface() {
	add_options_page('Global Custom Fields Shortcodes', 'Global Custom Fields Shortcodes', 'manage_options', 'gcf.php', 'editglobalcustomfields');
}


// Add Plugin Settings Button in Plugin Menu
add_filter('plugin_action_links_'.plugin_basename(__FILE__), 'salcode_add_plugin_page_settings_link');
function salcode_add_plugin_page_settings_link( $links ) {
	$links[] = '<a href="' .
		admin_url( 'options-general.php?page=gcf.php' ) .
		'">' . __('Settings') . '</a>';
	return $links;
}

// Include Frontend Custom CSS
function wpse_load_plugin_css() {
    $plugin_url = plugin_dir_url( __FILE__ );

    wp_enqueue_style( 'style', $plugin_url . 'css/style.css' );
}
add_action( 'wp_enqueue_scripts', 'wpse_load_plugin_css' );



// Include Frontend Custom JS 
// wp_register_script( 'my_plugin_script', plugins_url('js/custom.js', __FILE__), array('jquery'));

// wp_enqueue_script( 'my_plugin_script' );



//Add Privacy Policy Page on activation:
function install_privacy_pg(){
ob_start();
include 'inc/privacy-policy.php';
ob_end_clean();
        $new_page_title = 'Privacy Policy';
        $new_page_template = '';
        $page_check = get_page_by_title($new_page_title);
        $new_page = array(
                'post_type' => 'page',
                'post_title' => $new_page_title,
                'post_content' => $privacypolicy,
                'post_status' => 'publish',
                'post_author' => 1,
        );
        if(!isset($page_check->ID)){
                $new_page_id = wp_insert_post($new_page);
                if(!empty($new_page_template)){
                        update_post_meta($new_page_id, '_wp_page_template', $new_page_template);
                }
        }
}

register_activation_hook(__FILE__, 'install_privacy_pg');



//Add Cookie Page on activation:
function install_cookies_pg(){
ob_start();
include 'inc/cookie-policy.php';
ob_end_clean();
        $new_page_title = 'Cookie Policy';
        $new_page_template = '';
        $page_check = get_page_by_title($new_page_title);
        $new_page = array(
                'post_type' => 'page',
                'post_title' => $new_page_title,
                'post_content' => $cookie,
                'post_status' => 'publish',
                'post_author' => 1,
        );
        if(!isset($page_check->ID)){
                $new_page_id = wp_insert_post($new_page);
                if(!empty($new_page_template)){
                        update_post_meta($new_page_id, '_wp_page_template', $new_page_template);
                }
        }
}

register_activation_hook(__FILE__, 'install_cookies_pg');



//Add Terms & Conditions Page on activation:
function install_terms_pg(){
ob_start();
include 'inc/terms-and-conditions.php';
ob_end_clean();
        $new_page_title = 'Terms & Conditions';
        $new_page_template = '';
        $page_check = get_page_by_title($new_page_title);
        $new_page = array(
                'post_type' => 'page',
                'post_title' => $new_page_title,
                'post_content' => $terms,
                'post_status' => 'publish',
                'post_author' => 1,
        );
        if(!isset($page_check->ID)){
                $new_page_id = wp_insert_post($new_page);
                if(!empty($new_page_template)){
                        update_post_meta($new_page_id, '_wp_page_template', $new_page_template);
                }
        }
}

register_activation_hook(__FILE__, 'install_terms_pg');



// Post to WP Options Table
function editglobalcustomfields() {
	?>
	<div class='wrap'>
	<h2 style="margin-bottom:20px;">Global Custom Fields</h2>
	<form method="post" action="options.php">
	<?php wp_nonce_field('update-options') ?>



<style>
th {
        text-align:left;
    }
    
table {
    background: white !important;
    padding: 10px 20px 0px 20px;
    width: 100%;
}
	
	.gcfcolone {
    width: 75%;
    background: white;
		float:left;
		    min-height: 1170px;
}
	
.midtext {
    padding: 20px 20px 0px 20px;
}
	
	input[type="submit"] {
    background: #0173aa;
    padding: 10px;
    color: white;
}
	
.gcfcoltwo {
    min-height: 1170px;
    width: 100% !important;
    background: #e4e4e403;
    background-position: -141px;
    background-repeat: no-repeat;
    background-size: cover;
    display: block;
    box-shadow: 7px 6px 12px #0000001c;
}
	

</style>


<!-- Backend Options  -->

<div class="gcfcolone">
	
		
<table>
	<tr><td><h3>Global Fields</h3></td></tr>	
		<tr><td><p>These shortcodes and relevant fields display basic site information such as Telephone numbers and address. If the details need changing, they only require updating here and will autopopulate throughout the site everywhere they are used.</p></td></tr>
	
	<tr>	
 <th scope="row"><label for="global_options_landline">Landline Number</label></th>
  <td><input type="tel" name="landline" placeholder="Enter Landline Number" size="45" value="<?php echo get_option('landline'); ?>" /></td>
      <td><input type="text" id="essentialsshortcoder_option_name" name="essentialsshortcoder_option_name" value="[landline]" readonly="readonly" onClick="this.setSelectionRange(0, this.value.length)" /></td>
	</tr>
	
	
	<tr>	
 <th scope="row"><label for="global_options_mobile">Mobile Number</label></th>
  <td><input type="tel" name="mobile" placeholder="Enter Mobile Number" size="45" value="<?php echo get_option('mobile'); ?>" /></td>
      <td><input type="text" id="essentialsshortcoder_option_name" name="essentialsshortcoder_option_name" value="[mobile]" readonly="readonly" onClick="this.setSelectionRange(0, this.value.length)" /></td>
	</tr>
	
		<tr>	
 <th scope="row"><label for="global_options_email">Email</label></th>
  <td><input type="email" placeholder="Enter Main Email Address" name="email" size="45" value="<?php echo get_option('email'); ?>" /></td>
      <td><input type="text" id="essentialsshortcoder_option_name" name="essentialsshortcoder_option_name" value="[email]" readonly="readonly" onClick="this.setSelectionRange(0, this.value.length)" /></td>
	</tr>
	
	
			<tr>	
 <th scope="row"><label for="global_options_address">Address</label></th>
  <td><input type="text" placeholder="Enter Street Address" name="address" size="45" value="<?php echo get_option('address'); ?>" /></td>
      <td><input type="text" id="essentialsshortcoder_option_name" name="essentialsshortcoder_option_name" value="[address]" readonly="readonly" onClick="this.setSelectionRange(0, this.value.length)" /></td>
	</tr>
	
<tr><td><h3>GDPR Fields</h3></td></tr>	
	<tr><td><p>These fields are automatically included in the site privacy policy, cookie policy, and terms and conditions pages. All you need to do is update once and they'll automatically pull through everywhere. </p></td></tr>	
	
					<tr>	
 <th scope="row"><label for="global_options_gdpr_businessname">GDPR Business Name</label></th>
  <td><input type="text" placeholder="Enter Business Name" name="gdprbusinessname" size="45" value="<?php echo get_option('gdprbusinessname'); ?>" /></td>
      <td><input type="text" id="essentialsshortcoder_option_name" name="essentialsshortcoder_option_name" value="[gdpr_business_name]" readonly="readonly" onClick="this.setSelectionRange(0, this.value.length)" /></td>
	</tr>	

	
					<tr>	
 <th scope="row"><label for="global_options_gdpr_officer">GDPR Officer Name</label></th>
  <td><input type="text" placeholder="Enter the Name of the GDPR Officer" name="gdprofficer" size="45" value="<?php echo get_option('gdprofficer'); ?>" /></td>
      <td><input type="text" id="essentialsshortcoder_option_name" name="essentialsshortcoder_option_name" value="[gdpr_officer]" readonly="readonly" onClick="this.setSelectionRange(0, this.value.length)" /></td>
	</tr>
	
	
						<tr>	
 <th scope="row"><label for="global_options_phone">GDPR Phone Number</label></th>
  <td><input type="tel" placeholder="Enter GDPR Phone Number" name="gdprphone" size="45" value="<?php echo get_option('gdprphone'); ?>" /></td>
      <td><input type="text" id="essentialsshortcoder_option_name" name="essentialsshortcoder_option_name" value="[gdpr_phone]" readonly="readonly" onClick="this.setSelectionRange(0, this.value.length)" /></td>
	</tr>
	
	
							<tr>	
 <th scope="row"><label for="global_options_email">GDPR Email Address</label></th>
  <td><input type="email" placeholder="Enter the GDPR Email Address" name="gdpremail" size="45" value="<?php echo get_option('gdpremail'); ?>" /></td>
      <td><input type="text" id="essentialsshortcoder_option_name" name="essentialsshortcoder_option_name" value="[gdpr_email]" readonly="readonly" onClick="this.setSelectionRange(0, this.value.length)" /></td>
	</tr>

								<tr>	
 <th scope="row"><label for="global_options_gdpraddress">GDPR Address</label></th>
  <td><input type="text" placeholder="Enter GDPR Street Address" name="gdpraddress" size="45" value="<?php echo get_option('gdpraddress'); ?>" /></td>
      <td><input type="text" id="essentialsshortcoder_option_name" name="essentialsshortcoder_option_name" value="[gdpr_address]" readonly="readonly" onClick="this.setSelectionRange(0, this.value.length)" /></td>
	</tr>
	
	
<tr>	
 <th scope="row"><label for="global_options_gdprurl">GDPR Web Url</label></th>
  <td><input type="text" placeholder="Enter GDPR Domain URL" name="gdprurl" size="45" value="<?php echo get_option('gdprurl'); ?>" /></td>
      <td><input type="text" id="essentialsshortcoder_option_name" name="essentialsshortcoder_option_name" value="[gdpr_url]" readonly="readonly" onClick="this.setSelectionRange(0, this.value.length)" /></td>
	</tr>
	
	
	</table>	
		<div class="lowercolone">	
	<div class="midtext">
	
	
	<div>Below are some other handy shortcodes. These pull in different variables from the site to display where you need them. </div>
</div>			
			<table>
				<tbody>
					<tr>	
 <th scope="row"><label for="global_options_footer">Footer Copyright (with automatic year)</label></th>
      <td style="text-align:right;"><input type="text" id="essentialsshortcoder_option_name" name="essentialsshortcoder_option_name" value="[footer]" readonly="readonly" onClick="this.setSelectionRange(0, this.value.length)" /></td>
	</tr>
					
										<tr>	
 <th scope="row"><label for="global_options_gdpr_footer_links">GDPR Footer Links (Privacy, Cookie & Terms Pages)</label></th>
      <td style="text-align:right;"><input type="text" id="essentialsshortcoder_option_name" name="essentialsshortcoder_option_name" value="[gdpr_footer_links]" readonly="readonly" onClick="this.setSelectionRange(0, this.value.length)" /></td>
	</tr>


				
</tbody>
</table>
			
			<div style="padding-left:20px;" class="submitbutton">
							<p><input type="submit" name="Submit" value="Update Options" class="button button-primary"></p>

	<input type="hidden" name="action" value="update" />
	<input type="hidden" name="page_options" value="landline,mobile,email,address,gdprbusinessname,gdprofficer,gdprphone,gdpremail,gdpraddress,gdprurl,facebook,twitter,instagram,linkedin,pinterest,youtube,headerhide" />
			</div>
			
			
</div>
</div>	


<!-- Thomas the Tank Engine  -->
		
		<div class="gcfcoltwo">
			</div>
	
	<?php
}



// Landline Number Shortcode
function landline()
{
     ob_start(); ?>
            <a href="tel:<?php echo get_option('landline'); ?>"><?php echo get_option('landline'); ?></a>
<?php

    return ob_get_clean();
}
add_shortcode( 'landline', 'landline' );



// Mobile Number Shortcode
function mobile()
{
     ob_start(); ?>
            <a href="tel:<?php echo get_option('mobile'); ?>"><?php echo get_option('mobile'); ?></a>
<?php

    return ob_get_clean();
}
add_shortcode( 'mobile', 'mobile' );



// Email Shortcode
function email()
{
     ob_start(); ?>
            <a href="mailto:<?php echo get_option('email'); ?>"><?php echo get_option('email'); ?></a>
<?php

    return ob_get_clean();
}
add_shortcode( 'email', 'email' );



// Address Shortcode
function address() {

    $output = '';
    $output.= get_option('address');
    return $output;

}
add_shortcode( 'address', 'address' );



// GDPR Business Name Shortcode
function gdprbusinessname() {

    $output = '';
    $output.= get_option('gdprbusinessname');
    return $output;

}
add_shortcode( 'gdpr_business_name', 'gdprbusinessname' );



// GDPR Officer Shortcode
function gdprofficer() {

    $output = '';
    $output.= get_option('gdprofficer');
    return $output;

}
add_shortcode( 'gdpr_officer', 'gdprofficer' );


// GDPR Phone Number Shortcode
function gdprphone()
{
     ob_start(); ?>
            <a href="tel:<?php echo get_option('gdprphone'); ?>"><?php echo get_option('gdprphone'); ?></a>
<?php

    return ob_get_clean();
}
add_shortcode( 'gdpr_phone', 'gdprphone' );


// GDPR Email Shortcode
function gdpremail()
{
     ob_start(); ?>
            <a href="mailto:<?php echo get_option('gdpremail'); ?>"><?php echo get_option('gdpremail'); ?></a>
<?php

    return ob_get_clean();
}
add_shortcode( 'gdpr_email', 'gdpremail' );



// GDPR Address Shortcode
function gdpraddress() {

    $output = '';
    $output.= get_option('gdpraddress');
    return $output;

}
add_shortcode( 'gdpr_address', 'gdpraddress' );



// GDPR Web URL Shortcode
function gdprurl()
{
     ob_start(); ?>
            <a href="<?php echo get_option('gdprurl'); ?>"><?php echo get_option('gdprurl'); ?></a>
<?php

    return ob_get_clean();
}
add_shortcode( 'gdpr_url', 'gdprurl' );


// Facebook Icon Shortcode
function facebook()
{
      ob_start(); ?>

            <a href="<?php echo get_option('facebook'); ?>"><i class="fa fa-facebook" aria-hidden="true"></i></a>
 <?php

    return ob_get_clean();
}
add_shortcode( 'facebook', 'facebook' );



// Twitter Icon Shortcode
function twitter()
{
      ob_start(); ?>

            <a href="<?php echo get_option('twitter'); ?>"><i class="fa fa-twitter" aria-hidden="true"></i></a>
 <?php

    return ob_get_clean();
}
add_shortcode( 'twitter', 'twitter' );



// Instagram Icon Shortcode
function instagram()
{
      ob_start(); ?>

            <a href="<?php echo get_option('instagram'); ?>"><i class="fa fa-instagram" aria-hidden="true"></i></a>
 <?php

    return ob_get_clean();
}
add_shortcode( 'instagram', 'instagram' );



// Pinterest Icon Shortcode
function pinterest()
{
      ob_start(); ?>

            <a href="<?php echo get_option('pinterest'); ?>"><i class="fa fa-pinterest" aria-hidden="true"></i></a>
 <?php

    return ob_get_clean();
}
add_shortcode( 'pinterest', 'pinterest' );



// Linkedin Icon Shortcode
function linkedin()
{
      ob_start(); ?>

            <a href="<?php echo get_option('linkedin'); ?>"><i class="fa fa-linkedin" aria-hidden="true"></i></a>
 <?php

    return ob_get_clean();
}
add_shortcode( 'linkedin', 'linkedin' );




// Youtube Icon Shortcode
function youtube()
{
      ob_start(); ?>

            <a href="<?php echo get_option('youtube'); ?>"><i class="fa fa-youtube" aria-hidden="true"></i></a>
 <?php

    return ob_get_clean();
}
add_shortcode( 'youtube', 'youtube' );



//Site Name Shortcode
add_shortcode('bloginfo', function($atts) {

   $atts = shortcode_atts(array('filter'=>'', 'info'=>''), $atts, 'bloginfo');

   $infos = array(
     'name'
   );

   $filter = in_array(strtolower($atts['filter']), array('raw', 'display'), true)
     ? strtolower($atts['filter'])
     : 'display';

   return in_array($atts['info'], $infos, true) ? get_bloginfo($atts['info'], $filter) : '';
});



// Footer Copyright Shortcode
function footer()
{
     ob_start(); ?>

© <?php echo date("Y"); ?> <?php echo do_shortcode('[bloginfo info="name"]') ?>. All Rights Reserved.

<?php

    return ob_get_clean();
}
add_shortcode( 'footer', 'footer' );



// Footer GDPR Page Links Shortcode
function gdprpagelinks()
{
     ob_start(); ?>

<a href=/privacy-policy>Privacy Policy</a> | <a href=/cookie-policy>Cookie Policy</a> | <a href=/terms-and-conditions>Terms & Conditions</a>

<?php

    return ob_get_clean();
}
add_shortcode( 'gdpr_footer_links', 'gdprpagelinks' );
?>

