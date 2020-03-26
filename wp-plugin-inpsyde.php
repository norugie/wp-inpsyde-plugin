<?php

/**
 * @package wp-plugin-inpsyde
 */

/*
Plugin Name: WP Plugin Test
Plugin URI:
Description: This WordPress plugin lets the user access a list of users and user information from an API. Once the plugin is installed and activated through the WordPress admin panel, the user can navigate to domain.com/userlist.
Version: 1.0.0
Author: Rugie Ann Barrameda
Author URI: https://norugie.github.io
License: GNU GPLv3
Text Domain: wp-plugin-inpsyde
*/

/*
This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see <https://www.gnu.org/licenses/>.
*/

defined('ABSPATH') or die('You are restricted from accessing that page.');

class WPPluginInpsyde
{
    public function __construct()
    {
        add_action('query_vars', [$this, 'setQueryVar']);
        add_filter('template_include', [$this, 'pluginIncludeTemplate']);
    }

    public function activate()
    {
        add_rewrite_rule('^userlist$', 'index.php?custom_user_page=1', 'top'); // rewrite custom_user_page to userlist
        flush_rewrite_rules();
    }

    public function deactivate()
    {
        flush_rewrite_rules();
    }

    public function setQueryVar($varUrl)
    {
        array_push($varUrl, 'custom_user_page'); // add custom_user_page as a variable for current url
        return $varUrl;
    }

    public function pluginIncludeTemplate($template)
    {
        if (get_query_var('custom_user_page'))
            $template = plugin_dir_path(__FILE__) . 'templates/custom.php';
        return $template;
    }

    public function consumeApi()
    {
        $apiUrl = "https://jsonplaceholder.typicode.com/users"; // call api
        // setup api for json decode
        $client = curl_init($apiUrl);
        curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($client);
        $httpCode = curl_getinfo($client, CURLINFO_HTTP_CODE);
        
        // check if returned http status is 200
        if ($httpCode === 200) {
            // return variable for json
            $result = json_decode($response, true);
        } else {
            $result = null; // set results to null
        }
        
        return $result;
    }
}

if (class_exists('WPPluginInpsyde')) {
    $wpPluginInpsyde = new WPPluginInpsyde();
}

register_activation_hook(__FILE__, [$wpPluginInpsyde, 'activate']); // activate
register_deactivation_hook(__FILE__, [$wpPluginInpsyde, 'deactivate']); // deactivate
