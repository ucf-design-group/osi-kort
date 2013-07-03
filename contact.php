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
					<h1>Contact Us</h1>
					<h2>Mailing Address:</h2>
					<p>Knights of the RoundTable
						University of Central Florida
						12715 Pegasus Dr.
						Student Union, Room 208
						Orlando, FL 32816 </p>
					<h2>Directions:</h2>
					<p>KoRT is located on the second floor of the Student Union, inside the Office of Student Involvement, Room 208.</p>
					<h2>Phone:</h2>
					<a href="tel:407-823-4496">407-823-4496</a>
					<h2>Fax:</h2>
					<a href="tel:407-823-5899">407-823-5899</a>
					<h2>Email:</h2>
					<a href="mailto:kort@ucf.edu">kort@ucf.edu</a>
					<div>
						<h2>Social:</h2>
						<a class="facebook" href="#">Facebook</a>
						<a class="twitter" href="#">Twitter</a>
					</div>	
				</section>





				<section class="leader-board">
					<h1>Executive Board</h1>
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
						<h2><?php echo $title; ?></h2>
						<p><?php echo $position; ?><p>
						<p><?php echo $content; ?><p>
						<a class="email" href="mailto:<?php echo $email; ?>"><?php echo $email; ?></a>
					</article>
?>
				}

				</section> 
			
			</div>

<?php get_footer(); ?>