<?php

class t {

	public function __construct() {}

	// word
	public static function w($l) {
		$sql = mysqli_fetch_array(db::query("select * from `word` where txt = '".db::esc($l)."'"));
		if (isset($_SESSION['lang'])) $lang = $_SESSION['lang']; else $lang = 'kz';
		return isset($sql['txt_'.$lang]) ? $sql['txt_'.$lang] : $l;
	}

	// word block
	public static function wb($l) {
		$sql = mysqli_fetch_array(db::query("select * from `word_block` where txt = '".db::esc($l)."'"));
		if (isset($_SESSION['lang'])) $lang = $_SESSION['lang']; else $lang = 'kz';
		return isset($sql['txt_'.$lang]) ? $sql['txt_'.$lang] : $l;
	}

	// info
	public static function info($id) {
		$sql = mysqli_fetch_array(db::query("select * from `info` where id = '".(int)$id."'"));
		if (isset($_SESSION['lang'])) $lang = $_SESSION['lang']; else $lang = 'kz';
		return isset($sql['name_'.$lang]) ? $sql['name_'.$lang] : $l;
	}
    
}