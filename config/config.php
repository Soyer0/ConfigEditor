<?php
/**
 * Site configuration
 */

// $http_https_redirect = false; // disable redirect http => https
$HTTP_AUTHORIZATION = ['user' => 'test', 'password' => 'test'];
$useWWW = false; // Автовиправлення ОСНОВНОЇ адреси (не мультомовної якщо використовується піддомен)
$multilanguage_type = 'main domain'; // Якщо false то сайт НЕ мультимовний! може бути: false, "*.domain.com.ua" (адреса по головному домену, існування піддоменів мов на роботу не впливає), 'main domain' (мультимовність site.com/en/link..)
$default_admin_language = 'uk'; // мова адмінки
$_SESSION["all_languages"] = ["en","de","pl","fr","ru","uk"];// Список всіх  мов в масиві, перша мова - мова по замовчуванню. Не чіпати
$_SESSION['cache'] = false; // використання кешованих даних
$images_folder = 'images';
// define('IMG_PATH', 'https://domain.com/images/'); // якщо фото потрібно брати з робочого домену
defined('SITE_EMAIL') || define('SITE_EMAIL', 'info@site.com'); // Від даної пошти сайт відправляє листи
defined('SYS_PASSWORD') || define('SYS_PASSWORD', '5d*******fe'); // Сіль для кешування критичних даних (паролі)

$config['autoload'] = array('db', 'data');
$config['recaptcha'] = array (
  'public' => '123',
  'secret' => '132213',
  'public_v3' => 'RECAPTCHA_PUBLIC_KEY',
  'secret_v3' => 'RECAPTCHA_SECRET_KEY',
);
$config['facebook'] = array('appId' => 'FACEBOOK_APP_ID', 'secret' => 'FACEBOOK_SECRET_KEY');
$config['googlesignin'] = array (
  'clientId' => 'GOOGLE_CLIENT_ID213123123',
  'secret' => 'GOOGLE_API_SECRET123123123',
);

/**
 * Параметри для з'єднання до БД
 */
$config['db'] = array(
	'host' 		=> 'localhost',
	'user' 		=> 'root',
	'password'	=> '',
	'database'	=> 'site.com'
);

$config[ 'mail' ] = [
	'host'       => 'smtp.gmail.com',
	'user'       => 'no-reply@site.com',
	'password'   => 'strong-pass',
	'port'       => '587',
	'encryption' => 'tls',
];

$config['telegram_bot'] = [
	'token'   => '78793256**:***********',
	'chat_id' => '562*******',
];


$config[ 'paginator' ] = [
	'ul'                  => 'catalog_pag-pages flex align-center',
	'li'                  => 'nav-item|nav-item active',
	'previous text'       => 'Назад',
	'next text'           => 'Далі',
	'previous_next'       => 'end',
	'previous_next_block' => 'catalog_pag-nav flex align-center'
];
$config['video'] = array(
	'width'		=> 737
);

$config['production_system_curl'] = [
	'token'   => 'big-token',
	'api' => 'https://site.com/1C/rest/api.php?route=',
];

$config['deepl_translate'] = array (
  'server' => 'https://api-free.deepl.com/v2/1231',
  'apiKey' => 
  array (
    0 => '9ae376a9-****-4759-****-**********',
  ),
);

//if(file_exists(APP_PATH . 'config.env.php')) {
//	require APP_PATH . 'config.env.php';
//}