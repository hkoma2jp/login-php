<?php
header("Content-Type: text/html; charset=UTF-8");
function setToken() {
	session_start();
	$token = sha1(uniqid(mt_rand(),true));
	$_SESSION['token'] = $token;
	return $_SESSION['token'];
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8" />
	<title>ログイン</title>
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
		<form class="form-signin" action="register.php" method="post">
		<h2 class="form-signin-heading">ログイン</h2>
			<dl class="form-signin-body">
				<dt>
					<span>ID</span>
				</dt>
				<dd>
					<label for="inputUid" class="sr-only"></label>
					<input id="inputUid" class="form-control" required="" autofocus="" name="uid">
				</dd>
				<dt>
					<span>パスワード</span>
				</dt>
				<dd>
					<label for="inputPassword" class="sr-only"></label>
					<input type="password" id="inputPassword" class="form-control" required="" name="pswd">
				</dd>
			</dl>
			<div class="checkbox">
				<label>
					<input type="checkbox" value="remember-me">パスワードを記憶する
				</label>
			</div>
			<button id="buttonSubmit"  class="btn btn-lg btn-default btn-block" type="submit">ログイン</button>
			<input type="hidden" name="token" value="<?php echo setToken(); ?>" />
		</form>
	</div>
</body>
</html>