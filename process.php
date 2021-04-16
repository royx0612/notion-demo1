
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>帳號登入表單 - 處理器</title>
</head>
<body>
  <?php
  date_default_timezone_set('Asia/Taipei');


# 表單傳送到後端，會依據前端表單 method 的方法參數決定後端的接受變數
# 前端 method = "post" 對應 後端 $_POST
# 前端 method = "get" 對應 後端 $_GET
# $_GET 或 $_POST 變數皆為「陣列」，所有的表單內容資料都會放在裡面
# GET 與 POST 無法同時使用。

// 當前範例的 method 為 post，因此取用 $_POST
$username = $_POST['username']; // 取得表單 username 的內容 
$password = $_POST['password']; // 取得表單 password 的內容

$username = trim($username); //將 $username 的前後空白去除掉

# 檢查帳號是否有輸入內容
if(strlen($username) == 0){ // 檢查 $username 的長度
  // 列印錯誤訊息，提供連接反登入頁面
  printf("
    <p>錯誤：請輸入帳號</p>
    <a href='%s'>回登入頁面</a>
  ", "index.php"
  );

# 檢查密碼是否有輸入內容
}elseif(strlen($password) == 0){ // 檢查 $password 的長度
  // 列印錯誤訊息，提供連接反登入頁面
  printf("
    <p>錯誤：請輸入密碼</p>
    <a href='%s'>回登入頁面</a>
  ", "index.php"
  );
}else{
  # 檢查完輸入內容，開始進入正事啦...
  # 這邊的 $datas 是模擬資料庫內容，為2維陣列
  # 每一筆資料皆有兩個內容，分別為 username 及 password
  $datas = [
    ['username' => 'admin', 'password' => 'admin'],
    ['username' => 'amy', 'password' => 'beautiful'],
    ['username' => 'bob', 'password' => 'handsome'],
    ['username' => 'user', 'password' => 'user']  
  ];

  # 接下來要將使用者輸入的資料與資料庫做比對
  # 若輸入的帳號及密碼在資料庫比對相符
  # 就顯示登入成功訊息

  // 設定一個登入狀態變數，預設為 false（也就是尚未登入）
  $isLogin = false; 

  #用回圈進行資料庫比對
  foreach ($datas as $data) { // $data 就是一筆筆的資料
    # 用 if 判斷帳號及密碼是否完全符合
    if($username == $data['username'] && $password == $data['password']){
      $isLogin = true; //設定登入狀態為 true（已登入）
      break; // 因為比對到資料，所以跳出回圈（剩下的不用再跑了）
    }
  }

  # 這邊要顯示訊息，不管是登入成功或失敗，都應該要給使用者訊息
  if($isLogin){ // 登入成功
    // 顯示歡迎訊息及登入時間
    printf(" 
      <p>%s 您好，歡迎回來～<p>
      <p>登入時間：%s<p>
    ", $username, date('m月d日H點i分'));
  }else{ // 登入失敗
    // 顯示錯誤訊息，提供連結回上一頁
    printf("
      <p>錯誤：帳號或密碼輸入錯誤！</p>
      <a href='%s'>回登入頁面</a>
    ", "index.php"
    );
  }
}
  ?>
</body>
</html><?php
  
?>