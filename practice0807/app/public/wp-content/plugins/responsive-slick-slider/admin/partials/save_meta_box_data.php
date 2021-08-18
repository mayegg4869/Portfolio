<?php
// Exit if accessed directly
if(!defined( 'ABSPATH' ) ) {
	exit;
}
if(!is_admin() || empty($_POST) || !isset($_POST['post_name']) || $_POST['post_type'] != 'vsz_responsive_slick'){
	return;
}
if(!current_user_can( 'edit_post', $post_id )){
	return;
}
	
// check nonce
if(!isset($_POST['wp_banner_nonce']) || empty($_POST['wp_banner_nonce'])){
	return;
}

$nonce = $_POST['wp_banner_nonce'];
if(!wp_verify_nonce( $nonce, 'banner-save-meta-nonce-'.$post_id ) ) {
	// This nonce is not valid.
	return;
}
//Get banner type value
$decide_type_of_id = isset($_POST['decide_type_of_id']) ? sanitize_text_field($_POST['decide_type_of_id']) : 'post';

// Get post type
$post_type = isset($_POST['post_type_responsive_slider']) ? sanitize_text_field($_POST['post_type_responsive_slider']) : '';

//Get checked post and taxonomy id's
$postIdsToSave = isset($_POST['postsToSave']) ? $_POST['postsToSave'] : '';
if(!empty($postIdsToSave)){
	//Check all post id is integer or not
	$postIdsToSave = array_map( 'absint', $postIdsToSave );
}
//Get banner image id
$imageIds = isset($_POST['imageId']) ? $_POST['imageId'] : '';
if(!empty($imageIds)){
	//Check all image id is integer or not
	$imageIds = array_map( 'absint', $imageIds);
}
//Get Ipad banner image id
$imageiIds = isset($_POST['imageiId']) ? $_POST['imageiId'] : '';
if(!empty($imageiIds)){
	//Check all image id is integer or not
	$imageiIds = array_map( 'absint', $imageiIds);
}
//Get Mobile banner image id
$imagemIds = isset($_POST['imagemId']) ? $_POST['imagemId'] : '';
if(!empty($imagemIds)){
	//Check all image id is integer or not
	$imagemIds = array_map( 'absint', $imagemIds);
}

//Get Image title
$image_titles = isset($_POST['image_title']) ? $_POST['image_title'] : '';

if(!empty($image_titles)){
	//Sanitize all image content value
	foreach($image_titles as &$tag) {
		$tag = wp_kses_post(($tag));
	}
	unset($tag);
}


//get image URL
$image_url = isset($_POST['image_url']) ? $_POST['image_url'] : '';
if(!empty($image_url)){
	//Sanitize all image URL value
	$image_url = array_map( 'esc_url_raw', $image_url);
}

//Get image content
$image_content = isset($_POST['image_content']) ? $_POST['image_content'] : '';
if(!empty($image_content)){
	//Sanitize all image content value
	foreach($image_content as &$tag) {
		$tag = wp_kses_post(($tag));
	}
	unset($tag);
}

//Get Image order value
$image_orders = isset($_POST['image_order']) ? $_POST['image_order'] : '';
if(!empty($image_orders)){
	//Check all image order is integer or not
	$image_orders = array_map( 'absint', $image_orders);
}
//Get archive post value
$is_archieve = isset($_POST['is_archieve']) ? sanitize_text_field($_POST['is_archieve']) : '';

//Get display title in ipad or not value 
$image_ititle = isset($_POST['image_ititle']) ? $_POST['image_ititle'] : '';
if(!empty($image_ititle)){
	//Check all ipad image display title value is integer or not
	$image_ititle = array_map( 'absint', $image_ititle);
}
//Get display title in mobile or not value 
$image_mtitle = isset($_POST['image_mtitle']) ? $_POST['image_mtitle'] : '';
if(!empty($image_mtitle)){
	//Check all mobile image display title value is integer or not
	$image_mtitle = array_map( 'absint', $image_mtitle);
}
//Get display content in Ipad or not value 
$imagei_content = isset($_POST['imagei_content']) ? $_POST['imagei_content'] : '';
if(!empty($imagei_content)){
	//Check all ipad image display content value is integer or not
	$imagei_content = array_map( 'absint', $imagei_content);
}
//Get display content in mobile or not value 
$imagem_content = isset($_POST['imagem_content']) ? $_POST['imagem_content'] : '';
if(!empty($imagem_content)){
	//Check all mobile image display content value is integer or not
	$imagem_content = array_map( 'absint', $imagem_content);
}

