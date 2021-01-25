<?php
	require_once("session.php");
	require_once("header.php");
	require_once("form.php");
?>
<style>
	h5{
		text-align:left;
	}
	section h2 a{
		text-decoration: none;
	}
	input[type="text"]{
		width: 70%;
		float: left;
		margin-right: 20px;
	}
	.write{
		float: right;
		margin: -107px;
		padding: 0 20px 0 0;
	}
	.profile{
        width: 30px;
        float: left;
        border-radius: 14px;
        margin-right: 10px;
	}
	#main > .main {
			padding: 2em 5em 1em 5em ;
</style>
<!-- Nav -->
<nav id="nav">
	<ul>
		<li><a href="index.php">게임 소개</a></li>
		<li><a href="todayTip.php" class="active">오늘의 팁!</a></li>
		<li><a href="myFarm.php">농장 자랑</a></li>
		<li><a href="together.php">같이 해요~</a></li>
	</ul>
</nav>

<!-- Main -->
<div id="main">
	<!-- Content -->
	<?php
		require_once("dbcon.php");
		if (!isset($_SESSION['id'])){
			echo '<section id="content" class="main"><br/>';
			echo '<center><img src="images/PigMacha.png" alt="" /></center>';
			echo '<br/><center><h2>로그인이 필요한 서비스입니다...</h2></center>';
	?>
			<center><input type="button" value="로그인" onclick = "location.href='loginform.html'"/>
			<input type="button" value="회원가입" onclick = "location.href='signupform.html'"/></center><br/>
			<?php
			echo '</section>';
		}
		else{
			echo '<section id="content" class="main">';
			echo '<form class="search" method="post" action="Search.php">';
			echo '<input type="radio" name="chk_info" value="tip" checked="checked"/>';
			echo '<input type="text" name="title" placeholder="검색할 게시글 제목을 입력해 주세요!"/>';
			echo '<input type="submit" value="검색"/></form>';
			echo '<form class="write" action="Writeform.php">';
			echo '<input type="submit" value="글쓰기"/></form>';
			echo '</section>';

			/* 게시판 출력 */
			$dbc=mysqli_connect($host, $user, $pass, $dbname) or die("Error Connecting to MySQUL Server.");
			mysqli_query($dbc, 'set names utf8');
			$query="select * from UserWrite where categoryNum=1";
			$result=mysqli_query($dbc, $query) or die("Error Querying database.");
			if (mysqli_num_rows($result) > 0) {
				while($row=mysqli_fetch_assoc($result)){
					$dbc2=mysqli_connect($host, $user, $pass, $dbname) or die("Error Connecting to MySQUL Server.");
					mysqli_query($dbc2, 'set names utf8');
					$userindex=$row['userindex'];
					$query2="select * from UserInfo where id='$userindex'";
					$result2=mysqli_query($dbc2, $query2) or die("Error Querying database.");
					$row2=mysqli_fetch_assoc($result2);
					$userNick=$row2['NickName'];
					$userImage = $row2['userIMG'];
					$writeTitle=$row['writeTitle'];
					echo '<section id="content" class="main"><h2><a href="Show.php?varname='.$writeTitle.'">'.$writeTitle.'</a></h2>';
					echo "<img class=profile src='data:image/jpg;base64,".base64_encode($userImage)."' width='300px'>";
					echo '<h5>'.$userNick.'</h5><h5>'.$row['time'].'</h5>';
					echo '</section>';
				}
				mysqli_free_result($result);
				mysqli_free_result($result2);
			}
			else {
				echo '<section id="content" class="main">';
				echo '<center><img src="images/PigMacha.png" alt="" /></center>';
				echo '<center><h2>게시글이 없습니다...</h2></center>';
				echo '</section>';
			}
		}
	?>
</div>

<!-- Footer -->
<?php
	require_once("footer.php");
?>

<?php
	require_once("script.php");
?>