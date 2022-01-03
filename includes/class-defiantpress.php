<?php
/**
 * The file that defines the core plugin class.
 *
 * @since   1.0.0
 * @package DefiantPress
 */

/**
 * The core plugin class.
 *
 * @since      1.0.0
 * @package    DefiantPress
 * @author     Leon <leon@211j.com>
 */
class DefiantPress {

	/**
	 * Define the core functionality of the plugin.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {

		$this->get_team();
	}

	/**
	 * Get the team members from the https://www.defiant.com/team/ page.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function get_team() {

	}

}
