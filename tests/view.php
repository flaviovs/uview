<?php

use UView\View;

class ViewTestCase extends PHPUnit_Framework_TestCase {

	static protected $path;

	public static function setUpBeforeClass() {
		static::$path = \PhpunitTempDir\Helper::createTempDir();
	}

	public function test_to_string() {
		$view_file = static::$path . DIRECTORY_SEPARATOR . "view.php";
		file_put_contents($view_file, 'abc <' . '?php echo $foo ?' . '> xyz');

		$view = new View($view_file);
		$view->set('foo', 'bar');

		$this->assertEquals('abc bar xyz', (string)$view);
	}
}