//Get slider is display at front or not value 
$hidden=isset($_POST['hidden']) ? $_POST['hidden'] : '';
if(!empty($hidden)){
	//Check all mobile image display content value is integer or not
	$hidden = array_map( 'absint', $hidden);
}

$banner_type=isset($_POST['banner_type']) ? $_POST['banner_type'] : '';
if(!empty($banner_type)){
	//Sanitize all image title value
	$banner_type = array_map( 'sanitize_text_field', ($banner_type));
}

//Get all uploaded video URL here
$videoid=isset($_POST['videoid']) ? $_POST['videoid'] : '';
if(!empty($videoid)){
	//Sanitize all video URL value
	$videoid = array_map( 'esc_url_raw', $videoid);
}

//Get all youtube video URL here
$videoyoutubeid=isset($_POST['videoyoutubeid']) ? $_POST['videoyoutubeid'] : '';
if(!empty($videoyoutubeid)){
	//Sanitize all youtube video URL value
	$videoyoutubeid = array_map( 'esc_url_raw', $videoyoutubeid);
}
//Get all vimeo video URL here
$videovimeoid=isset($_POST['videovimeoid']) ? $_POST['videovimeoid'] : '';
if(!empty($videovimeoid)){
	//Sanitize all vimeo video URL value
	$videovimeoid = array_map( 'esc_url_raw', $videovimeoid);
}

//Get URL is open in new tab and existing tab value
$url=isset($_POST['url']) ? $_POST['url'] : '';
if(!empty($url)){
	//Check all value is integer or not
	$url = array_map( 'absint', $url);
}

if($postIdsToSave != ""){
	$ids_p = implode(",",$postIdsToSave);
}
else{
	$ids_p = '';
}


$buttontext = isset($_POST['buttontext']) ? $_POST['buttontext'] : '';
if(!empty($buttontext)){
	//Sanitize all image content value
	foreach($buttontext as &$tag) {
		$tag = wp_kses_post(($tag));
	}
	unset($tag);
}
	
$newImageOrders = $image_orders;
//Customize order wise slider array
if(!empty($newImageOrders)){
	foreach($newImageOrders as $newImageOrder){
		$maxKey = 0;
		$maxNum = 0;
		foreach($newImageOrders as $key=>$value){
			if($value >= $maxNum){
				$maxNum = $value;
				$maxKey = $key;
			}
		}
		$orderArray[] = $maxKey;
		unset($newImageOrders[$maxKey]);
	}
}

$orderArrayReverse = array();
if(is_array($orderArray) && !empty($orderArray)){
	$orderArrayReverse = array_reverse($orderArray);
}

// getting image related values
if(is_array($orderArrayReverse) && !empty($orderArrayReverse)){
	foreach($orderArrayReverse as $key=>$value){
		$newArray[$key]['banner_type'] = $banner_type[$value];
		$newArray[$key]['imageId'] = $imageIds[$value];
		$newArray[$key]['imageiId'] = $imageiIds[$value];
		$newArray[$key]['imagemId'] = $imagemIds[$value];	
		$newArray[$key]['videoid']=$videoid[$value];
		$newArray[$key]['videoyoutubeid']=$videoyoutubeid[$value];
		$newArray[$key]['videovimeoid']=$videovimeoid[$value];
		$newArray[$key]['imageTitle'] = $image_titles[$value];
		$newArray[$key]['imageUrl'] = $image_url[$value];
		$newArray[$key]['imageContent'] = $image_content[$value];
		$newArray[$key]['imageOrder'] = $image_orders[$value];
		$newArray[$key]['image_ititle'] = $image_ititle[$value];
		$newArray[$key]['image_mtitle'] = $image_mtitle[$value];
		$newArray[$key]['imagei_content'] = $imagei_content[$value];
		$newArray[$key]['imagem_content'] = $imagem_content[$value];
		$newArray[$key]['hidden'] = $hidden[$value];
		$newArray[$key]['url']=$url[$value];
		$newArray[$key]['buttontext']=$buttontext[$value];
		
		
	}
	update_post_meta($post_id,'imageDetails',$newArray);
}
	
