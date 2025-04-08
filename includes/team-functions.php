<?php

function get_team_id() {
    if (isset($_GET['team_id'])) {
        $team_id = sanitize_text_field($_GET['team_id']); 
    } else {
        $team_id = null;
    }
    return $team_id;
}

function get_team_data($field) {
    $team_id = get_team_id();
    if (!is_null($team_id)) {
        return get_post_meta($team_id, $field, true);
    }
    return '';
}

function get_team_edit_form() {
    $team_id = get_team_id();
    $acf_form_args = array(
        'post_id'       => $team_id ? $team_id : 'new_post',
        'post_title'    => false, 
        'post_content'  => false, 
        'new_post'      => array(
            'post_type'   => 'team',
            'post_status' => 'publish',
        ),
        'fields'        => array('name', 'description', 'photo'),
        'submit_value'  => 'Save Team', 
        'return'        => home_url('/edit-team/') . '?team_id=%post_id%',
    );

    acf_form($acf_form_args);
}


function handle_team_form_submission($post_id) {
    if (get_post_type($post_id) !== 'team') {
        return;
    }

    $team_id = $post_id;

    $team_captain_id = get_post_field('post_author', $team_id);

    $participants = get_field('participants', $team_id);
    
    if(!in_array($team_captain_id, $participants)) {
        $participants[] = $team_captain_id;
        update_field('participants', $participants, $team_id);
    }
    
}


add_action('acf/save_post', 'handle_team_form_submission', 20); // Priority 20 ensures ACF saves data first


