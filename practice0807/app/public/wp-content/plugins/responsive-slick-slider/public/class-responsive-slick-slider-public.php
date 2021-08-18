<?php
// Exit if accessed directly
if(!defined( 'ABSPATH' ) ) {
	exit;
}
/**
 * The public-facing functionality of the plugin.
 *
 * @link       #
 * @since      1.0.0
 *
 * @package    responsive-slick-slider
 * @subpackage responsive-slick-slider/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    responsive-slick-slider
 * @subpackage responsive-slick-slider/public
 * @author     vsourz Digital <mehul@vsourz.com>
 */
class responsive_slick_slider_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in responsive-slick-slider_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The responsive-slick-slider_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/responsive-slick-slider-public.css', array(), $this->version, 'all' );
		wp_enqueue_style( 'slick', plugin_dir_url( __FILE__ ) . 'css/slick.css', array(), $this->version, 'all' );
	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in responsive-slick-slider_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The responsive-slick-slider_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/responsive-slick-slider-public.js', array( 'jquery' ), $this->version, false );
		wp_enqueue_script( 'slick', plugin_dir_url( __FILE__ ) . 'js/slick.min.js', array( 'jquery' ), $this->version, false );
		wp_enqueue_script( 'vimeo', plugin_dir_url( __FILE__ ) . 'js/jquery.vimeo.api.js', array(), $this->version, 'all' );
	}
	public function banner_register_shortcodes(){
		
		//Add short code for display ticket related information
		if(!is_admin()){
			add_shortcode( 'vsz_slick_slider', array( $this, 'vsz_banner_display_front' ));
		}
	}
	
	//Display ticket related information 
	public function vsz_banner_display_front($atts, $content, $name){
		return require plugin_dir_path( dirname( __FILE__ ) ) . 'public/partials/vsz_banner_display_front.php';
	}
	//Add custom JS and CSS related links here 
	public function add_js_for_video(){
		?><script src="https://www.youtube.com/iframe_api"></script><?php
	}
	
	/*  Function to get image details and display images  
		Requires 1 parameter which should contain all the  data of images	*/
	function displayImageAtFront($imageLoop,$banner_id = ''){
		//include device detect class file
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/partials/Mobile_Detect.php';
		//Create class object
		$detect = new Bm_Mobile_Detect;
		$return = '';
		//Get total image count 
		$num = count($imageLoop);
		
		if($num>0){
			define('responsive_slick_slider',1);
			$i=1;
			$banner_id = intval($banner_id);
			$postObj = get_post($banner_id);
			if(!empty($postObj) && isset($postObj->post_name)){
				$bannerTitle = $postObj->post_name;
			}
			else{
				$bannerTitle = 'currentpost';
			}
			//Get slider related settings values
			$color=get_post_meta($banner_id,'background_color',true);
			$tcolor=get_post_meta($banner_id,'text_color',true);
			$height = get_post_meta($banner_id,'height',true);
			$width = get_post_meta($banner_id,'width',true);
			$select_width_management = get_post_meta($banner_id,'select_width_management',true);
			$layout=get_post_meta($banner_id,'layout',true);
			$content_width=get_post_meta($banner_id,'content_width',true);
			$opacity=get_post_meta($banner_id,'opacity',true);
			$display_Image=get_post_meta($banner_id,'display_Image',true);
			$ratio=$height/$width;
			$arrow =get_post_meta($banner_id,'select_navigation_arrow',true); 
			if($arrow == '1'){
				$leftarrow = 'arrow-left';
				$rightarrow = 'arrow-right';
				$arrowwidth = '41px';
				$arrowheight = '42px';
					
			}else if($arrow == '2'){
				$leftarrow = 'arrow-left-sm';
				$rightarrow = 'arrow-right-sm';
				$arrowwidth = '27px';
				$arrowheight = '44px';
					
			}
			else if($arrow == '3'){
				$leftarrow = 'arrow-left-3';
				$rightarrow = 'arrow-right-3';
				$arrowwidth = '28px';
				$arrowheight = '22px';
			}
			else if($arrow == '4'){
				$leftarrow = 'arrow-left-4';
				$rightarrow = 'arrow-right-4';
				$arrowwidth = '20px';
				$arrowheight = '20px';
			}
			else{
				$leftarrow = 'arrow-left';
				$rightarrow = 'arrow-right';
				$arrowwidth = '41px';
				$arrowheight = '42px';
			}
			//var_dump($arrow);exit;
			//var_dump($arrow);exit;
			// getting all image
			
			if($select_width_management == 'fixed'){ 
				$return .= '<div class="rss-inner-page-slider-1 '.$bannerTitle.'" style="width:'.intval($width).'px;background:#'.esc_html($color).';">
					<div class="rss-inner-slider-sec '.$layout.'">';
			}
			else{
				$return .= '<div class="rss-inner-page-slider-1 '.$bannerTitle.'" style="background:#'.esc_html($color).';">
					<div class="rss-inner-slider-sec '.$layout.'">';
			}
				
			$return .= '<div class="rss-innerpage-slider-wapp">';
			$youtubeid=1;
			$vimeoid=1;
			//Fetch image related information here
			foreach($imageLoop as $imageDetail){
				$showdiv=0;
				//Check current slide is display front or not
				if($imageDetail['hidden'] != '1'){
					//Check banner type value
					if($imageDetail['banner_type'] == 'image'){
						// getting image url from id
						$imageUrl = wp_get_attachment_image_src($imageDetail['imageId'],true);		
						//Check image URL empty or not
						if(!empty($imageUrl)){
						//Check current slide exist image title and content value
							if(($imageDetail['imageTitle'] != '') || ($imageDetail['imageContent'] != '')){
								$showdiv=1;
							}
							if(isset($imageDetail['buttontext']) && empty($imageDetail['buttontext'])) {
								$imageDetail['buttontext'] = 'Read More';
							}
							//Check current device information is tablet
							if($detect->isTablet()){
								//Get tablet related image URL 
								$imageiUrl = wp_get_attachment_image_src($imageDetail['imageiId'],true);	
								//Check if URL not empty then display image at front side
								if(!empty($imageiUrl)){
									$return .= '<div class="rss-inner-slider-item" style="background:url('.esc_url($imageiUrl[0]).') no-repeat center center; background-size:cover;">';
								}
								else{
									$return .= '<div class="rss-inner-slider-item" style="background:url('.esc_url($imageUrl[0]).') no-repeat center center; background-size:cover;">';
								}
								//Display image related other information here
								if($showdiv == 1){
									$return .= '<div class="rss-banner-layer container"><div class="rss-banner-caption">';
								}
								//Check image title is display front or not
								if(!$imageDetail['image_ititle'] == '1'){
									//If not empty value then display image title
									if($imageDetail['imageTitle'] != ''){
										$return .= '<div class="rss-banner-title">'.nl2br($imageDetail['imageTitle']).'</div>';	
									}
								}
								//Check image content is display front or not
								if(!$imageDetail['imagei_content'] == '1'){
									//If not empty value then display image content
									if($imageDetail['imageContent'] != ''){
										$return .= '<div class="rss-banner-description">'.do_shortcode(nl2br($imageDetail['imageContent'])).'</div>';	
									}
								}
								//check image URL value is empty or not and display at front side or not
								if($imageDetail['imageUrl'] != '' && $showdiv == 1){
									//link open in new tab or current tab setting here
									if($imageDetail['url'] != 0){
											$return .= '<div class="rss-banner-url"><a href='.esc_url($imageDetail['imageUrl']).'>'.$imageDetail['buttontext'].'</a></div>';	
										}
										else{
											$return .= '<div class="rss-banner-url"><a href='.esc_url($imageDetail['imageUrl']).' target="_blank">'.$imageDetail['buttontext'].'</a></div>';	
										}
								}
								//Close detail section div here
								if($showdiv == 1){
									$return .= '</div></div>';
								}
								$return .= '</div>';
							}//Close If tablet div 
							//Check current device information is mobile or not
							else if($detect->isMobile()){
								//Get mobile device related image URL
								$imagemUrl = wp_get_attachment_image_src($imageDetail['imagemId'],true);	
								if(!empty($imagemUrl)){
									$return .= '<div class="rss-inner-slider-item" style="background:url('.esc_url($imagemUrl[0]).') no-repeat center center; background-size:cover;">';
								}
								else{
									$return .= '<div class="rss-inner-slider-item" style="background:url('.esc_url($imageUrl[0]).') no-repeat center center; background-size:cover;">';
								}
								if($showdiv == 1){
									$return .= '<div class="rss-banner-layer container"><div class="rss-banner-caption">';
								}
								if(!$imageDetail['image_mtitle'] == '1'){
									if($imageDetail['imageTitle'] != ''){
											$return .= '<div class="rss-banner-title">'.nl2br($imageDetail['imageTitle']).'</div>';	
									}
								}
								if(!$imageDetail['imagem_content'] == '1'){
									if($imageDetail['imageContent'] != ''){
										$return .= '<div class="rss-banner-description">'.do_shortcode(nl2br($imageDetail['imageContent'])).'</div>';	
									}
								}
								if($showdiv == 1 && $imageDetail['imageUrl'] != ''){
									if($imageDetail['url'] != 0){
											$return .= '<div class="rss-banner-url"><a href='.esc_url($imageDetail['imageUrl']).'>'.$imageDetail['buttontext'].'</a></div>';	
										}
										else{
											$return .= '<div class="rss-banner-url"><a href='.esc_url($imageDetail['imageUrl']).' target="_blank">'.$imageDetail['buttontext'].'</a></div>';	
										}
								}		
								if($showdiv == 1){
									$return .= '</div></div>';
								}
								$return .= '</div>';
							}//Close mobile device if
							//All other device related code here 
							else{
								if($display_Image == 'bgimage'){
									$return .= '<div class="rss-inner-slider-item" style="background:url('.esc_url($imageUrl[0]).') no-repeat center center; background-size:cover;">';
								}
								else{
									$return .= '<div class="rss-inner-slider-item" style="background:url('.esc_url($imageUrl[0]).') no-repeat center center; background-size:cover;">';
					
								}
								if($showdiv == 1){
									$return .= '<div class="rss-banner-layer container"><div class="rss-banner-caption">';
								}
								if($imageDetail['imageTitle'] != ''){
									$return .= '<div class="rss-banner-title">'.nl2br($imageDetail['imageTitle']).'</div>';	
								}
								if($imageDetail['imageContent'] != ''){
									$return .= '<div class="rss-banner-description">'.do_shortcode(nl2br($imageDetail['imageContent'])).'</div>';	
								}
							
								if($showdiv == 1 ){
									if($imageDetail['imageUrl'] != ''){
											
										if($imageDetail['url'] != 0){
											$return .= '<div class="rss-banner-url"><a href='.esc_url($imageDetail['imageUrl']).'>'.$imageDetail['buttontext'].'</a></div>';	
										}
										else{
											$return .= '<div class="rss-banner-url"><a href='.esc_url($imageDetail['imageUrl']).' target="_blank">'.$imageDetail['buttontext'].'</a></div>';	
										}
									}				
									$return .= '</div></div>';
								}
								$return .= '</div>';
							}//Close else
									
						}//Close if for check image URL 
					}//Close if for check banner type is image or not
					//Check banner type is video or not
					else if($imageDetail['banner_type'] == 'video'){
						
						$return .='<div class="rss-inner-slider-item video-html5 " data-time="9000"><video src="'.esc_url($imageDetail['videoid']).'" width="100%"  height="100%" id="vd" class="rss-html5-video" controls></video>';
						$return .='</div>';	
					}
					//Check banner type is you tube video or not and video value exist or not
					else if(($imageDetail['banner_type'] == 'youtube') && ($imageDetail['videoyoutubeid'] != '')){
						$return .='<div class="rss-inner-slider-item youtube"><div videourl="players'.$youtubeid.'" class="rss-youtubevideo" src="'.esc_url($imageDetail['videoyoutubeid']).'?enablejsapi=1" height="100%"></div>';	
						$return .='<div id="players'.$youtubeid.'"></div></div>';	
						$youtubeid=$youtubeid+1;
					}
					//Check banner type is vimeo video or not and value exist or not
					else if(($imageDetail['banner_type'] == 'vimeo') && ($imageDetail['videovimeoid'] != '')){
								
						$vimeo_video_url = $imageDetail['videovimeoid'];
						//Check vimeo URL is valid URL or not. If not then change in URL
						$update_url = preg_replace_callback('#https://vimeo.com/\d*#', 
															function($vimeo_video_url){
																return convertVimeo($vimeo_video_url);
															},$vimeo_video_url);
						$return .='<div class="rss-inner-slider-item vimeo "> 
							<iframe id="vimeo'.$vimeoid.'" class="rss-vimeovideo" width="100%" height="100%" src="'.esc_url($update_url).'" frameborder="0" ></iframe>
						</div>'; 
						$vimeoid=$vimeoid+1;
					}
				}//Close if for check slider is display at front side or not
			}//Close for each for loop
			$return .= '</div></div>';
			$return .= '</div>';
		
			///// getting setting options for slider
			$metaArray = array("slider_speed","select_pagination","select_navigation","select_pauseonhover","select_fade","select_autoplay","autoplay_speed","centermode","centerpadding","video_autoplay");
			foreach($metaArray as $meta){
				$$meta = get_post_meta($banner_id,$meta,true);
			}
			
			$hex = "#".$color;
			list($r, $g, $b) = sscanf($hex, "#%02x%02x%02x");
			ob_start();
			?><style>
				.rss-inner-page-slider-1 .slickprev {
					background:url('<?php echo plugin_dir_url( dirname( __FILE__ ) )?>public/images/<?php echo $leftarrow;?>.png');
					background-size:cover;
					width:<?php echo $arrowwidth;?>;
					height:<?php echo $arrowheight;?>;
				}
				.rss-inner-page-slider-1 .slicknext {
					background:url('<?php echo plugin_dir_url( dirname( __FILE__ ) )?>public/images/<?php echo $rightarrow;?>.png');
					background-size:cover;
					width:<?php echo $arrowwidth;?>;
					height:<?php echo $arrowheight;?>;
				}
				.rss-banner-caption{
				  max-width:<?php echo  intval($content_width);?>px;
				  background:rgba(<?php echo "$r,$g,$b,$opacity";?>);
				  color:#<?php echo esc_html($tcolor);?>;
				}
				video {
					background:#000000;
				}
				.width100{
					width:100%;
				}
			</style>
			<script type="text/javascript">
				jQuery(document).ready(function($) {
					var slick_vd=jQuery('.rss-inner-page-slider-1 .rss-innerpage-slider-wapp').slick({
						centerMode:<?php echo $centermode;?>,
						centerPadding:'<?php echo intval($centerpadding);?>px',
						dots: <?php if($select_pagination == 0){ echo 'false'; } else{ echo 'true'; } ?>,
						arrows: <?php if($select_navigation == 0){ echo 'false'; } else{ echo 'true'; } ?>,
						infinite: true,
						<?php if($centermode == 'false') { ?>
						fade: <?php if($select_fade == 0){ echo 'false'; } else{ echo 'true'; }?>,
						<?php } ?>
						autoplay:<?php if($select_autoplay == 0){ echo 'false'; } else{ echo 'true'; } ?>,
						autoplaySpeed:<?php if(!empty($autoplay_speed)){ echo $autoplay_speed; } ?>,
						speed: <?php if(!empty($slider_speed)){ echo $slider_speed; } ?>,
						pauseOnHover: <?php if($select_pauseonhover == 1){ echo 'true'; } else{ echo 'false'; } ?>,
						// pauseOnDotsHover: <?php if($select_pauseonhover == 1){ echo 'true'; } else{ echo 'false'; } ?>,
						// pauseOnFocus: <?php if($select_pauseonhover == 1){ echo 'true'; } else{ echo 'false'; } ?>,
						slidesToShow: 1,
						slidesToScroll: 1,
						accessibility:true, 
						prevArrow: '<span class="slickprev "></span>',
						nextArrow: '<span class="slicknext "></span>'
					});
			
					jQuery('.rss-inner-page-slider-1 .slick-slider .slick-track, .rss-inner-page-slider-1 .slick-slider .slick-list,.rss-inner-page-slider-1 .slick-slider .slick-slide,.rss-inner-banner-left-section').height(<?php echo intval($height); ?>);
			
			
					var windowwidth=jQuery(window).width();
			
					if(windowwidth >  <?php echo intval($width); ?>){
					<?php if($select_width_management == 'fixed') { ?>
						jQuery('.rss-inner-page-slider-1').width(<?php echo intval($width); ?>);
					<?php } ?> 
					}
					else{
					jQuery('.rss-inner-page-slider-1').width('100%');
					}
			
					<?php  if($display_Image == 'image'){ ?>
						var windowwidth=jQuery(window).width();
						if(windowwidth >  <?php echo intval($width); ?>){
							jQuery('.rss-inner-page-slider-1 .slick-slider .slick-track, .rss-inner-page-slider-1 .slick-slider .slick-list,.rss-inner-page-slider-1 .slick-slider .slick-slide,.rss-inner-banner-left-section').height(<?php echo intval($height); ?>);
						}
						else{
							var height= windowwidth * <?php echo $ratio;?>;
							jQuery('.rss-inner-page-slider-1 .slick-slider .slick-track, .rss-inner-page-slider-1 .slick-slider .slick-list,.rss-inner-page-slider-1 .slick-slider .slick-slide,.rss-inner-banner-left-section,.rss-inner-page-slider-1').height(height);
						}
					<?php } ?> 
		
					 jQuery('.rss-html5-video').on('ended',function () {
						<?php if($select_autoplay == 1){?>
						slick_vd.slick('slickPlay');
						slick_vd.slick("slickNext");
						 <?php } ?>
					 });
					 jQuery('.rss-html5-video').on('playing',function () {
						slick_vd.slick('slickPause');
					 });
					var current_slid=jQuery('.slick-current');
					var html_video=current_slid.find('video')[0];
					if(html_video)
					{
						<?php if($video_autoplay == 1) { ?>
						html_video.play();
						//console.log(current_slid.find('video')[0].play());
						<?php } ?>
					}
					var currentSlide, slideType, player, command;
					currentSlide = jQuery('.slick-current');
					slideType = currentSlide.attr("class").split(" ")[1];
					player = currentSlide.find("iframe").get(0);
					setTimeout(function() {
						if (slideType == "youtube") {
						console.log("hiii");
							<?php if($video_autoplay == 1) { ?>
								command = {
								  "event": "command",
								  "func": "playVideo"
								};
							<?php } ?>
						var ID = '';
						var url=jQuery('.slick-current .rss-youtubevideo').attr('src');
						var heights=jQuery('.slick-current .rss-youtubevideo').attr('height');
						url = url.replace(/(>|<)/gi, '').split(/(vi\/|v=|\/v\/|youtu\.be\/|\/embed\/)/);
						if (url[2] !== undefined) {
							 ID = url[2].split(/[^0-9a-z_\-]/i);
							 ID = ID[0];
							} 
						else 
						{
							ID = url;
						}
						var players;
						var data=jQuery('.slick-current .rss-youtubevideo').attr('videourl');
						onYouTubePlayerAPIReady(data,ID,heights);
						function onYouTubePlayerAPIReady(data,ID,heights) {
							players = new YT.Player(data, {
							  height: heights,
							  width: '100%',
							  videoId: ID,
							  events: {
								onReady: onPlayerReady,
								onStateChange: onPlayerStateChange
							  }
							});
						}
						function onPlayerReady(event) {
							console.log("hellooooo");
							<?php if($video_autoplay == 1) { ?>
							slick_vd.slick('slickPause');
							event.target.playVideo();
							<?php } ?>		
						}
						function onPlayerStateChange(event) {
							if(event.data === 1) {
								
								slick_vd.slick('slickPause');
							}
							if(event.data === 0) {          
							  <?php if($select_autoplay == 1){?>
								slick_vd.slick('slickPlay');
								slick_vd.slick("slickNext");
							<?php } ?>
							}
						}
					}
					if (slideType == "vimeo") {
						//alert("hii");
						<?php if($video_autoplay == 1) { ?>
						command = {
									"method": "play",
									"value": "true"
								};
						jQuery(".slick-current iframe").vimeo("play");
						<?php } ?>
						jQuery(".slick-current iframe").on("finish", function(e){
							<?php if($select_autoplay == 1){?>
								slick_vd.slick('slickPlay');
								slick_vd.slick("slickNext");
						<?php } ?>
						});
						jQuery(".slick-current iframe").on("play", function(e){
								 slick_vd.slick('slickPause');
							  });
					}
				}, 3000);
			
				if (player != undefined) {
					//post our command to the iframe.
					player.contentWindow.postMessage(JSON.stringify(command), "*");
				}
			
		 
				jQuery('.rss-inner-page-slider-1 .rss-innerpage-slider-wapp').on('afterChange', function(event, slick, currentSlide, nextSlide){
					<?php if($select_autoplay == 1){?>
					slick_vd.slick('slickPlay');
					<?php } ?>
					var current_slid=jQuery(slick.$slides.get(currentSlide));
					var html_video=current_slid.find('video')[0];
					if(html_video)
					{
						<?php if($video_autoplay == 1) { ?>
						slick_vd.slick('slickPause');
						html_video.play();
						//console.log(current_slid.find('video')[0].play());
						<?php } ?>
					}
					var currentSlide, slideType, player, command;
					currentSlide = $(slick.$slider).find(".slick-current");
					slideType = currentSlide.attr("class").split(" ")[1];
					player = currentSlide.find("iframe").get(0);
					if (slideType == "youtube") {
							console.log("628");
						<?php if($video_autoplay == 1) { ?>
							slick_vd.slick('slickPause');
							 command = {
							  "event": "command",
							  "func": "playVideo"
							}; 
						<?php } ?>	
						var ID = '';
						var url=jQuery('.slick-current .rss-youtubevideo').attr('src');
						var heights=jQuery('.slick-current .rss-youtubevideo').attr('height');
						url = url.replace(/(>|<)/gi, '').split(/(vi\/|v=|\/v\/|youtu\.be\/|\/embed\/)/);
						if (url[2] !== undefined) {
							 ID = url[2].split(/[^0-9a-z_\-]/i);
							 ID = ID[0];
							} 
						else 
						{
							ID = url;
						}
						var players;
						var data=jQuery('.slick-current .rss-youtubevideo').attr('videourl');
						onYouTubePlayerAPIReady(data,ID,heights);
						function onYouTubePlayerAPIReady(data,ID,heights) {
							players = new YT.Player(data, {
							  height: heights,
							  width: '100%',
							  videoId: ID,
							  events: {
								onReady: onPlayerReady,
								onStateChange: onPlayerStateChange
							  }
							});
						}
						function onPlayerReady(event) {
							
							<?php if($video_autoplay == 1) { ?>
							slick_vd.slick('slickPause');
							currentSlide = $(slick.$slider).find(".slick-current");
							slideType = currentSlide.attr("class").split(" ")[1];
							if (slideType == "youtube") {
								event.target.playVideo();
							}	
							<?php } ?>		
						}
						function onPlayerStateChange(event) {
							if(event.data === 1) {
								
								slick_vd.slick('slickPause');
							}
							if(event.data === 0) {          
							  <?php if($select_autoplay == 1){?>
								slick_vd.slick('slickPlay');
								slick_vd.slick("slickNext");
							<?php } ?>
							}
						}
					}
					if (slideType == "vimeo") {
						<?php if($video_autoplay == 1) { ?>
						command = {
									"method": "play",
									"value": "true"
								};
						<?php } ?>			
						jQuery(".slick-current iframe").on("finish", function(e){
							 <?php if($select_autoplay == 1){?>
							 slick_vd.slick("slickNext");
							 <?php } ?>		
						});
						jQuery(".slick-current iframe").on("play", function(e){
								 slick_vd.slick('slickPause');
							  });
					}
					if (player != undefined) {
					//post our command to the iframe.
						player.contentWindow.postMessage(JSON.stringify(command), "*");
					}
				});

				jQuery('.rss-inner-page-slider-1 .rss-innerpage-slider-wapp').on('beforeChange', function(event, slick, currentSlide, nextSlide){
			
					var current_slid=$(slick.$slides.get(currentSlide));
					var html_video=current_slid.find('video')[0];
					if(html_video)
					{
						setTimeout(function (){html_video.pause();},500);	
					}
					var currentSlide, slideType, player, command;
					currentSlide = $(slick.$slider).find(".slick-current");
					 slideType = currentSlide.attr("class").split(" ")[1];
					 player = currentSlide.find("iframe").get(0);
					
					if (slideType == "youtube") {
						//alert(222);
							console.log("628");
						command = {
						  "event": "command",
						  "func": "pauseVideo"
						};
					}
					else{
						command = {
						  "method": "pause",
						  "value": "true"
						};
					}
					if (player != undefined) {
						//post our command to the iframe.
						player.contentWindow.postMessage(JSON.stringify(command), "*");
					}
				});
		
				//jQuery('.rss-inner-slider-item').fitVids();
			});//Close for ready
		
			function banner_height(){
				var header_height=jQuery('#header').outerHeight();
				var top_height=jQuery('#top-menu-container').outerHeight();
				var win_height = jQuery(window).height()-header_height-top_height;
				//win_height = jQuery(window).height()-jQuery('#header').height();
				//jQuery('.homepage-slider-01 .homepage-slider-item').css('height',win_height+'px');
			}

			banner_height();
			jQuery(window).resize(function(e) {
				banner_height();
				
				var windowwidth=jQuery(window).width();
				//alert(windowwidth);
				if(windowwidth >  <?php echo intval($width); ?>){
					<?php if($select_width_management == 'fixed') { ?>
						jQuery('.rss-inner-page-slider-1').width(<?php echo intval($width); ?>);
					<?php } ?> 
				}
				else{
					jQuery('.rss-inner-page-slider-1').width('100%');
				}
			
				<?php  if($display_Image == 'image'){ ?>
					var windowwidth=jQuery(window).width();
					if(windowwidth >  <?php echo intval($width); ?>){
						jQuery('.rss-inner-page-slider-1 .slick-slider .slick-track, .rss-inner-page-slider-1 .slick-slider .slick-list, .rss-inner-page-slider-1 .slick-slider .slick-slide, .rss-inner-banner-left-section,.rss-inner-page-slider-1').height(<?php echo intval($height); ?>);
					}
					else{
						var height= windowwidth * <?php echo $ratio;?>;
						jQuery('.rss-inner-page-slider-1 .slick-slider .slick-track, .rss-inner-page-slider-1 .slick-slider .slick-list, .rss-inner-page-slider-1 .slick-slider .slick-slide,.rss-inner-banner-left-section,.rss-inner-page-slider-1').height(height);
					}
				<?php } ?> 
			});
		</script><?php
		$slider_content = ob_get_contents();
		ob_end_clean();
		$return .= $slider_content;
		}////Close if for number of images
		return $return;
	}//Close image function
}//Close for class


//Customize vimeo video URL 
function convertVimeo($url){
	
	$url = esc_url($url[0]);
	
	########################################################
	//extract the ID
	if(preg_match('/\/\/(www\.)?vimeo.com\/(\d+)($|\/)/',$url,$matches)){
		//the ID of the Vimeo URL: 71673549 
		$id = $matches[2];  
		//echo the embed code and wrap it in a class
		return 'http://player.vimeo.com/video/'.$id;
	}
}
