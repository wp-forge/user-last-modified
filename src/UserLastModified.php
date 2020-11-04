<?php

namespace WP_Forge;

/**
 * Class UserLastModified
 *
 * @package WP_Forge
 */
class UserLastModified {

	/**
	 * Meta key.
	 *
	 * @var string
	 */
	const META_KEY = 'user_last_modified';

	/**
	 * Initialize functionality.
	 */
	public static function init() {

		// Register meta field.
		register_meta(
			'user',
			self::META_KEY,
			array(
				'type'              => 'string',
				'description'       => 'The date and time in GMT that a user was last modified.',
				'single'            => true,
				'sanitize_callback' => 'sanitize_text_field',
				'show_in_rest'      => true,
			)
		);

		// Listen for user updates.
		add_action( 'user_register', array( __CLASS__, 'set' ) );
		add_action( 'profile_update', array( __CLASS__, 'set' ) );

	}

	/**
	 * Get the user last modified value from the database.
	 *
	 * @param int $user_id User ID.
	 *
	 * @return string The last modified date in the Y-m-d h:i:s format in the GMT timezone.
	 */
	public static function fetch( $user_id ) {
		return get_user_meta( $user_id, self::META_KEY, true );
	}

	/**
	 * Check if the user has a last modified time.
	 *
	 * @param int $user_id User ID.
	 *
	 * @return bool Whether or not a user has a last modified time set.
	 */
	public static function has( $user_id ) {
		return ! empty( self::fetch( $user_id ) );
	}

	/**
	 * Get the user last modified time in the requested format.
	 *
	 * @param int    $user_id User ID.
	 * @param string $format  DateTime format.
	 *
	 * @return string The last modified date in the selected format, or an empty string on failure.
	 */
	public static function get( $user_id, $format = 'c' ) {
		$value = '';
		if ( self::has( $user_id ) ) {
			try {
				$date_time = new \DateTime( self::fetch( $user_id ), new \DateTimeZone( 'GMT' ) );
				$value     = $date_time->format( $format );
			} catch ( \Exception $exception ) {
				$value = '';
			}
		}

		return $value;
	}

	/**
	 * Set the user last modified time.
	 *
	 * @param int $user_id User ID.
	 */
	public static function set( $user_id ) {
		update_user_meta( $user_id, self::META_KEY, current_time( 'mysql', 1 ) );
	}

	/**
	 * Delete the user last modified time.
	 *
	 * @param int $user_id User ID.
	 */
	public static function delete( $user_id ) {
		delete_user_meta( $user_id, self::META_KEY );
	}

}
