<?php
// Exit if accessed directly
if(!defined( 'ABSPATH' ) ) {
	exit;
}
/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       www.vsourz.com
 * @since      1.0.0
 *
 * @package    responsive-slick-slider
 * @subpackage responsive-slick-slider/admin/partials
 */
wp_enqueue_style( 'bootstrap.min' ); 
wp_enqueue_style( 'responsive-slick-slider' );
 global $post;
 $imageLoop = get_post_meta($post->ID,'imageDetails',true);		// getting image details
 if(!empty($imageLoop)){
	$num = count($imageLoop);
 }
 else{
	 $num = 0;
 }

 // getting initial parameters
$decide_type_of_id = get_post_meta($post->ID,'decide_type_of_id',true);
$is_archieve = get_post_meta($post->ID,'is_archieve',true);
$postIdsSaved = get_post_meta($post->ID,'postIdsSaved',true);
if(!empty($is_archieve)){	// archieve set
	$post_type_selected = $is_archieve;
}
else{						// archieve not set so getting post type
	if(!empty($postIdsSaved)){					// some post ids saved
		if(!empty($decide_type_of_id)){
			if($decide_type_of_id == "post"){			// saved id is of "post" type
				$postsIdsSaved = explode(",",$postIdsSaved);
				
				$post_id_to_check = $postsIdsSaved[0];
				$post_type_selected = get_post_type( $post_id_to_check );
			}
			else if($decide_type_of_id == "taxonomy"){	// saved id is of "taxonomy" type
				$termsIdsSaved = explode(",",$postIdsSaved);
				$term_id_to_check = $termsIdsSaved[0];
				$term_to_check = get_term( $term_id_to_check );
				if(!empty($term_to_check)){
					$post_type_selected = $term_to_check->taxonomy;
				}
				else{
					$post_type_selected = '';
				}
			}
		}
		else{
			$decide_type_of_id = '';
			$post_type_selected = '';
		}
	}
	else{						// not saved any post id
		if(empty($decide_type_of_id)){
			$decide_type_of_id = 'post';
		}
		$post_type_selected = '';
	}
}
$nonce = wp_create_nonce( 'banner-save-meta-nonce-'.$post->ID );

?>
<style>
.cross-image{
	background:url('<?php echo plugin_dir_url(__DIR__)?>/images/crossimg.png') no-repeat center center /cover ;
}
.banner-div select.post_type_select  {
	background: #0d98e8 url(<?php echo plugin_dir_url(__DIR__)?>/images/drop-down-arrow.png) no-repeat right center;
}
 

</style><?php
$args = array('public'   => true);

$output = 'objects'; // names or objects, note names is the default
$operator = 'and'; // 'and' or 'or'

//Get all registered  post type 
$post_types = get_post_types( $args, $output, $operator );
//Get all registered  taxonomies
$taxonomies = get_taxonomies();

