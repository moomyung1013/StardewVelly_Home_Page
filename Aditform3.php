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
		<li><a href="myFarm.php">농장 자랑</a></li>
		<li><a href="together.php" class="active">같이 해요~</a></li>
	</ul>
</nav>
<?php
    require_once('dbcon.php');

    $dbc=mysqli_connect($host, $user, $pass, $dbname) or die("Error Connecting to MySQUL Server.");

    $writeid=$_GET['varname'];
    mysqli_query($dbc, 'set names utf8');
    $query="select * from UserWrite where writeid='$writeid'";
    $result=mysqli_query($dbc, $query) or die("Error Querying database.");
    $row=mysqli_fetch_assoc($result);
    $writeTitle=$row['writeTitle'];
    $picture = $row['picture'];
    $writeMemo=$row['writeMemo'];
    mysqli_close($dbc);
?>

<form id="main" method="post" action="Adit.php?varname=<?php echo $writeid; ?>" enctype="multipart/form-data">
    <section id="content" class="main" enctype="multipart/form-data">
    <h3>카테고리_     
    <input type="radio" name="chk_info" value="together" checked="checked" >같이해요~</input></h3>
        <h2>제목
        <input type="text" name="title" value=<?php echo $writeTitle; ?>><br/></h2>
        <h2>내용</h2>
        <textarea name="content" style="resize: none;"><?php echo $writeMemo; ?></textarea><br/><br/><br/>
        <br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
    </section>
    <section id="content" class="main">
        <center><input type="submit" value="수정"/></center>
    </section>
</form>

<!-- Footer -->
<?php
	require_once("footer.php");
?>

<?php
	require_once("script.php");
?>