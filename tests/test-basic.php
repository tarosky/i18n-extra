<?php
/**
 * Function test
 *
 * @package Gianism
 */

/**
 * Sample test case.
 */
class I18nUtil_Basic_Test extends WP_UnitTestCase {

	/**
	 * Setup names.
	 */
	function setUp() {
		update_user_meta( 1, 'first_name', 'Fumiki' );
		update_user_meta( 1, 'last_name', 'Takahashi' );
	}

	/**
	 * A single example test
	 *
	 */
	function test_auto_loader() {
		// Check English name.
		$this->assertEquals( 'Fumiki Takahashi', \Tarosky\I18nUtil::user_name( 1 ) );
		// Check Japanese name.
		update_user_meta( 1, 'locale', 'ja' );
		$this->assertEquals( 'Takahashi Fumiki', \Tarosky\I18nUtil::user_name( 1 ) );
	}

	/**
	 * Delete user meta.
	 */
	function tearDown() {
		delete_user_meta( 1, 'first_name' );
		delete_user_meta( 1, 'last_name' );
		delete_user_meta( 1, 'locale' );
	}
}
