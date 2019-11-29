<?php
/**
 * Helper Functions
 *
 * @package     Storytelling PR
 * @author      Kate Amann
 * @since       1.0.0
 * @license     GPL-2.0+
 */



/**
 * Move Yoast to the Bottom
 */
function yoast_to_bottom() {
  return 'low';
}
//add_filter( 'wpseo_metabox_prio', 'yoast_to_bottom');
