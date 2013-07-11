<?php

function album_meta_setup() {

	add_action('add_meta_boxes','album_meta_add');
	add_action('save_post','album_meta_save');
}
add_action('load-post.php','album_meta_setup');
add_action('load-post-new.php','album_meta_setup');

function album_meta_add() {
 
	add_meta_box (
	'album_meta',
	'Facebook Album ID',
	'album_meta',
	'fb-albums',
	'normal',
	'default');
}

function album_meta() {

	global $post;
	wp_nonce_field(basename( __FILE__ ), 'album-form-nonce' );

	$albumid = get_post_meta($post->ID, 'album-form-id', true) ? get_post_meta($post->ID, 'album-form-id', true) : '';
	$albumlink = get_post_meta($post->ID, 'album-form-link', true) ? get_post_meta($post->ID, 'album-form-link', true) : '';

	?>
	<style type="text/css">#album-form-id{width: 200px;}#album-form-link{width: 400px;}#album-form div{display:block; padding:0 5px;}</style>
	<table id="album-form">
		<tr>
			<th><label for="album-form-id">Facebook Album ID: </label></th>
			<td><input type="text" name="album-form-id" id="album-form-id" value="<?php echo $albumid; ?>" /></td>
		</tr>
		<tr>
			<th><label for="album-form-link">Link to Album: </label></th>
			<td><input type="text" name="album-form-link" id="album-form-link" value="<?php echo $albumlink; ?>" /></td>
		</tr>
	</table>
	<?php
}


function album_meta_save() {

	global $post;
	$post_id = $post->ID;

	if (!isset($_POST['album-form-nonce']) || !wp_verify_nonce($_POST['album-form-nonce'], basename( __FILE__ ))) {
		return $post->ID;
	}

	$post_type = get_post_type_object($post->post_type);

	if (!current_user_can($post_type->cap->edit_post, $post_id)) {
		return $post->ID;
	}

	$input = array();

	$input['id'] = (isset($_POST['album-form-id']) ? $_POST['album-form-id'] : '');
	$input['link'] = (isset($_POST['album-form-link']) ? $_POST['album-form-link'] : '');
	
	foreach ($input as $field => $value) {

		$old = get_post_meta($post_id, 'album-form-' . $field, true);

		if ($value && '' == $old)
			add_post_meta($post_id, 'album-form-' . $field, $value, true );
		else if ($value && $value != $old)
			update_post_meta($post_id, 'album-form-' . $field, $value);
		else if ('' == $value && $old)
			delete_post_meta($post_id, 'album-form-' . $field, $old);
	}
}

?>