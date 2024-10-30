<?php

/**
 * Provide a public-facing view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Plugin_Name
 * @subpackage Plugin_Name/public/partials
 */
?>
<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<style scoped>
#cookie-monster{ 
	background-color: <?php echo $this->config['cookie_monster_fixedbar_background'];?>; 
	opacity: <?php echo $this->config['cookie_monster_opacity_bar']; ?>;
	color: <?php echo $this->config['cookie_monster_fixedbar_color'];?>;
}
.cookie-monster-text a{
	color: <?php echo $this->config['cookie_monster_fixedbar_color'];?>;
	text-decoration: underline;
}
	
.info-cookie-monster{
	color: <?php echo $this->config['cookie_monster_info_color']; ?>;
	background-color: <?php echo $this->config['cookie_monster_info_background']; ?>;
}
.close-cookie-monster{ 
	color: <?php echo $this->config['cookie_monster_accept_color']; ?>;
	background-color: <?php echo $this->config['cookie_monster_accept_background']; ?>;
}
/*
.hide-cookie-monster{ 
	<?php if ($this->config['cookie_monster_position_bar'] != 'corner'): ?>
		right: -20px; 
	<?php else:?>
		right: 0px; 
	<?php endif;?>
}
*/
<?php echo stripslashes($this->config['cookie_monster_css']);?>
			
</style>
		
<?php if ($this->config['cookie_monster_hide'] == 'true'): ?>
<script type="text/javascript">
	jQuery(document).ready(function($){
		$('#cookie-monster').delay(<?php echo ($this->config['cookie_monster_hide_time']*1000);?>).fadeOut('slow');
	});
</script>
<?php endif;?>

<?php if(!defined('ICL_LANGUAGE_CODE')) :?>		
	
	<div id="cookie-monster" class="bar-<?php echo $this->config['cookie_monster_position_bar'];?>">
	
		<img class="hide-cookie-monster" src="<?php echo plugins_url('../img/close.png', __FILE__ );?>" alt="<?php _e('Close',$this->plugin_name);?>"/>
		<p class="cookie-monster-text">
			<?php echo stripslashes($this->config['cookie_monster_text']);?>
		</p>
		<div class="cookie-monster-buttons">
			
			<button class="close-cookie-monster"><?php echo stripslashes($this->config['cookie_monster_accept']);?></button>
			
			<?php if (!empty($this->config['cookie_monster_info'])):?>
			<a href="<?php echo esc_url($this->config['cookie_monster_info_url']); ?>" target="_blank">
				<button class="info-cookie-monster"><?php echo $this->config['cookie_monster_info'];?></button>
			</a>
			<?php endif;?>
			
		</div>
	</div>
	
<?php else:
$text = unserialize($this->config['cookie_monster_text']); 
$accept = unserialize($this->config['cookie_monster_accept']);
$info = unserialize($this->config['cookie_monster_info']);
$info_url = unserialize($this->config['cookie_monster_info_url']);
?>
	<div id="cookie-monster" class="bar-<?php echo $this->config['cookie_monster_position_bar'];?>">
		<img class="hide-cookie-monster" src="<?php echo plugins_url('../img/close.png', __FILE__ );?>" alt="<?php _e('Close',$this->plugin_name);?>"/>
		
		<p class="cookie-monster-text">
		
			<?php echo stripslashes($text[ICL_LANGUAGE_CODE]);?>
				
			<a href="<?php echo esc_url($info_url[ICL_LANGUAGE_CODE]); ?>" target="_blank">
				<?php echo $info[ICL_LANGUAGE_CODE];?>
			</a>
		</p>
		<div class="cookie-monster-buttons">
		
			<button class="close-cookie-monster"><?php echo stripslashes($accept[ICL_LANGUAGE_CODE]);?></button> 
			
			<?php if (!empty($info[ICL_LANGUAGE_CODE])):?>
			<a href="<?php echo esc_url($info_url[ICL_LANGUAGE_CODE]); ?>" target="_blank">
				<button class="info-cookie-monster"><?php echo $info[ICL_LANGUAGE_CODE];?></button>
			</a>
			<?php endif;?>
		
		</div>
	</div>
<?php endif;?>
<div id="cookie-monster-debug"></div>
