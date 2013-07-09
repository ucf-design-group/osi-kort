<?php /* Template Name: Contact */

get_header(); ?>

			<div class="content-area">
				<div class="main"> 
					<?php
					while (have_posts()) {
						the_post();
						get_template_part( 'content', 'page' );
					} ?>
				</div>
				

				<section class="contact">
					<h2>Contact Us</h2>
					<h3>Mailing Address:</h3>
					<p>Knights of the RoundTable
						University of Central Florida
						12715 Pegasus Dr.
						Student Union, Room 208
						Orlando, FL 32816 </p>
					<h3>Directions:</h3>
					<p>KoRT is located on the second floor of the Student Union, inside the Office of Student Involvement, Room 208.</p>
					<h3>Phone:</h3>
					<a href="tel:407-823-4496">407-823-4496</a>
					<h3>Fax:</h3>
					<a href="tel:407-823-5899">407-823-5899</a>
					<h3>Email:</h3>
					<a href="mailto:kort@ucf.edu">kort@ucf.edu</a>
					<div>
						<h3>Social:</h3>
						<a class="facebook" href="#">Facebook</a>
						<a class="twitter" href="#">Twitter</a>
					</div>	
				</section>





				<section class="leader-board">
					<h2>Executive Board</h2>
<?php
					$leaderLoop = new WP_QUERY(array('post_type' => 'leader-board', 'posts_per_page' => -1, 'orderby' =>'meta_value', 'order' => 'ASC', 'meta_key' => 'leader-form-order'));
					while ($leaderLoop->have_posts()) {
						$leaderLoop->the_post();
						$title = get_the_title();
						$content = get_the_content();
						$image = get_the_post_thumbnail($post->ID, 'small');
						$position = get_post_meta($post->ID, 'leader-form-position', true);
						$email = get_post_meta($post->ID, 'leader-form-email', true);
?>	
					<article class="leader-board">
						<?php echo $image; ?>
						<h3><?php echo $title; ?></h3>
						<p><?php echo $position; ?><p>
						<p><?php echo $content; ?><p>
						<a class="email" href="mailto:<?php echo $email; ?>"><?php echo $email; ?></a>
					</article>
				}

				</section> 
			
			</div>

<?php get_footer(); ?>