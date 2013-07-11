<?php /* Template Name: Home */

get_header(); ?>

			<div class="content-area">
				<div class="main"> 
					<?php
					while (have_posts()) {
						the_post();
						get_template_part( 'content', 'home' );
					} ?>
				</div>

				<section class="mini-nav">
					<article class="events">
						<a class="icon" href="<?php echo site_url('/events'); ?>">Events</a>
<?php
						$eventLoop = new WP_QUERY(array('post_type' => 'osi-events', 'posts_per_page' => 1, 'orderby' =>'meta_value', 'order' => 'ASC', 'meta_key' => 'oe-form-start', 'meta_value' => time(), 'meta_compare' => '>='));
						if ($eventLoop->have_posts()) {
							$eventLoop->the_post();
							$title = get_the_title();
?>
						<p><?php echo $title; ?></p>
<?php 
						}
						else {
?>
						<p>There are currently no events scheduled</p>
<?php
						}
?>
					</article>
					<article class="kldp">
						<a class="icon" href="<?php echo site_url('/kldp'); ?>">Knight Quest</a>
						<p>Learn about KoRT’s Leadership Development Program, a unique opportunity for UCF’s student leaders!</p>
					</article>
					<article class="knight-quest">
						<a class="icon" href="<?php echo site_url('/knightquest'); ?>">KLDP</a>
						<p>Interested in getting involved on campus? KnightQuest can help you start your quest for success!</p>					
					</article>
					<article class="rso">
						<a class="icon" href="http://ucf.collegiatelink.net/organization/kort">RSO Database</a>
						<p>There are over 500 registered student organizations at UCF. All of them are listed in this searchable database!</p>
					</article>
				</section>
			</div>

<?php get_footer(); ?>