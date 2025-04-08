<?php 

acf_form_head();

get_header(); 

$team_id = get_team_id();

$team_captain_id = get_post_field('post_author', $team_id);

$participants = get_field('participants', $team_id);
echo $participants;

render_page_by_id(12380);

get_footer(); 
