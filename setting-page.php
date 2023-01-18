<?php
/**
 * parqsense setup
 *
 * Snippet by GenerateWP.com
 * Generated on January 12, 2023 03:46:21
 * @link https://generatewp.com/snippet/V9MbVyx/
 */


class Parqsense_Plugin {

	public function __construct() {

		add_action( 'admin_menu', array( $this, 'add_admin_menu' ) );
		add_action( 'admin_init', array( $this, 'init_settings'  ) );

	}

	public function add_admin_menu() {

		add_menu_page(
			esc_html__( 'Parqsense Settings', 'text_domain' ),
			esc_html__( 'Parqsense', 'text_domain' ),
			'manage_options',
			'parqsense_setup',
			array( $this, 'page_layout' ),
			'dashicons-welcome-widgets-menus',
			10
		);

	}

	public function init_settings() {

		register_setting(
			'parqsense_group',
			'parqsense_settings'
		);

		add_settings_section(
			'parqsense_settings_section',
			'',
			false,
			'parqsense_settings'
		);

		add_settings_field(
			'registration_form_id',
			__( 'Registration Form', 'text_domain' ),
			array( $this, 'render_registration_form_id_field' ),
			'parqsense_settings',
			'parqsense_settings_section'
		);
		add_settings_field(
			'vehicle_form_id',
			__( 'Vehicle Form', 'text_domain' ),
			array( $this, 'render_vehicle_form_id_field' ),
			'parqsense_settings',
			'parqsense_settings_section'
		);

	}

	public function page_layout() {

		// Check required user capability
		if ( !current_user_can( 'manage_options' ) )  {
			wp_die( esc_html__( 'You do not have sufficient permissions to access this page.', 'text_domain' ) );
		}

		// Admin Page Layout
		echo '<div class="wrap">' . "n";
		echo '	<h1>' . get_admin_page_title() . '</h1>' . "n";
		echo '	<form action="options.php" method="post">' . "n";

		settings_fields( 'parqsense_group' );
		do_settings_sections( 'parqsense_settings' );
		submit_button();

		echo '	</form>' . "n";
		echo '</div>' . "n";

	}

	function render_registration_form_id_field() {

		// Retrieve data from the database.
		$options = get_option( 'parqsense_settings' );

		// Set default value.
		$value = isset( $options['registration_form_id'] ) ? $options['registration_form_id'] : '';

		// Field output.
		echo '<select name="parqsense_settings[registration_form_id]" class="registration_form_id_field">';
		echo '	<option value="1" ' . selected( $value, '1', false ) . '> ' . __( 'One', 'text_domain' ) . '</option>';
		echo '	<option value="2" ' . selected( $value, '2', false ) . '> ' . __( 'Two', 'text_domain' ) . '</option>';
		echo '</select>';
		echo '<p class="description">' . __( 'Please select the Registration form.', 'text_domain' ) . '</p>';

	}

	function render_vehicle_form_id_field() {

		// Retrieve data from the database.
		$options = get_option( 'parqsense_settings' );

		// Set default value.
		$value = isset( $options['vehicle_form_id'] ) ? $options['vehicle_form_id'] : '';

		// Field output.
		echo '<select name="parqsense_settings[vehicle_form_id]" class="vehicle_form_id_field">';
		echo '	<option value="1" ' . selected( $value, '1', false ) . '> ' . __( 'One', 'text_domain' ) . '</option>';
		echo '	<option value="2" ' . selected( $value, '2', false ) . '> ' . __( 'Two', 'text_domain' ) . '</option>';
		echo '</select>';
		echo '<p class="description">' . __( 'Select the form used to add a vehicle. (This represents the form that is added to the registration form)', 'text_domain' ) . '</p>';

	}

}

new Parqsense_Plugin;
