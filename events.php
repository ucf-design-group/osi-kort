<?php /* Template Name: Events */

get_header(); ?>

			<div class="content-area">
				<div class="main"> 
					<?php
					while (have_posts()) {
						the_post();
						get_template_part( 'content', 'page' );
					} ?>
				</div>

				<section class="events">
					<h2>Upcoming Events</h2>

<?php
					$eventLoop = new WP_QUERY(array('post_type' => 'osi-events', 'posts_per_page' => -1, 'orderby' =>'meta_value', 'order' => 'ASC', 'meta_key' => 'oe-form-start', 'meta_value' => time(), 'meta_compare' => '>='));
					while ($eventLoop->have_posts()) {
						$eventLoop->the_post();
						$title = get_the_title();
						$start = get_post_meta($post->ID, 'oe-form-start', true);
						$end = get_post_meta($post->ID, 'oe-form-end', true);
						$content = get_the_content();
						$link = get_post_meta($post->ID, 'oe-form-url', true);

						if ($end == "none")
							$dates = date('l F jS, g:ia', $start);
						else if (date('F j', $start) == date('F j', $end))
							$dates = date('l F jS, g:ia', $start) . " - " . date('g:ia', $end);
						else
							$dates = date('F jS, g:ia', $start) . " to " . date('F jS, g:ia', $end);
?>	
					<article class="event">
						<h3><?php echo $title; ?></h3>
						<h4><?php echo $dates; ?></h4>
						<?php echo $content; ?>
<?php
						if ($link != "") {
?>
						<a href="<?php echo $link; ?>">View flyer</a>
<?php
						}
?>
					</article>
<?php
				}
?>

				</section> 

			</div>


<?php get_footer(); ?>