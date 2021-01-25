<style>
    .proFile{
        margin: -8px;
        width: 30px;
        border-radius: 14px;
        border: 3px solid #FFFFFF;
        margin-right: 10px;
    }
</style>
<body class="is-preload">

<!-- Wrapper -->
<div id="wrapper">

    <!-- Header -->
        <header id="header" class="alt">
            <span class="logo"><a href="index.php"><img src="./images/logo.png" alt="" /></a></span>
            <a href="index.php"><h1>농장주의 속닥속닥</h1></a>
            <nav class="move">
                <ul>
                    <?php
                        require_once('dbcon.php');
                        if (!isset($_SESSION['id'])){
                            echo '<li><a href="loginform.html">로그인</a></li>';
                            echo '<li><a href="signupform.html"> 회원가입</a></li>';
                        }
                        else{
                            $userid=$_SESSION['id'];
                            $dbc=mysqli_connect($host, $user, $pass, $dbname) or die("Error Connecting to MySQUL Server.");
                            mysqli_query($dbc, 'set names utf8');
                            $query="select * from UserInfo where id='$userid'";
                            $result=mysqli_query($dbc, $query) or die("Error Querying database.");
                            $row=mysqli_fetch_assoc($result);
                            $userName = $row['NickName'];
                            $userImage = $row['userIMG'];
                            echo "<img class=proFile src='data:image/jpg;base64,".base64_encode($userImage)."' width='300px'>";
                            echo $userName.'님 환영합니다!';
                            echo '<li><a href="logout.php">로그아웃</a></li>';
                        }
                    ?>
                </ul>
            </nav>
        </header>