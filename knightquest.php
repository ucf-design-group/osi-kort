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

				<section class="Office Hours">

					<h2>Office Hours</h2>
					<h3><?php echo $idk; ?></h3>
					<p><?php echo $idk; ?></p>
					<a class="email" href="mailto:<?php echo $email; ?>"><?php echo $email; ?></a>

			</div>


<?php get_footer(); ?>