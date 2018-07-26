<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit; // exit if accessed directly
}

if ( ! class_exists( 'Gravity_Forms_Copernica_Addon_Core' ) ) {

    /**
     * Gravity_Forms_Copernica_Addon_Core class
     *
     * @copyright Copyright (c), Floris P. Lof
     * @author Floris P. Lof <floris@florisplof.nl>
     *
     */
    class Gravity_Forms_Copernica_Addon_Core {

        private static $instance;

        private $_url = 'http://www.gravityforms.com/';
        private $_min_wp_version = '3.9.1';
        private $_min_gravityforms_version = '1.8.7.2';

        var $settings;

        /**
         * Launch the class, hook into WP
         *
         * @author Floris P. Lof <floris@florisplof.nl>*
         */
        public function __construct() {

            $this->settings = get_option( 'gfca_settings' );

            // Activation hook
            register_activation_hook( __FILE__, array( $this, 'install' ) ); //on-install checkups

            // Actions
            add_action( 'init', array( $this, 'load_languagefile' ) ); //get language file
            add_action( 'init', array( $this, 'init' ) ); //init specifics for this plugin
            add_action( 'gform_after_submission', array( $this, 'post_to_copernica' ), 10, 2 ); //post formfields to Copernica
            add_action( 'gform_field_advanced_settings', array( $this, 'advanced_settings' ) ); //add our options to the advanced tab in GF
            add_action( 'gform_editor_js', array( $this, 'editor_script' ) ); //enables our advanced option
	        add_action('gform_ideal_fulfillment', array( $this, 'save_invoice'), 10, 2 );

            // Filters
            add_filter( 'gform_tooltips', array( $this, 'add_tooltips' ) ); //adds our tooltip
	        add_filter( 'gform_pre_render', array( $this, 'pre_render_profile_id' ) );

        }

        /**
         * Create a new Settings Page on Gravity Forms' settings screen, for users who have enough rights
         *
         * @author Floris P. Lof <floris@florisplof.nl>
         */
        public function init() {
            if ( current_user_can( 'gravityforms_copernica' ) && class_exists( 'RGForms' ) ) {
                RGForms::add_settings_page( 'Copernica', array(
                    $this,
                    'settings_page'
                ), GFCA_PLUGIN_URL . '/images/copernica_wordpress_icon_32.png' );
            }
        }

        /**
         * Manage the contents of the settings page, save-handler for the settings
         *
         * @author Floris P. Lof <floris@florisplof.nl>
         */
        public function settings_page() {

            $copernica_access_token = isset( $this->settings['gfca_access_token'] ) ? $this->settings['gfca_access_token'] : '';
            $copernica_database_id  = isset( $this->settings['gfca_database_id'] ) ? $this->settings['gfca_database_id'] : 0;

            if ( isset( $_POST['gfca_submit'] ) ) {

                check_admin_referer( 'update', 'gfca_update' ); //check nonce

                $settings = array(
                    'gfca_access_token' => isset( $_POST['gfca_access_token'] ) ? sanitize_text_field( $_POST['gfca_access_token'] ) : '',
                    'gfca_database_id'  => isset( $_POST['gfca_database_id'] ) ? absint( $_POST['gfca_database_id'] ) : 0
                );

                //store
                update_option( 'gfca_settings', $settings );

            }

            // Retrieve all remote DB's for this account
            $databases = Gravity_Forms_Copernica_Addon_API::get_instance()->get_databases();
            ?>
            <style>
                .gfca-label {
                    width: 200px;
                    display: inline-block;
                }

                .gfca-error-message {
                    color: red;
                }
            </style>

            <form method="post" action="">
                <?php wp_nonce_field( "update", "gfca_update" ) ?>
                <h3><?php _e( "Copernica Account Information", GFCA_TEXTDOMAIN ) ?></h3>

                <p>
                    <?php _e( sprintf( 'Copernica is an online multichannel platform to create professional marketing campaigns and engage your audience. Segment your database, create content and automate campaigns via email, web, mobile, social and print. %sLearn more%s', '<a href="http://www.copernica.com/" target="_blank">', '</a>' ), GFCA_TEXTDOMAIN ); ?>
                </p>
                <ul>
                    <li>
                        <label class="gfca-label" for="gfca_access_token"><?php _e( 'Access token', GFCA_TEXTDOMAIN ); ?></label>
                        <input type="text" size="200" id="gfca_access_token" name="gfca_access_token" value="<?php echo esc_attr( $copernica_access_token ); ?>"/>
                    </li>
                    <li>
                        <p>
                            <small><?php _e( 'You can find/generate your unique Access Token for your account key by clicking on the "Applications" link on the Copernica website', GFCA_TEXTDOMAIN ); ?></small>
                        </p>
                    </li>
                    <li>
                        <?php
                        if ( isset( $databases->error ) && isset( $databases->error->message ) ) {
                            ?>
                            <label class="gfca-label" for="gfca_database_id"><?php _e( 'Setup status', GFCA_TEXTDOMAIN ); ?></label>
                            <label class="gfca-message gfca-error-message"><?php echo $databases->error->message; ?></label>
                            <?php
                        } else {
                            ?>
                            <label class="gfca-label" for="gfca_database_id"><?php _e( 'Database', GFCA_TEXTDOMAIN ); ?></label>
                            <?php
                            if ( isset( $databases->data ) && is_array( $databases->data ) ) {
                                $out = '<select name="gfca_database_id">';
                                $out .= '<option value="0"> -- ' . __( 'Select', GFCA_TEXTDOMAIN ) . ' -- </option>';

                                foreach ( $databases->data as $database ) {
                                    $out .= '<option value="' . absint( $database->ID ) . '"' . selected( $database->ID, $copernica_database_id, false ) . '>' . $database->name . '</option>';
                                }
                                $out .= '</select>';

                            } else {
                                $out = __( 'No databases found for this account...', GFCA_TEXTDOMAIN );;
                            }

                            echo $out;

                        }
                        ?>
                    </li>
                    <li>
                        <input type="submit" name="gfca_submit" class="button-primary" value="<?php esc_attr_e( 'Save Settings', GFCA_TEXTDOMAIN ); ?>"/>
                    </li>
                </ul>
            </form>

            <?php
        }

        /**
         * Create our setting on position 50 in the Advanced Tab ( right after Admin Label )
         *
         * @author Floris P. Lof <floris@florisplof.nl>
         *
         * @param $position
         */
        public function advanced_settings( $position ) {
            if ( $position != 50 ) {
                return $position;
            }

            $out = '';

            // Get all fields that are inside this Copernica DB
            $copernica_database_id  = isset( $this->settings['gfca_database_id'] ) ? $this->settings['gfca_database_id'] : 0;
            $fields = Gravity_Forms_Copernica_Addon_API::get_instance()->get_database_fields( $copernica_database_id );

            //create the form elements with these DB-fields
            if ( isset( $fields->data ) && is_array( $fields->data ) ) {
                if ( count( $fields->data ) > 0 ) {
                    $out .= '<select id="field_copernica_value" onchange="SetFieldProperty(\'copernicaField\', this.value);">';
                    $out .= '<option selected="selected" value=""> -- ' . __( 'Select', GFCA_TEXTDOMAIN ) . ' -- </option>';
                    $out .= '<optgroup label="Default fields">';
                    foreach ( $fields->data as $field ) {
                        $out .= '<option value="' . $field->name . '">' . $field->name . '</option>';
                    }
                    $out .= '</optgroup>';

                    // Show fields of collections (if available)
                    $collections = Gravity_Forms_Copernica_Addon_API::get_instance()->get_database_collections( $copernica_database_id );
                    if ( isset( $collections->data ) && is_array( $collections->data ) ) {
                        foreach ( $collections->data as $collection ) {
                            $out .= '<optgroup label="' . $collection->name . '">';

                            // Get collection fields
                            $collection_fields = Gravity_Forms_Copernica_Addon_API::get_instance()->get_collection_fields( $collection->ID, true );
                            if ( isset( $collection_fields->data ) && is_array( $collection_fields->data ) ) {
                                foreach ( $collection_fields->data as $field ) {
                                    $out .= '<option value="' . $collection->ID . '|::|' . $field->name . '">' . $field->name . '</option>';
                                }
                            }

                            $out .= '</optgroup>';
                        }
                    }

                    $out .= '</select>';
                } else {
                    $out .= '<input class="fieldwidth-2" type="text" id="field_copernica_value" onkeyup="SetFieldProperty(\'copernicaField\', this.value);" />';
                }

            } elseif ( isset( $fields->error ) && isset( $fields->error->message ) ) {

                $out .= '<p class="gfca-error-msg">' . $fields->error->message . '</p>';

            } else {
                return; //do nothing,..skip everything in this function
            }
            ?>
            <style>
                .gfca-error-msg {
                    color: red;
                }
            </style>
            <li class="copernica_setting field_setting">
                <label for="field_copernica_value">
                    <?php _e( 'Copernica fieldname', GFCA_TEXTDOMAIN ); ?>
                    <?php gform_tooltip( 'form_field_copernica_value' ) ?>
                </label>
                <?php echo $out; ?>
            </li>
            <?php
        }

	    /**
	     *
	     * Submit the fields to Copernica
	     *
	     * @author Floris P. Lof <floris@florisplof.nl>
	     *
	     * @param $entry
	     * @param $form
	     *
	     * @return mixed
	     */
        public function post_to_copernica( $entry, $form ) {

	        if ( rgar( $entry, 'status' ) == 'spam' ) {
		        // abort; the entry is spam
		        return $entry;
	        }

            $data                  = array( 'default' => array() );
            $subprofile_data = array();
            $copernica_database_id = isset( $this->settings['gfca_database_id'] ) ? $this->settings['gfca_database_id'] : 0;
            $email_address = '';
            $amount = 0;

            // Loop through all fields
            foreach ( $form['fields'] as $field ) {
                // Start mapping the fields from GF to Copernica ( all data is already sanitized here )
                if ( ! empty( $field->copernicaField ) ) {
                    $copernica_field = sanitize_text_field( $field->copernicaField );
                    $value = rgpost( 'input_' . $field->id );
                    $copernica_field = explode( '|::|', $copernica_field );

                    // Clean up price fields
                    if( $field->inputType == 'hiddenproduct' ) {
                        $value = isset( $entry['payment_amount'] ) ? $entry['payment_amount'] : '';
                        if( '' == $value ) {
                            $value = rgpost( MLDS_Donation::get_instance()->input_price_id );
                            $value = str_replace( ',', '.', $value );
                            $value = str_replace( '€', '', $value );
                            $value = number_format( (float)$value, 2, ',', '' );
                        }
                    }
                    else if( 'newsletter' == $field->inputName ) { // Newsletter field
                        $value = rgpost( 'input_' . $field->id . '_1' );
                    }
                    else if( 'email' == $field->type && 'email' == strtolower( $field->copernicaField ) ) {
                        $email_address = $value;
                    }
                    else if( 'hidden' == $field->type && 'date' == $field->inputName ) {
                        $value = date( 'Y-m-d' );
                    }


                    if( sizeof( $copernica_field ) == 1 ) {
                        $data['default'][ esc_attr( $copernica_field[0] ) ] = $value;
                    } else { // Store items for subprofile handling
                        $data[ $copernica_field[0] ][ $copernica_field[1] ] = $value;
                        $subprofile_data[ $field->id ] = array(
                            'id' => $copernica_field[0],
                            'name' => $copernica_field[1]
                        );
                    }
                }
            }

            // Save subprofile data to GF entry as meta data
            gform_update_meta( $entry['id'], 'subprofile_data', $subprofile_data );

            // Search for existing profiles, so we can update the profile, since duplicates are not allowed
            $profile_exists = Gravity_Forms_Copernica_Addon_API::get_instance()->profile_exists( $copernica_database_id, $email_address );

            // json encode data
            $response = Gravity_Forms_Copernica_Addon_API::get_instance()->submit_entry_fields( $data['default'], $copernica_database_id, $profile_exists );

            // Get Copernica profile ID to store as meta data
            $profile_id = '';
            if( false == is_wp_error( $response ) && isset( $response['headers']['location'] ) ) {
                $location = $response['headers']['location'];
                $location = parse_url( $location );
                if( isset( $location['path'] ) ) {
                    $profile_id = str_replace( '/profile/', '', $location['path'] );

                    gform_update_meta( $entry['id'], 'profile_id', $profile_id );
                }
            }
            else if( is_wp_error( $response ) ) {
	            if( 11 == $form['id'] ) { // Only for donation form
		            /** @var $response \WP_Error */
		            $error_content = 'Error creating profile: ' . PHP_EOL . PHP_EOL . print_r( $response->get_error_message(), true ) . PHP_EOL . PHP_EOL . print_r( $data['default'], true );
		            wp_mail( 'arjan@uprise.nl', 'Copernica error', $error_content );
	            }
			}

            // If $data array contains subprofile array items (that means: other dan 'default'), store the subprofiles.
            if( false == is_wp_error( $response ) && sizeof( $data ) > 1 ) {
                // Unset 'default' item, since that is stored already
                unset( $data['default'] );

                // Get profile ID from return header
                $location = isset( $response['headers']['location'] ) ? $response['headers']['location'] : '';
                if( '' != $location ) {
                    $location_url = parse_url( $location );
                    $profile_id = str_replace( '/profile/', '', $location_url['path'] );

                    if( '' != $profile_id ) {
                        foreach( $data as $collection_id => $data_subprofile ) {
                            $response = Gravity_Forms_Copernica_Addon_API::get_instance()->submit_subprofile_fields( $data_subprofile, $profile_id, $collection_id );

                            // Add subprofile ID
                            if( false == is_wp_error( $response ) && isset( $response['headers']['location'] ) && isset( $data_subprofile['Betaalwijze'] ) ) {
                                $location = $response['headers']['location'];
                                $location = parse_url( $location );
                                $invoice_nr = '';
                                if( isset( $location['path'] ) ) {
                                    $invoice_nr = $profile_exists . '/' . str_replace( '/subprofile/', '', $location['path'] );
                                }

                                if( '' != $profile_id ) {
                                    gform_update_meta( $entry['id'], 'invoice_nr', $invoice_nr );
                                }
                            }
                            else if( is_wp_error( $response ) ) {
	                            if( 11 == $form['id'] ) { // Only for donation form
		                            /** @var $response \WP_Error */
		                            $error_content = 'Error creating profile: ' . PHP_EOL . PHP_EOL . print_r( $response->get_error_message(), true ) . PHP_EOL . PHP_EOL . print_r( $data_subprofile, true );
		                            wp_mail( 'arjan@uprise.nl', 'Copernica error', $error_content );
	                            }
                            }
                        }
                    }
                }
            }

        }

        public function save_invoice( $entry, $feed ) {
            $invoice_nr = gform_get_meta( $entry['id'], 'invoice_nr' );
            $invoice = explode( '/', $invoice_nr );
            $profile_id = isset( $invoice[0] ) ? $invoice[0] : '';
            $subprofile_id = isset( $invoice[1] ) ? $invoice[1] : '';
            $data_to_send = array();

            if( '11' != $entry['form_id'] ) {
               return $entry;
            }

            $copernica_fields = array(
                'BRQ_PAYMENT' => 'brq_transactions',
                'BRQ_PAYMENT_METHOD' => 'brq_transaction_method',
                'BRQ_STATUSCODE' => 'brq_statuscode',
                'BRQ_STATUSCODE_DETAIL' => 'brq_statuscode_detail',
            );

            foreach ( $copernica_fields as $copernica_field => $post_field ) {
                $value = isset( $_POST[ $post_field ] ) ? esc_attr( $_POST[ $post_field ] ) : '';
                $data_to_send[ $copernica_field ] = $value;
            }

            $response = null;
            if ( ! empty( $data_to_send ) ) {
                $url      = '/subprofile/' . $subprofile_id . '/fields/';
                $response = Gravity_Forms_Copernica_Addon_API::get_instance()->post_data( $url, $data_to_send );
            }

            // Create hash of donation data and retrieve previously stored data from DB. Then add entry ID to current option
            $method = 'buckaroo';
            $amount = isset( $_POST['brq_amount'] ) ? esc_attr( $_POST['brq_amount'] ) : 0;
            $email = isset( $entry['10'] ) ? esc_attr( $entry['10'] ) : '';

            $hash = md5( $email . '-' . $amount . '-' . $method );
            $db_data = get_option( 'donation_' . $hash );

            if( ! empty( $db_data ) ) {
                $db_data->entry_id = $entry['id'];
                update_option( 'donation_' . $hash, json_encode( $db_data ) );
            }

            return $entry;
        }

        /**
         * Inject supporting script to the form editor page
         *
         * @author Floris P. Lof <floris@florisplof.nl>
         */
        public function editor_script() {
            ?>
            <script type='text/javascript'>
                // append to all types
                for (var i in fieldSettings) {
                    fieldSettings[i] += ", .copernica_setting";
                }

                // binding to the load field settings event to initialize the checkbox
                jQuery(document).bind("gform_load_field_settings", function(event, field, form) {
                    jQuery("#field_copernica_value").val(field["copernicaField"]);
                });
            </script>
            <?php
        }

        /**
         * Add our tooltip
         *
         * @author Floris P. Lof <floris@florisplof.nl>
         *
         */
        public function add_tooltips( $tooltips ) {
            $tooltips["form_field_copernica_value"] = '<h6>' . __( 'Copernica', GFCA_TEXTDOMAIN ) . '</h6>' . __( 'Enter the name of this field so we can map it correctly to your Copernica database.', GFCA_TEXTDOMAIN ) . '';

            return $tooltips;
        }
	
	    /**
	     * Pre-render the form when Copernica user ID has been given in URL.
	     *
	     * @param $form
	     *
	     * @return mixed
	     */
	    public function pre_render_profile_id( $form ) {
			if( ! isset( $_GET['uid'] ) || ! isset( $this->settings['gfca_database_id'] ) ) {
				return $form;
			}
			
			$user_id = filter_input( INPUT_GET, 'uid', FILTER_SANITIZE_NUMBER_INT );
		    $copernica_database_id  = $this->settings['gfca_database_id'];
			
			$profile = Gravity_Forms_Copernica_Addon_API::get_instance()->get_profile( $copernica_database_id, $user_id );
			
			if( empty( $profile ) ) {
				return $form;
			}
			
			$prefill_fields = [
				'email',
				'voornaam',
				'achternaam',
				'straatnaam',
				'huisnummer',
				'woonplaats',
				'postcode',
				'telefoon',
			];
			
		    foreach ( $form['fields'] as $index => &$field ) {
		    	$found = array_search( $field['inputName'], $prefill_fields );
			    if ( false !== $found ) {
			    	$field_name = ucfirst( $prefill_fields[ $found ] );
			    	if( 'Telefoon' == $field_name ) {
			    		$field_name = 'Telefoonnummer';
					}
					
				    $field['defaultValue'] = $profile->$field_name;
			    }
		    }
		    
	    	return $form;
		}

        /**
         * Handles the steps needed on activation of this plugins
         * Version checks
         * Rights management
         *
         * @author Floris P. Lof <floris@florisplof.nl>
         */
        public function install() {

            //is the correct WordPress-version installed?
            if ( ! $this->_is_wordpress_version_supported() ) {

                deactivate_plugins( plugin_basename( __FILE__ ) );
                wp_die( __( sprintf( 'Gravity Forms Copernica Add-On requires at least WordPress %s. Upgrade automatically on the %sUpgrade page%s.', $this->_min_wp_version, '<a href="upgrade.php">', '</a>' ), GFCA_TEXTDOMAIN ) );

            }

            //is GF installed?
            if ( ! $this->_is_gravityforms_installed() ) {

                deactivate_plugins( plugin_basename( __FILE__ ) );
                wp_die( __( sprintf( 'Gravity Forms Copernica Add-On requires Gravity Forms. You can buy and download it a their %swebsite%s.', '<a target="_blank" href="' . $this->_url . '">', '</a>' ), GFCA_TEXTDOMAIN ) );

            }

            //is the correct GF-version installed?
            if ( ! $this->_is_gravityforms_version_supported() ) {

                deactivate_plugins( plugin_basename( __FILE__ ) );
                wp_die( __( sprintf( 'Campaign Monitor Add-On requires Gravity Forms %s. Upgrade automatically on the %sPlugin page%s.', $this->_min_gravityforms_version, '<a href="plugins.php">', '</a>' ), GFCA_TEXTDOMAIN ) );

            }

            //add some capabilities to the admin role
            global $wp_roles;
            $wp_roles->add_cap( 'administrator', 'gravityforms_copernica' );
            $wp_roles->add_cap( 'administrator', 'gravityforms_copernica_uninstall' );

        }

        /**
         * Checks if the current WP-version is compatible with this plugin
         *
         * @author Floris P. Lof <floris@florisplof.nl>
         */
        private function _is_wordpress_version_supported() {
            global $wp_version;

            return version_compare( $wp_version, $this->_min_wp_version, '>=' );

        }

        /**
         * Checks if gravity forms is installed
         *
         * @author Floris P. Lof <floris@florisplof.nl>
         */
        private function _is_gravityforms_installed() {
            return class_exists( 'RGForms' );
        }

        /**
         * Checks if the current Gravity Forms version is compatible with this plugin
         *
         * @author Floris P. Lof <floris@florisplof.nl>
         */
        private function _is_gravityforms_version_supported() {
            if ( class_exists( 'GFCommon' ) ) {
                return version_compare( GFCommon::$version, $this->_min_gravityforms_version, '>=' );
            } else {
                return false;
            }
        }

        /**
         *
         * Load languages
         *
         * @author Floris P. Lof <floris@florisplof.nl>
         */
        public function load_languagefile() {
            load_plugin_textdomain( GFCA_TEXTDOMAIN, false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
        }

        /**
         * Returns an instance of this class. An implementation of the singleton design pattern.
         *
         * @return   instance    A reference to an instance of this class.
         * @since    1.0.0
         */
        public static function get_instance() {
            if ( null == self::$instance ) {
                self::$instance = new Gravity_Forms_Copernica_Addon_Core();
            }

            return self::$instance;
        }

    }

}