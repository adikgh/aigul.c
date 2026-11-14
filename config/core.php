<?php
	// Ортақ бастау: сайт, клиент кабинеті және админ панель осы файлды қолданады.

	if (!file_exists(__DIR__.'/db.php')) exit('config/db.php табылмады: config/db.example.php файлын db.php деп көшіріп, толтырыңыз.');
	require_once __DIR__.'/db.php';

	// Қателерді экранға шығармай, logs/php-error.log файлына жазамыз (debug => true болса экранға шығады)
	$_debug = !empty($config['debug']);
	ini_set('display_errors', $_debug ? '1' : '0');
	ini_set('log_errors', '1');
	ini_set('error_log', dirname(__DIR__).'/logs/php-error.log');
	error_reporting($_debug ? E_ALL : (E_ALL & ~E_NOTICE & ~E_WARNING & ~E_DEPRECATED));
	require_once __DIR__.'/db.class.php';
	require_once __DIR__.'/fun.php';
	require_once __DIR__.'/t.php';

	// Бетке бағыттау (header-дан кейін код әрі қарай орындалмауы үшін exit)
	if (!function_exists('go')) {
		function go($url) {
			header('Location: '.$url);
			exit();
		}
	}

	// HTML-ге қауіпсіз шығару
	if (!function_exists('e')) {
		function e($s) {
			return htmlspecialchars((string)$s, ENT_QUOTES, 'UTF-8');
		}
	}

	class core {
		public static $user_data = array();
		const REMEMBER = 2592000; // 30 күн

		public function __construct() {
			new db; new fun; new t;
			date_default_timezone_set('Asia/Almaty');

			if (session_status() !== PHP_SESSION_ACTIVE) {
				ini_set('session.gc_maxlifetime', self::REMEMBER);
				session_set_cookie_params([
					'lifetime' => self::REMEMBER,
					'path' => '/',
					'secure' => self::https(),
					'httponly' => true,
					'samesite' => 'Lax',
				]);
				session_start();
			}

			self::escape_input();
			$this->authorize();
		}

		public static function https() {
			return (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') || (isset($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] == 443);
		}

		// Ескі код сұраныстарды '$var' деп тікелей жинайды.
		// SQL-инъекциядан қорғау үшін барлық GET/POST мәндерін бір жерде қорғаймыз.
		private static function escape_input() {
			$f = function (&$arr) use (&$f) {
				foreach ($arr as $k => &$v) {
					if (is_array($v)) $f($v);
					else $v = db::esc($v);
				}
			};
			$f($_GET); $f($_POST); $f($_REQUEST);
		}

		private static function secret() {
			global $config;
			return isset($config['secret']) && $config['secret'] ? $config['secret'] : 'aigul-'.__DIR__;
		}

		private static function sign($id, $exp, $pass) {
			return hash_hmac('sha256', $id.'|'.$exp.'|'.$pass, self::secret());
		}

		private function authorize() {
			$id = isset($_SESSION['uid']) ? (int)$_SESSION['uid'] : 0;

			// Сессия жоқ болса, «есте сақтау» cookie-ін тексереміз
			if (!$id && !empty($_COOKIE['aid'])) {
				$p = explode('|', $_COOKIE['aid']);
				if (count($p) == 3 && (int)$p[1] > time()) {
					$u = fun::user((int)$p[0]);
					if ($u && hash_equals(self::sign((int)$p[0], (int)$p[1], (string)$u['password']), $p[2])) {
						$id = (int)$p[0];
						$_SESSION['uid'] = $id;
					}
				}
			}

			if ($id) {
				$u = fun::user($id);
				if ($u && !$u['locked']) self::$user_data = $u;
				else self::logout();
			}
		}

		// Кіру: сессия + 30 күндік қолтаңбалы cookie (құпия сөз cookie-де сақталмайды)
		public static function login($id) {
			$u = fun::user((int)$id);
			if (!$u) return false;
			session_regenerate_id(true);
			$_SESSION['uid'] = (int)$u['id'];
			$exp = time() + self::REMEMBER;
			setcookie('aid', $u['id'].'|'.$exp.'|'.self::sign((int)$u['id'], $exp, (string)$u['password']), [
				'expires' => $exp, 'path' => '/', 'secure' => self::https(), 'httponly' => true, 'samesite' => 'Lax',
			]);
			self::$user_data = $u;
			return true;
		}

		public static function logout() {
			self::$user_data = array();
			unset($_SESSION['uid']);
			setcookie('aid', '', ['expires' => time() - 3600, 'path' => '/']);
		}

		// Кіргеннен кейін қай бетке бару керек: админ → админ панель, клиент → кабинет
		public static function home() {
			return !empty(self::$user_data['right']) ? '/admin/' : '/education/my/';
		}
	}

	// data
	$core = new core;
	$user = core::$user_data;
	$user_id = isset($user['id']) ? $user['id'] : null;
	$user_right = isset($user['right']) ? $user['right'] : null;
	$user_super_right = isset($user['super_right']) ? $user['super_right'] : null;

	require_once __DIR__.'/var.php';

	// setting
	$site = mysqli_fetch_array(db::query("select * from `site` where id = 1"));
	if (!$site) $site = ['site' => '', 'name' => 'Aigul Asqar', 'phone' => '', 'phone_view' => '', 'whatsapp' => '', 'whatsapp_view' => '', 'instagram' => '', 'telegram' => '', 'youtube' => '', 'metrika' => null, 'analitics' => null, 'pixel' => null, 'mail' => ''];
