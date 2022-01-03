<?php
/**
 * The file that defines the core plugin class.
 *
 * @since   1.0.0
 * @package DefiantPress
 */

use Goutte\Client;

/**
 * The core plugin class.
 *
 * @since      1.0.0
 * @package    DefiantPress
 * @author     Leon <leon@211j.com>
 */
class DefiantPress {

	/**
	 * Defiant team members crawled from https://www.defiant.com/team/.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      array    $members    Contains an array of all team members.
	 */
	protected $members = array();

	/**
	 * Define the core functionality of the plugin.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {

		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
		$this->get_team();
	}

	/**
	 * Enqueue the DefiantPress scripts and styles..
	 *
	 * @since    1.0.0
	 * @access   public
	 */
	public function enqueue_scripts() {

		wp_enqueue_script( 'defiantpress-js', DEFIANTPRESS_URL . 'assets/defiantpress.js', array( 'jquery' ), DEFIANTPRESS_VERSION, true );
		wp_enqueue_style( 'defiantpress-css', DEFIANTPRESS_URL . 'assets/defiantpress.css', array(), DEFIANTPRESS_VERSION );
	}

	/**
	 * Get the team members from the https://www.defiant.com/team/ page.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function get_team() {

		$client  = new Client();
		$crawler = $client->request( 'GET', 'https://www.defiant.com/team/' );
		$crawler->filter( 'div.staff-member' )->each(
			function ( $node, $i ) {
				$name_title      = $node->filter( 'h2' )->first()->html();
				$name_title      = str_replace( '</span>', '', $name_title );
				$name_title      = explode( '<span>', $name_title );
				$this->members[] = array(
					'name'  => $name_title[0],
					'title' => $name_title[1],
					'image' => $node->filter( 'img' )->first()->attr( 'src' ),
					'about' => $node->children()->last()->text(),
				);
			}
		);
	}

}
