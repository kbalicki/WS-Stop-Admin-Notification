<?php
/*
 * Plugin Name: WS Stop Admin Notification
 * Description: WS Stop disable New User registration and User password change email notifications for Admin
 * Version:           0.9
 * Author:            Web Systems
 * Author URI:        https://www.web-systems.pl
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
*/

//Disable the new user notification sent to the site admin
function ws_disable_new_user_notifications() {
  //Remove original use created emails
  remove_action( 'register_new_user', 'wp_send_new_user_notifications' );
  remove_action( 'edit_user_created_user', 'wp_send_new_user_notifications', 10, 2 );
  
  //Add new function to take over email creation
  add_action( 'register_new_user', 'ws_send_new_user_notifications' );
  add_action( 'edit_user_created_user', 'ws_send_new_user_notifications', 10, 2 );
 }
 function ws_send_new_user_notifications( $user_id, $notify = 'user' ) {
  if ( empty($notify) || $notify == 'admin' ) {
  return;
  }elseif( $notify == 'both' ){

  //Only send the new user their email, not the admin
  $notify = 'user';
  }
  wp_send_new_user_notifications( $user_id, $notify );
 }
 add_action( 'init', 'ws_disable_new_user_notifications' );



?>