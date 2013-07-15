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

				<section class="kldp-board">
					

<?php
					$counter = 0;

					$leaderLoop = new WP_QUERY(array('post_type' => 'kldp-board', 'posts_per_page' => -1, 'orderby' =>'meta_value', 'order' => 'ASC', 'meta_key' => 'kldp-form-order'));
					while ($leaderLoop->have_posts()) {
						$leaderLoop->the_post();
						$title = get_the_title();
						$content = get_the_content();
						$image = get_the_post_thumbnail($post->ID, 'small');

						if ($counter==0){
?>
					<h2>Board of Directors</h2>
<?php
						}
?>	
					<article class="kldp-leader">
						<?php echo $image; ?>
						<h3><?php echo $title; ?></h3>
					</article>
<?php
					$counter++;
				}
?>
				</section> 

			</div>


<?php get_footer(); ?>