<script type="text/javascript">
jQuery(document).ready(function($){
	jQuery('.pf_rpw_widget_colors_bg_box, .pf_rpw_widget_colors_link_cl_box, .pf_rpw_widget_colors_bd_box, .pf_rpw_widget_colors_bg_arrow, .pf_rpw_widget_colors_bd_arrow,.pf_rpw_widget_colors_main_arrow').wpColorPicker();
});
</script>
<div class="wrap">
	<h2><?php echo RPWSettingLabel; ?></h2>
	<?php if($setting_update == 1){?>
	<div id="setting-error-settings_updated" class="updated settings-error notice is-dismissible"> 
	<p><strong>Settings saved.</strong></p><button type="button" class="notice-dismiss"><span class="screen-reader-text">Dismiss this notice.</span></button></div>
	<?php } ?>
	<form method="post" action="" >
		<input type="hidden" id="_wpnonce" name="_wpnonce" value="<?php echo $nonce; ?>">
		<table class="form-table">
			<tbody>
				<tr>
					<th scope="row"><label for="pf_rpw_default_dispaly">Default display</label></th>
					<td><select name="pf_rpw_default_dispaly" id="pf_rpw_default_dispaly">
							<option value="1" <?php echo $pf_rpw_default_dispaly == '1' ? 'selected' : ''; ?>>Small</option>
							<option value="2" <?php echo $pf_rpw_default_dispaly == '2' ? 'selected' : ''; ?>>Medium</option>
							<option value="3" <?php echo $pf_rpw_default_dispaly == '3' ? 'selected' : ''; ?>>Large</option>
						</select>
					</td>
				</tr>
				<tr>
					<th width="33%" scope="row"><label for="pf_rpw_widget_displayed_top">Widget Displayed</label></th>
					<td>
						<input name="pf_rpw_widget_displayed_top" type="text" id="pf_rpw_widget_displayed_top" value="<?php echo $pf_rpw_widget_displayed_top; ?>" class="pf_rpw_widget_displayed_top"><strong>TOP</strong> in <i>pixels</i>
						<input name="pf_rpw_widget_displayed_bottom" type="text" id="pf_rpw_widget_displayed_bottom" value="<?php echo $pf_rpw_widget_displayed_bottom; ?>" class="pf_rpw_widget_displayed_bottom"><strong>Bottom</strong> in <i>pixels</i>
						<p class="description" id="tagline-description">Added "0" means not added to design.</p>						
					</td>
				</tr>
				<tr>
					<th></th>
					<td>
						<input name="pf_rpw_widget_displayed_left" type="text" id="pf_rpw_widget_displayed_left" value="<?php echo $pf_rpw_widget_displayed_left; ?>" class="pf_rpw_widget_displayed_left"><strong>LEFT</strong> in <i>percentage </i>
						<input name="pf_rpw_widget_displayed_right" type="text" id="pf_rpw_widget_displayed_right" value="<?php echo $pf_rpw_widget_displayed_right; ?>" class="pf_rpw_widget_displayed_right"><strong>RIGHT</strong> in <i>percentage </i>
						<p class="description" id="tagline-description">Added "0" means not added to design.</p>						
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="pf_rpw_widget_colors_bg_box">Widget Colors:</label></th>
					<td>
						<input name="pf_rpw_widget_colors_bg_box" type="text" id="pf_rpw_widget_colors_bg_box" value="<?php echo $pf_rpw_widget_colors_bg_box; ?>" class="pf_rpw_widget_colors_bg_box"><strong>Background Color Box</strong>
						<input name="pf_rpw_widget_colors_bd_box" type="text" id="pf_rpw_widget_colors_bd_box" value="<?php echo $pf_rpw_widget_colors_bd_box; ?>" class="pf_rpw_widget_colors_bd_box"><strong>Border Color Box</strong>											
					</td>
				</tr>
				<tr>
					<th scope="row"></th>
					<td>
						<input name="pf_rpw_widget_colors_link_cl_box" type="text" id="pf_rpw_widget_colors_link_cl_box" value="<?php echo $pf_rpw_widget_colors_link_cl_box; ?>" class="pf_rpw_widget_colors_link_cl_box"><strong>Link or Post title Color</strong>
						<input name="pf_rpw_widget_colors_main_arrow" type="text" id="pf_rpw_widget_colors_main_arrow" value="<?php echo $pf_rpw_widget_colors_main_arrow; ?>" class="pf_rpw_widget_colors_main_arrow"><strong>Arrows Color</strong>
					</td>
				</tr>				
				<tr>
					<th scope="row"></th>
					<td>
						<input name="pf_rpw_widget_link_text_fonts" type="text" id="pf_rpw_widget_link_text_fonts" value="<?php echo $pf_rpw_widget_link_text_fonts; ?>" class="pf_rpw_widget_link_text_fonts"><strong>Post title fonts</strong>
						<input name="pf_rpw_widget_arrow_fonts" type="text" id="pf_rpw_widget_arrow_fonts" value="<?php echo $pf_rpw_widget_arrow_fonts; ?>" class="pf_rpw_widget_arrow_fonts"><strong>Arrows fonts</strong>
						<p class="description" id="tagline-description">Fonts size in pixels.</p>						
					</td>					
				</tr>	
				<tr>
					<th scope="row">Default Image</th>
					<td class="">
						<div class="uploader stag-metabox-table">
							<!-- <input id="_unique_name" name="settings[_unique_name]" type="text" /> -->
							<div class="current">
								<div class="container">
									<div class="placeholder">
										<div class="inner" id="pf_rpw_widget_no_images">
											<?php if($pf_rpw_widget_no_images_id != '' && $pf_rpw_widget_no_images_id != '0'){ 
												echo wp_get_attachment_image($pf_rpw_widget_no_images_id,'medium');
												}else {
												echo '<span>No image selected</span>';
												}
												?>
											
										</div>
										<input id="pf_rpw_widget_no_images_id" name="pf_rpw_widget_no_images_id" type="hidden" value="<?php echo $pf_rpw_widget_no_images_id;?>"/>
									</div>
								</div>
							</div>
							<!-- <input id="_unique_name_button" class="button" name="_unique_name_button" type="text" value="Select" /> -->
							<div id="remove-button-div">
							<?php if($pf_rpw_widget_no_images_id != '' && $pf_rpw_widget_no_images_id != '0'){  ?>
								<button type="button" class="button remove-button" id="pf_rpw_widget_no_images_button">Remove</button>
							<?php } ?>
							</div>
							<div class="upload-button-div">
							<button type="button" class="button upload-button" id="pf_rpw_widget_no_images_button">Select Image</button>
							</div>
						</div>	
					</td>
				</tr>			
			</tbody>
		</table>
		<p class="submit">
			<input type="submit" name="submit" id="submit"	class="button button-primary" value="Save Changes">
		</p>
	</form>
</div>
<script>

</script>