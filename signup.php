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
			
			if (empty($_POST['ID']) || empty($_POST['PW']) || empty($_POST['PW_RE']) || empty($_POST['NICKNAME']) || empty($_FILES['FROFILE']['tmp_name'])) {
				echo "<script language=javascript> alert('입력 폼을 모두 채워주세요!'); location.replace(history.go(-1)); </script>";
				exit;
			}
			
			if (!isset($_FILES['FROFILE'])) {
				echo "<script language=javascript> alert('이미지 업로드 에러!'); location.replace(history.go(-1)); </script>";
				exit;
			}
			
			if ($_POST['PW']!=$_POST['PW_RE']){
				echo "<script language=javascript> alert('비밀번호 확인을 다시 입력해주세요!'); location.replace(history.go(-1)); </script>";
				exit;
			}

			$dbc=mysqli_connect($host, $user, $pass, $dbname) or die("Error Connecting to MySQUL Server.");
			
			$user_ID=mysqli_real_escape_string($dbc, trim($_POST['ID']));
			$user_PW=mysqli_real_escape_string($dbc, trim($_POST['PW']));
			$user_PW_RE=mysqli_real_escape_string($dbc, trim($_POST['PW_RE']));
			$user_NICKNAME=mysqli_real_escape_string($dbc, trim($_POST['NICKNAME']));
			$user_PROFILE=addslashes(file_get_contents($_FILES['FROFILE']['tmp_name']));
			
			mysqli_query($dbc, 'set names utf8');
			$query="select * from UserInfo where userID='$user_ID'";
			$result=mysqli_query($dbc, $query) or die("Error Querying database.");
			if (mysqli_num_rows($result) != 0) {
				echo "<script language=javascript> alert('이미 등록된 ID입니다!'); location.replace(history.go(-1)); </script>";
				exit;
			}
			mysqli_free_result($result);
			$query2="select id from UserInfo where NickName='$user_NICKNAME'";
			$result=mysqli_query($dbc, $query2) or die("Error Querying database.");
			if (mysqli_num_rows($result) != 0) {
				echo "<script language=javascript> alert('이미 등록된 닉네임입니다!'); location.replace(history.go(-1)); </script>";
				exit;
			}
			mysqli_free_result($result);
			
			$query="insert into UserInfo values(null, '$user_ID', '$user_PW', '$user_NICKNAME', '$user_PROFILE')";
			$result=mysqli_query($dbc, $query) or die("Error Querying database.");
								
			mysqli_close($dbc);
		?>
	<div id="wrapper">

	<!-- Header -->
		<header id="header" class="alt">
			<span class="logo"><img src="./images/logo.png" alt="" /></span>
			<h1>농장주의 속닥속닥</h1>
		</header>

	<!-- Main -->
		<form id="main" method="post" action="index.php" enctype="multipart/form-data">
			<!-- Content -->
				<section id="content" class="main">
					<?php echo "<h1>회원가입이 정상적으로 이루어졌습니다.<br/>"."$user_NICKNAME"."님 환영합니다!</h1><br/>"; ?>
				</section>
				<section id="content" class="main">
					<center><input type="submit" value="홈으로"/></center>
				</section>
		</form>

	<!-- Footer -->
	<?php
		require_once("footer.php");
		require_once("script.php");
	?>