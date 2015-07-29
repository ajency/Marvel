<?php global $post; ?>
<li <?php job_listing_class(); ?> data-longitude="<?php echo esc_attr( $post->geolocation_lat ); ?>" data-latitude="<?php echo esc_attr( $post->geolocation_long ); ?>">

		<?php the_company_logo(); ?>
		<div class="position row">
			<h3 class="vc_col-sm-2 wpb_column vc_column_container job-name"><?php the_title();?></h3>
		  <div class="job-description vc_col-sm-8 wpb_column vc_column_container"><div class="wpb_wrapper"><p><?php echo $post->post_content;?></p></div></div>
			<a href="#" class="wpb_button_a vc_col-sm-2 wpb_column vc_column_container popmake-careers-apply-now">
				<span class="wpb_button wpb_btn-inverse wpb_regularsize">Apply Now</span>
			</a>
			<div class="company">
				<?php the_company_name( '<strong>', '</strong> ' ); ?>
				<?php the_company_tagline( '<span class="tagline">', '</span>' ); ?>
			</div>
		</div>
		<div class="location">
			<?php the_job_location( false ); ?>
		</div>
		<!--<ul class="meta">
			<?php do_action( 'job_listing_meta_start' ); ?>

			<li class="job-type <?php echo get_the_job_type() ? sanitize_title( get_the_job_type()->slug ) : ''; ?>"><?php the_job_type(); ?></li>
			<li class="date"><date><?php printf( __( '%s ago', 'wp-job-manager' ), human_time_diff( get_post_time( 'U' ), current_time( 'timestamp' ) ) ); ?></date></li>-->

			<?php do_action( 'job_listing_meta_end' ); ?>
		</ul>

</li>