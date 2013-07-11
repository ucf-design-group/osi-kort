<?php /* Template Name: KnightQuest */

get_header(); ?>


			<div class="content-area">
				<div class="main"> 
					<?php
					while (have_posts()) {
						the_post();
						get_template_part( 'content', 'page' );
					} ?>
				</div>
			
				<section class ="officehours">
					<h2>Office hours</h2>

<?php
					$hoursloop = new WP_QUERY(array('post_type' => 'kq-hours', 'posts_per_page' => -1, 'orderby' =>'name', 'order' => 'ASC' ));
					while ($hoursloop->have_posts()) {
						$hoursloop->the_post();
						$title = get_the_title();
						$content = get_the_content();
?>	
					<article class="kq-leader">
						<h3><?php echo $title; ?></h3>
						<p><?php echo $content; ?></p>
					</article>
<?php
				}
?>
				</section> 




			</div>

<?php get_footer(); ?>