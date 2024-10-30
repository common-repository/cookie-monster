<?php 


?>
<h3><?php _e('Advanced Setup',$this->plugin_name);?></h3>
<div id="cookie-monster-advanced" class="cpanel">
	
	<label for="cookie_monster_css"><?php _e('Custom Style Sheet',$this->plugin_name);?></label>
	<textarea name="cookie_monster_css" id="cookie_monster_css" cols="50" rows="4"><?php echo stripslashes($options['cookie_monster_css']);?></textarea>
</div>