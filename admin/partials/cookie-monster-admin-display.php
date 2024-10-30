<?php

/**
 * Provide a dashboard view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link       http://example.com
 * @since      1.2.0
 *
 * @package    Cookie_Monster
 * @subpackage Cookie_Monster/admin/partials
 */

//$options = unserialize(get_option('cookie-monster-settings'));
$selected = 'selected="selected"';
$checked = 'checked="checked"';

?>
<!-- This file should primarily consist of HTML with a little bit of PHP. -->
	<div id="cookie-monster-wrap" class="wrap container">
		
		<h2><?php _e('Cookie Monster',$this->plugin_name);?> <?php echo $this->version;?></h2>
		<form name="ohayo-cookie-moster-setup" method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']);?>">
		
		<?php wp_nonce_field( plugin_basename( __FILE__ ), 'cookie_monster_document_noncename' ); ?>
	
		<div id="cookie-monster-cpanel" class="cpanel">

			<div class="cookie_monster_active">
				<label for="cookie_monster_active" style="float: left; width: auto;"><h3><?php _e('Is Cookie Monster running?',$this->plugin_name);?></h3></label>
				<div class="cm-left">
					<label class="switch-light switch-candy large-3" onclick="" >
						<input type="checkbox" id="cookie_monster_active" name="cookie_monster_active" <?php if($options['cookie_monster_active']=='on') echo 'checked';?>>
						<span>
							<span><?php _e('No',$this->plugin_name);?></span>
							<span><?php _e('Yes',$this->plugin_name);?></span>
						</span>
						<a></a>
					</label>
				</div>
			</div><!-- cookie_monster_active -->
		
		<div class="clear"></div>
		<div class="alert_type">
			<h3><?php _e('Configuration', $this->plugin_name )?></h3>
	        
	        <div class="clear"></div>

			<div class="switch-toggle switch-3 switch-candy">
				<input id="cookie_monster_alert_type_info" name="cookie_monster_alert_type" value="texts" type="radio">
				<label for="cookie_monster_alert_type_info" onclick="" ><?php _e('Texts & Languages',$this->plugin_name);?></label>
			
				<input id="cookie_monster_alert_type_implied" name="cookie_monster_alert_type" value="display" type="radio">
				<label for="cookie_monster_alert_type_implied" onclick="" ><?php _e('Display',$this->plugin_name);?></label>
				
				<input id="cookie_monster_alert_type_explicit" name="cookie_monster_alert_type" value="advanced" type="radio">
				<label for="cookie_monster_alert_type_explicit" onclick="" ><?php _e('Advanced',$this->plugin_name);?></label>
							
				<a></a>
			</div>
		</div>
		<div class="clear"></div>
		
		<div class="alert-type-selection"></div><!-- ajax content -->
		
		<div id="config-texts" class="">
			<?php include_once('cookie-monster-config-texts.php');?>
		</div>
		<div id="config-display" class="">
			<?php include_once('cookie-monster-config-display.php');?>
		</div>
		<div id="config-advanced" class="">
			<?php include_once('cookie-monster-config-advanced.php');?>
		</div>
	
	<div id="cookie-monster-submit"><?php submit_button(); ?></div>
	</form>
	

</div><!--.wrap-->
<?php 