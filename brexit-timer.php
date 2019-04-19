<?php
/**
 * Plugin Name: Brexit Timer
 * Description: Keep your readers upto date with the upcoming event - Brexit. Just add [brexit] to your post or page
 * Version: 0.1.0
 * Author: Laurence Bahiirwa
 * Author URI: https://omukiguy.com
 * Plugin URI: https://github.com/bahiirwa/brexittimer
 * Text Domain: brexittimer
 * 
 * This is free software released under the terms of the General Public License,
 * version 2, or later. It is distributed WITHOUT ANY WARRANTY; without even the
 * implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. Full
 * text of the license is available at https://www.gnu.org/licenses/gpl-2.0.txt.
 */

// Prevent direct access.
if (!defined('ABSPATH')) { die(); }

class BrexitTimer {

	/**
	 * Process shortcode - This public function processes the brexit_timer shortcode into HTML markup.
	 *
	 * @author Laurence Bahiirwa
	 *
	 * @since 0.1.0
	 *
	 * @param array $atts Shortcode arguments.
	 * @return string Markup of shortcode output.
	 */
	public function process_shortcode($atts, $content = null) {

        return '<span id="brexit-timer" class="brexit-timer"></span>';
	}

    /**
	 * Enqueue scripts for plugin
	 *
	 * @author Laurence Bahiirwa
	 *
	 * @since 0.1.0
	 *
	 * @return string null
	 */
	public function brexit_timer_scripts($atts) {

        $vars = shortcode_atts( array(
            'wording'   => 'Brexit',
            'date'  => '2019-10-31 23:00:00'
        ), $atts );


	    //Get UL timezone GMT+0
        $gmt_date = gmdate('M d, Y H:i:s', strtotime($vars['date']) );

        // Localize the script with new data
        $translation_array = array(
            'wording' => __( $vars['wording'], 'brexittimer' ),
            'uk_time'     => $gmt_date
        );

        wp_register_script( 'brexit_timer_script', plugin_dir_url( __FILE__ ) . 'js/timer.js' );
        wp_localize_script( 'brexit_timer_script', 'brexit_string', $translation_array );
        wp_enqueue_script( 'brexit_timer_script');

    }
    /**
	 * Run the functions register in the class.
	 *
	 * @author Laurence Bahiirwa
	 *
	 * @since 0.1.0
	 *
	 * @return string null
	 */
	public function register() {
        
        //Enqueue the scripts with localization.
        add_action('wp_enqueue_scripts', array($this,'brexit_timer_scripts'));

        // Add action to process shortcodes.
        add_shortcode('brexit_timer', array($this, 'process_shortcode'));

    }

}

/**
 * Load the class in a variable.
 * Instatiate default function register();
 */ 
$timer_load = new BrexitTimer;
$timer_load->register();