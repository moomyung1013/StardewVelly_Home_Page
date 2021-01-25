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

			$dbc=mysqli_connect($host, $user, $pass, $dbname) or die("Error Connecting to MySQUL Server.");
			
            $writeid=$_GET['varname'];
			mysqli_query($dbc, 'set names utf8');
			$query="delete from UserWrite where writeid=$writeid";
			$result=mysqli_query($dbc, $query) or die("Error Querying database.");
            mysqli_close($dbc);
            echo "<script language=javascript> alert('게시글이 정상적으로 삭제되었습니다!'); location.replace('index.php'); </script>";
            exit;
		?>
	<div id="wrapper">

	<!-- Footer -->
	<?php
		require_once("footer.php");
		require_once("script.php");
	?>