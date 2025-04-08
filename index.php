<?php
/**
 * Plugin Name: PlatformaCustom
 * Description: Platforma Custom plugin
 * Version: 1.0
 * Author: Cat
 * License: GPL2
 */


function load_custom_post_template($template) {
    
    if (is_singular('project')) { 
        $plugin_template = plugin_dir_path(__FILE__) . 'templates/single-project.php';

        if (file_exists($plugin_template)) {
            return $plugin_template;
        }
    }

   if (is_page('public-user-profile')) { 
        $plugin_template = plugin_dir_path(__FILE__) . 'templates/page-public-user-profile.php';
        return $plugin_template;
    }

    if (is_page('edit-team')) { 
        $plugin_template = plugin_dir_path(__FILE__) . 'templates/page-edit-team.php';
        return $plugin_template;
    }

    return $template;
}

function render_page_by_id($post_id) {
    $post = get_post($post_id);
	$themebuildermanager = ffContainer()->getThemeFrameworkFactory()->getThemeBuilderManager();
	$postContent = str_repeat($post->post_content, 1);
	ffStopWatch::timeStart();
	$final = $themebuildermanager->renderButNotPrint($post->post_content);
	echo do_shortcode( $final );

	$renderedCss = $themebuildermanager->getRenderedCss();

	if( isset( $post->post_content_css ) ) {

	}

	echo '<style>' .  PHP_EOL . $themebuildermanager->getRenderedCss() . '</style>';
	echo '<script>' .  PHP_EOL . $themebuildermanager->getRenderedJs() . '</script>';
	echo '<div class="smazat" style="position: fixed;bottom: 0;left: 0;min-height: 30px;width: 250px;background: rgba(200,200,200,0.7);z-index: 99999">';
	ffStopWatch::timeEndDump();
	ffStopWatch::dumpVariables();
	echo '</div>';
}

add_filter('template_include', 'load_custom_post_template', 99);


require_once plugin_dir_path(__FILE__) . 'includes/project-functions.php';
require_once plugin_dir_path(__FILE__) . 'includes/user-profile-functions.php';
require_once plugin_dir_path(__FILE__) . 'includes/team-functions.php';
