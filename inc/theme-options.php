<?php
/**
 * Create A Simple Theme Options Panel
 *
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Start Class
if ( ! class_exists( 'WPEX_Theme_Options' ) ) {

	class WPEX_Theme_Options {

		/**
		 * Start things up
		 *
		 * @since 1.0.0
		 */
		public function __construct() {

			// We only need to register the admin panel on the back-end
			if ( is_admin() ) {
				add_action( 'admin_menu', array( 'WPEX_Theme_Options', 'add_admin_menu' ) );
				add_action( 'admin_init', array( 'WPEX_Theme_Options', 'register_settings' ) );
			}

		}

		/**
		 * Returns all theme options
		 *
		 * @since 1.0.0
		 */
		public static function get_theme_options() {
			return get_option( 'theme_options' );
		}

		/**
		 * Returns single theme option
		 *
		 * @since 1.0.0
		 */
		public static function get_theme_option( $id ) {
			$options = self::get_theme_options();
			if ( isset( $options[$id] ) ) {
				return $options[$id];
			}
		}

		/**
		 * Add sub menu page
		 *
		 * @since 1.0.0
		 */
		public static function add_admin_menu() {
			add_menu_page(
				esc_html__( 'Theme Settings', 'tsum' ),
				esc_html__( 'Theme Settings', 'tsum' ),
				'manage_options',
				'theme-settings',
				array( 'WPEX_Theme_Options', 'create_admin_page' )
			);
		}

		/**
		 * Register a setting and its sanitization callback.
		 *
		 * We are only registering 1 setting so we can store all options in a single option as
		 * an array. You could, however, register a new setting for each option
		 *
		 * @since 1.0.0
		 */
		public static function register_settings() {
			register_setting( 'theme_options', 'theme_options', array( 'WPEX_Theme_Options', 'sanitize' ) );
		}

		/**
		 * Sanitization callback
		 *
		 * @since 1.0.0
		 */
		public static function sanitize( $options ) {

			// If we have options lets sanitize them
			if ( $options ) {

				// Checkbox
				if ( ! empty( $options['checkbox_example'] ) ) {
					$options['checkbox_example'] = 'on';
				} else {
					unset( $options['checkbox_example'] ); // Remove from options if not checked
				}

				// Input
				if ( ! empty( $options['input_example'] ) ) {
					$options['input_example'] = sanitize_text_field( $options['input_example'] );
				} else {
					unset( $options['input_example'] ); // Remove from options if empty
				}
				// Textarea
				if ( ! empty( $options['textarea_example'] ) ) {
					$options['textarea_example'] = sanitize_text_field( $options['textarea_example'] );
				} else {
					unset( $options['textarea_example'] ); // Remove from options if empty
				}

				// Select
				if ( ! empty( $options['select_example'] ) ) {
					$options['select_example'] = sanitize_text_field( $options['select_example'] );
				}

			}

			// Return sanitized options
			return $options;

		}

		/**
		 * Settings page output
		 *
		 * @since 1.0.0
		 */
		public static function create_admin_page() { ?>

			<div class="wrap">

				<h1><?php esc_html_e( 'Theme Options', 'tsum' ); ?></h1>

				<form method="post" action="options.php">

					<?php settings_fields( 'theme_options' ); ?>

					<table class="form-table">

						<?php // Text input example ?>
						<tr valign="top">
							<th scope="row"><?php esc_html_e( 'Address', 'tsum' ); ?></th>
							<td>
								<?php $value = self::get_theme_option( 'address' ); ?>
								<input type="text" name="theme_options[address]" value="<?php echo esc_attr( $value ); ?>" class="regular-text code">
							</td>
						</tr>
						<tr valign="top">
							<th scope="row"><?php esc_html_e( 'Phone', 'tsum' ); ?></th>
							<td>
								<?php $value = self::get_theme_option( 'phone' ); ?>
								<input type="number" name="theme_options[phone]" value="<?php echo esc_attr( $value ); ?>" class="regular-text code">
							</td>
						</tr>
						<tr valign="top">
							<th scope="row"><?php esc_html_e( 'Phone', 'tsum' ); ?></th>
							<td>
								<?php $value = self::get_theme_option( 'phone2' ); ?>
								<input type="number" name="theme_options[phone2]" value="<?php echo esc_attr( $value ); ?>" class="regular-text code">
							</td>
						</tr>
                        <tr valign="top">
							<th scope="row"><?php esc_html_e( 'Mobile Number 1', 'tsum' ); ?></th>
							<td>
								<?php $value = self::get_theme_option( 'mobile1' ); ?>
								<input type="number" name="theme_options[mobile1]" value="<?php echo esc_attr( $value ); ?>" class="regular-text code">
							</td>
						</tr>
						<tr valign="top">
							<th scope="row"><?php esc_html_e( 'Mobile Number 2', 'tsum' ); ?></th>
							<td>
								<?php $value = self::get_theme_option( 'mobile2' ); ?>
								<input type="number" name="theme_options[mobile2]" value="<?php echo esc_attr( $value ); ?>" class="regular-text code">
							</td>
						</tr>
						<tr valign="top">
							<th scope="row"><?php esc_html_e( 'Fax', 'tsum' ); ?></th>
							<td>
								<?php $value = self::get_theme_option( 'fax' ); ?>
								<input type="number" name="theme_options[fax]" value="<?php echo esc_attr( $value ); ?>" class="regular-text code">
							</td>
						</tr>
						<tr valign="top">
							<th scope="row"><?php esc_html_e( 'Email 1', 'tsum' ); ?></th>
							<td>
								<?php $value = self::get_theme_option( 'email' ); ?>
								<input type="email" name="theme_options[email]" value="<?php echo esc_attr( $value ); ?>" class="regular-text code">
							</td>
						</tr>
						<tr valign="top">
							<th scope="row"><?php esc_html_e( 'Email 2', 'tsum' ); ?></th>
							<td>
								<?php $value = self::get_theme_option( 'email2' ); ?>
								<input type="email" name="theme_options[email2]" value="<?php echo esc_attr( $value ); ?>" class="regular-text code">
							</td>
						</tr>
						<tr valign="top">
							<th scope="row"><?php esc_html_e( 'Email 3', 'tsum' ); ?></th>
							<td>
								<?php $value = self::get_theme_option( 'email3' ); ?>
								<input type="email" name="theme_options[email3]" value="<?php echo esc_attr( $value ); ?>" class="regular-text code">
							</td>
						</tr>
						<tr valign="top">
							<th scope="row"><?php esc_html_e( 'Email 4', 'tsum' ); ?></th>
							<td>
								<?php $value = self::get_theme_option( 'email4' ); ?>
								<input type="email" name="theme_options[email4]" value="<?php echo esc_attr( $value ); ?>" class="regular-text code">
							</td>
						</tr>
						<?php // textarea example ?>
						<tr valign="top">
							<th scope="row"><?php esc_html_e( 'Map Location', 'tsum' ); ?></th>
							<td>
								<?php $value = self::get_theme_option( 'maplocation' ); ?>
								<textarea name="theme_options[maplocation]" placeholder="Paste Google Map Embed Code Here" cols="130" rows="10"><?php echo esc_attr( $value ); ?></textarea>
							</td>
						</tr>
						<tr valign="top">
							<th scope="row"><?php esc_html_e( 'Facebook', 'tsum' ); ?></th>
							<td>
								<?php $value = self::get_theme_option( 'facebook' ); ?>
								<input type="text" name="theme_options[facebook]" value="<?php echo esc_attr( $value ); ?>" class="regular-text code">
							</td>
						</tr>
						<tr valign="top">
							<th scope="row"><?php esc_html_e( 'Twitter', 'tsum' ); ?></th>
							<td>
								<?php $value = self::get_theme_option( 'twitter' ); ?>
								<input type="text" name="theme_options[twitter]" value="<?php echo esc_attr( $value ); ?>" class="regular-text code">
							</td>
						</tr>
						<tr valign="top">
							<th scope="row"><?php esc_html_e( 'linkedin', 'tsum' ); ?></th>
							<td>
								<?php $value = self::get_theme_option( 'linkedin' ); ?>
								<input type="text" name="theme_options[linkedin]" value="<?php echo esc_attr( $value ); ?>" class="regular-text code">
							</td>
						</tr>
						<tr valign="top">
							<th scope="row"><?php esc_html_e( 'Google Plus', 'tsum' ); ?></th>
							<td>
								<?php $value = self::get_theme_option( 'googleplus' ); ?>
								<input type="text" name="theme_options[googleplus]" value="<?php echo esc_attr( $value ); ?>" class="regular-text code">
							</td>
						</tr>
						<tr valign="top">
							<th scope="row"><?php esc_html_e( 'Tripadvisor', 'tsum' ); ?></th>
							<td>
								<?php $value = self::get_theme_option( 'tripadvisor' ); ?>
								<input type="text" name="theme_options[tripadvisor]" value="<?php echo esc_attr( $value ); ?>" class="regular-text code">
							</td>
						</tr>
						<tr valign="top">
							<th scope="row"><?php esc_html_e( 'Youtube', 'tsum' ); ?></th>
							<td>
								<?php $value = self::get_theme_option( 'youtube' ); ?>
								<input type="text" name="theme_options[youtube]" value="<?php echo esc_attr( $value ); ?>" class="regular-text code">
							</td>
						</tr>
						<tr valign="top">
							<th scope="row"><?php esc_html_e( 'Skype', 'tsum' ); ?></th>
							<td>
								<?php $value = self::get_theme_option( 'skype' ); ?>
								<input type="text" name="theme_options[skype]" value="<?php echo esc_attr( $value ); ?>" class="regular-text code">
							</td>
						</tr>

					</table>

					<?php submit_button(); ?>

				</form>

			</div><!-- .wrap -->
		<?php }

	}
}
new WPEX_Theme_Options();

// Helper function to use in your theme to return a theme option value
function myprefix_get_theme_option( $id = '' ) {
	return WPEX_Theme_Options::get_theme_option( $id );
}