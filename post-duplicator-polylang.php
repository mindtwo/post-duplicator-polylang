<?php

/**
 * Post Duplicator Polylang.
 *
 * @see               https://www.mindtwo.de/
 * @since             1.0.0
 *
 * @wordpress-plugin
 * Plugin Name:       Post Duplicator Polylang
 * Plugin URI:        https://github.com/mindtwo/post-duplicator-polylang
 * Description:       Removes Polylang 'post_translation' relationships from original post after duplication.
 * Version:           1.0.0
 * Author:            mindtwo GmbH
 * Author URI:        https://www.mindtwo.de/
 * License:           The MIT License (MIT)
 * License URI:       https://opensource.org/licenses/MIT
 */

// If this file is called directly, abort.
if (! defined('WPINC')) {
    die;
}

/*
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define('PLUGIN_NAME_VERSION', '1.2');

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-post-duplicator-polylang-activator.php.
 */
function activate_post_duplicator_polylang()
{
    require_once plugin_dir_path(__FILE__).'includes/class-post-duplicator-polylang-activator.php';
    Post_Duplicator_Polylang_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-post-duplicator-polylang-deactivator.php.
 */
function deactivate_post_duplicator_polylang()
{
    require_once plugin_dir_path(__FILE__).'includes/class-post-duplicator-polylang-deactivator.php';
    Post_Duplicator_Polylang_Deactivator::deactivate();
}

register_activation_hook(__FILE__, 'activate_post_duplicator_polylang');
register_deactivation_hook(__FILE__, 'deactivate_post_duplicator_polylang');

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path(__FILE__).'includes/class-post-duplicator-polylang.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_post_duplicator_polylang()
{
    $plugin = new Post_Duplicator_Polylang();
    $plugin->run();
}
run_post_duplicator_polylang();
