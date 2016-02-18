<?php

use UView\Registry;

class RegistryTestCase extends PHPUnit_Framework_TestCase {

	static protected $path;

	public static function setUpBeforeClass() {
		static::$path = \PhpunitTempDir\Helper::createTempDir();
	}

	public function test_get_existent_view_returns_view() {
		$reg = new Registry(static::$path);

		$view_path = static::$path . DIRECTORY_SEPARATOR . 'name.php';
		file_put_contents($view_path, "foobar");

		// This should not raise any exception
		$view = $reg->get('name');
	}

	public function test_get_non_existent_view_throws_exception() {
		$reg = new Registry(static::$path);

		$this->assertFalse(file_exists(static::$path . DIRECTORY_SEPARATOR . "missing.php"));
		$this->setExpectedException('RuntimeException');
		$reg->get('missing');
	}
}
