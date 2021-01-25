<?php
    require_once("session.php");
    require_once("header.php");
	require_once("form.php");
?>
<style>
    .writeTitle{
        margin: 30px 0 30px 0;
        text-align: left;
    }
    .test{
        margin: 0 0 0 0;
    }
    .profile{
        width: 30px;
        float: left;
        border-radius: 14px;
        margin: 2px 0 0 0;
        margin-right: 10px;
    }
    .adit{
        float: right;
        display: inline;
        margin: -30px 0 0 0;
    }
    section{
        margin: -40px 0 0 0;
    }
    .search{
        display: inline;
    }
	input[type="text"]{
		width: 86%;
        height: 5em;
		float: left;
		margin-right: 20px;
    }
    #grade_desc input[type="text"]{
        width: 86%;
        height: 3em;
		float: left;
		margin-right: 20px;
    }

    .search input[type="submit"] {
        min-width: 5em;
        height: 5em;
    }
    .info{
        display:inline;
        margin-right:20px;
    }
    .reply{
        margin: 0 0 0 20px;
    }    
    #test {
        min-width: 3em;
        height: 3em;
    }
</style>
<body>        

<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <?php
        require_once('dbcon.php');	
            
        $dbc=mysqli_connect($host, $user, $pass, $dbname) or die("Error Connecting to MySQUL Server.");
        $writeTitle=$_GET['varname'];
        mysqli_query($dbc, 'set names utf8');
        //$query="select * from UserWrite where writeTitle='$writeTitle'";
        $query = "select w.userIndex, w.time, w.writeMemo, w.picture, w.categoryNum, w.writeid, u.NickName, u.userIMG
        from UserWrite as w
        join UserInfo as u on w.writeTitle = '$writeTitle' and w.userIndex=u.id;"; 
        $result=mysqli_query($dbc, $query) or die("Error Querying database.");
        $row=mysqli_fetch_assoc($result);
        $userIndex=$row['userindex'];
        $writeTime=$row['time'];
        $writeContent=$row['writeMemo'];
        $writeIMG=$row['picture'];
        $category=$row['categoryNum'];
        $writeid=$row['writeid'];
        mysqli_free_result($result);
        
        //$query="select * from UserInfo where id='$userIndex'";
        //$result=mysqli_query($dbc, $query) or die("Error Querying database.");
        $userNick=$row['NickName'];
        $userImage=$row['userIMG'];
        mysqli_close($dbc);
    ?>


<div id="main">
    <section id="content" class="main">
        <?php 
            echo "<h1 class=writeTitle>".$writeTitle."</h1>";
            echo "<img class=profile src='data:image/jpg;base64,".base64_encode($userImage)."' width='300px'>";
            echo "<h4 class='test'>".$userNick."</h4>";
            echo "<h4 class='test'>".$writeTime."</h4>";
            if ($userNick==$userName){
                echo '<ul class="adit"><a href="Delete.php?varname='.$writeid.'">삭제</a></ul>';
                if ($category==1)
                    echo '<ul class="adit"><a href="Aditform.php?varname='.$writeid.'">수정</a></ul>';
                else if ($category==2)
                    echo '<ul class="adit"><a href="Aditform2.php?varname='.$writeid.'">수정</a></ul>';
                else
                    echo '<ul class="adit"><a href="Aditform3.php?varname='.$writeid.'">수정</a></ul>';
            }
        ?>
    </section>
    <section id="content" class="main" style="font-size: 25px;">
        <?php
            if ($writeIMG!=null){
                echo '<br/><span class="image main">';
                echo "<img src='data:image/jpg;base64,".base64_encode($writeIMG)."'></span>";
            }
            
            echo nl2br($writeContent);
        ?>
    </section>
    <section id="content" class="main">
        <!--댓글 출력-->
        <?php
            require_once('dbcon.php');	
            $dbc=mysqli_connect($host, $user, $pass, $dbname) or die("Error Connecting to MySQUL Server.");
            mysqli_query($dbc, 'set names utf8');
            $query="select * from UserReply where writeid='$writeid'";
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
					echo "<img class=profile src='data:image/jpg;base64,".base64_encode($userImage)."' width='300px'>";
                    echo '<h4 class="info">'.$userNick.'</h4><h5 class="info">'.$row['time'].'</h5>';
                    if ($userNick==$userName){
                        echo '<ul class="adit"><a href="DeleteReply.php?varname='.$row['replyid'].'">삭제</a></ul>';
                        echo '<ul class="adit" id="btn_grade_desc"><a href="ReplyForm.php?varname='.$row['replyid'].'">수정</a></ul><br/><br/>';
                        echo '<h4 class="reply" id="grade_desc">'.$row['replyMemo'].'</h4>';
                    }
                    else{
                        echo '<h4 class="reply">'.$row['replyMemo'].'</h4>';
                    }   
                    echo '<hr/>';
				}
				mysqli_free_result($result);
				mysqli_free_result($result2);
			}
        ?>
        <form class="search" method="post" action="Reply.php">
        <?php
            if ($category==1){
                echo '<input type="radio" name="chk_info" value="tip" checked="checked"/>';
            }
            else if ($category==2){
                echo '<input type="radio" name="chk_info" value="farm" checked="checked"/>';
            }
            else{
                echo '<input type="radio" name="chk_info" value="together" checked="checked"/>';
            }
        ?>
        <input type="text" name="memo" placeholder=""/>
        <input type="radio" name="writeid" value=<?php echo $writeid; ?> checked="checked"/>
        <input class="test" type="submit" value="댓글등록"/></form>
        
    </section>
    <section id="content" class="main">
        <?php
            if ($category==1){
                echo '<form action="todayTip.php">';
                echo '<center><input type="submit" value="이전으로"/></center></form>';
            }
            else if ($category==2){
                echo '<form action="myFarm.php">';
			    echo '<center><input type="submit" value="이전으로"/></center></form>';
            }
            else{
                echo '<form action="together.php">';
			    echo '<center><input type="submit" value="이전으로"/></center></form>';
            }
        ?>
    </section>
</div>
	<!-- Footer -->
	<?php
		require_once("footer.php");
		require_once("script.php");
	?>