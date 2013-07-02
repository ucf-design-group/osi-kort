<?php

function kldp_meta_setup() {

	add_action('add_meta_boxes','kldp_meta_add');
	add_action('save_post','kldp_meta_save');
}
add_action('load-post.php','kldp_meta_setup');
add_action('load-post-new.php','kldp_meta_setup');

function kldp_meta_add() {

	add_meta_box (
	'kldp_meta',
	'Leader Information',
	'kldp_meta',
	'kldp-board',
	'normal',
	'default');
}

function kldp_meta() {

	global $post;
	wp_nonce_field(basename( __FILE__ ), 'kldp-form-nonce' );

	$position = get_post_meta($post->ID, 'kldp-form-position', true) ? get_post_meta($post->ID, 'kldp-form-position', true) : '';
	$email = get_post_meta($post->ID, 'kldp-form-email', true) ? get_post_meta($post->ID, 'kldp-form-email', true) : '';
	$order = get_post_meta($post->ID, 'kldp-form-order', true) ? get_post_meta($post->ID, 'kldp-form-order', true) : '';

	?>
	<style type="text/css">#kldp-form-position{width: 200px;}#kldp-form-email{width: 200px;}#kldp-form-order{width: 50px;}#kldp-form div{display:inline-block; padding:0 5px;}</style>
	<div id="kldp-form">
		<div>
			<label for="kldp-form-position">Position:</label>
			<input type="text" name="kldp-form-position" id="kldp-form-position" value="<?php echo $position; ?>" />
		</div>
		<div>
			<label for="kldp-form-email">E-Mail:</label>
			<input type="text" name="kldp-form-email" id="kldp-form-email" value="<?php echo $email; ?>" />
		</div>
		<div>
			<label for="kldp-form-order">Order on Page:</label>
			<input type="text" name="kldp-form-order" id="kldp-form-order" value="<?php echo $order; ?>" />
		</div>
	</div>
	<?php
}


function kldp_meta_save() {

	global $post;
	$post_id = $post->ID;

	if (!isset($_POST['kldp-form-nonce']) || !wp_verify_nonce($_POST['kldp-form-nonce'], basename( __FILE__ ))) {
		return $post->ID;
	}

	$post_type = get_post_type_object($post->post_type);

	if (!current_user_can($post_type->cap->edit_post, $post_id)) {
		return $post->ID;
	}

	$input = array();

	$input['position'] = (isset($_POST['kldp-form-position']) ? $_POST['kldp-form-position'] : '');
	$input['email'] = (isset($_POST['kldp-form-email']) ? $_POST['kldp-form-email'] : '');
	$input['order'] = (isset($_POST['kldp-form-order']) ? $_POST['kldp-form-order'] : '');

	$input['order'] = str_pad($input['order'], 3, "0", STR_PAD_LEFT);

	foreach ($input as $field => $value) {

		$old = get_post_meta($post_id, 'kldp-form-' . $field, true);

		if ($value && '' == $old)
			add_post_meta($post_id, 'kldp-form-' . $field, $value, true );
		else if ($value && $value != $old)
			update_post_meta($post_id, 'kldp-form-' . $field, $value);
		else if ('' == $value && $old)
			delete_post_meta($post_id, 'kldp-form-' . $field, $old);
	}
}

?>