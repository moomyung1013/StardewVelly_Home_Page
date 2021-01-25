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
        
        $writeid=$_GET['varname'];
        $title=mysqli_real_escape_string($dbc, trim($_POST['title']));
        $content=mysqli_real_escape_string($dbc, trim($_POST['content']));
        if (isset($_FILES['img'])) { 
			$writeIMG=addslashes(file_get_contents($_FILES['img']['tmp_name']));
        }

        if (isset($_FILES['img'])) { 
            $query="UPDATE UserWrite SET writeTitle='$title', writeMemo='$content', picture='$writeIMG' where writeid='$writeid'";
        }
        else
            $query="UPDATE UserWrite SET writeTitle='$title', writeMemo='$content' where writeid='$writeid'";
        
        $result=mysqli_query($dbc, $query) or die("Error Querying database.");
        mysqli_close($dbc);

        echo "<script language=javascript> alert('게시글이 정상적으로 수정되었습니다!'); location.replace('index.php'); </script>";
        exit;
    ?>
	<?php
		require_once("footer.php");
		require_once("script.php");
	?>