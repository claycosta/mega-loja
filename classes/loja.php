<?php
class Loja {
  public function sanitize($string, $capitalize = true) {
		$string = str_ireplace("&","&amp;", $string);
		if ($capitalize == true) {
		  $string[0] = strtoupper($string[0]);
		}
		return $string;
	}
}