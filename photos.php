<?php /* Template Name: Photos */

get_header(); ?>

			<div class="content-area">
				<div class="main"> 
					<?php
					while (have_posts()) {
						the_post();
						get_template_part( 'content', 'page' );
					} ?>
				</div>

				<section class="photos">
						<h2>Photo Albums</h2>
<?php
						$albumloop = new WP_QUERY(array('post_type' => 'fb-albums', 'posts_per_page' => -1, 'orderby' =>'date', 'order' => 'DESC'));
						while ($albumloop->have_posts()) {
							$albumloop->the_post();
							$title = get_the_title();
							$albumid = get_post_meta($post->ID, 'album-form-id', true);
							$albumlink = get_post_meta($post->ID, 'album-form-link', true);
?>	
						<article class="album">
							<h3><?php echo $title; ?></h3>
							<?php echo do_shortcode('[fbphotos id=' . $albumid . ' limit=4 rand=1]'); ?>
							<a href="<?php echo $albumlink; ?>">See More on Facebook</a>
						</article>
<?php 				}
?>
					</section> 
			
			</div>

<?php get_footer(); ?>