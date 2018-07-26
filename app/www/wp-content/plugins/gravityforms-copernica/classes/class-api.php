<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit; // exit if accessed directly
}

if ( ! class_exists( 'Gravity_Forms_Copernica_Addon_API' ) ) {

    /**
     * Gravity_Forms_Copernica_Addon_API class
     *
     * @copyright Copyright (c), Floris P. Lof
     * @author Floris P. Lof <floris@florisplof.nl>
     *
     */
    class Gravity_Forms_Copernica_Addon_API {

        private static $instance;

        private $_access_token = null;
        private $_database_id = null;
        private $_api_base = 'https://api.copernica.com';

        public function __construct() {

            $settings            = get_option( 'gfca_settings' );
            $this->_access_token = isset( $settings['gfca_access_token'] ) ? $settings['gfca_access_token'] : '';
            $this->_database_id  = isset( $settings['gfca_database_id'] ) ? $settings['gfca_database_id'] : 0;

        }

        /**
         * Get the remote DB's for this Copernica account
         *
         * @author Floris P. Lof <floris@florisplof.nl>
         *
         * @param bool $skip_cache
         * @return array|mixed|object
         */
        public function get_databases( $skip_cache = false ) {
            $body = $this->get_data( '/databases', $skip_cache );

            // Re-decode and return
            return json_decode( $body );
        }

        /**
         * Get the remote DB's fields for this Copernica account and chosen DB
         *
         * @author Floris P. Lof <floris@florisplof.nl>
         *
         * @param $database_id
         * @param bool $skip_cache
         *
         * @return array|mixed|object
         */
        public function get_database_fields( $database_id, $skip_cache = false ) {
            if ( empty( $database_id ) ) {
                $body = array( 'error' => array( 'message' => __( 'Please choose a database on settings page first...', GFCA_TEXTDOMAIN ) ) );
                $body = json_encode( $body ); //then let PHP worry about the proper sanitation via json_encode
            } else {
                // Get request, create response
                $body = $this->get_data( '/database/' . $database_id . '/fields', $skip_cache );
            }

            // Re-decode and return
            return json_decode( $body );
        }

        /**
         * Get the remote DB's fields for this Copernica account and chosen collection
         *
         * @author Arjan Snaterse <arjan@uprise.nl>
         *
         * @param $collection_id
         * @param bool $skip_cache
         *
         * @return array|mixed|object
         */
        public function get_collection_fields( $collection_id, $skip_cache = false ) {
            if ( empty( $collection_id ) ) {
                $body = array( 'error' => array( 'message' => __( 'Please choose a database on settings page first...', GFCA_TEXTDOMAIN ) ) );
                $body = json_encode( $body ); //then let PHP worry about the proper sanitation via json_encode
            } else {
                $body = $this->get_data( '/collection/' . $collection_id . '/fields', $skip_cache );
            }

            // Re-decode and return
            return json_decode( $body );
        }

        /**
         * Get the remote DB's profiles for this Copernica account and chosen DB*
         * @author Arjan Snaterse <arjan@uprise.nl>
         *
         * @param $database_id
         * @param bool $skip_cache
         *
         * @return array|mixed|object
         */
        public function get_database_collections( $database_id, $skip_cache = false ) {
            if ( empty( $database_id ) ) {
                $body = array( 'error' => array( 'message' => __( 'Please choose a database on settings page first...', GFCA_TEXTDOMAIN ) ) );
                $body = json_encode( $body ); //then let PHP worry about the proper sanitation via json_encode
            } else {
                // Get request, create response
                $body = $this->get_data( '/database/' . $database_id . '/collections', $skip_cache );
            }

            // Re-decode and return
            return json_decode( $body );
        }

        /**
         * Get the remote DB's profiles for this Copernica account and chosen DB*
         * @author Arjan Snaterse <arjan@uprise.nl>
         *
         * @param $database_id
         * @param $email
         *
         * @return false|int
         * @internal param bool $skip_cache
         *
         */
        public function profile_exists( $database_id, $email ) {
            $profile_exists = false;

            if ( empty( $database_id ) ) {
                return false;
            }

            // Get request, create response
            $body = $this->get_data( '/database/' . $database_id . '/profiles/?limit=1&fields[]=Email%3D%3D' . $email, true );
            $body = json_decode( $body );

            if( ! empty( $body->data ) && is_array( $body->data ) ) {
                $profile_exists = $body->data[0]->ID;
            }

            return $profile_exists;
        }
        
        public function get_profile( $database_id, $user_id ) {
        	$profile = null;
	        $body = $this->get_data( '/profile/' . $user_id, true );
	        $body = json_decode( $body );
	
	        if( ! empty( $body->fields ) ) {
		        $profile = $body->fields;
	        }
        	
        	return $profile;
        }

        /**
         *
         * Submit the fields to Copernica to create new profile
         *
         * @author Floris P. Lof <floris@florisplof.nl>
         *
         * @param $data
         * @param $database_id
         *
         * @return array|WP_Error
         */
        public function submit_entry_fields( $data, $database_id, $profile_exists ) {

            // Create api-uri
            if( false == $profile_exists ) {
                $url = '/database/' . $database_id . '/profiles';
            }
            else {
                $url = '/profile/' . $profile_exists . '/fields';
            }

            return $this->post_data( $url, $data );
        }

        /**
         *
         * Submit the fields to Copernica profile to create subprofile (ie. fill the Collection fields)
         *
         * @author Arjan Snaterse <arjan@uprise.nl>
         *
         * @param $data
         * @param $profile_id
         * @param $collection_id
         *
         * @return array|WP_Error
         */
        public function submit_subprofile_fields( $data, $profile_id, $collection_id ) {
            // Create api-uri
            $url = '/profile/' . $profile_id . '/subprofiles/' . $collection_id;

            // Post request, create response
            return $this->post_data( $url, $data );
        }

        /**
         * Gets data from Copernica API
         *
         * @param string $slug
         * @param bool|false $skip_cache
         *
         * @return array|mixed|string
         */
        public function get_data( $slug, $skip_cache = false ) {

            $transient_name = 'gfca_data_' . sanitize_text_field( $slug );
            $body = get_transient( $transient_name );

            $base_url = $this->_api_base . $slug;

            if ( false == $body || true == $skip_cache ) {
                if ( empty( $this->_access_token ) ) {
                    // First create a proper array
                    $body = array( 'error' => array( 'message' => __( 'Please enter a valid access token on the settings page first...', GFCA_TEXTDOMAIN ) ) );
                    $body = json_encode( $body ); // then let PHP worry about the proper sanitation via json_encode

                } else {

                    // Get request, create response
                    $url    = add_query_arg( array(
                         'access_token' => $this->_access_token
                    ), $base_url );
                    $remote = wp_remote_get( $url );
                    
	                if( is_wp_error( $remote ) ) {
		                return json_encode( [] );
	                }

                    $body = $remote['body']; // THIS SHOULD BE A PROPER JSON

                    // So let's check that shall we
                    if ( ! is_object( json_decode( $body ) ) ) {
                        $body = array( 'error' => array( 'message' => strip_tags( $body ) ) );
                        $body = json_encode( $body ); // then let PHP worry about the proper sanitation via json_encode
                    }

                }

                set_transient( $transient_name, $body, 1 * DAY_IN_SECONDS );
            }

            return $body;
        }

        /**
         *
         * Submit the fields to Copernica
         *
         * @author Arjan Snaterse <arjan@uprise.nl>
         *
         * @param $request_slug
         * @param array $data
         *
         * @return array|WP_Error
         */
        public function post_data( $request_slug, $data ) {
            $data_string = json_encode( $data );

            // The Args
            $args = array(
                'headers' => array(
                    'Content-Type'   => 'application/json',
                    'Content-Length' => strlen( $data_string )
                ),
                'body'    => $data_string,
            );

            // Create api-uri
            $url = $this->_api_base . $request_slug . '?access_token=' . $this->_access_token;

            // Post request, create response
            $response = wp_remote_post( $url, $args );

            // Response handling
            if ( is_wp_error( $response ) ) { // something went wrong inside WP, apparently...
                // TODO: maybe, someday do something better with this message :-)
                $message = "Response:\n" . var_export( $response, true );
                $message .= "Request slug: " . $request_slug . "\n";
                $message .= "Input data:\n" . var_export( $data, true );

                wp_mail( get_option( 'admin_email' ), 'submit errors: ' . $response->get_error_message(), $message );
            } elseif ( $response['response']['code'] != 201 ) { // 201 == Created successfully
                // TODO: maybe, someday do something better with this message :-)
                $message = "Response:\n" . var_export( $response, true );
                $message .= "Request slug: " . $request_slug . "\n";
                $message .= "Input data:\n" . var_export( $data, true );

                wp_mail( get_option( 'admin_email' ), 'submit errors: ' . $response['response']['message'], $message );
            }
            else {
                // TODO: maybe, someday do something better with handling success response :-)
            }

            return $response;
        }

        /**
         * Returns an instance of this class. An implementation of the singleton design pattern.
         *
         * @return   object    A reference to an instance of this class.
         * @since    1.0.0
         */
        public static function get_instance() {
            if ( null == self::$instance ) {
                self::$instance = new Gravity_Forms_Copernica_Addon_API();
            }

            return self::$instance;
        }

    }

}