?><!-- This file should primarily consist of HTML with a little bit of PHP. -->
<input type="hidden" name="decide_type_of_id" class="decide_type_of_id" value="<?php echo esc_html($decide_type_of_id); ?>" />
<div class="form-horizontal banner-div " style="padding:15px 0;">
	<div class="form-group">
		<label class="col-sm-2 text-right"><?php echo __('Display slider on','responsive-slick-slider');?></label>
		<div class="col-sm-9">
			<select name="post_type_responsive_slider" class="post_type_select width81 form-control banner_dropdown" >
					<option value="" > -- <?php echo __('SELECT','responsive-slick-slider');?> -- </option>
					<optgroup label='Post Type'><?php
					foreach($post_types as $post_type =>$objPost ){
						if($post_type != "attachment"){
							?><option data-attribute="post" value="<?php echo esc_html($post_type); ?>" <?php if(isset($post_type_selected) && $post_type_selected == $post_type){ echo "selected='selected'"; } ?>><?php echo esc_html($objPost->label); ?></option><?php
						}
					}
					?></optgroup>
					<optgroup label='Taxonomies'><?php
						if(!empty($taxonomies)){
							foreach($taxonomies as $taxonomy){
								//Get taxonomy name related object 
								$objTaxonomy = get_taxonomy( $taxonomy );
								?><option data-attribute="taxonomy" value="<?php echo esc_html($taxonomy); ?>" <?php if(isset($post_type_selected) && $post_type_selected == $taxonomy){ echo "selected='selected'"; } ?>><?php echo esc_html($objTaxonomy->label); ?></option><?php
							}
						}
					?></optgroup><?php
			?></select>
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-2 text-right"><?php echo __('Choose Pages/Posts','responsive-slick-slider');?></label>
		<div class="col-sm-9 displayPosts">
		</div>
	</div>
	<div class="inner"><?php
		$i=1;
		if(!empty($imageLoop)){
			$num = count($imageLoop);
			foreach($imageLoop as $imageDetail){
				?><div  class="removeslide accordianmain slide_item">
					<h2 class="remove<?php echo $i;?> fa<?php echo $i;?> sildediv accordianheading <?php if($i == 1){?>upimage<?php } else {?>downimage<?php } ?>" slide="<?php echo $i;?>" ><?php echo __('Slide','responsive-slick-slider');?><?php echo $i;?> <a href="javascript:void(0);" title="Delete" class="removeImageSection "><span class="cross-image"></span></a></h2>
					
					<div class="newAddedImageSection" id="<?php echo $i;?>" style=" <?php if($i != 1){?>display:none;<?php } ?>" >
						<div class="vsz_slide_type">
							<div class="form-group">
								<label class="col-sm-2 text-right"><?php echo __('Banner Type','responsive-slick-slider');?></label>
								<div class="col-sm-4">
									<select name="banner_type[]" class="banner-type form-control" >
										<option value="image" <?php if($imageDetail['banner_type'] == "image") { ?> selected="selected"<?php } ?> ><?php echo __('Image','responsive-slick-slider');?></option>
										<option value="video" <?php if($imageDetail['banner_type'] == "video") { ?> selected="selected"<?php } ?> ><?php echo __('Mp4 Video','responsive-slick-slider');?></option>
										<option value="youtube" <?php if($imageDetail['banner_type'] == "youtube") { ?> selected="selected"<?php } ?> ><?php echo __('Youtube Video','responsive-slick-slider');?></option>
										<option value="vimeo" <?php if($imageDetail['banner_type'] == "vimeo") { ?> selected="selected"<?php } ?> ><?php echo __('Vimeo Video','responsive-slick-slider');?></option>
									</select>
								</div>	
								<div class="col-sm-2 pull-right">								
									<input id="hodeslide-<?php echo $i;?>" hide="hidden<?php echo $i;?>" type="checkbox" class="hiddencheckbox" value="1" style="margin-top:-5px;" <?php if($imageDetail['hidden'] == '1'){?>checked="checked"<?php } ?>>
									<label for="hodeslide-<?php echo $i;?>"  class="hiddencheckbox" hide="hidden<?php echo $i;?>" >Hidden</label>
									<input type="hidden" name="hidden[]" id="hidden<?php echo $i;?>" value="<?php if($imageDetail['hidden'] == '1'){ echo '1';}else{ echo '0';}?>">
								</div>
								
								<div class="col-sm-2 pull-right">
									<input type="number" min="1" class="image_order form-control" name="image_order[]" value="<?php echo $i; ?>" />
								</div>
								<div class="col-sm-2 pull-right text-right"><label><?php echo __('Order','responsive-slick-slider');?></label></div>
							</div>
						</div>						
						<div class="type-image <?php if($imageDetail['banner_type'] == "image") { echo "display-type"; } else { echo "hide-type"; } ?>">
							<div class="vsz_img_row">	
								<div class="form-group">								
									<div class="col-sm-4">
										<label><?php echo __('Image','responsive-slick-slider');?></label><?php
										//Get image URL here
										$imageUrl = wp_get_attachment_image_src($imageDetail['imageId'],"full");
										if(!empty($imageUrl)){
											?><img src="<?php echo esc_url($imageUrl[0]); ?>" class="num_<?php echo $i; ?>_image checkImage" width="auto" height="150" />
											<input type="button" class="add_image num_<?php echo $i; ?> btn btn-success" value="+ Add Image" style="display:none;" />
											<input type="button" class="removeImage num_<?php echo $i; ?>_remove btn btn-danger" value="- Remove" style="display:block;" />
											<input type="hidden" class="num_<?php echo $i; ?>_id" value="<?php echo $imageDetail['imageId']; ?>" name="imageId[]" /><?php
										}
										else{
											?><input type="button" class="add_image num_<?php echo $i; ?> btn btn-success" value="+ Add Image" />
											<input type="button" class="removeImage num_<?php echo $i; ?>_remove btn btn-danger" value="- Remove" style="display:none;" />
											<input type="hidden" class="num_<?php echo $i; ?>_id" value="<?php echo $imageDetail['imageId']; ?>" name="imageId[]" /><?php
										}
									?></div>
									<div class="col-sm-4">
										<label><?php echo __('Ipad Image','responsive-slick-slider');?></label><?php
										$imageUrl = wp_get_attachment_image_src($imageDetail['imageiId'],"full");
										if(!empty($imageUrl)){
											?><img src="<?php echo esc_url($imageUrl[0]); ?>" class="numi_<?php echo $i; ?>_image checkImage" width="auto" height="150" />
											<input type="button" class="add_imagei numi_<?php echo $i; ?> btn btn-success" value="+ Add Image" style="display:none;" />
											<input type="button" class="removeImagei numi_<?php echo $i; ?>_remove btn btn-danger" value="- Remove" style="display:block;" />
											<input type="hidden" class="numi_<?php echo $i; ?>_id" value="<?php echo $imageDetail['imageiId']; ?>" name="imageiId[]" /><?php
										}
										else{
											?><input type="button" class="add_imagei numi_<?php echo $i; ?> btn btn-success" value="+ Add Image" />
											<input type="button" class="removeImagei numi_<?php echo $i; ?>_remove btn btn-danger" value="- Remove" style="display:none;" />
											<input type="hidden" class="numi_<?php echo $i; ?>_id" value="<?php echo $imageDetail['imageiId']; ?>" name="imageiId[]" /><?php
										}
									?></div>
									<div class="col-sm-4">
										<label><?php echo __('Mobile Image','responsive-slick-slider');?></label><?php
											$imageUrl = wp_get_attachment_image_src($imageDetail['imagemId'],"full");
											if(!empty($imageUrl)){
												?><img src="<?php echo esc_url($imageUrl[0]); ?>" class="numm_<?php echo $i; ?>_image checkImage" width="auto" height="150" />
												<input type="button" class="add_imagem numm_<?php echo $i; ?> btn btn-success" value="+ Add Image" style="display:none;" />
												<input type="button" class="removeImagem numm_<?php echo $i; ?>_remove btn btn-danger" value="- Remove" style="display:block;" />
												<input type="hidden" class="numm_<?php echo $i; ?>_id" value="<?php echo $imageDetail['imagemId']; ?>" name="imagemId[]" /><?php
											}
											else{
												?><input type="button" class="add_imagem numm_<?php echo $i; ?> btn btn-success" value="+ Add Image" />
												<input type="button" class="removeImagem numm_<?php echo $i; ?>_remove btn btn-danger" value="- Remove" style="display:none;" />
												<input type="hidden" class="numm_<?php echo $i; ?>_id" value="<?php echo $imageDetail['imagemId']; ?>" name="imagemId[]" /><?php
											}
									?></div>
								</div>
							</div>
							<div class="vsz_title_row">
								<div class="form-group">
									<div class="col-sm-6">
										<label><?php echo __('Title','responsive-slick-slider');?></label>
										<input type="text" name="image_title[]" class="form-control" value="<?php echo esc_html($imageDetail['imageTitle']); ?>" placeholder="Enter Title"/>
									</div>
									<div class="col-sm-3">
										<label class="ipad_title"><?php echo __('Hide Title in ipad','responsive-slick-slider');?></label>
										<input id="ipadtitle-<?php echo $i; ?>" type="checkbox" name="" class="form-control ipadtitle cmn-toggle cmn-toggle-round-flat" ipad="<?php echo $i; ?>" value="1" <?php if($imageDetail['image_ititle'] == '1'){?>checked="checked"<?php } ?> />
										<label for="ipadtitle-<?php echo $i; ?>"></label>
										<input type="hidden" id="ipad<?php echo $i; ?>" name="image_ititle[]" value="<?php if($imageDetail['image_ititle'] == '1'){ echo '1';}else{ echo '0';}?>"> 
									</div>
									<div class="col-sm-3">
										<label class="mobile_title"><?php echo __('Hide Title in Mobile','responsive-slick-slider');?></label>
										<input id="mobiletitle-<?php echo $i; ?>" type="checkbox" name="" class="form-control mobiletitle cmn-toggle cmn-toggle-round-flat" mobile="<?php echo $i; ?>" value="1" <?php if($imageDetail['image_mtitle'] == '1'){?>checked="checked"<?php } ?> />
										<label for="mobiletitle-<?php echo $i; ?>"></label>
										<input type="hidden" id="mobile<?php echo $i; ?>" name="image_mtitle[]" value="<?php if($imageDetail['image_mtitle'] == '1'){ echo '1';}else{ echo '0';}?>">
									</div>
								</div>	
							</div>
							<div class="vsz_content_row">
								<div class="form-group">
									<div class="col-sm-6">
										<label><?php echo __('Content','responsive-slick-slider');?></label>
										<textarea name="image_content[]" class="form-control"><?php echo ($imageDetail['imageContent']); ?></textarea>
									</div>
									<div class="col-sm-3">
										<label><?php echo __('Hide Content in ipad','responsive-slick-slider');?></label>
										<input id="ipadcontent-<?php echo $i; ?>" type="checkbox" name="" class="form-control ipadcontent cmn-toggle cmn-toggle-round-flat" ipad="<?php echo $i; ?>" value="1" <?php if($imageDetail['imagei_content'] == '1'){?>checked="checked"<?php } ?> />
										<label for="ipadcontent-<?php echo $i; ?>"></label>
										<input type="hidden" id="ipadcontent<?php echo $i; ?>" name="imagei_content[]" value="<?php if($imageDetail['imagei_content'] == '1'){ echo '1';}else{ echo '0';}?>">
									</div>
									<div class="col-sm-3">
										<label><?php echo __('Hide Content in Mobile','responsive-slick-slider');?></label>
										<input id="mobilecontent-<?php echo $i; ?>" type="checkbox" name="" class="form-control mobilecontent cmn-toggle cmn-toggle-round-flat" mobile="<?php echo $i; ?>" value="1" <?php if($imageDetail['imagem_content'] == '1'){?>checked="checked"<?php } ?> />
										<label for="mobilecontent-<?php echo $i; ?>"></label>
										<input type="hidden" id="mobilecontent<?php echo $i; ?>" name="imagem_content[]" value="<?php if($imageDetail['imagem_content'] == '1'){ echo '1';}else{ echo '0';}?>">
									</div>
								</div>
							</div>
							<div class="vsz_url_row">
								<div class="form-group">							
									<div class="col-sm-7">
										<label for="image_custom_url-<?php echo $i; ?>"><?php echo __('Url','responsive-slick-slider');?></label>
										<input type="text" name="image_url[]" class="form-control singleUrl" value="<?php echo esc_url($imageDetail['imageUrl']); ?>"  id="image_custom_url-<?php echo $i; ?>"/>
									</div>
									<div class="col-sm-2">
										<label for="url"><?php echo __('Open Url','responsive-slick-slider');?></label>
										<select name="url[]">
											<option value="1" <?php if($imageDetail['url'] == "1" ){ echo 'selected="selected"'; } ?>><?php echo __('Existing Tab','responsive-slick-slider');?></option>
											<option value="0" <?php if($imageDetail['url'] == "0"){ echo 'selected="selected"'; } ?>><?php echo __('New Tab','responsive-slick-slider');?></option>
										</select>
									</div>
									<div class="col-sm-3">
										<label for="buttontext"><?php echo __('Button Text','responsive-slick-slider');?></label>
										<input type="text" name="buttontext[]" class="form-control" value="<?php echo esc_html($imageDetail['buttontext']); ?>" placeholder="Read More"/>
									</div>
									
								</div>	
							</div>
						</div>	
						<div class="type-video <?php if($imageDetail['banner_type'] == "image") { echo "hide-type"; } else { echo "display-type"; } ?>">
							<div class="form-group">
								<label class="col-sm-2 text-right"><?php echo __('Video  Url','responsive-slick-slider');?></label>
								<div class="mp4video" <?php if($imageDetail['banner_type'] != "video") { ?>style="display:none;"<?php } ?>>
									<div class="col-sm-6 ">
										<input type="text" name="videoid[]" id="videonumv_<?php echo $i; ?>" class="form-control" value="<?php echo esc_url($imageDetail['videoid']); ?>" />
									</div>		    
									<div class="col-sm-3 " >
										<input type="button" class="add_video numv_<?php echo $i; ?> btn btn-success" value="+ Add Video" style="<?php if($imageDetail['videoid'] != ''){ ?>display:none; <?php } ?>"/>                                    
										<input type="button" class="remove_video numv_<?php echo $i; ?>  btn btn-danger" value="- Remove Video" style="<?php if($imageDetail['videoid'] == ''){ ?>display:none; <?php } ?>" />									
									</div>
								</div>	
								<div class="youtubevideo" <?php if($imageDetail['banner_type'] != "youtube") { ?>style="display:none;"<?php } ?>>
									<div class="col-sm-6 ">
										<input type="text" name="videoyoutubeid[]"  class="form-control" value="<?php echo esc_url($imageDetail['videoyoutubeid']); ?>" />
									</div>		    
									<div class="col-sm-3 " style="<?php if($imageDetail['videoyoutubeid'] == ''){ ?>display:none; <?php } ?>" >
										<input type="button" class="emptyvideo  btn btn-danger" value="- Remove Video"  />									
									</div>
								</div>
								<div class="vimeovideo" <?php if($imageDetail['banner_type'] != "vimeo") { ?>style="display:none;"<?php } ?>>
									<div class="col-sm-6 ">
										<input type="text" name="videovimeoid[]" id="videonumv_<?php echo $i; ?>" class="form-control" value="<?php echo esc_url($imageDetail['videovimeoid']); ?>" />
									</div>		    
									<div class="col-sm-3 " style="<?php if($imageDetail['videovimeoid'] == ''){ ?>display:none; <?php } ?>" >
										<input type="button" class="emptyvideo  btn btn-danger" value="- Remove Video"  />									
									</div>
								</div>			
							</div>
						</div>
					</div>	
				</div><?php
				$i++;
			}
		}
	?></div>
	<input type="hidden" class="numElem" value="<?php echo $num; ?>" />
	<input type="hidden" name="wp_banner_nonce"  value="<?php echo $nonce; ?>" />
	<div style="margin-top:20px;">
        <a href="javascript:void(0);" style="text-align: center;" class="add_new_image_button btn btn-success"><?php echo __('+ Add Slide','responsive-slick-slider');?></a>
	</div>
