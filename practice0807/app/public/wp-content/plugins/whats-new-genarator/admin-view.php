<div class="wrap">
	<div class="icon32" id="icon-options-general">
		<br>
	</div>
	<h2>What's New Generator 設定</h2>
	<h3>ショートコード</h3>
	<p>以下のコードをコピーして、What's Newを表示する固定ページや投稿の本文内に貼り付けてください。</p>
	<p>
		<input type="text" value=<?php echo $shortcode;?> readonly />
	</p>
	<form action="options.php" method="post">
		<?php settings_fields( $option_name ); ?>
		<?php do_settings_sections( $file ); ?>
		<p class="submit">
			<input name="Submit" type="submit" class="button-primary"
				value="<?php esc_attr_e('Save Changes'); ?>" />
		</p>
	</form>
	<h3>プレビュー</h3>
</div>
