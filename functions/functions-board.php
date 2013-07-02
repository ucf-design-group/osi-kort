<?php

function leader_meta_setup() {

	add_action('add_meta_boxes','leader_meta_add');
	add_action('save_post','leader_meta_save');
}
add_action('load-post.php','leader_meta_setup');
add_action('load-post-new.php','leader_meta_setup');

function leader_meta_add() {
 
	add_meta_box (
	'leader_meta',
	'Leader Information',
	'leader_meta',
	'exec-board',
	'normal',
	'default');
}

function leader_meta() {

	global $post;
	wp_nonce_field(basename( __FILE__ ), 'leader-form-nonce' );

	$position = get_post_meta($post->ID, 'leader-form-position', true) ? get_post_meta($post->ID, 'leader-form-position', true) : '';
	$email = get_post_meta($post->ID, 'leader-form-email', true) ? get_post_meta($post->ID, 'leader-form-email', true) : '';
	$order = get_post_meta($post->ID, 'leader-form-order', true) ? get_post_meta($post->ID, 'leader-form-order', true) : '';

	?>
	<style type="text/css">#leader-form-position{width: 200px;}#leader-form-email{width: 200px;}#leader-form-order{width: 50px;}#leader-form div{display:inline-block; padding:0 5px;}</style>
	<div id="leader-form">
		<div>
			<label for="leader-form-position">Position:</label>
			<input type="text" name="leader-form-position" id="leader-form-position" value="<?php echo $position; ?>" />
		</div>
		<div>
			<label for="leader-form-email">E-Mail:</label>
			<input type="text" name="leader-form-email" id="leader-form-email" value="<?php echo $email; ?>" />
		</div>
		<div>
			<label for="leader-form-order">Order on Page:</label>
			<input type="text" name="leader-form-order" id="leader-form-order" value="<?php echo $order; ?>" />
		</div>
	</div>
	<?php
}


function leader_meta_save() {

	global $post;
	$post_id = $post->ID;

	if (!isset($_POST['leader-form-nonce']) || !wp_verify_nonce($_POST['leader-form-nonce'], basename( __FILE__ ))) {
		return $post->ID;
	}

	$post_type = get_post_type_object($post->post_type);

	if (!current_user_can($post_type->cap->edit_post, $post_id)) {
		return $post->ID;
	}

	$input = array();

	$input['position'] = (isset($_POST['leader-form-position']) ? $_POST['leader-form-position'] : '');
	$input['email'] = (isset($_POST['leader-form-email']) ? $_POST['leader-form-email'] : '');
	$input['order'] = (isset($_POST['leader-form-order']) ? $_POST['leader-form-order'] : '');

	$input['order'] = str_pad($input['order'], 3, "0", STR_PAD_LEFT);

	foreach ($input as $field => $value) {

		$old = get_post_meta($post_id, 'leader-form-' . $field, true);

		if ($value && '' == $old)
			add_post_meta($post_id, 'leader-form-' . $field, $value, true );
		else if ($value && $value != $old)
			update_post_meta($post_id, 'leader-form-' . $field, $value);
		else if ('' == $value && $old)
			delete_post_meta($post_id, 'leader-form-' . $field, $old);
	}
}

?>