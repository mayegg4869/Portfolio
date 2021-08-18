<?php
// Exit if accessed directly
if(!defined( 'ABSPATH' ) ) {
	exit;
}
global $post;

$metaArray = array("height","width","select_width_management","select_pagination","select_navigation","select_pauseonhover","select_fade","select_autoplay","autoplay_speed","background_color","text_color","centermode","centerpadding","layout","video_autoplay","content_width","opacity","display_Image","slider_speed","select_navigation_arrow");
foreach($metaArray as $meta){
	$$meta = get_post_meta($post->ID,$meta,true);
}
//var_dump($select_navigation_arrow);die;
?><!--<form name="bannerSettingForm" id="bannerSettingForm" method="post"  action="">-->
	<table class="form-table slideOption">
		<tbody>
        <tr id="trsettingpagination">
            <th scope="row">
                <div>
                    <label for="select_fade"><?php echo __('Transition Effects','responsive-slick-slider');?></label>
                </div>
            </th>
            <td>
                <select name="select_fade" id="select_fade">
                    <option value="1" <?php if($select_fade === "1"){ echo 'selected="selected"'; } ?>><?php echo __('Fade','responsive-slick-slider');?></option>
                    <option value="0" <?php if($select_fade === "0"){ echo 'selected="selected"'; } ?>><?php echo __('Slide Horizontally','responsive-slick-slider');?></option>
                </select>
            </td>
        </tr>
        <tr id="trsettingpagination">
            <th scope="row">
                <div>
                    <label for="select_autoplay"><?php echo __('Slider Auto Play','responsive-slick-slider');?></label>
                </div>
            </th>
            <td>
                <select name="select_autoplay" id="select_autoplay">
                    <option value="1" <?php if($select_autoplay === "1"){ echo 'selected="selected"'; } ?>><?php echo __('Yes','responsive-slick-slider');?></option>
                    <option value="0" <?php if($select_autoplay === "0"){ echo 'selected="selected"'; } ?>><?php echo __('No','responsive-slick-slider');?></option>
                </select>
            </td>
        </tr>
        <tr id="trsettingpagination">
            <th scope="row">
                <div>
                    <label for="autoplay_speed"><?php echo __('Auto Play Delay','responsive-slick-slider');?></label>
                    <span class="note"><?php echo __('(ms)','responsive-slick-slider');?></span>
                </div>
            </th>
            <td>
                <input type="number" min="10" step="10" name="autoplay_speed" id="autoplay_speed" value="<?php  if($autoplay_speed) {  echo intval($autoplay_speed); } else { echo intval('4000'); }  ?>" size="30" />
            </td>
        </tr>
		 <tr id="trsettingpagination">
            <th scope="row">
                <div>
                    <label for="slider_speed"><?php echo __('Slider Speed','responsive-slick-slider');?></label>
                    <span class="note"><?php echo __('(ms)','responsive-slick-slider');?></span>
                </div>
            </th>
            <td>
                <input type="number" min="10" step="10" name="slider_speed" id="slider_speed" value="<?php  if($slider_speed) {  echo intval($slider_speed); } else { echo intval('1000'); }  ?>" size="30" />
            </td>
        </tr>
        <tr id="trsettingwidth">
            <th scope="row">
                <div>
                    <label for="width"><?php echo __('Width','responsive-slick-slider');?></label>
                    <span class="note"><?php echo __('(px)','responsive-slick-slider');?></span>
                </div>
            </th>
            <td>
                <input type="number" min="1" name="width" id="width" value="<?php if($width) {  echo intval($width); } else { echo intval('960'); } ?>" size="30">
            </td>
        </tr>
        <tr id="trsettingheight">
            <th scope="row">
                <div>
                    <label for="Height"><?php echo __('Height','responsive-slick-slider');?></label>
                    <span class="note"><?php echo __('(px)','responsive-slick-slider');?></span>
                </div>
            </th>
            <td>
                <input type="number" min="1" name="height" id="height" value="<?php if($height) {  echo intval($height); } else { echo intval('500'); } ?>" size="30">
            </td>
        </tr>
        <tr id="trsettingwidthmanagement">
            <th scope="row">
                <div>
                    <label for="bannerwidthmanagement"><?php echo __('Width Management','responsive-slick-slider');?></label>
                </div>
            </th>
            <td>
                <select name="select_width_management" id="bannerwidthmanagement" >
                    <option value="full" <?php if($select_width_management == "full"){ echo 'selected="selected"'; } ?>><?php echo __('Full','responsive-slick-slider');?></option>
                    <option value="fixed" <?php if($select_width_management == "fixed"){ echo 'selected="selected"'; } ?>><?php echo __('Fixed','responsive-slick-slider');?></option>
                </select>
            </td>
        </tr>
        <tr id="trsettingheightmanagement">
                <th scope="row">
                    <div>
                        <label for="display_Image"><?php echo __('Height Management','responsive-slick-slider');?></label>
                    </div>
                </th>
                <td>
                    <select name="display_Image" id="display_Image">
                        <option value="image" <?php if($display_Image == "image"){ echo 'selected="selected"'; } ?>><?php echo __('Responsive','responsive-slick-slider');?></option>
                        <option value="bgimage" <?php if($display_Image == "bgimage"){ echo 'selected="selected"'; } ?>><?php echo __('Fixed','responsive-slick-slider');?></option>
                        
                    </select>
                </td>
        </tr>
        <tr id="trsettingheight">
				<th scope="row">
					<div>
						<label for="Content_width"><?php echo __('Content Width','responsive-slick-slider');?></label>
						<span class="note"><?php echo __('(px)','responsive-slick-slider');?></span>
					</div>
				</th>
				<td>
					<input type="number" min="1" name="content_width" id="Content_width" value="<?php if($content_width) {  echo intval($content_width); } else { echo intval('500'); } ?>" size="30">
				</td>
		</tr>
		<tr id="trsettingwidthlayout">
				<th scope="row">
					<div>
						<label for="display_content"><?php echo __('Content Position','responsive-slick-slider');?></label>
					</div>
				</th>
				<td>
					<select name="layout" id="display_content">
						<?php if($layout == ''){ 
							$layout= 'bottomleft';
						} 
						?>
						<option value="topleft" <?php if($layout == "topleft"){ echo 'selected="selected"'; } ?>><?php echo __('Top Left','responsive-slick-slider');?></option>
						<option value="topcenter" <?php if($layout == "topcenter"){ echo 'selected="selected"'; } ?>><?php echo __('Top Center','responsive-slick-slider');?></option>
						<option value="topright" <?php if($layout == "topright"){ echo 'selected="selected"'; } ?>><?php echo __('Top Right','responsive-slick-slider');?></option>
						<option value="centerleft" <?php if($layout == "centerleft"){ echo 'selected="selected"'; } ?>><?php echo __('Middle Left','responsive-slick-slider');?></option>
						<option value="centercenter" <?php if($layout == "centercenter"){ echo 'selected="selected"'; } ?>><?php echo __('Middle Center','responsive-slick-slider');?></option>
						<option value="centerright" <?php if($layout == "centerright"){ echo 'selected="selected"'; } ?>><?php echo __('Middle Right','responsive-slick-slider');?></option>
						<option value="bottomleft" <?php if($layout == "bottomleft" ){ echo 'selected="selected"'; } ?>><?php echo __('Bottom Left','responsive-slick-slider');?></option>
						<option value="bottomcenter" <?php if($layout == "bottomcenter"){ echo 'selected="selected"'; } ?>><?php echo __('Bottom Center','responsive-slick-slider');?></option>
						<option value="bottomright" <?php if($layout == "bottomright"){ echo 'selected="selected"'; } ?>><?php echo __('Bottom Right','responsive-slick-slider');?></option>
					</select>
				</td>
			</tr>		
            <tr id="trsettingtextcolor">
				<th scope="row">
					<div>
						<label for="text_color"><?php echo __('Content Text Color','responsive-slick-slider');?></label>
					</div>
				</th>
				<td>
					<input type="text" name="text_color" class="option_color jscolor colorwidth" id="text_color" value="<?php echo esc_html($text_color); ?>" size="30">
				</td>
			</tr>
			<tr id="trsettingbackcolor">
				<th scope="row">
					<div>
						<label for="background_color"><?php echo __('Content Background Color','responsive-slick-slider');?></label>
					</div>
				</th>
				<td>
					<input type="text" name="background_color" class="option_color jscolor" id="background_color" value="<?php if($background_color) { echo esc_html($background_color); } else { echo '000000';}?>" size="30">
				</td>
			</tr>
			<tr id="trsettingbackcolor">
				<th scope="row">
					<div>
						<label for="opacity"><?php echo __('Content Background Opacity','responsive-slick-slider');?></label>
					</div>
				</th>
				<td>
					<input type="text" id="opacity" class="opacitywidth" name="opacity" value="<?php if(isset($opacity)){ echo esc_html($opacity); } else{ echo 0.5; }  ?>" size="30">
				</td>
			</tr>
			<tr id="trsettingwidthmanagement">
				<th scope="row">
					<div>
						<label for="centermode"><?php echo __('Centermode','responsive-slick-slider');?></label>
					</div>
				</th>
				<td>
					<select name="centermode" id="centermode" >
						<option value="false"<?php if($centermode == "false"){ echo 'selected="selected"'; } ?>><?php echo __('No','responsive-slick-slider');?></option>
						<option value="true"<?php if($centermode == "true"){ echo 'selected="selected"'; } ?>><?php echo __('Yes','responsive-slick-slider');?></option>
					</select>
				</td>
			</tr>
			<tr id="trsettingwidthmanagement">
				<th scope="row">
					<div>
						<label for="centerpadding"><?php echo __('Center Padding','responsive-slick-slider');?></label>
						<span class="note"><?php echo __('(px)','responsive-slick-slider');?></span>
					</div>
				</th>
				<td>
					<input type="number" name="centerpadding" value="<?php if($centerpadding){ echo intval($centerpadding); } ?>" id="centerpadding">
					
				</td>
			</tr>
			<tr id="trsettingpagination">
				<th scope="row">
					<div>
						<label for="option_pagination"><?php echo __('Pagination','responsive-slick-slider');?></label>
					</div>
				</th>
				<td>
					<select name="select_pagination" id="option_pagination">
						<option value="1" <?php if($select_pagination === "1"){ echo 'selected="selected"'; } ?>><?php echo __('Show','responsive-slick-slider');?></option>
						<option value="0" <?php if($select_pagination === "0"){ echo 'selected="selected"'; } ?>><?php echo __('Hide','responsive-slick-slider');?></option>
					</select>
				</td>
			</tr>
			<tr id="trsettingnavigation">
				<th scope="row">
					<div>
						<label for="select_navigation"><?php echo __('Navigation','responsive-slick-slider');?></label>
					</div>
				</th>
				<td>
					<select name="select_navigation" id="select_navigation" >
						<option value="1" <?php if($select_navigation === "1"){ echo 'selected="selected"'; } ?>><?php echo __('Yes','responsive-slick-slider');?></option>
						<option value="0" <?php if($select_navigation === "0"){ echo 'selected="selected"'; } ?>><?php echo __('No','responsive-slick-slider');?></option>
					</select>
				</td>
			</tr>
			<tr id="trsettingnavigation">
				<th scope="row">
					<div>
						<label for="select_navigation_arrow"><?php echo __('Navigation Arrow','responsive-slick-slider');?></label>
					</div>
				</th>
				<td>
					<?php if($select_navigation_arrow == '1'){ 
								$leftarrows = 'arrow-left';
								$rightarrows = 'arrow-right';
							}else if($select_navigation_arrow == '2'){
								$leftarrows = 'arrow-left-sm';
								$rightarrows = 'arrow-right-sm';
							}else if($select_navigation_arrow == '3'){
								$leftarrows = 'arrow-left-3';
								$rightarrows = 'arrow-right-3';
							}else if($select_navigation_arrow == '4'){
								$leftarrows = 'arrow-left-4';
								$rightarrows = 'arrow-right-4';
							}
							else {
								$leftarrows = 'arrow-left';
								$rightarrows = 'arrow-right';
							}?>
					<select name="select_navigation_arrow" id="select_navigation_arrow" style="margin-bottom:10px;">  
						<option value="1" <?php if($select_navigation_arrow == "1"){ echo 'selected="selected"'; } ?>>arrow 1</option>
						<option value="2" <?php if($select_navigation_arrow == "2"){ echo 'selected="selected"'; } ?> >arrow 2</option>
						<option value="3" <?php if($select_navigation_arrow == "3"){ echo 'selected="selected"'; } ?> >arrow 3</option>
						<option value="4" <?php if($select_navigation_arrow == "4"){ echo 'selected="selected"'; } ?> >arrow 4</option>
					</select><br/>
					<img class="arrow-images arrow-images-left" src="<?php echo plugin_dir_url(__DIR__)?>images/<?php echo $leftarrows;?>.png"/>
					<img class="arrow-images arrow-images-right" src="<?php echo plugin_dir_url(__DIR__)?>images/<?php echo $rightarrows;?>.png"/>
				</td>
			</tr>
			<tr id="trsettingpagination">
				<th scope="row">
					<div>
						<label for="select_pauseonhover"><?php echo __('Pause On Hover','responsive-slick-slider');?></label>
					</div>
				</th>
				<td>
					<select name="select_pauseonhover" id="select_pauseonhover">
						<option value="0" <?php if($select_pauseonhover === "0"){ echo 'selected="selected"'; } ?>><?php echo __('No','responsive-slick-slider');?></option>
						<option value="1" <?php if($select_pauseonhover === "1"){ echo 'selected="selected"'; } ?>><?php echo __('Yes','responsive-slick-slider');?></option>
					</select>
				</td>
			</tr>
			
			<tr id="trsettingpagination">
				<th scope="row">
					<div>
						<label for="video_autoplay"><?php echo __('Video Auto Play','responsive-slick-slider');?></label>
					</div>
				</th>
				<td>
					<select name="video_autoplay" id="video_autoplay">
						<option value="1" <?php if($video_autoplay === "1"){ echo 'selected="selected"'; } ?>><?php echo __('Yes','responsive-slick-slider');?></option>
						<option value="0" <?php if($video_autoplay === "0"){ echo 'selected="selected"'; } ?>><?php echo __('No','responsive-slick-slider');?></option>
					</select>
				</td>
			</tr>
		</tbody>
	</table>
	<input type="hidden" name="settingaction" id="settingaction" value="">
	<script>
		jQuery(document).ready(function(){
			jQuery("#select_navigation_arrow").change(function(){
				var selectedoptionval = jQuery("#select_navigation_arrow option:selected").val();
				if(selectedoptionval == '1'){
					jQuery(".arrow-images-left").attr('src','<?php echo plugin_dir_url(__DIR__)?>images/arrow-left.png');
					jQuery(".arrow-images-right").attr('src','<?php echo plugin_dir_url(__DIR__)?>images/arrow-right.png');
				}
				if(selectedoptionval == '2'){
					//jQuery("#select_navigation_arrow").css('background-image','url(<?php echo plugin_dir_url(__DIR__)?>images/second-arrow.png)');
					jQuery(".arrow-images-left").attr('src','<?php echo plugin_dir_url(__DIR__)?>images/arrow-left-sm.png');
					jQuery(".arrow-images-right").attr('src','<?php echo plugin_dir_url(__DIR__)?>images/arrow-right-sm.png');
				}
				if(selectedoptionval == '3'){
					//jQuery("#select_navigation_arrow").css('background-image','url(<?php echo plugin_dir_url(__DIR__)?>images/second-arrow.png)');
					jQuery(".arrow-images-left").attr('src','<?php echo plugin_dir_url(__DIR__)?>images/arrow-left-3.png');
					jQuery(".arrow-images-right").attr('src','<?php echo plugin_dir_url(__DIR__)?>images/arrow-right-3.png');
				}
				if(selectedoptionval == '4'){
					//jQuery("#select_navigation_arrow").css('background-image','url(<?php echo plugin_dir_url(__DIR__)?>images/second-arrow.png)');
					jQuery(".arrow-images-left").attr('src','<?php echo plugin_dir_url(__DIR__)?>images/arrow-left-4.png');
					jQuery(".arrow-images-right").attr('src','<?php echo plugin_dir_url(__DIR__)?>images/arrow-right-4.png');
				}
				
			});
		});
	</script>
<!--</form>-->