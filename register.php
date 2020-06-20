<?php
include("configure.php");
$link = new PDO('mysql:host=' . $hostname . ';dbname=' . $database . ';charset=utf8', $username, $password);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>註冊帳號</title>
  <link rel="stylesheet" href="./style.css">
  <!-- 設定警告訊息 -->
  <script type="text/javascript">
    function F_Open_dialog() {
      document.getElementById("file").click();
    }

    function F_alert(n) {
      if (n == 0)
        alert("選取成功");
      else if (n == 1)
        alert("註冊成功");
      else if (n == 2)
        alert("圖片上傳失敗!! 僅接受jpg,jpeg檔案");
      else if (n == 3)
        alert("帳號已存在");
      else if (n == 4)
        alert("發生錯誤!");
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
  <div class="form2 form-panel">
    <div class="form-header">註冊帳號</div>
    <div class="form-content">
      <form action="register.php" method="post" enctype="multipart/form-data">
        <div class="form-group">
          <label>暱稱</label>
          <input type="text" id="uname" name="uname"" required=" required" />

          <label>學號</label>
          <input type="text" id="id" name="id" required="required" />

          <label>密碼</label>
          <input type="password" id="pwd" name="pwd" required="required" />

          <label>電子郵件</label>
          <input type="email" id="email" name="email" required="required" />

          <label>大頭貼(請選擇正方形圖片)</label>
          <input type="file" id="file" name="file" onchange="F_alert(0)" style="display:none" required="required">
          <button type="button" onclick="F_Open_dialog()"">上傳圖片</button>
                <button type=" submit" id="submit" name="submit">註冊</button>
          <a class="form-foot" href="login.php"">已經有帳號了？</a>
        </div>
      </form>
      <?php
      if (isset($_POST['submit'])) {
        echo '<div class="form-group">';
        if (($_FILES["file"]["type"] == "image/jpeg") || ($_FILES["file"]["type"] == "image/jpg") && ($_FILES["file"]["size"] < 200000)) {
          if ($_FILES["file"]["error"] > 0) {
            echo "<script type='text/javascript'>F_alert(4);</script>"; //發生錯誤
          } else {
            // 註冊帳號時將大頭貼照片檔名設定成使用者的學號
            // 因此在檢查是否重複申請帳號時只要檢查相同檔名是否存在
            $filetype = explode(".", $_FILES["file"]["name"]);
            $newfilename = "upload/" . $_POST["id"] . "." . $filetype[1];
            if (file_exists($newfilename)) {
              echo "<script type='text/javascript'>F_alert(3);</script>"; //帳號已存在
            } else {
              move_uploaded_file(
                $_FILES["file"]["tmp_name"],
                $newfilename
              );
              $query = 'INSERT INTO `users`(`Uname`,`ID`, `Pwd`, `Email`, `Photo`) VALUES ("' . $_POST["uname"] . '","' . $_POST["id"] . '","' . $_POST["pwd"] . '","' . $_POST["email"] . '","' . $newfilename . '")';
              $result = $link->exec($query);
              echo "<script type='text/javascript'>F_alert(1);</script>"; //註冊成功
            }
          }
        } else {
          echo "<script type='text/javascript'>F_alert(2);</script>"; //上傳失敗後顯示錯誤資訊
        }
        echo '</div>';
      }
      ?>
  </div>
  </div>
</body>
</html>