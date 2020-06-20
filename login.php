<?php
include("configure.php");
$link = new PDO('mysql:host=' . $hostname . ';dbname=' . $database . ';charset=utf8', $username, $password);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>登入頁面</title>
  <link rel="stylesheet" href="./style.css">
  <!-- 設定警告訊息 -->
  <script type="text/javascript">
    function F_alert() {
      alert("帳號或密碼錯誤!");
    }
  </script>
</head>

<body>
  <?php
  // 若已經登入直接導向主頁面
  if (!empty($_COOKIE['id']) && !empty($_COOKIE['pwd'])) {
    header("Location: homepage.php");
  }
  ?>
  <div class="form">
    <div class="form-panel">
      <div class="form-header">北護社群網</div>
      <div>
        <form action="login.php" method="post">
          <div class="form-group">
            <label>學號</label>
            <input type="text" id="id" name="id" required="required" />
            <label>密碼</label>
            <input type="password" id="pwd" name="pwd" required="required" />
            <a class="form-foot" href="register.php">註冊帳號</a>
            <a class="form-foot" href="#">忘記密碼？</a>
            <button type="submit" id="submit" name="submit">登入</button>
          </div>
        </form>
        <?php
        if (isset($_POST['submit'])) {
          $query = 'SELECT * FROM `users` WHERE `ID`="' . $_POST['id'] . '" AND `Pwd`="' . $_POST['pwd'] . '"';

          $result = $link->query($query);
          $row = $result->fetch(PDO::FETCH_ASSOC);
          if ($row) {
            // 登入成功後以cookie方式保持登入狀態 設定六小時時限
            setcookie("id", $_POST['id'], time() + 3600 * 6);
            setcookie("pwd", $_POST['pwd'], time() + 3600 * 6);
            header("Location: homepage.php");
          } else {
            echo "<script type='text/javascript'>F_alert();</script>"; //帳密錯誤
          }
        }
        if (isset($_POST['logout'])) {
          // 登出後將cookie設為空值
          setcookie("id", "", time());
          setcookie("pwd", "", time());
        }
        if (isset($_POST['delacc'])) {
          // 刪除帳號
          // 刪除帳號的留言
          $query = 'DELETE FROM `comment` WHERE `ID` = "' . $_COOKIE['id'] . '"';
          $result = $link->exec($query);
          // 刪除其他帳號對此帳號文章的留言
          $query = 'DELETE `comment` FROM `comment` JOIN `posts` ON `posts`.`pID` = `comment`.`pID` WHERE `posts`.`ID` = "' . $_COOKIE['id'] . '"';
          $result = $link->exec($query);
          // 刪除本機文章圖片
          $query = 'SELECT * FROM `posts` WHERE `posts`.`ID`="' . $_COOKIE['id'] . '"';
          $result = $link->query($query);
          foreach ($result as $row) {
            unlink($row['pPic']);
          }
          // 刪除文章
          $query = 'DELETE FROM `posts` WHERE `ID` = "' . $_COOKIE['id'] . '"';
          $result = $link->exec($query);
          // 刪除大頭貼
          $query = 'SELECT * FROM `users` WHERE `ID`="' . $_COOKIE['id'] . '"';
          $result = $link->query($query);
          $row = $result->fetch(PDO::FETCH_ASSOC);
          unlink($row['Photo']);
          // 刪除帳號資訊
          $query = 'DELETE FROM `users` WHERE `ID` = "' . $_COOKIE['id'] . '"';
          $result = $link->exec($query);

          setcookie("id", "", time());
          setcookie("pwd", "", time());
        }
        ?>
      </div>
    </div>
  </div>
</body>
</html>