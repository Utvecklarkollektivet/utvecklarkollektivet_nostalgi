<?php
App::uses('RegisterKey', 'Model');

/**
 * RegisterKey Test Case
 *
 */
class RegisterKeyTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.register_key'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->RegisterKey = ClassRegistry::init('RegisterKey');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->RegisterKey);

		parent::tearDown();
	}

}
