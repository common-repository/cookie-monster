<?php 


?>
	
<h3><?php _e('Hide user interface',$this->plugin_name);?></h3>
<ul>
	<li>
		<label style="display:inline;"><input type="radio" value="true" checked="checked" id="cookie_monster_hide" name="cookie_monster_hide" <?php if($options['cookie_monster_hide']=='true') echo $checked;?>>
         	<?php _e('Yes',$this->plugin_name);?></label><label class="short" style="display:inline;">, <?php _e('show for',$this->plugin_name);?>
            <input type="text" value="7" name="cookie_monster_hide_time" id="cookie_monster_hide_time" class="text short">
        	<?php _e('seconds',$this->plugin_name);?>
        </label>
	</li>
	<li>
		<label>
			<input type="radio" value="false" id="cookie_monster_hide" name="cookie_monster_hide" <?php if($options['cookie_monster_hide']=='false') echo $checked;?>>
            <?php _e('No',$this->plugin_name);?>
		</label>
	</li>
</ul>


	<div>
			<div class="clear"></div>
		
		<h3><?php _e('Custom Display',$this->plugin_name);?></h3>
		
		<label for="cookie_monster_show_registered_users"><?php _e('Show to logged users',$this->plugin_name);?> </label>
		<select id="cookie_monster_show_registered_users" name="cookie_monster_show_registered_users">
			<option value="yes" <?php if($options['cookie_monster_show_registered_users']=='yes') echo $selected;?>><?php _e('Yes',$this->plugin_name);?></option>
			<option value="no" <?php if($options['cookie_monster_show_registered_users']=='no') echo $selected;?>><?php _e('No',$this->plugin_name);?></option>
		</select>
		
		<label><?php _e('Position',$this->plugin_name);?></label>
		<select id="cookie_monster_position_bar" name="cookie_monster_position_bar">
			<option value="top" <?php if($options['cookie_monster_position_bar']=='top') echo $selected;?>><?php _e('Top',$this->plugin_name);?></option>
			<option value="bottom" <?php if($options['cookie_monster_position_bar']=='bottom') echo $selected;?>><?php _e('Bottom',$this->plugin_name);?></option>
			<option value="corner" <?php if($options['cookie_monster_position_bar']=='corner') echo $selected;?>><?php _e('Corner',$this->plugin_name);?></option>
		</select>
		<div class="clear"></div>
		<div style="float: left; width: 31%; margin: 0 1%;">
			<label for="cookie_monster_fixedbar_background"><?php _e('Background Color',$this->plugin_name);?></label>
			<input type="text" value="<?php echo $options['cookie_monster_fixedbar_background'];?>" class="background-color" name="cookie_monster_fixedbar_background" id="cookie_monster_fixedbar_background">
			<label for="cookie_monster_fixedbar_color"><?php _e('Font Color',$this->plugin_name);?></label>
			<input type="text" value="<?php echo $options['cookie_monster_fixedbar_color'];?>" class="background-color" name="cookie_monster_fixedbar_color" id="cookie_monster_fixedbar_color">
		</div>
		<div style="float: left; width: 31%; margin: 0 1%;">
			<label for="cookie_monster_accept_background"><?php _e('Background Color for Accept Button',$this->plugin_name);?></label>
			<input type="text" name="cookie_monster_accept_background" id="cookie_monster_accept_background" class="background-color" value="<?php echo $options['cookie_monster_accept_background'];?>"/>
			<label for="cookie_monster_accept_color"><?php _e('Font Color for Accept Button',$this->plugin_name);?></label>
			<input type="text" name="cookie_monster_accept_color" id="cookie_monster_accept_color" class="background-color" value="<?php echo $options['cookie_monster_accept_color'];?>"/>
		</div>
		<div style="float: left; width: 31%; margin: 0 1%;">
			<label for="cookie_monster_info_background"><?php _e('Background Color for Info Button',$this->plugin_name);?></label>
			<input type="text" name="cookie_monster_info_background" id="cookie_monster_info_background" class="background-color" value="<?php echo $options['cookie_monster_info_background'];?>"/>
			<label for="cookie_monster_info_color"><?php _e('Font Color for Info Button',$this->plugin_name);?></label>
			<input type="text" name="cookie_monster_info_color" id="cookie_monster_info_color" class="background-color" value="<?php echo $options['cookie_monster_info_color'];?>"/>
		</div>
		
		<label><?php _e('Opacity',$this->plugin_name);?></label>
		<select id="cookie_monster_opacity_bar" name="cookie_monster_opacity_bar">
			<option value="1" <?php if($options['cookie_monster_opacity_bar']=='1') echo $selected;?>><?php _e('None',$this->plugin_name);?></option>
			<option value=".1" <?php if($options['cookie_monster_opacity_bar']=='.1') echo $selected;?>>.1</option>
			<option value=".2" <?php if($options['cookie_monster_opacity_bar']=='.2') echo $selected;?>>.2</option>
			<option value=".3" <?php if($options['cookie_monster_opacity_bar']=='.3') echo $selected;?>>.3</option>
			<option value=".4" <?php if($options['cookie_monster_opacity_bar']=='.4') echo $selected;?>>.4</option>
			<option value=".5" <?php if($options['cookie_monster_opacity_bar']=='.5') echo $selected;?>>.5</option>
			<option value=".6" <?php if($options['cookie_monster_opacity_bar']=='.6') echo $selected;?>>.6</option>
			<option value=".7" <?php if($options['cookie_monster_opacity_bar']=='.7') echo $selected;?>>.7</option>
			<option value=".8" <?php if($options['cookie_monster_opacity_bar']=='.8') echo $selected;?>>.8</option>
			<option value=".9" <?php if($options['cookie_monster_opacity_bar']=='.9') echo $selected;?>>.9</option>
			
		</select>
	</div><!--.cookie-monster-cpanel-->