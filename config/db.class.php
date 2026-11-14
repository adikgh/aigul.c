<?php

class db {

	public static $connect = null;

	public function __construct() {
		global $config;
		$c = $config['db'];
		mysqli_report(MYSQLI_REPORT_OFF);
		self::$connect = @mysqli_connect($c['host'], $c['user'], $c['pass'], $c['name']);
		if (!self::$connect) exit("Базаға қосылу мүмкін болмады. config/db.php баптауын тексеріңіз.");
		mysqli_set_charset(self::$connect, 'utf8mb4');
	}

	public static function query($sql) {
		return mysqli_query(self::$connect, $sql);
	}

	// SQL ішіне қоятын мәнді қорғау
	public static function esc($v) {
		return mysqli_real_escape_string(self::$connect, (string)$v);
	}

	public static function id() {
		return mysqli_insert_id(self::$connect);
	}

}
