<?php

function get_user_from_query() {
    $user_id = isset($_GET['user_id']) ? intval($_GET['user_id']) : 0;
    $user = new WP_User($user_id);

    if ($user->exists()) {
        return $user;
    }
    
    return;
}