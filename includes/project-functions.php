<?php


function get_project_short_description() {
    return get_post_meta(get_the_ID(), 'short_description', true);
}

function get_project_description() {
    return get_post_meta(get_the_ID(), 'description', true);
}

function get_project_expected_results() {
    return get_post_meta(get_the_ID(), 'expected_results', true);
}

function get_project_related_data() {
    return get_post_meta(get_the_ID(), 'related_data', true);
}

function get_similar_projects_ids() {
    return get_post_meta(get_the_ID(), 'similar_projects', true);
}

function get_past_projects_ids() {
    return get_post_meta(get_the_ID(), 'past_projects', true);
}

function get_project_categories() {
    $taxonomy = 'project_category';

    $terms = wp_get_post_terms(get_the_ID(), $taxonomy);
    $terms_names = [];

    if (!empty($terms) && !is_wp_error($terms)) {
        foreach ($terms as $term) {
            array_push($terms_names, $term->name);
        }
    }
    return $terms_names;
}