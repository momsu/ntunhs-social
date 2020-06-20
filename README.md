---構想---
創建一個屬於北護人使用的社群網站，包括發文、發照片、留言等基本社群網站功能

---php檔案---
1. login.php 登入頁面
2. register.php 註冊頁面
3. homepage.php 主頁面
4. album.php 個人相簿
5. profile.php 個人資訊
6. configure.php 設定檔

---資料庫---
FinalDB
1. users 紀錄使用者帳號密碼及基本資訊
2. posts 紀錄使用者的貼文 以使用者帳號與users關聯
3. comment 記錄使用者對貼文的留言 以使用者帳號與users關聯 以文章編號與posts關聯

---其他---
1. style.css 用於保存登入及註冊介面的樣式
2. upload 資料夾用於保存使用者大頭貼照
3. upload_pic 資料夾用於保存貼文的附圖
4. new 資料夾用於保存學校最新消息的圖片