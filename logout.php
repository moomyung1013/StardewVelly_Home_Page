<?php
	session_start();
	ob_start();
?>

<!DOCTYPE html>
<html>
<head>
		<title>농장주의 속닥속닥</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link href="./images/icon.ico" rel="shortcut icon" type="image/x-icon">
		<link rel="stylesheet" href="assets/css/main.css" />
		<noscript><link rel="stylesheet" href="assets/css/noscript.css" /></noscript>
	</head>
	<body>
		<?php
			require_once('dbcon.php');
			
			if (!isset($_SESSION['id'])) {
                echo "<script language=javascript> alert('로그인 상태가 아닙니다. 홈으로!'); location.replace('index.php'); </script>";
                exit;
            }
			
			$_SESSION=array();
			
			if(isset($_COOKIE[session_name()])) {
				setcookie(session_name(), '', time()-(60*60));
			}
			session_destroy();
			setcookie('id', '', time()-(60*60));
			setcookie('userID', '', time()-(60*60));
			
            echo "<script language=javascript> alert('로그아웃하였습니다.'); location.replace('index.php'); </script>";
            exit;
			
		?>
	</body>
</html>