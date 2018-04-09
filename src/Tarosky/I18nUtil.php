<?php

namespace Tarosky;

/**
 * Utility class for i18n in WordPress
 *
 * @package i18nutil
 */
class I18nUtil {

	/**
	 * Name reverser lang.
	 */
	const NAME_REVERSER_LANG = [
		'ja',
	];

	/**
	 * Get user name from first_name and last_name.
	 *
	 * @param int|\WP_User|\stdClass $user User object, id, data.
	 * @param string                 $glue Default space.
	 * @return string
	 */
	public static function user_name( $user = 0, $glue = ' ' ) {
		$user = new \WP_User( $user );
		if ( ! $user->ID ) {
			return '';
		}
		$locale   = self::get_user_local( $user );
		$name_row = [
			$user->first_name,
			$user->last_name,
		];
		if ( self::should_reverse( $user ) ) {
			$name_row = array_reverse( $name_row );
		}
		$name = trim( implode( $glue, $name_row ) );
		return $name ?: $user->display_name;
	}

	/**
	 * Get user locale.
	 *
	 * @param int|\WP_User|\stdClass $user
	 *
	 * @return string
	 */
	protected static function get_user_local( $user = 0 ) {
		return get_user_locale( $user );
	}

	/**
	 * Detect if user name should be reverse.
	 *
	 * @param int|\WP_User|\stdClass $user User id, object, data.
	 *
	 * @return bool
	 */
	public static function should_reverse( $user = 0 ) {
		$locale = self::get_user_local( $user );
		return in_array( $locale, self::name_reverse_lang(), true );
	}

	/**
	 * Get language to reverse name.
	 *
	 * @return array
	 */
	protected static function name_reverse_lang() {
		/**
		 * taro_i18n_name_reverse_lang
		 *
		 * Array of name to be reverse.
		 *
		 * @param array $langs Languages.
		 * @return array
		 */
		return apply_filters( 'taro_i18n_name_reverse_lang', self::NAME_REVERSER_LANG );
	}
}
