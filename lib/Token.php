<?php 
namespace MyApp;
class Token {
	static public function create() {
		if(!isset($_SESSION['token'])) {
			$_SESSION['token'] = bin2hex(openssl_random_pseudo_bytes(16));
		}
	}
	static public function validate($token) {
		if(
			!isset($_SESSION['token']) || !isset($_SESSION[$token]) ||
			$_SESSION['token'] !== $_POST[$token]
		) {
			throw new \Exception('invalid token!');
		}
	}
}