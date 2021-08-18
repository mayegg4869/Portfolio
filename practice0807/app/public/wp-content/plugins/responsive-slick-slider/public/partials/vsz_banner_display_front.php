<?php
// Exit if accessed directly
if(!defined( 'ABSPATH' ) ) {
	exit;
}
global $wpdb;

// get id for banner shortcode if define
$arrInfo = shortcode_atts( array( 'id' => '' ),$atts );
$bannerPostId = intval($arrInfo['id']);	
if(!empty($bannerPostId)){
	$arrSliderPost = get_post($bannerPostId);
	if(empty($arrSliderPost) || $arrSliderPost->post_status != 'publish' || $arrSliderPost->post_type != 'vsz_responsive_slick') return ;
}

$return = '';

	////////////////////////////// case :- post id is given
	if(!empty($bannerPostId)){
			/* post id is given as parameter */
		$imageLoop = get_post_meta($bannerPostId,'imageDetails',true);
		// displaying the images added
		if(!empty($imageLoop)){
			$return = $this->displayImageAtFront($imageLoop,$bannerPostId);		//// displaying specific banner
		}
	}
	//////////////////////////////////////////// case :- post id is not given. (Use default setting)
	else{
		/* post id is not given as parameter so have to fetch the post by meta query */
		///////////////////// case homepage 
		if(is_front_page() || is_home()){
			global $post;
			$postId = '';
			if(isset($post->ID)){
				$postId = $post->ID;
			}
			if(empty($postId)){
				return;
			}
			/* fetching posts for category id */
				$args = array (
								'post_type' => 'vsz_responsive_slick',
								'meta_query' => array(
													'relation' => 'AND',
													array(
														'key' => 'postIdsSaved',
														'value' => $postId,
														'compare' => 'LIKE'
													),
													array(
														'key' => 'decide_type_of_id',
														'value' => 'post'
													)
												)
							);
				$result = get_posts($args);
				if(!empty($result)){
					foreach($result as $value){
						$bannerPostId = intval($value->ID);
						$postIdsSaved = get_post_meta($bannerPostId,'postIdsSaved',true);
						
						if(!empty($postIdsSaved)){
							$postIdsSaved  = explode(',',$postIdsSaved);
							if(!empty($postIdsSaved) && !in_array($postId,$postIdsSaved)){
								continue;
							}
						}
						$imageLoop = get_post_meta($bannerPostId,'imageDetails',true);
						
						// displaying the images added
						if(!empty($imageLoop)  ){
							$return = $this->displayImageAtFront($imageLoop,$bannerPostId);		//// displaying specific banner
						}
						break;  // to display only 1 banner at a time
						
					}
				}
		}
		else if ( is_archive() ) {
			
			// to restrict for 404 page on archieve
			if(is_404())
			{
				return '';
			}
			
			////////////////////////////// case:- category
			if( is_category() || is_tax() ){
				
				global $wp_query;
				if(isset($wp_query->query_vars['cat'])){
					$catId = $wp_query->query_vars['cat'];
					if(empty($catId)){
						$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
						if(!empty($term) && isset($term->term_id)){
							$catId = $term->term_id;
						}
						else{
							$catId = '';
						}
					}
					
					
				}
				else{
					$catId = '';
				}
				
				/* fetching posts for category id */
				$args = array (
								'post_type' => 'vsz_responsive_slick',
								'meta_query' => array(
													'relation' => 'AND',
													array(
														'key' => 'postIdsSaved',
														'value' => $catId,
														'compare' => 'LIKE'
													),
													array(
														'key' => 'decide_type_of_id',
														'value' => 'taxonomy'
													)
												)
							);
				
				$result = get_posts($args);
				
				if(!empty($result)){
					foreach($result as $value){
						$bannerPostId = intval($value->ID);
						$postIdsSaved = get_post_meta($bannerPostId,'postIdsSaved',true);
						
						if(!empty($postIdsSaved)){
							$postIdsSaved  = explode(',',$postIdsSaved);
							if(!empty($postIdsSaved) && !in_array($catId,$postIdsSaved)){
								continue;
							}
						}
						$imageLoop = get_post_meta($bannerPostId,'imageDetails',true);
						
						// displaying the images added
						if(!empty($imageLoop)  ){
							$return = $this->displayImageAtFront($imageLoop,$bannerPostId);		//// displaying specific banner
						}
						break;  // to display only 1 banner at a time
						
					}
				}
			}
			///////////////////////////////// case:-  no category
			else{
				$post_type = get_post_type();
				/* fetching posts for post type */
				$args = array (
								'post_type' => 'vsz_responsive_slick',
								'meta_query' => array(
													'relation' => 'AND',
													array(
														'key' => 'is_archieve',
														'value' => $post_type,
													)	
												)
							);
				$result = get_posts($args);
				if(!empty($result)){
					foreach($result as $value){
						$bannerPostId = intval($value->ID);
						$imageLoop = get_post_meta($bannerPostId,'imageDetails',true);
						// displaying the images added
						if(!empty($imageLoop)){
							$return = $this->displayImageAtFront($imageLoop,$bannerPostId);		//// displaying specific banner
						}
						break;  // to display only 1 banner at a time
					}
				}
			}
		}
		///////////////////// case single
		else{
			global $post;
			if(isset($post->ID)){
				$pageID = $post->ID;
			}
			else{
				return;
			}
			//Hide on homepage
			/* 
			if($pageID == $post->ID){
				//
				return;
			} */
			/* fetching posts for post id id */
			$args = array(
						'post_type' => 'vsz_responsive_slick',
						'meta_query' => array(
											'relation' => 'AND',
											array(
												'key' => 'postIdsSaved',
												'value' => $pageID,
												'compare' => 'LIKE'
											),
											array(
												'key' => 'decide_type_of_id',
												'value' => 'post'
											)
										)
						);
			$result = get_posts($args);
			if(!empty($result)){
				foreach($result as $value){
					$bannerPostId = intval($value->ID);
					
					$postIdsSaved = get_post_meta($bannerPostId,'postIdsSaved',true);
							
					if(!empty($postIdsSaved)){
						$postIdsSaved  = explode(',',$postIdsSaved);
						if(!empty($postIdsSaved) && !in_array($pageID,$postIdsSaved)){
							continue;
						}
					}
					
					$imageLoop = get_post_meta($bannerPostId,'imageDetails',true);
					// displaying the images added
					if(!empty($imageLoop)){
						$return = $this->displayImageAtFront($imageLoop,$bannerPostId);		//// displaying specific banner
					}
					break;  // to display only 1 banner at a time
				}
			}
		}
	}	
return $return;		// return the output
	
	