<?php
    require_once("session.php");
    require_once("header.php");
?>
<body>
    <?php
        require_once('dbcon.php');
        if (empty($_POST['title']) || empty($_POST['content']) || empty($_POST['chk_info'])) {
            echo "<script language=javascript> alert('폼을 모두 채워주세요!'); location.replace(history.go(-1)); </script>";
            exit;
        }
        $dbc=mysqli_connect($host, $user, $pass, $dbname) or die("Error Connecting to MySQUL Server.");
        mysqli_query($dbc, 'set names utf8');
        $id=$_SESSION['id'];
        $title=mysqli_real_escape_string($dbc, trim($_POST['title']));
        $content=mysqli_real_escape_string($dbc, trim($_POST['content']));
        if (isset($_FILES['img'])) { 
			$writeIMG=addslashes(file_get_contents($_FILES['img']['tmp_name']));
        }

        if (mysqli_real_escape_string($dbc, trim($_POST['chk_info']))=="tip")
            $category=1;
        else if (mysqli_real_escape_string($dbc, trim($_POST['chk_info']))=="farm")
            $category=2;
        else
            $category=3;
        
        if (isset($_FILES['img'])) { 
            $query="insert into UserWrite values(null, '$category', $id, '$writeIMG', '$title', '$content', NOW())";
        }
        else
            $query="insert into UserWrite values(null, '$category', $id, null, '$title', '$content', NOW())";
        
        $result=mysqli_query($dbc, $query) or die("Error Querying database.");
        mysqli_close($dbc);

        echo "<script language=javascript> alert('게시글이 정상적으로 등록되었습니다!'); location.replace('index.php'); </script>";
        exit;
    ?>
	<?php
		require_once("footer.php");
		require_once("script.php");
	?>