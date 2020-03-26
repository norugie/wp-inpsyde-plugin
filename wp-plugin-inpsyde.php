<?php

/**
 * @package wp-plugin-inpsyde
 */

/*
Plugin Name: WP Plugin Test
Plugin URI:
Description: A WP plugin for code review
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
    public function __construct(){      
        add_action('query_vars', array($this, 'set_query_var'));
        add_filter('template_include', array($this, 'plugin_include_template'));
    }

    public function activate(){
        add_rewrite_rule('^custom$','index.php?custom_page=1','top'); // rewrite custom_page to custom
        flush_rewrite_rules();
    }

    public function deactivate(){
        flush_rewrite_rules();
    }

    public function set_query_var($varURL) {
        array_push($varURL, 'custom_page'); // add custom_page as a variable for current url
        return $varURL;
    }

    public function plugin_include_template($template){
        if(get_query_var('custom_page')){
            $template = plugin_dir_path( __FILE__ ) . 'templates/custom.php';;
        }    
        return $template;    
    }

    public function consume_api(){
        $apiURL = "https://jsonplaceholder.typicode.com/users"; // call api
        // setup api for json decode
        $client = curl_init($apiURL);
        curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($client);
        $httpcode = curl_getinfo($client, CURLINFO_HTTP_CODE);
        
        // check if returned http status is 200
        if($httpcode == "200"){
            // return variable for json
            $result = json_decode($response, true);
        } else $result = NULL; // set results to null
        
        return $result;
    }
}

if(class_exists('WPPluginInpsyde')) $wpPluginInpsyde = new WPPluginInpsyde();

register_activation_hook(__FILE__, array($wpPluginInpsyde, 'activate')); // activate
register_deactivation_hook(__FILE__, array($wpPluginInpsyde, 'deactivate')); // deactivate