<?php
include("configure.php");
$link = new PDO('mysql:host=' . $hostname . ';dbname=' . $database . ';charset=utf8', $username, $password);
?>

<html>
<title>北護社群網</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- 匯入w3schools的css檔 -->
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

<!-- 設定警告訊息 -->

<head>
    <script type="text/javascript">
    function F_Open_dialog() {
        document.getElementById("file").click();
    }

    function F_alert(n) {
        if (n == 0)
            alert("選取成功");
        else if (n == 1)
            alert("發布成功");
        else if (n == 2)
            alert("圖片上傳失敗!! 僅接受jpg,jpeg檔案");
        else if (n == 3)
            alert("發生錯誤!");
    }
    </script>
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
                    // 讀取個人圖片
                    echo '<p><img src="' . $profilepic . '" class="w3-circle" style="height:106px;width:106px" alt="ProfilePic.png"></p>';
                    echo '<h4> 嗨!' . $row["Uname"] . '</h4>';
                    ?>
                </div>
                <br>
                <!-- Accordion -->
                <div class="w3-card w3-round">
                    <div class="w3-theme">
                        <button onclick="location.href='profile.php'" class="w3-button w3-block w3-left-align"><i
                                class="fa fa-user fa-fw w3-margin-right "></i>個人資訊</button>
                        <button onclick="location.href='homepage.php'" class="w3-button w3-block w3-left-align "><i
                                class="fa fa-rss fa-fw w3-margin-right"></i>動態時報</button>
                        <button onclick="location.href='album.php'" class="w3-button w3-block w3-left-align"><i
                                class="fa fa-image fa-fw w3-margin-right"></i>我的相簿</button>
                    </div>
                </div>
                <br>

                <!-- NEWS -->
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
                    <div class="w3-col m12">
                        <div class="w3-card w3-round w3-white">
                            <div class="w3-container w3-theme-l4">
                                <h5>撰寫貼文</h5>
                            </div>
                            <form method="post" enctype="multipart/form-data">
                                <textarea id="txtarea" name="txtarea" rows="2" placeholder="在想些什麼呢？" required="required"
                                    style="resize:none; width:100%; border: 0; padding-left: 16px; padding-top: 6px; font-weight:500;"></textarea>
                                <input type="file" id="file" name="file" onchange="F_alert(0)" style="display:none">
                                <button type="button" onclick="F_Open_dialog()"
                                    class="w3-button w3-theme w3-round-xxlarge" style="margin:10px 10px;"><i
                                        class="fa fa-upload fa-fw"></i> 上傳圖片</button>
                                <button type="submit" id="submit" name="submit"
                                    class="w3-button w3-theme w3-round-xxlarge"><i class="fa fa-pencil fa-fw"></i>
                                    發布</button>
                            </form>
                            <?php
                            // 發文 分為有圖片及無圖片 將資料輸入資料庫
                            if (isset($_POST['submit'])) {
                                // 檢查圖片是否為指定檔案格式
                                if (($_FILES["file"]["type"] == "image/jpeg") || ($_FILES["file"]["type"] == "image/jpg") && ($_FILES["file"]["size"] < 200000)) {
                                    // 將文章圖片的檔名設成與文章id一樣 並且保存到本機
                                    $query = 'SELECT MAX(pID)+1 FROM `posts`';
                                    $result = $link->query($query);
                                    $row = $result->fetch(PDO::FETCH_ASSOC);
                                    $filetype = explode(".", $_FILES["file"]["name"]);
                                    $newfilename = "upload_pic/" . $row["MAX(pID)+1"] . "." . $filetype[1];
                                    move_uploaded_file(
                                        $_FILES["file"]["tmp_name"],
                                        $newfilename
                                    );
                                    // 將文章資訊及圖片檔案位址寫入資料庫
                                    $query = 'INSERT INTO `posts` (`ID`, `pID`, `pText`, `pPic`, `pTime`) VALUES ("' . $_COOKIE['id'] . '", NULL, "' . nl2br($_POST['txtarea']) . '","' . $newfilename . '",current_timestamp())';
                                    $result = $link->exec($query);
                                    echo "<script type='text/javascript'>F_alert(1);</script>";
                                } 
                                else if ($_FILES["file"]["error"] > 0) //沒有讀取到圖片 以純文字發布
                                {
                                    // 寫入資料庫
                                    $query = 'INSERT INTO `posts` (`ID`, `pID`, `pText`, `pPic`, `pTime`) VALUES ("' . $_COOKIE['id'] . '", NULL, "' . nl2br($_POST['txtarea']) . '","NULL",current_timestamp())';
                                    $result = $link->exec($query);
                                    echo "<script type='text/javascript'>F_alert(1);</script>";
                                } 
                                else  //發生錯誤
                                {
                                    echo "<script type='text/javascript'>F_alert(3);</script>";
                                }
                                echo '<meta http-equiv="refresh" content="0">';
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <!-- posts -->
                <?php
                // 從資料庫抓出所有文章
                $query = "SELECT * FROM `posts` JOIN `users` ON `posts`.`ID`=`users`.`ID` ORDER BY `pID` DESC";
                $result = $link->query($query);
                foreach ($result as $row) {
                    echo '<div class="w3-container w3-card w3-white w3-round w3-margin"><br>
                        <img src="' . $row['Photo'] . '" alt="ProfilePic.png" class="w3-left w3-circle w3-margin-right" style="width:50px">
                        <div class="w3-right">
                            <span class=" w3-opacity">' . $row['pTime'] . '</span>';
                    // 如果是本帳號發的文章 顯示刪除文章按鈕
                    if ($row['ID'] == $_COOKIE['id']) {
                        echo '<br>
                        <form method="post">
                                <input type="hidden" name="del_pid" id="del_pid" value="' . $row['pID'] . '">
                            <button type="submit" id="pdel" name="pdel" class="w3-right w3-margin-top">刪除貼文</button>
                        </form>';
                    }
                    echo '</div>
                        <h4>' . $row['Uname'] . '</h4>
                        <p style="font-size: 25px;">' . $row['pText'] . '</p>';
                    // 以上先顯示出文章 再檢查文章有沒有附圖
                    if ($row['pPic'] != 'NULL') {
                        echo '<div class="w3-row-padding" style="margin:0 -16px">
                            <img src="' . $row['pPic'] . '" style="width:30%" alt="img" class="w3-margin-bottom">
                        </div>';
                    }
                    echo '<hr>';
                    //抓出留言
                    $query2 = "SELECT * FROM `comment` JOIN `users` ON `comment`.`ID`=`users`.`ID` WHERE `comment`.`pID`=" . $row['pID'] . " ORDER BY `cID` ASC";
                    $result2 = $link->query($query2);
                    foreach ($result2 as $row2)                            // 同 while ($row = $result->fetch())
                    {
                        echo '<div class="w3-bar w3-light-grey w3-round-xxlarge" style="line-height:35px">
                                <img src="' . $row2['Photo'] . '" class="w3-bar-item w3-circle" style="height:50px">
                                <span class="w3-bar-item w3-text-blue">' . $row2['Uname'] . '</span>   
                                <span class="w3-bar-item">' . $row2['cText'] . '</span>
                                <span class="w3-bar-item w3-right w3-opacity">' . $row2['cTime'] . '</span>   
                            </div>
                            <br>';
                    }
                    //新增留言的表單
                    echo '
                        <form class="w3-bar" method="post" style="height:60px">
                                <input type="hidden" name="C_pid" id="C_pid" value="' . $row['pID'] . '">
                            <img src="' . $profilepic . '" alt="img" class="w3-bar-item w3-circle" style="height:50px;">
                            <input class="w3-bar-item w3-input w3-round-large w3-light-grey" type="text" id="input_C" name="input_C" placeholder="留個言吧..." style="width:76%; height:50px; font-weight:500;">
                            <button type="submit" id="submit_C" name="submit_C" class="w3-button  w3-bar-item" style="width:15%; height:50px;"><i class="fa fa-comment" ></i>  留言  </button>
                        </form> 
                    </div>';
                }
                // 加入留言
                if (isset($_POST['C_pid']) && $_POST["C_pid"] != "") {
                    $query = 'INSERT INTO `comment` (`ID`, `pID`, `cID`, `cText`, `cTime`) VALUES ("' . $_COOKIE['id'] . '", "' . $_POST['C_pid'] . '", NULL, "' . $_POST['input_C'] . '", current_timestamp())';
                    $result = $link->exec($query);
                    echo '<meta http-equiv="refresh" content="0">';
                }
                // 文章主人可以刪除自己的文章 先將資料庫裡對這篇文章的留言刪除 再刪除整個文章
                if (isset($_POST['del_pid']) && $_POST["del_pid"] != "") {
                    // 刪除本機文章圖片
                    $query = 'SELECT * FROM `posts` WHERE `posts`.`pID` = ' . $_POST['del_pid'];
                    $result = $link->query($query);
                    $row = $result->fetch(PDO::FETCH_ASSOC);
                    unlink($row['pPic']);
                    
                    $query = 'DELETE FROM `comment` WHERE `comment`.`pID` = ' . $_POST['del_pid'];
                    $result = $link->exec($query);
                    $query = 'DELETE FROM `posts` WHERE `posts`.`pID` = ' . $_POST['del_pid'];
                    $result = $link->exec($query);
                    echo '<meta http-equiv="refresh" content="0">';
                }
                ?>
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