// updating values
update_post_meta($post_id,'decide_type_of_id',$decide_type_of_id);
update_post_meta($post_id,'postIdsSaved',$ids_p);
update_post_meta($post_id,'is_archieve',$is_archieve);
update_post_meta($post_id,'res_post_type',$post_type);

//Save banner related settings value here

$metaArray = array("slider_speed","display_Image","height","width","select_width_management","select_pagination","select_navigation","select_pauseonhover","select_fade","select_autoplay","autoplay_speed","background_color","text_color","centermode","centerpadding","layout","video_autoplay","content_width","opacity","select_navigation_arrow");

//Get slider speed value
$slider_speed = isset($_POST['slider_speed']) && !empty($_POST['slider_speed']) ? absint($_POST['slider_speed']) : '';
//Get display Image value
$display_Image = isset($_POST['display_Image']) && !empty($_POST['display_Image']) ? sanitize_text_field($_POST['display_Image']) : '';
//Get height value
$height = isset($_POST['height']) && !empty($_POST['height']) ? absint($_POST['height']) : '';
//Get width value
$width = isset($_POST['width']) && !empty($_POST['width']) ? absint($_POST['width']) : '';

//Get select width management value
$select_width_management = isset($_POST['select_width_management']) && !empty($_POST['select_width_management']) ? sanitize_text_field($_POST['select_width_management']) : '';

//Get pagination value
$select_pagination = isset($_POST['select_pagination']) ? absint($_POST['select_pagination']) : '';

//Get navigation value
$select_navigation = isset($_POST['select_navigation']) ? absint($_POST['select_navigation']) : '';

//Get pause on hover value
$select_pauseonhover = isset($_POST['select_pauseonhover']) ? absint($_POST['select_pauseonhover']) : '';

//Get fade value
$select_fade = isset($_POST['select_fade']) ? absint($_POST['select_fade']) : '';

//Get autoplay value
$select_autoplay = isset($_POST['select_autoplay']) ? absint($_POST['select_autoplay']) : '';

//Get autoplay speed value
$autoplay_speed = isset($_POST['autoplay_speed']) && !empty($_POST['autoplay_speed']) ? absint($_POST['autoplay_speed']) : '';

//Get background color value
$background_color = isset($_POST['background_color']) && !empty($_POST['background_color']) ? sanitize_text_field($_POST['background_color']) : '';

//Get text color value
$text_color = isset($_POST['text_color']) && !empty($_POST['text_color']) ? sanitize_text_field($_POST['text_color']) : '';
	
//Get center mode value
$centermode = isset($_POST['centermode']) && !empty($_POST['centermode']) ? sanitize_text_field($_POST['centermode']) : '';

//Get center padding value
$centerpadding = isset($_POST['centerpadding']) && !empty($_POST['centerpadding']) ? absint($_POST['centerpadding']) : '';

//Get layout value
$layout = isset($_POST['layout']) && !empty($_POST['layout']) ? sanitize_text_field($_POST['layout']) : '';

//Get video autoplay value
$video_autoplay = isset($_POST['video_autoplay']) ? absint($_POST['video_autoplay']) : '';

//Get content width value
$content_width = isset($_POST['content_width']) && !empty($_POST['content_width']) ? absint($_POST['content_width']) : '';

//Get opacity value
$opacity = isset($_POST['opacity'])  ? sanitize_text_field($_POST['opacity']) : '';

$select_navigation_arrow = isset($_POST['select_navigation_arrow'])  ? sanitize_text_field($_POST['select_navigation_arrow']) : ''; 
foreach($metaArray as $meta){
	update_post_meta($post_id,$meta,$$meta);
}
	
?>