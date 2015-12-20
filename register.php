<?php
header("Content-Type: text/html; charset=UTF-8");
session_start();

// Define Paramaters.
$passWord = 'pasword';
$uid = $_POST['uid'];
$pswd = $_POST['pswd'];
$sid = $_POST['token'];

// Define RegPattern for Checking.
$pat_uid = '/\d{6}/';

// Define Logfile Path.
$logFilename = 'logs/log.csv';

// Main.

	// Error Checking.
	switch (true){
		case empty($sid) || $_SESSION['token'] !== $sid: // Session Error.
		$logincond = '2';
		$title = 'セッションエラー';
		$message = 'セッションが終了しています。ログインを済ませてご利用ください。';
		break;

		case preg_match($pat_uid,$uid) !== 1 || strlen($uid) !== 6: // UserID Error.
		$logincond = '1';
		$title = 'ユーザーIDエラー';
		$message = '該当するユーザーIDは存在しません。';
		break;

		case $pswd !== $passWord: // Password un-match.
		$logincond = '1';
		$title = 'パスワードエラー';
		$message = 'パスワードが間違っています。';
		break;

		default: // Login Success.
		$logincond = '0';
		$title = '';
		$message = '';
	};

	// Select View.

	if ($logincond !== '0'){
		// For Error view.

print<<<EOF
<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8" />
	<title>$title</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/yui/3.18.0/cssreset/cssreset-min.css" charset="UTF-8" />
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
	<!-- Latest compiled and minified JavaScript -->
	<script src="//code.jquery.com/jquery-1.9.1.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.2/html5shiv.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.min.js"></script>
</head>
<body>
	<div class="container">
	<p>$message</p>
	</div>
</body>
</html>
EOF;

	}else{
		// For Login Success view.

$html = file_get_contents('success/index.html');

print_r($html);

	};

	// Logging.
	$logfp = fopen($logFilename, "a");
	$logline = date('Y/m/d (D) H:i:s',time()) . ',' . $logincond . ',' . $uid . "\n";
	$logline = mb_convert_encoding($logline, "SJIS-win","UTF-8");
	fwrite($logfp,$logline);
	fclose($logfp);

	// Session Initialize.
	$_SESSION = array();
	session_destroy();

?>


