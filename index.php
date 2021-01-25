<?php
 require_once('dbcon.php');
 require_once("session.php");
 require_once("header.php");
 require_once("form.php");
?>
<nav id="nav">
	<ul>
		<li><a href="index.php">게임 소개</a></li>
		<li><a href="todayTip.php">오늘의 팁!</a></li>
		<li><a href="myFarm.php" class="active">농장 자랑</a></li>
		<li><a href="together.php">같이 해요~</a></li>
	</ul>
</nav>

<!-- Footer -->
<?php
	require_once("footer.php");
?>

<?php
	require_once("script.php");
?>