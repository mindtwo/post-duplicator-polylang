<?php

/**
 * The file that defines the core plugin class.
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @see       https://www.mindtwo.de/
 * @since      1.0.0
 */

/**
 * The core plugin class.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 *
 * @author     mindtwo GmbH <info@mindtwo.de>
 */
class Post_Duplicator_Polylang
{
    /**
     * The loader that's responsible for maintaining and registering all hooks that power
     * the plugin.
     *
     * @since    1.0.0
     *
     * @var Post_Duplicator_Polylang_Loader maintains and registers all hooks for the plugin
     */
    protected $loader;

    /**
     * The unique identifier of this plugin.
     *
     * @since    1.0.0
     *
     * @var string the string used to uniquely identify this plugin
     */
    protected $plugin_name;

    /**
     * The current version of the plugin.
     *
     * @since    1.0.0
     *
     * @var string the current version of the plugin
     */
    protected $version;

    /**
     * Define the core functionality of the plugin.
     *
     * Set the plugin name and the plugin version that can be used throughout the plugin.
     * Load the dependencies, define the locale, and set the hooks for the admin area and
     * the public-facing side of the site.
     *
     * @since    1.0.0
     */
    public function __construct()
    {
        if (defined('PLUGIN_NAME_VERSION')) {
            $this->version = PLUGIN_NAME_VERSION;
        } else {
            $this->version = '1.0.0';
        }
        $this->plugin_name = 'post-duplicator-polylang';

        $this->load_dependencies();
    }

    /**
     * Load the required dependencies for this plugin.
     *
     * Include the following files that make up the plugin:
     *
     * - Post_Duplicator_Polylang_Loader. Orchestrates the hooks of the plugin.
     * - Post_Duplicator_Polylang_i18n. Defines internationalization functionality.
     * - Post_Duplicator_Polylang_Admin. Defines all hooks for the admin area.
     * - Post_Duplicator_Polylang_Public. Defines all hooks for the public side of the site.
     *
     * Create an instance of the loader which will be used to register the hooks
     * with WordPress.
     *
     * @since    1.0.0
     */
    private function load_dependencies()
    {
        /**
         * The class responsible for orchestrating the actions and filters of the
         * core plugin.
         */
        require_once plugin_dir_path(dirname(__FILE__)).'includes/class-post-duplicator-polylang-loader.php';

        $this->loader = new Post_Duplicator_Polylang_Loader();
    }

    /**
     * Run the loader to execute all of the hooks with WordPress.
     *
     * @since    1.0.0
     */
    public function run()
    {
        $this->loader->add_action('mtphr_post_duplicator_created', $this, 'remove_polylang_post_translation_relationships', 10, 3);

        $this->loader->run();
    }

    /**
     * The name of the plugin used to uniquely identify it within the context of
     * WordPress and to define internationalization functionality.
     *
     * @since     1.0.0
     *
     * @return string the name of the plugin
     */
    public function get_plugin_name()
    {
        return $this->plugin_name;
    }

    /**
     * The reference to the class that orchestrates the hooks with the plugin.
     *
     * @since     1.0.0
     *
     * @return Post_Duplicator_Polylang_Loader orchestrates the hooks of the plugin
     */
    public function get_loader()
    {
        return $this->loader;
    }

    /**
     * Retrieve the version number of the plugin.
     *
     * @since     1.0.0
     *
     * @return string the version number of the plugin
     */
    public function get_version()
    {
        return $this->version;
    }

    /**
     * Find the original-post's translations and delete them.
     */
    public function remove_polylang_post_translation_relationships($original_id, $duplicate_id, $settings)
    {
        global $wpdb;

        // Get term_taxonomy_id of the original-post's translations
        $term_taxonomy_id = $wpdb->get_var($wpdb->prepare("
            SELECT tr.term_taxonomy_id
            FROM {$wpdb->prefix}term_relationships AS tr
            JOIN {$wpdb->prefix}term_taxonomy AS tt ON tt.term_taxonomy_id = tr.term_taxonomy_id
            WHERE tr.object_id=%s AND tt.taxonomy = \"post_translations\"
        ", $duplicate_id)) ?? false;

        // Delete wp_term_relationships for duplicated post
        if($term_taxonomy_id) {
            $wpdb->delete("{$wpdb->prefix}term_relationships", [
                'object_id' => $duplicate_id,
                'term_taxonomy_id' => $term_taxonomy_id
            ]);
        }
    }
}
