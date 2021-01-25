<?php
    require_once("session.php");
    require_once("header.php");
?>
<body>
    <?php
        require_once('dbcon.php');
        $dbc=mysqli_connect($host, $user, $pass, $dbname) or die("Error Connecting to MySQUL Server.");
        mysqli_query($dbc, 'set names utf8');
        $id=$_SESSION['id'];
        $replyid=$_GET['varname'];
        $text=mysqli_real_escape_string($dbc, trim($_POST['replyMemo']));

        $query="UPDATE UserReply SET replyMemo='$text' where replyid='$replyid'";
        $result=mysqli_query($dbc, $query) or die("Error Querying database.");
        mysqli_close($dbc);

        echo "<script language=javascript> alert('댓글이 정상적으로 수정되었습니다!'); history.go(-2); </script>";
        exit;
    ?>
<?php
require_once("footer.php");
require_once("script.php");
?>

</body>