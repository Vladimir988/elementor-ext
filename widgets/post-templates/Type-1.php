<?php
	ob_start();
	$query = $this->posts_query();
	if ( ! $query->have_posts() ) {
		echo 'Posts Not Found!';
	}
	while ( $query->have_posts() ) {
		$query->the_post();
		/*==============================================================*/
		$date         = get_the_date('d / F / Y');
		$permalink    = get_the_permalink();
		$image_url    = $this->get_image_url();
		$title        = $this->get_posts_title();
		$content      = $this->get_posts_content();
		$category     = $this->get_settings('post_cat');
		$comments     = wp_count_comments(get_the_ID())->total_comments;
		$author       = get_the_author();
		$author_email = get_the_author_meta('email');
		$author_img   = get_avatar_url($author_email, 69);
		$custom_field = get_post_meta(get_the_ID(), 'value', true);
		$columns      = $this->get_classes(array(
			'desk' => $this->get_settings('columns'),
			'tab'  => $this->get_settings('columns_tablet'),
			'mob'  => $this->get_settings('columns_mobile'),
		));
		/*==============================================================*/
		?>
		<div class="custom_posts_item <?php echo $columns; ?>">

			<!-- ---------------------- Template Start ---------------------- -->
			<img src="<?php echo $image_url; ?>" alt="<?php echo $title; ?>">
			<h3><?php echo $title; ?></h3>
			<p><?php echo $content; ?></p>
			<div class="time"><time><?php echo $date; ?></time></div>
			<a class="btn" href="<?php echo $permalink; ?>"><?php _e('Read More', 'elementor-custom-element'); ?></a>
			<!-- ---------------------- Template End ------------------------ -->

		</div>
		<?php
	}
	wp_reset_postdata();
	return ob_get_clean();