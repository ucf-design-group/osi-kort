<?php /* Template Name: KLDP */

get_header(); ?>

			<div class="content-area">
				<div class="main"> 
					<?php
					while (have_posts()) {
						the_post();
						get_template_part( 'content', 'page' );
					} ?>
				</div>

				<section class="kdlp-board">
					<h2>KLDP Board of Directors</h2>

<?php
					$leaderLoop = new WP_QUERY(array('post_type' => 'kldp-board', 'posts_per_page' => -1, 'orderby' =>'meta_value', 'order' => 'ASC', 'meta_key' => 'kldp-form-order'));
					while ($leaderLoop->have_posts()) {
						$leaderLoop->the_post();
						$title = get_the_title();
						$content = get_the_content();
						$image = get_the_post_thumbnail($post->ID, 'small');
						$position = get_post_meta($post->ID, 'kldp-form-position', true);
						$email = get_post_meta($post->ID, 'kldp-form-email', true);
?>	
					<article class="kldp-board">
						<?php echo $image; ?>
						<h3><?php echo $title; ?></h3>
						<p><?php echo $content; ?><p>
						<a class="email" href="mailto:<?php echo $email; ?>"><?php echo $email; ?></a>
					</article>
?>
				}

				</section> 

			</div>


<?php get_footer(); ?>