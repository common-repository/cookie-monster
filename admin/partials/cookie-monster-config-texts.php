<?php 
/**
 * Vista parcial para la seleccion informativa
 * 
 */
?>


<?php if(!$this->get_wpml_support()): ?>
	<h3><?php _e('Texts',$this->plugin_name);?></h3>
	
	<label for="cookie_monster_text"><?php _e('Message',$this->plugin_name);?></label><!-- continuar traduccion -->
	<textarea name="cookie_monster_text" id="cookie_monster_text" cols="50" rows="4"><?php echo esc_textarea(stripslashes($options['cookie_monster_text']));?></textarea>

	<label for="cookie_monster_text"><?php _e('Text for Accept Button',$this->plugin_name);?></label>
	<input type="text" name="cookie_monster_accept" id="cookie_monster_accept" value="<?php echo stripslashes($options['cookie_monster_accept']);?>"/>
	
	
	<label for="cookie_monster_text"><?php _e('Text for More Info Button',$this->plugin_name);?></label>
	<input type="text" name="cookie_monster_info" id="cookie_monster_info" value="<?php echo stripslashes($options['cookie_monster_info']);?>"/>
	
	<label for="cookie_monster_text"><?php _e('More Info Page Destination', $this->plugin_name);?></label>
	<?php  /* <input type="text" name="cookie_monster_info_url" id="cookie_monster_info_url" value="<?php echo $options['cookie_monster_info_url'];?>"/>*/?>

	<?php $pages = $this->get_pages();
	if($pages):?>
	<select id="cookie_monster_info_url" name="cookie_monster_info_url">
		<option value="custom"><?php _e('None','$this->plugin_name')?></option>
		<?php foreach ($pages as $key => $value):?>
		
		<option value="<?php echo $key?>" <?php echo ($options['cookie_monster_info_url'] == $key) ? 'selected' : null ; ?>><?php echo $value?></option>					
		<?php endforeach; ?>
	
	</select>
	<?php endif;
	
	?>
	
	
<?php else: 
	$languages = icl_get_languages('skip_missing=0');
?>
	<h3><?php _e('Languages from WPML',$this->plugin_name);?></h3>
	<section>
	<div class="tabs tabs-style-underline">
		<?php if(1 < count($languages)) :?>
		<nav>
			<ul>
			<?php foreach($languages as $l){
			
				?><li class="<?php if($l['active']) echo 'tab-current'; ?>"><a href="#language-<?php echo $l['language_code']?>"><img src="<?php echo $l['country_flag_url'];?>"/> <?php echo $l['native_name'];?></a></li>
				
			<?php } ?>
			</ul>
		</nav>

<?php endif; ?>
<div class="content-wrap"> 
<?php if(1 < count($languages)){
		
		$text = unserialize($options['cookie_monster_text']);
		$accept = unserialize($options['cookie_monster_accept']);
		$info = unserialize($options['cookie_monster_info']);
		$info_url = unserialize($options['cookie_monster_info_url']);

		foreach($languages as $l) : ?>
		<section id="language-<?php echo $l['language_code']?>" class="<?php if($l['active']==1) echo 'content-current'; ?>">
			<!-- <div class="language-box"> -->
				<label for="cookie_monster_text[<?php echo $l['language_code']?>]"><?php _e('Message',$this->plugin_name);?></label><!-- continuar traduccion -->
				<textarea name="cookie_monster_text[<?php echo $l['language_code']?>]" id="cookie_monster_text" cols="50" rows="4"><?php echo esc_textarea(stripslashes($text[$l['language_code']]));?></textarea>
		
				<label for="cookie_monster_text[<?php echo $l['language_code']?>]"><?php _e('Text for Accept Button',$this->plugin_name);?></label>
				<input type="text" name="cookie_monster_accept[<?php echo $l['language_code']?>]" id="cookie_monster_accept" value="<?php echo stripslashes($accept[$l['language_code']]);?>"/>
		
				<label for="cookie_monster_text[<?php echo $l['language_code']?>]"><?php _e('Text for More Info Button',$this->plugin_name);?></label>
				<input type="text" name="cookie_monster_info[<?php echo $l['language_code']?>]" id="cookie_monster_info" value="<?php echo stripslashes($info[$l['language_code']]);?>"/>
				
				<label for="cookie_monster_text[<?php echo $l['language_code']?>]"><?php _e('More Info Page Destination',$this->plugin_name);?></label>
				<?php /* <input type="text" name="cookie_monster_info_url[<?php echo $l['language_code']?>]" id="cookie_monster_info_url" value="<?php echo $info_url[$l['language_code']];?>"/> */ ?>
				
				<?php $pages = $this->get_pages();
				if($pages):?>
				<select id="cookie_monster_info_url" name="cookie_monster_info_url[<?php echo $l['language_code']?>]">
					<option value="custom"><?php _e('None','$this->plugin_name')?></option>
				<?php foreach ($pages as $key => $value):?>
					<option value="<?php echo $key?>" <?php echo ($info_url[$l['language_code']] == $key) ? 'selected' : null ; ?> ><?php echo $value?></option>					
					
				<?php endforeach; ?>
				</select>
				<?php endif;
				
				?>
				
			<!-- </div> -->
		</section>
		<?php  endforeach;
			
	} ?>
</div>
</div>
</section>
<script>
		(function() {

			[].slice.call( document.querySelectorAll( '.tabs' ) ).forEach( function( el ) {
				new CBPFWTabs( el );
			});

		})();
</script>
<?php endif;?>
<div class="clear"></div>