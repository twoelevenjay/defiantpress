<?php
/**
 * The file that defines the core plugin class.
 *
 * @since   1.0.0
 * @package DefiantPress
 */

namespace DefiantPress;

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
		add_action( 'wp_ajax_dismiss_tutorial', array( $this, 'dismiss_tutorial' ) );
		add_action( 'wp_ajax_nopriv_dismiss_tutorial', array( $this, 'dismiss_tutorial' ) );
		add_action( 'admin_notices', array( $this, 'introduce_member' ) );
		$this->get_team();
	}

	/**
	 * Enqueue the DefiantPress scripts and styles..
	 *
	 * @since    1.0.0
	 * @access   public
	 */
	public function enqueue_scripts() {
		wp_enqueue_script( 'jquery-ui-dialog' );
		wp_enqueue_script( 'defiantpress-js', DEFIANTPRESS_URL . 'assets/defiantpress.js', array( 'jquery', 'jquery-ui-dialog' ), DEFIANTPRESS_VERSION, true );
		wp_enqueue_style( 'wp-jquery-ui-dialog' );
		wp_enqueue_style( 'defiantpress-css', DEFIANTPRESS_URL . 'assets/defiantpress.css', array( 'wp-jquery-ui-dialog' ), DEFIANTPRESS_VERSION );
		$data = array(
			'viewed' => in_array( get_current_user_id(), get_transient( 'defiantpress_welcome_message' ), true ) ? 'viewed' : 'unviewed',
			'ajax'   => admin_url( 'admin-ajax.php' ),
		);
		wp_localize_script( 'defiantpress-js', 'defiantpress', $data );
	}

	/**
	 * Randomly select one member from the team array.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	public function dismiss_tutorial() {
		$viewed          = get_transient( 'defiantpress_welcome_message' );
		$current_user_id = get_current_user_id();
		if ( ! in_array( $current_user_id, $viewed, true ) ) {
			$viewed[] = $current_user_id;
		}
		set_transient( 'defiantpress_welcome_message', $viewed );
	}

	/**
	 * Randomly select one member from the team array.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	public function introduce_member() {
		$random_key = array_rand( $this->members, 1 );
		add_thickbox();
		?>
		<div id="defiantpress-modal" title="<?php echo esc_attr( $this->members[ $random_key ]['name'] ); ?>" style="display:none;">
			<img src="<?php echo esc_attr( $this->members[ $random_key ]['image'] ); ?>" />
			<p><?php echo esc_html( $this->members[ $random_key ]['about'] ); ?></p>
		</div>
		<?php
		$lang = '';
		if ( 'en_' !== substr( get_user_locale(), 0, 3 ) ) {
			$lang = ' lang="en"';
		}
		printf(
			'<p id="defiantpress"><span class="screen-reader-text">%s </span><span dir="ltr"%s><a class="click-to-view" href="/click-to-view-%s">%s</a></span> <a class="click-to-view-tutorial" href="/click-to-view-tutorial"><span class="dashicons dashicons-info"></span></a></p>',
			esc_html_x( 'Defiant Team Member:', 'defiantpress' ),
			esc_attr( $lang ),
			esc_attr( sanitize_title( $this->members[ $random_key ]['name'] ) ),
			esc_html( $this->members[ $random_key ]['name'] )
		);
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
