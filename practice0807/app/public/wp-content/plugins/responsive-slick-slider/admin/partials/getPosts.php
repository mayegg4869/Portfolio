<?php
// Exit if accessed directly
if(!defined( 'ABSPATH' ) ) {
	exit;
}
	
// getting parameters
$post_type = isset($_POST['post_type']) ? sanitize_title($_POST['post_type']) : '';
$id_type = isset($_POST['id_type']) ? sanitize_title($_POST['id_type']) : '';
$postId = isset($_POST['postId']) ? intval($_POST['postId']) : '';

if(!current_user_can( 'edit_post', $postId )){
	return;
}
if(!check_ajax_referer( 'post_taxonomy_nonce', 'ajax_nonce')){
	return;
}

$is_archieve = get_post_meta($postId,'is_archieve',true);

if($post_type != ''){
	
	// saved post / category ids
	$postIdsSaved = get_post_meta($postId,'postIdsSaved',true);
	if(!empty($postIdsSaved)){
		$postsIdsSaved = explode(",",$postIdsSaved);
	}
	else{
		$postsIdsSaved = array();
	}
	// for taxonomy
	if($id_type == "taxonomy"){
		$terms = get_terms(array('taxonomy' => $post_type,'hide_empty' => false));
		if(!empty($terms)){
			$newDisplay = true;
			$i=0;$j=0;
			foreach($terms as $term){
				?><div style="width: 33%;float:left;">
					<input type="checkbox" name="postsToSave[]" value="<?php echo $term->term_id; ?>" <?php
				if(isset($postsIdsSaved) && is_array($postsIdsSaved) && in_array( $term->term_id,$postsIdsSaved)){ echo "checked"; } ?> class="singleCheck" id="input<?php echo $j;?>" style="margin:0;"/>
				<label class="post-span" for="input<?php echo $j;?>" style="font-weight:normal;"> <?php echo esc_html($term->name);?>
				</label><?php
				?></div><?php
				$i=$i+1;
				$j=$j+1;
				 if($i%3 == 0 && $i != 0){ ?><div class="clearfix margin-bot5"></div><?php $i=0; } 
			}
			
		}
		else{
			print '<div class="post-term-error"> Not found any term under selected taxonomy.';
		}
	}
	// for post
	else if($id_type == "post"){
		
		$args = array('post_type'=>$post_type,'posts_per_page'=>-1,'post_status'=>'publish','order' => 'ASC','orderby' => 'title');
		$loop = new WP_Query($args);
		
		if($loop->have_posts()){
			
			$newDisplay = true;
			$i=0;
			$j=0;
			while($loop->have_posts()) : $loop->the_post();
				global $post;
				if($i%3 == 0 && $i != 0){
					?><div class="clearfix margin-bot5"></div><?php $i=0; 
				}
				if($newDisplay){
					// for giving first option of archieve
					?><div style="width:33%; float:left;">
						<input type="checkbox" name="is_archieve" value="<?php echo $post_type; ?>" <?php if($is_archieve == $post_type){ echo "checked"; } ?> class="singleCheck" style="margin:0;" id="input<?php echo $j;?>" />
						<label for="input<?php echo $j;?>" class="post-span" style="font-weight:normal;">Archive (Listing)</label>
					</div><?php
					$newDisplay = false;
					$i=$i+1;
					$j=$j+1;
				}
				
				if($i%3 == 0 && $i != 0){
					?><div class="clearfix margin-bot5"></div><?php $i=0;
				} 
				
				?><div style="width: 33%;float:left;">
				
					<input type="checkbox" name="postsToSave[]" value="<?php echo get_the_id(); ?>" <?php
					if(isset($postsIdsSaved) && is_array($postsIdsSaved) && in_array( get_the_id(),$postsIdsSaved)){ echo "checked"; } ?> class="singleCheck" style="margin:0;" id="input<?php echo $j;?>"/>
					<label class="post-span" for="input<?php echo $j;?>" style="font-weight:normal;"><?php 
						$post_title = get_the_title();
						
						// Get parent label
						$label = "";
						if(!empty($post->post_parent)){
							$post_id = $post->ID;
							$parentIds = get_post_ancestors($post_id);
							$parentIds = array_reverse($parentIds);
							if(!empty($parentIds)){
								foreach($parentIds as $key => $val){
									$post_parent = get_post($val);
									if(!empty($post_parent)){
										if(empty($label)){
											$label .= '( '.$post_parent->post_title;
										}
										else{
											$label .= ' / '.$post_parent->post_title;
										}
									}
								}
							}
							$label .= " )";
						}
						echo $post_title;
						if(!empty($label)){
							echo "&nbsp;<span class='post_parent_highlight'>".$label."</span>"; 
						}
					?></label>
				</div>
			
			<?php $j=$j+1;$i=$i+1; if($i%3 == 0 && $i != 0){ ?><div class="clearfix margin-bot5"></div><?php $i=0; } ?>
			<?php
			endwhile;
		}
		else{
			print '<div class="post-term-error"> Not found any post under selected post type.';
		}
	}
}
wp_die();