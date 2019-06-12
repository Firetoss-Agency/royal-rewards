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

function get_details_excerpt($count){
    $excerpt = get_field('details');
    $excerpt = strip_tags($excerpt);
    $excerpt = substr($excerpt, 0, $count);
    $excerpt = $excerpt.'...';
    return $excerpt;
}


/*
 * Template Redirects
 */

function redirect_templates() {

	// Redirect users not logged in, to the login page
	if(!is_user_logged_in() && !is_page('login')) {
		wp_redirect( home_url('/') );
		exit;
	}

	// User is logged in
	if (is_user_logged_in()) {

		// If user is a tenant or resident
		if (in_array('tenant', wp_get_current_user()->roles) || in_array('resident', wp_get_current_user()->roles)) {

			// If template trying to hit is settings or favorites
			if (is_page('settings') || is_page('favorites')) {

				// Redirect to the Dashboard
				wp_redirect( home_url('/dashboard') );
				exit;
			}
		}

		// If a logged in user tries to hit the login page
		if (is_page('login')) {

			// Redirect to the Dashboard
			wp_redirect( home_url('/dashboard') );
			exit;
		}
	}
}
add_action('template_redirect', 'redirect_templates', 9);

/*
 * Redirect on logout
 */

function auto_redirect_after_logout(){
	wp_redirect( home_url() );
	exit;
}
add_action('wp_logout','auto_redirect_after_logout');

/**
 * WordPress function for redirecting users on login based on user role
 */

function user_login_redirect( $redirect_to, $request, $user ){
	if( $user && is_object( $user ) && is_a( $user, 'WP_User' ) ) {
		//is there a user to check?
		if (isset($user->roles) && is_array($user->roles)) {
			// check for Admin
			if (in_array('administrator', $user->roles)) {
				$redirect_to =  home_url('/wp-admin');
			}

			// check for Employee, Tenant or Resident
			if (in_array('employee', $user->roles) || in_array('tenant', $user->roles) || in_array('resident', $user->roles)) {
				$redirect_to =  home_url('/dashboard');
			}
		}
	}
	return $redirect_to;
}
add_filter( 'login_redirect', 'user_login_redirect', 10, 3 );


/*
 * ROLES
 */

// Add Roles
add_role('employee', __('Employee'), [
  'read'         => true,
  'edit_posts'   => true,
  'delete_posts' => true
]);

add_role('tenant', __('Tenant'), [
  'read'         => true,
  'edit_posts'   => true,
  'delete_posts' => true
]);

add_role('resident', __('Resident'), [
  'read'         => true,
  'edit_posts'   => true,
  'delete_posts' => true
]);
