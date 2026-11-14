<?php include 'config/core.php';

	// Сайттан келген өтінімдер: базаға сақтап, Telegram-ға жібереміз (config/db.php ішінде tg_token, tg_chat)
	function tg_send($arr) {
		global $config;
		if (empty($config['tg_token']) || empty($config['tg_chat'])) return true;
		$txt = '';
		foreach ($arr as $key => $value) $txt .= "<b>".$key."</b> ".htmlspecialchars($value)."\n";
		$url = 'https://api.telegram.org/bot'.$config['tg_token'].'/sendMessage?'.http_build_query(['chat_id'=>$config['tg_chat'], 'parse_mode'=>'html', 'text'=>$txt]);
		return (bool) @file_get_contents($url);
	}

	if (isset($_GET['mess']) || isset($_GET['mess2'])) {
		$name  = strip_tags($_POST['name'] ?? '');
		$phone = strip_tags($_POST['phone'] ?? '');
		if ($name == '' || $phone == '') { echo 'error'; exit(); }
		db::query("INSERT INTO `lide`(`name`, `phone`, `ins_dt`) VALUES ('$name', '$phone', '$datetime')");
		$ok = tg_send(['Типі:' => 'Сайттан өтінім', 'Аты-жөні:' => stripslashes($name), 'Телефон:' => stripslashes($phone)]);
		echo $ok ? 'yes' : 'error';
		exit();
	}