</div>
<script type="text/javascript">
	jQuery(document).ready(function(){
		
		// get posts for initial load
		var post_type = jQuery(".post_type_select option:selected").val();
		var id_type = jQuery(".post_type_select option:selected").attr("data-attribute");
		var ajax_nonce = '<?php echo wp_create_nonce( "post_taxonomy_nonce" ); ?>';
		var postId = '<?php echo (int)$post->ID; ?>';
		var data = {
			'action'	: 'display_post_taxonomy_list',
			'post_type' :encodeURIComponent(post_type),
			'postId'	:encodeURIComponent(postId),
			'id_type'	:encodeURIComponent(id_type),
			'ajax_nonce':encodeURIComponent(ajax_nonce)
		};
		jQuery.ajax({
			url: ajaxurl, 
			type: 'POST',
			data: data,
			success: function(data){
				jQuery(".displayPosts").html(data);
				jQuery(".decide_type_of_id").val(id_type);
			}
		});
		
		// dom for adding new image sections
		jQuery(".add_new_image_button").click(function(){
			var num = jQuery(".numElem").val();
			num++;
			var v=num + 1;
			
			var html= '<div class="removeslide accordianmain slide_item"><h2 class="remove'+num+' fa'+num+' sildediv accordianheading upimage" slide="'+num+'" ><?php echo __('Slide','responsive-slick-slider');?>'+num+' <a href="javascript: void(0);" title="Delete" class="removeImageSection"><span class="cross-image"></span></a></h2>';
			
			html +='<div class="newAddedImageSection" id="'+num+'"><div class="vsz_slide_type"><div class="form-group"><label class="col-sm-2 text-right"><?php echo __('Banner Type','responsive-slick-slider');?></label><div class="col-sm-4"><select name="banner_type[]" class="banner-type form-control" ><option value="image"><?php echo __('Image','responsive-slick-slider');?></option><option value="video"><?php echo __('Mp4 Video','responsive-slick-slider');?></option><option value="youtube"><?php echo __('Youtube Video','responsive-slick-slider');?></option><option value="vimeo" ><?php echo __('Vimeo Video','responsive-slick-slider');?></option></select></div><div class="col-sm-2 pull-right"><input id="hodeslide-'+num+'" hide="hidden'+num+'" type="checkbox" class="hiddencheckbox" value="1" style="margin-top:-5px;"><label for="hodeslide-'+num+'"  class="hiddencheckbox" hide="hidden'+num+'" >Hidden</label><input type="hidden" name="hidden[]" id="hidden'+num+'" value="0"></div><div class="col-sm-2 pull-right"><input type="number" min="1" class="image_order form-control" name="image_order[]" value="'+num+'" /></div><div class="col-sm-2 pull-right text-right"><label><?php echo __('Order','responsive-slick-slider');?></label></div></div></div>';
			
			html +='<div class="type-image display-type">'
			
				html +='<div class="vsz_img_row"><div class="form-group"><div class="col-sm-4"><label><?php echo __('Image','responsive-slick-slider');?></label><input type="button" class="add_image num_'+num+' btn btn-success" value="+ Add Image" /><input type="button" class="removeImage num_'+num+'_remove btn btn-danger" value="- Remove" style="display:none;" /><input type="hidden" class="num_'+num+'_id" value="'+num+'" name="imageId[]" /></div><div class="col-sm-4"><label><?php echo __('Ipad Image','responsive-slick-slider');?></label><input type="button" class="add_imagei numi_'+num+'  btn btn-success" value="+ Add Image" /><input type="button" class="removeImagei numi_'+num+'_remove btn btn-danger" value="- Remove" style="display:none;" /><input type="hidden" class="numi_'+num+'_id" value="'+num+'" name="imageiId[]" /></div><div class="col-sm-4"><label><?php echo __('Mobile Image','responsive-slick-slider');?></label><input type="button" class="add_imagem numm_'+num+' btn btn-success" value="+ Add Image" /><input type="button" class="removeImagem numm_'+num+'_remove btn btn-danger" value="- Remove" style="display:none;" /><input type="hidden" class="numm_'+num+'_id" value="'+num+'" name="imagemId[]" /></div></div></div>';
							
				html += '<div class="vsz_title_row"><div class="form-group"><div class="col-sm-6"><label><?php echo __('Title','responsive-slick-slider');?></label><input type="text" name="image_title[]" class="form-control"  placeholder="Enter Title"/></div><div class="col-sm-3"><label class="ipad_title"><?php echo __('Hide Title in ipad','responsive-slick-slider');?></label><input id="ipadtitle-'+num+'" type="checkbox" name="" class="form-control ipadtitle cmn-toggle cmn-toggle-round-flat" ipad="'+num+'" value="1"  /><label for="ipadtitle-'+num+'"></label><input type="hidden" id="ipad'+num+'" name="image_ititle[]" value="0"></div><div class="col-sm-3"><label class="mobile_title"><?php echo __('Hide Title in Mobile','responsive-slick-slider');?></label><input id="mobiletitle-'+num+'" type="checkbox" name="image_mtitle[]" class="form-control mobiletitle cmn-toggle cmn-toggle-round-flat" mobile="'+num+'" value="1" /><label for="mobiletitle-'+num+'"></label><input type="hidden" id="mobile'+num+'" name="image_mtitle[]" value="0"></div></div></div>';			
							
				
				html +='<div class="vsz_content_row"><div class="form-group"><div class="col-sm-6"><label><?php echo __('Content','responsive-slick-slider');?></label><textarea name="image_content[]" class="form-control"></textarea></div><div class="col-sm-3"><label><?php echo __('Hide Content in ipad','responsive-slick-slider');?></label><input id="ipadcontent-'+num+'" type="checkbox" name="" class="form-control ipadcontent cmn-toggle cmn-toggle-round-flat" ipad="'+num+'" value="1"  /><label for="ipadcontent-'+num+'"></label><input type="hidden" id="ipadcontent'+num+'" name="imagei_content[]" value="0"></div><div class="col-sm-3"><label><?php echo __('Hide Content in Mobile','responsive-slick-slider');?></label><input id="mobilecontent-'+num+'" type="checkbox" name="" class="form-control mobilecontent cmn-toggle cmn-toggle-round-flat" mobile="'+num+'" value="1"  /><label for="mobilecontent-'+num+'"></label><input type="hidden" id="mobilecontent'+num+'" name="imagem_content[]" value="0"></div></div></div>';			
							
				
				html +='<div class="vsz_url_row"><div class="form-group"><div class="col-sm-7"><label><?php echo __('Url','responsive-slick-slider');?></label><input type="text" name="image_url[]" class="form-control singleUrl" id="image_custom_url-'+num+'" /></div><div class="col-sm-2"><label for="url"><?php echo __('Open Url','responsive-slick-slider');?></label><select name="url[]"><option value="1"   selected="selected"><?php echo __('Existing Tab','responsive-slick-slider');?></option><option value="0"><?php echo __('New Tab','responsive-slick-slider');?></option></select></div><div class="col-sm-3"><label for="buttontext"><?php echo __('Button Text','responsive-slick-slider');?></label><input type="text" name="buttontext[]" class="form-control" value="" placeholder="Read More"/></div></div></div>';	

			html +='</div>';
			
			html += '<div class="type-video hide-type"><div class="form-group"><label class="col-sm-2 text-right"><?php echo __('Video  Url','responsive-slick-slider');?></label><div class="mp4video" style="display:none;"> <div class="col-sm-6 "> <input type="text" name="videoid[]" id="videonumv_'+num+'" class="form-control" value="" /> </div> <div class="col-sm-3 " > <input type="button" class="add_video numv_'+num+' btn btn-success" value="+ Add Video"  "/> <input type="button" class="remove_video numv_'+num+'  btn btn-danger" value="- Remove Video" style="display:none;" /> </div> </div> <div class="youtubevideo" style="display:none;"> <div class="col-sm-6 "> <input type="text" name="videoyoutubeid[]"  class="form-control" value="" /> </div> <div class="col-sm-3 " style="display:none;" > <input type="button" class="emptyvideo  btn btn-danger" value="- Remove Video"  /> </div> </div> <div class="vimeovideo" style="display:none;"> <div class="col-sm-6 "> <input type="text" name="videovimeoid[]" class="form-control" value="" /> </div> <div class="col-sm-3 " style="display:none;" > <input type="button" class="emptyvideo  btn btn-danger" value="- Remove Video"  /></div></div></div>';

			html += '</div></div></div>';
					
			jQuery(".numElem").val(num);
			jQuery(".inner").append(html);
			var temp=num;
			
			jQuery('.fa'+temp).click(function(){
				var slide=jQuery(this).attr('slide');
				jQuery('#'+slide).slideToggle(400);
				if(jQuery('.fa'+temp).hasClass('upimage')){
					
					jQuery('.fa'+temp).removeClass('upimage');
					jQuery('.fa'+temp).addClass('downimage');
				}
				else{
					
					jQuery('.fa'+temp).removeClass('downimage');
					jQuery('.fa'+temp).addClass('upimage');
				}
			});
			jQuery('.ipadtitle').click(function(){
			
				if(jQuery(this). prop("checked") == true){
				var slide=jQuery(this).attr('ipad');
				jQuery('#ipad'+slide).val('1');
				}
				else if(jQuery(this). prop("checked") == false){
				var slide=jQuery(this).attr('ipad');
				jQuery('#ipad'+slide).val('0');
				}
			});
			jQuery('.mobiletitle').click(function(){
				
				if(jQuery(this). prop("checked") == true){
				var slide=jQuery(this).attr('mobile');
				jQuery('#mobile'+slide).val('1');
				}
				else if(jQuery(this). prop("checked") == false){
				var slide=jQuery(this).attr('mobile');
				jQuery('#mobile'+slide).val('0');
				}
			});
			jQuery('.ipadcontent').click(function(){
				
				if(jQuery(this). prop("checked") == true){
				var slide=jQuery(this).attr('ipad');
				jQuery('#ipadcontent'+slide).val('1');
				}
				else if(jQuery(this). prop("checked") == false){
				var slide=jQuery(this).attr('ipad');
				jQuery('#ipadcontent'+slide).val('0');
				}
			});
			jQuery('.mobilecontent').click(function(){
				
				if(jQuery(this). prop("checked") == true){
				var slide=jQuery(this).attr('mobile');
				jQuery('#mobilecontent'+slide).val('1');
				}
				else if(jQuery(this). prop("checked") == false){
				var slide=jQuery(this).attr('mobile');
				jQuery('#mobilecontent'+slide).val('0');
				}
			});
			jQuery('.hiddencheckbox').click(function(){
				
				if(jQuery(this).prop("checked") == true){
				var slide=jQuery(this).attr('hide');
				jQuery('#'+slide).val('1');
				}
				else if(jQuery(this).prop("checked") == false){
				var slide=jQuery(this).attr('hide');
				jQuery('#'+slide).val('0');
				}
			});
		});
		
		// removing image section
		//jQuery('.removeImageSection').live("click", function() { 
		jQuery(document).on('click','.removeImageSection',function(){
			 if (confirm("Are you sure you want to delete this slide?") == true) {
					jQuery(this).closest(".removeslide").remove();
			} 
			else {
				return false;
			}
			
		});
		
		// adding images
		var custom_uploader_video;
		jQuery(document).on('click','.add_video', function(e){
			
			var classes = jQuery(this).prop("class");
			classArray = classes.split(" ");
			numClass = classArray[1];
			e.preventDefault();
			//If the uploader object has already been created, reopen the dialog
			if (custom_uploader_video) {
				custom_uploader_video.open();
				return;
			}
			//Extend the wp.media object
			custom_uploader_video = wp.media.frames.file_frame = wp.media({
				title: 'Choose Video',
				button: {
					text: 'Choose Video'
				},
				library : { type : 'video' }, 
				multiple: false
			});
			custom_uploader_video.on('select', function() {
				
				attachment = custom_uploader_video.state().get('selection').first().toJSON();
				if ('video' == attachment.type) {
					file_id = attachment.id;
					file_url=attachment.url;
					num = jQuery(".numElem").val();
					//alert(file_url);
					//alert(numClass);
					jQuery("#video"+numClass).val(file_url);
					jQuery('.remove_video.'+numClass).css('display','block');
					jQuery('.add_video.'+numClass).css('display','none');
					
				}
				else {
					alert("Please Select Video only.");
				}
			});
			custom_uploader_video.open();
		});
		jQuery(document).on('click','.remove_video', function(e){
			var classes = jQuery(this).prop("class");
			classArray = classes.split(" ");
			numClass = classArray[1];
			jQuery("#video"+numClass).val('');
			jQuery('.remove_video.'+numClass).css('display','none');
			jQuery('.add_video.'+numClass).css('display','block');
		});
		var custom_uploader;
		jQuery(document).on('click','.add_image', function(e) {
			
			var classes = jQuery(this).prop("class");
			classArray = classes.split(" ");
			numClass = classArray[1];
			e.preventDefault();
			//If the uploader object has already been created, reopen the dialog
			if (custom_uploader) {
				custom_uploader.open();
				return;
			}
			//Extend the wp.media object
			custom_uploader = wp.media.frames.file_frame = wp.media({
				title: 'Choose Image',
				button: {
					text: 'Choose Image'
				},
				library : { type : 'image' }, 
				multiple: false
			});
			custom_uploader.on('select', function() {
				
				attachment = custom_uploader.state().get('selection').first().toJSON();
				
				if ('image' == attachment.type && 'undefined' != typeof attachment.sizes) {
					
					/* if(attachment.width < 300 || attachment.height < 300){
						alert("Please upload more than 300X300 dimension image.");
						return;
					} */
					file_url = attachment.sizes.full.url;
					file_id = attachment.id;
					if ('undefined' != typeof attachment.sizes.thumbnail) {
						file_url = attachment.sizes.thumbnail.url;
					}
					num = jQuery(".numElem").val();
					//alert(numClass);
					jQuery("."+numClass).after('<image src="'+file_url+'" class="'+numClass+'_image checkImage" style="width: auto; height: 150px;" />');
					jQuery("."+numClass).hide();
					jQuery("."+numClass+"_id").val(file_id);
					jQuery("."+numClass+"_remove").css('display','block');
				}
				else {
					alert("Please Select Image only.");
				}
			});
			custom_uploader.open();
		});
		var custom_uploaderi;
		jQuery(document).on('click','.add_imagei', function(e) {
			
			var classes = jQuery(this).prop("class");
			classArray = classes.split(" ");
			numClass = classArray[1];
			e.preventDefault();
			//If the uploader object has already been created, reopen the dialog
			if (custom_uploaderi) {
				custom_uploaderi.open();
				return;
			}
			//Extend the wp.media object
			custom_uploaderi = wp.media.frames.file_frame = wp.media({
				title: 'Choose Image',
				button: {
					text: 'Choose Image'
				},
				library : { type : 'image' }, 
				multiple: false
			});
			custom_uploaderi.on('select', function() {
				
				attachment = custom_uploaderi.state().get('selection').first().toJSON();
				
				if ('image' == attachment.type && 'undefined' != typeof attachment.sizes) {
					
					/* if(attachment.width < 300 || attachment.height < 300){
						alert("Please upload more than 300X300 dimension image.");
						return;
					} */
					file_url = attachment.sizes.full.url;
					file_id = attachment.id;
					if ('undefined' != typeof attachment.sizes.thumbnail) {
						file_url = attachment.sizes.thumbnail.url;
					}
					num = jQuery(".numElem").val();
					
					jQuery("."+numClass).after('<image src="'+file_url+'" class="'+numClass+'_image checkImage" style="width: auto; height: 150px;" />');
					jQuery("."+numClass).hide();
					jQuery("."+numClass+"_id").val(file_id);
					jQuery("."+numClass+"_remove").css('display','block');
				}
				else {
					alert("Please Select Image only.");
				}
			});
			custom_uploaderi.open();
		});
		var custom_uploaderm;
		jQuery(document).on('click','.add_imagem', function(e) {
			
			var classes = jQuery(this).prop("class");
			classArray = classes.split(" ");
			numClass = classArray[1];
			e.preventDefault();
			//If the uploader object has already been created, reopen the dialog
			if (custom_uploaderm) {
				custom_uploaderm.open();
				return;
			}
			//Extend the wp.media object
			custom_uploaderm = wp.media.frames.file_frame = wp.media({
				title: 'Choose Image',
				button: {
					text: 'Choose Image'
				},
				library : { type : 'image' }, 
				multiple: false
			});
			custom_uploaderm.on('select', function() {
				
				attachment = custom_uploaderm.state().get('selection').first().toJSON();
				
				if ('image' == attachment.type && 'undefined' != typeof attachment.sizes) {
					
					/* if(attachment.width < 300 || attachment.height < 300){
						alert("Please upload more than 300X300 dimension image.");
						return;
					} */
					file_url = attachment.sizes.full.url;
					file_id = attachment.id;
					if ('undefined' != typeof attachment.sizes.thumbnail) {
						file_url = attachment.sizes.thumbnail.url;
					}
					num = jQuery(".numElem").val();
					
					jQuery("."+numClass).after('<image src="'+file_url+'" class="'+numClass+'_image checkImage" style="width: done; height: 150px;" />');
					jQuery("."+numClass).hide();
					jQuery("."+numClass+"_id").val(file_id);
					jQuery("."+numClass+"_remove").css('display','block');
				}
				else {
					alert("Please Select Image only.");
				}
			});
			custom_uploaderm.open();
		});
		// remove attached iamge
		jQuery(document).on("click",".removeImage",function(){
			
			var classes = jQuery(this).prop("class");
			
			classArray = classes.split(" ");
			numClass = classArray[1];
			var classNameArray = numClass.split("_");
			var lenArray = classNameArray.length;
			var className = classNameArray[lenArray-2];
			
			jQuery(this).hide();
			jQuery(".num_"+className).show();
			jQuery(".num_"+className+"_image").remove();
			jQuery(".num_"+className+"_id").val('');
			
		});
		jQuery(document).on("click",".removeImagei",function(){
			
			var classes = jQuery(this).prop("class");
			
			classArray = classes.split(" ");
			numClass = classArray[1];
			var classNameArray = numClass.split("_");
			var lenArray = classNameArray.length;
			var className = classNameArray[lenArray-2];
			
			jQuery(this).hide();
			jQuery(".numi_"+className).show();
			jQuery(".numi_"+className+"_image").remove();
			jQuery(".numi_"+className+"_id").val('');
			
		});
		jQuery(document).on("click",".removeImagem",function(){
			
			var classes = jQuery(this).prop("class");
			
			classArray = classes.split(" ");
			numClass = classArray[1];
			var classNameArray = numClass.split("_");
			var lenArray = classNameArray.length;
			var className = classNameArray[lenArray-2];
			
			jQuery(this).hide();
			jQuery(".numm_"+className).show();
			jQuery(".numm_"+className+"_image").remove();
			jQuery(".numm_"+className+"_id").val('');
			
		});
		// to change post field values dynamically
		jQuery(".post_type_select").change(function(){
			var post_type = jQuery(".post_type_select option:selected").val();
			var id_type = jQuery(".post_type_select option:selected").attr("data-attribute");
			//baseUrl = '<?php echo plugin_dir_url(__FILE__)."getPosts.php"; ?>';
			var postId = '<?php echo (int) $post->ID; ?>';
			var ajax_nonce = '<?php echo wp_create_nonce( "post_taxonomy_nonce" ); ?>';
				var data = {
				'action'	: 'display_post_taxonomy_list',
				'post_type' :encodeURIComponent(post_type),
				'postId'	:encodeURIComponent(postId),
				'id_type'	:encodeURIComponent(id_type),
				'ajax_nonce':encodeURIComponent(ajax_nonce)
			};
			
			jQuery.ajax({
				url: ajaxurl, 
				type: 'POST',
				data: data,
				success: function(data){
					jQuery(".displayPosts").html(data);
					jQuery(".decide_type_of_id").val(id_type);
						
				}
			});	
		});
		
		//// validate parameters before save
		var checkVal = false;
	
		jQuery("#publish").click(function(){
		
			var post_type = jQuery("#post_type").val();
			checkVal = false;
			var returnurl = true;
			jQuery("body").find(".banner-type").each(function(){
			
				
				var selectedvalue=jQuery(this).val();
				
				var result;
				var temp=jQuery(this).parent().parent().parent().parent().attr('id');
				if(selectedvalue == 'youtube'){
					var urlval=jQuery('#'+temp+' .youtubevideo .form-control').val();
				}
				else if(selectedvalue == 'vimeo'){
					var urlval=jQuery('#'+temp+' .vimeovideo .form-control').val();
				}
				else if(selectedvalue == 'video'){
					var urlval=jQuery('#videonumv_'+temp).val();
				}
				else{
					var urlval=jQuery('#image_custom_url-'+temp).val();
				}
				
				if(urlval != ''){
					if(selectedvalue == 'youtube'){
						 var p = /^(?:https?:\/\/)?(?:m\.|www\.)?(?:youtu\.be\/|youtube\.com\/(?:embed\/|v\/|watch\?v=|watch\?.+&v=))((\w|-){11})(?:\S+)?$/;
						if(urlval.match(p)){
							 result='youtube';
						}
						//var result=urlval.match("/^(?:https?:\/\/)?(?:www\.)?(?:youtube\.com|youtu\.be)\/watch\?v=([^&]+)/m");
					}
					if(selectedvalue == 'vimeo'){
						
						  urlval.match(/(http:\/\/|https:\/\/|)(player.|www.)?(vimeo\.com|youtu(be\.com|\.be|be\.googleapis\.com))\/(video\/|embed\/|watch\?v=|v\/)?([A-Za-z0-9._%-]*)(\&\S+)?/);
						 if (RegExp.$3.indexOf('vimeo') > -1) {
								result='vimeo';
							}
					}
					if(selectedvalue == 'video'){
						var videocheckArray=urlval.split(".");
						if(videocheckArray[videocheckArray.length-1]  == 'mp4'){
							result='video';
						}
					}
					
					if(selectedvalue != 'image' ){
						
						if(result != selectedvalue){
							//alert(result);
							//alert(selectedvalue);	
							jQuery('#videonumv_'+temp).focus();
							alert("Please Enter Valid "+selectedvalue+ " Url in slide"+temp);
							returnurl=false;
							return false;
						}
					}
					else{
						var regi = /^(ftp|http|https):\/\/[^ "]+$/;
						if(!regi.test(urlval.toLowerCase())){ 
							jQuery('#image_custom_url-'+temp).focus();
							alert("Please Enter Valid "+selectedvalue+ " Url in slide"+temp);
							returnurl=false;
							return false;
						}
					}
				}
			});
			return returnurl;		
		});
		jQuery('.sildediv').click(function(){
			var slide=jQuery(this).attr('slide');
			
			jQuery('#'+slide).slideToggle(400);
			if(jQuery(this).hasClass('upimage')){
				
				jQuery(this).removeClass('upimage');
				jQuery(this).addClass('downimage');
			}
			else{
				
				jQuery(this).removeClass('downimage');
				jQuery(this).addClass('upimage');
			}
		});
		jQuery('.ipadtitle').click(function(){
			
			if(jQuery(this). prop("checked") == true){
			var slide=jQuery(this).attr('ipad');
			jQuery('#ipad'+slide).val('1');
			}
			else if(jQuery(this). prop("checked") == false){
			var slide=jQuery(this).attr('ipad');
			jQuery('#ipad'+slide).val('0');
			}
		});
		jQuery('.mobiletitle').click(function(){
			
			if(jQuery(this). prop("checked") == true){
			var slide=jQuery(this).attr('mobile');
			jQuery('#mobile'+slide).val('1');
			}
			else if(jQuery(this). prop("checked") == false){
			var slide=jQuery(this).attr('mobile');
			jQuery('#mobile'+slide).val('0');
			}
		});
		jQuery('.ipadcontent').click(function(){
			
			if(jQuery(this). prop("checked") == true){
			var slide=jQuery(this).attr('ipad');
			jQuery('#ipadcontent'+slide).val('1');
			}
			else if(jQuery(this). prop("checked") == false){
			var slide=jQuery(this).attr('ipad');
			jQuery('#ipadcontent'+slide).val('0');
			}
		});
		jQuery('.mobilecontent').click(function(){
			
			if(jQuery(this). prop("checked") == true){
			var slide=jQuery(this).attr('mobile');
			jQuery('#mobilecontent'+slide).val('1');
			}
			else if(jQuery(this). prop("checked") == false){
			var slide=jQuery(this).attr('mobile');
			jQuery('#mobilecontent'+slide).val('0');
			}
		});
		jQuery('.hiddencheckbox').click(function(){
			
			if(jQuery(this). prop("checked") == true){
			var slide=jQuery(this).attr('hide');
			jQuery('#'+slide).val('1');
			}
			else if(jQuery(this). prop("checked") == false){
			var slide=jQuery(this).attr('hide');
			jQuery('#'+slide).val('0');
			}
		});
		jQuery(document).on("change",".banner-type",function(){
			var selectedvalue=jQuery(this).val();
			//alert(selectedvalue);
			var temp=jQuery(this).parent().parent().parent().parent().attr('id');
			
			if(selectedvalue == 'image')
			{
				
				jQuery('#'+temp+' .type-image').removeClass('hide-type');
				jQuery('#'+temp+' .type-image').addClass('display-type');
				jQuery('#'+temp+' .type-video').removeClass('display-type');
				jQuery('#'+temp+' .type-video').addClass('hide-type');
			}
			else{
		
				jQuery('#'+temp+' .type-image').removeClass('display-type');
				jQuery('#'+temp+' .type-image').addClass('hide-type');
				jQuery('#'+temp+' .type-video').removeClass('hide-type');
				jQuery('#'+temp+' .type-video').addClass('display-type');
			}
			if(selectedvalue == 'video')
			{
				jQuery('#'+temp+' .mp4video').css('display','block');
			}
			else{
					jQuery('#'+temp+' .mp4video').css('display','none');

			}
			if(selectedvalue == 'youtube')
			{
				jQuery('#'+temp+' .youtubevideo').css('display','block');
				if(jQuery('#'+temp+' .youtubevideo .form-control').val() != ''){
					jQuery('#'+temp+' .youtubevideo .col-sm-3').css('display','block');
				}
				else{
					jQuery('#'+temp+' .youtubevideo .col-sm-3').css('display','none');
				}
			}
			else{
					jQuery('#'+temp+' .youtubevideo').css('display','none');

			}
			if(selectedvalue == 'vimeo')
			{
				jQuery('#'+temp+' .vimeovideo').css('display','block');
				if(jQuery('#'+temp+' .vimeovideo .form-control').val() != ''){
					jQuery('#'+temp+' .vimeovideo .col-sm-3').css('display','block');
				}
				else{
					jQuery('#'+temp+' .vimeovideo .col-sm-3').css('display','none');
				}
			}
			else{
					jQuery('#'+temp+' .vimeovideo').css('display','none');

			}
		});
		jQuery(document).on("click",".emptyvideo",function(){
			jQuery(this).parent().parent().find('.form-control').val('');
			jQuery(this).parent().css('display','none');
		});
		
	});//Close ready syntax here
</script>