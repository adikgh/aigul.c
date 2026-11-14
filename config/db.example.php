<?php
	// Жергілікті баптаулар. Бұл файлды db.php деп көшіріп, мәндерін толтырыңыз.
	// db.php git-ке кірмейді (.gitignore), құпия сөздер тек осында тұрады.

	$config = [
		'db' => [
			'host' => 'localhost',
			'user' => 'root',
			'pass' => '',
			'name' => 'aigul',
		],

		// cookie қолтаңбасы үшін кездейсоқ ұзын жол (кез келген әріп/сан)
		'secret' => 'change-me-to-random-string',

		// SMS (smsc.kz) — бос болса SMS жіберілмейді
		'smsc_login' => '',
		'smsc_password' => '',

		// Telegram бот (өтінімдер келетін чат) — бос болса жіберілмейді
		'tg_token' => '',
		'tg_chat' => '',

		// true болса PHP қателері экранға шығады (тек жергілікті тексеру үшін)
		'debug' => false,
	];
