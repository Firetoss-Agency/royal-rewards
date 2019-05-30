<?php

/**
 * Laravel Mix Manifest tracker
 *
 * @param  string $asset Path to the Mix'd asset
 *
 * @return string        Path to the asset file
 */

function mix($asset)
{
	$manifest = App\config('theme.dir') . '/public/mix-manifest.json';

	if (file_exists($manifest)) {
		$asset_paths = json_decode(file_get_contents($manifest));
		$asset = $asset_paths->{$asset};
	}

	return ltrim($asset, '/');
}


/**
 * Add a class to the <main> element of the current page slug
 *
 * @return string CSS Class
 */

function main_class()
{
	$query = get_queried_object();
	$page_class = 'default';


	if (is_archive()) {
		if (is_category()) {
			$page_class = $query->taxonomy . ' ' . $query->slug;
		} elseif (is_tax()) {
			$page_class = str_replace('_', '-', $query->taxonomy);
		} elseif (is_date()) {
			$page_class = 'date';
		} else {
			$page_class = str_replace('/', '-', $query->rewrite['slug']);
		}
	} elseif (is_single()) {
		$post_type_slug = str_replace('_', '-', $query->post_type);
		$page_class = $post_type_slug . '-single';
	} elseif (is_page()) {
		$template_path = str_replace('.blade.php', '', get_page_template_slug($post->ID));
		$page_class = str_replace('views/page-', '', $template_path);
		if (!$page_class) {
			$page_class = 'default';
		}
	} elseif (is_404()) {
		$page_class = 'four-oh-four';
	} elseif (is_home()) {
		$page_class = 'blog';
	}

	return $page_class;
}


/**
 * Generate a URL to the theme images folder
 *
 * @param string $img Image name and extension e.g. icon.png
 *
 * @return string Image URL
 */

function the_img($img)
{
	return App\asset_path("img/{$img}");
}


/**
 * Add ACF Options page
 */

if (function_exists('acf_add_options_page')) {
	acf_add_options_page([
	  'menu_title' => 'Global Content',
	  'menu_slug'  => 'global-content',
	  'capability' => 'edit_posts',
	  'redirect'   => true,
	  'icon_url'   => 'dashicons-admin-site',
	]);

	acf_add_options_sub_page([
	  'page_title'  => 'Site General Settings',
	  'menu_title'  => 'General',
	  'parent_slug' => 'global-content',
	]);

	acf_add_options_sub_page([
	  'page_title'  => 'Site Header Settings',
	  'menu_title'  => 'Header',
	  'parent_slug' => 'global-content',
	]);

	acf_add_options_sub_page([
	  'page_title'  => 'Site Footer Settings',
	  'menu_title'  => 'Footer',
	  'parent_slug' => 'global-content',
	]);

	acf_add_options_sub_page([
	  'page_title'  => 'Site Analytics Settings',
	  'menu_title'  => 'Analytics',
	  'parent_slug' => 'global-content',
	]);
}


/**
 * Custom excerpt by character length
 */

//function get_excerpt($count){
//    $excerpt = get_the_content();
//    $excerpt = strip_tags($excerpt);
//    $excerpt = substr($excerpt, 0, $count);
//    $excerpt = $excerpt.'...';
//    return $excerpt;
//}


// Redirect users not logged in, to the login page
function redirect_private_content() {
	global $wp_query, $wpdb;
	if ( is_404() ) {
		$current_query = $wpdb->get_row($wp_query->request);
		if( 'private' == $current_query->post_status ) {
			wp_redirect( home_url('/') );
			exit;
		}
	}
}
add_action( 'template_redirect', 'redirect_private_content', 9 );


/**
 * WordPress function for redirecting users on login based on user role
 */

function user_login_redirect( $redirect_to, $request, $user ){
	if( $user && is_object( $user ) && is_a( $user, 'WP_User' ) ) {
		//is there a user to check?
		if (isset($user->roles) && is_array($user->roles)) {
			//check for subscribers
			if (in_array('subscriber', $user->roles)) {
				// redirect them to another URL, in this case, the homepage
				$redirect_to =  home_url('/dashboard');
			}
		}
	}
	return $redirect_to;
}
add_filter( 'login_redirect', 'user_login_redirect', 10, 3 );


// Add Role capabilities
function add_role_caps() {
	// gets the author role
	$role = get_role( 'subscriber' );

	// This only works, because it accesses the class instance.
	// would allow the author to edit others' posts for current role only
	$role->add_cap( 'read_private_posts' );
	$role->add_cap( 'read_private_pages' );
}
add_action( 'admin_init', 'add_role_caps');
