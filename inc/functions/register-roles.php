<?php
/**
 * Functions Add Role Superadmin
 * Doctorpedia
 * Author: wcanvas.com
 */

/* 
add_role( 'superadmin', 'Superadmin', get_role( 'administrator' )->capabilities );

$superadmins = get_users('role=superadmin');

foreach ( $superadmins as $user) {
    grant_super_admin($user->ID);
} 
*/

/**
 * Add Superadmin Capabilities to specific user
 */
grant_super_admin(285);