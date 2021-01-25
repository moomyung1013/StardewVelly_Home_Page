<?php
    require_once("session.php");
    require_once("header.php");
?>
<body>
    <?php
        require_once('dbcon.php');
        
        if (empty($_POST['memo'])) {
            echo "<script language=javascript> alert('댓글폼을 모두 채워주세요!'); location.replace(history.go(-1)); </script>";
            exit;
        }
        $dbc=mysqli_connect($host, $user, $pass, $dbname) or die("Error Connecting to MySQUL Server.");
        $memo=mysqli_real_escape_string($dbc, trim($_POST['memo']));
        $writeid=mysqli_real_escape_string($dbc, trim($_POST['writeid']));
        $userindex=$_SESSION['id'];

        if (mysqli_real_escape_string($dbc, trim($_POST['chk_info']))=="tip")
            $category=1;
        else if (mysqli_real_escape_string($dbc, trim($_POST['chk_info']))=="farm")
            $category=2;
        else
            $category=3;
        
        mysqli_query($dbc, 'set names utf8');
        $query="insert into UserReply values(null, '$writeid', '$userindex', '$category', '$memo', NOW())";
        $result=mysqli_query($dbc, $query) or die("Error Querying database.");
        mysqli_close($dbc);

        echo "<script language=javascript> alert('댓글이 정상적으로 등록되었습니다!'); location.replace(history.go(-1)); </script>";
        exit;
    ?>
	<?php
		require_once("footer.php");
		require_once("script.php");
	?>