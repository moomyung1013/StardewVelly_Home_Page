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
        <?php
            $dbc=mysqli_connect($host, $user, $pass, $dbname) or die("Error Connecting to MySQUL Server.");
            mysqli_query($dbc, 'set names utf8');
            if (mysqli_real_escape_string($dbc, trim($_POST['chk_info']))=="tip"){
                echo '<li><a href="index.php">게임 소개</a></li>';
                echo '<li><a href="todayTip.php" class="active">오늘의 팁!</a></li>';
                echo '<li><a href="myFarm.php">농장 자랑</a></li>';
                echo '<li><a href="together.php">같이 해요~</a></li>';
            }
            else if (mysqli_real_escape_string($dbc, trim($_POST['chk_info']))=="farm"){
                echo '<li><a href="index.php">게임 소개</a></li>';
                echo '<li><a href="todayTip.php">오늘의 팁!</a></li>';
                echo '<li><a href="myFarm.php" class="active">농장 자랑</a></li>';
                echo '<li><a href="together.php">같이 해요~</a></li>';
            }
            else{
                echo '<li><a href="index.php">게임 소개</a></li>';
                echo '<li><a href="todayTip.php">오늘의 팁!</a></li>';
                echo '<li><a href="myFarm.php">농장 자랑</a></li>';
                echo '<li><a href="together.php" class="active">같이 해요~</a></li>';
            }
        ?>
	</ul>
</nav>

<body>
<div id="main">
    <?php
        require_once('dbcon.php');
        if (empty($_POST['title'])) {
            echo "<script language=javascript> alert('검색하고자 하는 제목을 입력해주세요!'); location.replace(history.go(-1)); </script>";
            exit;
        }
        $dbc=mysqli_connect($host, $user, $pass, $dbname) or die("Error Connecting to MySQUL Server.");
        mysqli_query($dbc, 'set names utf8');

        $title=mysqli_real_escape_string($dbc, trim($_POST['title']));
        $content=mysqli_real_escape_string($dbc, trim($_POST['content']));

        echo '<section id="content" class="main">';
        echo '<form class="search" method="post" action="Search.php">';

        if (mysqli_real_escape_string($dbc, trim($_POST['chk_info']))=="tip"){
            $category=1;  
            echo '<input type="radio" name="chk_info" value="tip" checked="checked"/>';
            echo '<input type="text" name="title" placeholder="검색할 게시글 제목을 입력해 주세요!"/>';
            echo '<input type="submit" value="검색"/></form>';
            echo '<form class="write" action="Writeform.php">';
            echo '<input type="submit" value="글쓰기"/></form>';
        }
        else if (mysqli_real_escape_string($dbc, trim($_POST['chk_info']))=="farm"){
            $category=2;  
            echo '<input type="radio" name="chk_info" value="farm" checked="checked"/>';
            echo '<input type="text" name="title" placeholder="검색할 게시글 제목을 입력해 주세요!"/>';
            echo '<input type="submit" value="검색"/></form>';
            echo '<form class="write" action="Writeform2.php">';
            echo '<input type="submit" value="글쓰기"/></form>';
        }
        else{
            $category=3;  
            echo '<input type="radio" name="chk_info" value="together" checked="checked"/>';
            echo '<input type="text" name="title" placeholder="검색할 게시글 제목을 입력해 주세요!"/>';
            echo '<input type="submit" value="검색"/></form>';
            echo '<form class="write" action="Writeform3.php">';
            echo '<input type="submit" value="글쓰기"/></form>';
        }
        
        echo '</section>';
        
        $query="select * from UserWrite join UserInfo on UserWrite.userindex=UserInfo.id and UserWrite.writeTitle like '%$title%'";
        $result=mysqli_query($dbc, $query) or die("Error Querying database.");
        if (mysqli_num_rows($result) > 0) {
            while($row=mysqli_fetch_assoc($result)){
                $result2=mysqli_query($dbc, $query) or die("Error Querying database.");
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
            else{
                echo '<section id="content" class="main">';
				echo '<center><img src="images/PigMacha.png" alt="" /></center>';
				echo '<center><h2>해당 게시글이 존재하지 않습니다...</h2></center>';
				echo '</section>';
            }
    ?>
</div>
	<?php
		require_once("footer.php");
		require_once("script.php");
	?>