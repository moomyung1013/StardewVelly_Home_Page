<?php
	require_once("session.php");
	require_once("header.php");
	require_once("form.php");
?>
<style>
      textarea {
        width: 100%;
        height: 500px;
	  }
	  h3{
		  text-align:right;
	  }
</style>
<!-- Nav -->
<nav id="nav">
	<ul>
	
		<li><a href="index.php">게임 소개</a></li>
		<li><a href="todayTip.php">오늘의 팁!</a></li>
		<li><a href="myFarm.php" class="active">농장 자랑</a></li>
		<li><a href="together.php">같이 해요~</a></li>
	</ul>
</nav>
		<!-- Main -->
			<form id="main" method="post" action="Write.php" enctype="multipart/form-data">
					<section id="content" class="main" enctype="multipart/form-data">
					<h3>카테고리_     
					<input type="radio" name="chk_info" value="farm" checked="checked" >농장자랑</input></h3>
						<h2>제목
						<input type="text" name="title" placeholder="제목을 입력해주세요!"/><br/></h2>
						<h2>내용</h2>
                        <textarea placeholder="내용을 입력해주세요!" name="content" style="resize: none;"></textarea>
						<h2>첨부파일</h2>
						<input type="file" name="img" value="파일 선택"/>
					</section>
					<section id="content" class="main">
						<center><input type="submit" value="글쓰기"/></center>
					</section>
			</form>

<!-- Footer -->
<?php
	require_once("footer.php");
?>

<?php
	require_once("script.php");
?>