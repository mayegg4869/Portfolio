<?php
// Exit if accessed directly
if(!defined( 'ABSPATH' ) ) {
	exit;
}
?><style>
.contentdata{
	font-size:14px;
}
.pagedetail{
	background-color:rgba(0,0,0,0.07);
	font-size:14px; 
	padding:5px 10px; 
}
</style>
<div class="wrap">
	<h2>
		Designer Support
	</h2>
</div>
<div class="wrap contentdata">
	
	<h3>How to display banner at front? </h3>
	
	<span>
		There are main two way to display banner at front which given below.
	</span>
	<ol>
		<li>
			<h3> Use Short-code directly </h3>
			<span>
				=> You can get Banner which you make by just copy it short code and paste it in your archive page.
			</span>
			<p class="pagedetail">
				- In your published banner list you will get short code define in table column for short code like this<br>
				  <b style="margin-left:15px;">[vsz_slick_slider]</b>.<br>
				- Copy this short code and paste in the archive file before while loop in current theme folder with 
				  in function like this<br>
				  <b style="margin-left:15px;"> <?php echo htmlentities("<?php echo do_shortcode('[vsz_slick_slider]');?>")?></b>.<br>
				- If you create custom archive file than paste in that file before while loop in current theme folder
				  with in function like this 
				  <b style="margin-left:15px;"> <?php echo htmlentities("<?php echo do_shortcode('[vsz_slick_slider]');?>")?></b>.<br>
				- Save File.<br>
				- Its display specific post type related banner display.
			</p>
		</li>
		<li>
			<h3> Use Short-code directly with Id </h3>
			<span>
				=> You can get Banner which you make by just copy it short code and paste it in your archive page.
			</span>
			<p class='pagedetail'>
				- In your published banner list you will get short code define in table column for short code like this<br>
				  <b style="margin-left:15px;">[vsz_slick_slider id = " Id for specific post type "]</b>.<br>
				- Copy this short code and paste in the archive file before while loop in current theme folder with 
				  in function like this<br> 
                  <b style="margin-left:15px;"> <?php echo htmlentities("<?php echo do_shortcode('[vsz_slick_slider id ='specific post type Id']');?>")?></b>.<br>
				- If you create custom archive file than paste in that file before while loop in current theme folder
				  with in function like this <br>
				  <b style="margin-left:15px;"> <?php echo htmlentities("<?php echo do_shortcode('[vsz_slick_slider id ='specific post type Id']');?>")?></b>.<br>
				- Save File.<br>
				- Its display specific post type id related banner display.
			</p>
		</li>
	</ol>
</div>