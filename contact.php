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
					<article class="address">
						<h3>Mailing Address:</h3>
						<p>Knights of the RoundTable <br />
							University of Central Florida <br />
							12715 Pegasus Dr. <br />
							Student Union, Room 208 <br />
							Orlando, FL 32816 </p> <br />
						<h3>Directions:</h3>
						<p>KoRT is located on the second floor of the Student Union, inside the Office of Student Involvement, Room 208.</p>
					</article>
					<article class="contact">
						<h3>Phone:</h3>
						<p><a href="tel:407-823-4496">407-823-4496</a></p>
						<h3>Fax:</h3>
						<p><a href="tel:407-823-5899">407-823-5899</a></p>
						<h3>Email:</h3>
						<p><a href="mailto:kort@ucf.edu">kort@ucf.edu</a></p>
						<h3>Social:</h3>
						<div class="socialbuttons">
							<a href="https://twitter.com/UCF_KoRT" class="twitter-follow-button" data-show-count="false">Follow @UCF_KoRT</a>
							<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
							<div class="fb-like-box" data-href="https://www.facebook.com/ucfkort" data-width="200" data-show-faces="false" data-colorscheme="dark" data-stream="false" data-show-border="false" data-header="false"></div>
						</div>
					</article>	
				</section>





				<section class="exec-board">
					<h2>Executive Board</h2>
<?php
					$leaderLoop = new WP_QUERY(array('post_type' => 'exec-board', 'posts_per_page' => -1, 'orderby' =>'meta_value', 'order' => 'ASC', 'meta_key' => 'leader-form-order'));
					while ($leaderLoop->have_posts()) {
						$leaderLoop->the_post();
						$title = get_the_title();
						$content = get_the_content();
						$image = get_the_post_thumbnail($post->ID, 'small');
						$position = get_post_meta($post->ID, 'leader-form-position', true);
						$email = get_post_meta($post->ID, 'leader-form-email', true);
?>	
					<article class="leader">
						<?php echo $image; ?>
						<h3><?php echo $title; ?></h3>
						<p><?php echo $position; ?><p>
						<p><?php echo $content; ?><p>
						<a class="email" href="mailto:<?php echo $email; ?>"><?php echo $email; ?></a>
					</article>
<?php 				}
?>
				</section> 
			
			</div>

<?php get_footer(); ?>


<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>