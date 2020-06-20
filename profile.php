<?php
include("configure.php");
$link = new PDO('mysql:host=' . $hostname . ';dbname=' . $database . ';charset=utf8', $username, $password);
?>

<html>
<title>北護社群網</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-blue.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
html,
body,
h1,
h2,
h3,
h4,
h5,
p,
button {
    font-family: 微軟正黑體;
    font-weight: 550;
}
</style>

<head>
</head>

<body class="w3-theme-l5">
    <!-- 驗證登入 -->
    <?php
    if (!empty($_COOKIE['id']) && !empty($_COOKIE['pwd'])) {
        $query = 'SELECT * FROM `users` WHERE `ID`="' . $_COOKIE['id'] . '" AND `Pwd`="' . $_COOKIE['pwd'] . '"';
        $result = $link->query($query);
        $row = $result->fetch(PDO::FETCH_ASSOC);
        $profilepic = $row['Photo'];
    } 
    else {
        header("Location: login.php");
    }
    ?>

    <!-- Navbar -->
    <div class="w3-top">
        <div class="w3-bar w3-large w3-theme-d1">
            <div class="w3-bar-item w3-theme-d3 w3-padding-large  w3-border-right">北護社群網</div>
            <button onclick="location.href='https://www.ntunhs.edu.tw/'"
                class="w3-bar-item w3-button w3-padding-large w3-border-right">北護官網</button>
            <button onclick="location.href='https://ilms.ntunhs.edu.tw/'"
                class="w3-bar-item w3-button w3-padding-large  w3-border-right">iLMS</button>
            <button
                onclick="location.href='https://system8.ntunhs.edu.tw/myNTUNHS_student/Modules/Main/Index_student.aspx?first=true'"
                class="w3-bar-item w3-button w3-padding-large  w3-border-right">e-Porfolio</button>
            <!-- 登出網站 在login.php消除cookie -->
            <form action="login.php" method="post">
                <button id="logout" name="logout" class="w3-bar-item w3-button w3-right w3-padding-large">登出</button>
            </form>
        </div>
    </div>

    <!-- Page Container -->
    <div class="w3-container w3-content" style="max-width:1400px;margin-top:80px">
        <!-- The Grid -->
        <div class="w3-row">
            <!-- Left Column -->
            <div class="w3-col m3">
                <!-- Profile -->
                <div class="w3-card w3-round w3-white w3-container w3-center">
                    <?php
                    echo '<p><img src="' . $profilepic . '" class="w3-circle" style="height:106px;width:106px" alt="ProfilePic"></p>';
                    echo '<h4> 嗨!' . $row["Uname"] . '</h4>';
                    ?>
                </div>
                <br>
                <!-- Accordion -->
                <div class="w3-card w3-round">
                    <div class="w3-theme">
                        <button onclick="" class="w3-button w3-block w3-left-align"><i
                                class="fa fa-user fa-fw w3-margin-right "></i>個人資訊</button>
                        <button onclick="location.href='homepage.php'" class="w3-button w3-block w3-left-align "><i
                                class="fa fa-rss fa-fw w3-margin-right"></i>動態時報</button>
                        <button onclick="location.href='album.php'" class="w3-button w3-block w3-left-align"><i
                                class="fa fa-image fa-fw w3-margin-right"></i>我的相簿</button>
                    </div>
                </div>
                <br>

                <!-- NEWS -->
                <div class="w3-card w3-round w3-white w3-center">
                    <div class="w3-container">
                        <p>最新消息</p>
                        <img src="news/news.png" alt="news" style="width:100%;">
                        <p><strong>2020-6-15</strong></p>
                        <p><button
                                onclick="location.href='https://student.ntunhs.edu.tw/files/13-1002-45745.php?Lang=zh-tw'"
                                class="w3-button w3-block w3-theme-l4">Info</button></p>
                    </div>
                </div>
                <!-- End Left Column -->
            </div>

            <!-- Middle Column -->
            <div class="w3-col m9">
                <div class="w3-row-padding">
                    <!-- posts -->
                    <?php
                    // 顯示個人資料
                    echo '<div class="w3-card w3-white w3-round w3-margin-left w3-margin-right w3-margin-bottom"
                    style="padding:10px; display: inline-block;">
                        <div class="w3-half">
                            <img src="' . $profilepic . '" style="width:100%">
                        </div>
                        <div class="w3-half w3-padding">
                            <div class="w3-panel w3-theme">
                                <h4>暱稱
                                <div class="w3-right">' . $row["Uname"] . '</div></h4>
                            </div>

                            <div class="w3-panel w3-theme-d1">
                                <h4>學號
                                <div class="w3-right">' . $row["ID"] . '</div></h4>
                            </div>

                            <div class="w3-panel w3-theme-d2">
                                <h4>密碼
                                <div class="w3-right">' . $row["Pwd"] . '</div></h4>
                            </div>

                            <div class="w3-panel w3-theme-d3">
                                <h4>電子郵件
                                <div class="w3-right">' . $row["Email"] . '</div></h4>
                            </div>

                            <div class="w3-panel w3-red">
                                <form action="login.php" method="post" class=" w3-center">
                                    <h4><button id="delacc" name="delacc" class="w3-button">刪除帳號</button></h4>
                                </form>
                            </div>
                        </div>
                    </div>';
                    ?>
                </div>
                <!-- End Middle Column -->
            </div>
            <!-- End Grid -->
        </div>

        <!-- End Page Container -->
    </div>
    <br>

    <!-- Footer -->
    <footer class="w3-container w3-theme-d5">
        <p>Created by 072214117 蘇寄屏</p>
    </footer>
</body>

</html>