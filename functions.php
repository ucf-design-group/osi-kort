<?php

add_theme_support('post-thumbnails');

/* Remove menus from the admin dashboard */

function remove_menus() {
	$user = wp_get_current_user();
	if ($user->wp_capabilities['administrator'] != 1) {

			remove_submenu_page('index.php', 'update-core.php');
		remove_menu_page('edit.php');
			remove_submenu_page('edit.php', 'post-new.php');
			remove_submenu_page('edit.php', 'edit-tags.php?taxonomy=category');
			remove_submenu_page('edit.php', 'edit-tags.php?taxonomy=post_tag');
		remove_menu_page('upload.php');
			remove_submenu_page('upload.php', 'media-new.php');
		remove_menu_page('link-manager.php');
			remove_submenu_page('link-manager.php', 'link-add.php');
			remove_submenu_page('link-manager.php', 'edit-tags.php?taxonomy=link_category');
		remove_menu_page('edit.php?post_type=page');
			remove_submenu_page('edit.php', 'post-new.php?post_type=page');
		remove_menu_page('edit-comments.php');
		remove_menu_page('themes.php');
			remove_submenu_page('themes.php', 'widgets.php');
			remove_submenu_page('themes.php', 'nav-menus.php');
			remove_submenu_page('themes.php', 'theme-editor.php');
		remove_menu_page('plugins.php');
			remove_submenu_page('plugins.php', 'plugin-install.php');
			remove_submenu_page('plugins.php', 'plugin-editor.php');
		remove_menu_page('users.php');
			remove_submenu_page('users.php', 'user-new.php');
			remove_submenu_page('users.php', 'profile.php');
		remove_menu_page('tools.php');
			remove_submenu_page('tools.php', 'import.php');
			remove_submenu_page('tools.php', 'export.php');
		remove_menu_page('options-general.php');
			remove_submenu_page( 'options-general.php', 'options-writing.php' );
			remove_submenu_page( 'options-general.php', 'options-reading.php' );
			remove_submenu_page( 'options-general.php', 'options-discussion.php' );
			remove_submenu_page( 'options-general.php', 'options-media.php' );
			remove_submenu_page( 'options-general.php', 'options-permalink.php' );
	}
}
add_action('admin_menu', 'remove_menus');


/* Custom Post Types */

function custom_post_types() {

	register_post_type('exec-board', array(
		'labels' => array(
			'name' => 'Executive Board',
			'singular_name' => 'Board Member'),
		'public' => true,
		'hierarchical' => false,
		'supports' => array('title', 'editor', 'thumbnail'),
		'taxonomies' => array(),
		'has_archive' => false
		));

	register_post_type('fb-albums', array(
		'labels' => array(
			'name' => 'FB Albums',
			'singular_name' => 'FB Album'),
		'public' => true,
		'hierarchical' => false,
		'supports' => array('title'),
		'taxonomies' => array(),
		'has_archive' => false
		));

	register_post_type('kldp-board', array(
		'labels' => array(
			'name' => 'KLDP Board',
			'singular_name' => 'KLDP Leader'),
		'public' => true,
		'hierarchical' => false,
		'supports' => array('title', 'editor', 'thumbnail'),
		'taxonomies' => array(),
		'has_archive' => false
		));

	register_post_type('kq-hours', array(
		'labels' => array(
			'name' => 'KQ Hours',
			'singular_name' => 'KQ Time'),
		'public' => true,
		'hierarchical' => false,
		'supports' => array('title', 'editor'),
		'taxonomies' => array(),
		'has_archive' => false
		));
}
add_action('init', 'custom_post_types');


function cpt_icons() {

	?>
	<style type="text/css" media="screen">
		#menu-posts-news .wp-menu-image {
			background: url(<?php echo get_stylesheet_directory_uri(); ?>/resources/news.png) no-repeat 6px -17px !important;
		}
		#menu-posts-news:hover .wp-menu-image, #menu-posts-news.wp-has-current-submenu .wp-menu-image {
			background-position: 6px 7px!important;
		}
	</style>
	<?php
}
add_action('admin_head', 'cpt_icons');


include("functions/functions-albums.php");
include("functions/functions-board.php");
include("functions/functions-kldp.php");
include("functions/functions-nav.php");

?>