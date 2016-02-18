<?php

namespace UView;

class View {
	protected $storage = [];
	protected $path;

	public function __construct( $path ) {
		$this->path = $path;
	}

	public function set( $var, $value ) {
		$this->storage[ $var ] = $value;
	}

	public function __toString() {
		ob_start();

		// "Trigger" a "-" error, so that we can check if the include
		// issued any error. Unfortunately error_clear_last() requires
		// PHP >= 7.
		@trigger_error('-');

		extract($this->storage);
		@include $this->path;
		$err = error_get_last();
		$output = ob_get_clean();

		if ($err['message'] != '-') {
			// Call error_log() as a last resort.
			error_log($err['message']);
		}

		return $output;
	}
}


class Registry {

	protected $path;

	public function __construct( $path ) {
		$this->path = $path;
	}

	public function get( $name ) {
		$path = $this->path . "/$name.php";
		if ( ! file_exists($path) ) {
			throw new \RuntimeException("No such view '$name' found in '$this->path'");
		}
		return new View($path);
	}
}
