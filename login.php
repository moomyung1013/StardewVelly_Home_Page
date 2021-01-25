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
			
			if (isset($_SESSION['id'])) {
                echo "<script language=javascript> alert('세션을 통해서 로그인 정보를 확인했습니다.'); location.replace(history.go(-1)); </script>";
				exit;
            }
			
			if (empty($_POST['ID']) || empty($_POST['PW'])) {
                echo "<script language=javascript> alert('로그인 폼을 모두 채워주세요!'); location.replace(history.go(-1)); </script>";
				exit;
            }
			
            $dbc=mysqli_connect($host, $user, $pass, $dbname) or die("Error Connecting to MySQUL Server.");
			$user_ID=mysqli_real_escape_string($dbc, trim($_POST['ID']));
			$user_PW=mysqli_real_escape_string($dbc, trim($_POST['PW']));
			
			mysqli_query($dbc, 'set names utf8');
            $query="select id, userID from UserInfo where userID='$user_ID' and userPW='$user_PW'";
			$result=mysqli_query($dbc, $query) or die("Error Querying database.");
			if (mysqli_num_rows($result) == 1) {
				$row = mysqli_fetch_assoc($result);
				$userid=$row['id'];
				$_SESSION['id']=$userid;
				//setcookie('id',$row['id'], time()+(60*60*24));
				//setcookie('email',$row['userID'], time()+(60*60*24));
				
                echo "<script language=javascript> location.replace('index.php'); </script>";
			}
			else {
                echo "<script language=javascript> alert('로그인에 실패하였습니다.'); location.replace(history.go(-1)); </script>";
                exit;
			}
			mysqli_free_result($result);
			mysqli_close($dbc);
		?>
	</body>
</html>