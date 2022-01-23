

<?php
//1.  DB接続します
try {
  //Password:MAMP='root',XAMPP=''
  $pdo = new PDO('mysql:dbname=akisaku_test0123;charset=utf8;host=mysql745.db.sakura.ne.jp','akisaku','xxxx');
} catch (PDOException $e) {
  exit('DBConnectError:'.$e->getMessage());
}

//２．SQL文を用意(データ取得：SELECT)
$stmt = $pdo->prepare("SELECT * FROM `gs_db_talk_table`");

//3. 実行
$status = $stmt->execute();

//4．データ表示
$view="";
if($status==false) {
    //execute（SQL実行時にエラーがある場合）
  $error = $stmt->errorInfo();
  exit("ErrorQuery:".$error[2]);

}else{
  //Selectデータの数だけ自動でループしてくれる
  //FETCH_ASSOC=http://php.net/manual/ja/pdostatement.fetch.php
  while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){ 
    if($result['name']=="akira"){
        $view .="<div id='mymessagediv'>";
        $view .='<div id="myname">';
        $view .=($result['name']);
        $view .='</div>';
        $view .='<div id="mymsgdelete">';
        $view .='<div id="mymessage">';
        $view .=($result['message']);
        $view .='</div>';
        $view .='<button id="delete" class="';
        $view .='*key*';
        $view .='">削除</button>';
        $view .='<button id="transl" class="';
        $view .=($result['message']);
        $view .='">翻訳</button>';            
        $view .='</div>';
        $view .='<div id="mydate">';
        $view .=($result['indate']);
        $view .='</div></div>';
    }else{
        $view .="<div id='othermessagediv'>";
        $view .='<div id="othername">';
        $view .=($result['name']);
        $view .='</div>';
        $view .='<div id="othermsgdelete">';
        $view .='<div id="othermessage">';
        $view .=($result['message']);
        $view .='</div>';
        $view .='<button id="delete" class="';
        $view .='*key*';
        $view .='">削除</button>';
        $view .='<button id="transl" class="';
        $view .=($result['message']);
        $view .='">翻訳</button>';            
        $view .='</div>';
        $view .='<div id="otherdate">';
        $view .=($result['indate']);
        $view .='</div></div>';
    }
  }
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">  
<script src="https://cdn.webrtc.ecl.ntt.com/skyway-4.4.3.js"></script> 


<title>ラインアプリ（PHP&DB版）</title>
<link rel="stylesheet" href="reset.css">
<link rel="stylesheet" href="style.line.css">
</head>
<body>

<!-- コンテンツ表示画面 -->

<div class="head">ラインアプリ（PHP&DB版）</div>
<div>
    <div id="outputframe"><div id="output" ><?=$view?></div></div>
    <form method="post" action="insert2.sakura.php">
        <div id="inputarea">
            <div>
                <input type="text" id="uname" name="name" placeholder="name">
            </div>
            <div>
                <textarea  id="text" name="message" cols="30" rows="10"placeholder="message"></textarea>
                <button id="send">send</button>
            </div>
        </div>
    </form>
    <div id="idarea">
        <p>Your ID：　　</p>
        <p id="my-id"></p>
    </div>
    <br>
</div>
<div id="talkarea">
    <button id="talk">Video Mode</button>
    <button id="make-call">CALL</button>
</div>
<br>
<br>
<button id="allDelete">all delete</button>


<!--/ コンテンツ表示画面 -->









<!-- JQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<!-- JQuery -->
<script>
    $("#output").scrollTop(999999999);
</script>

<!--** 以下Firebase **-->
<script type="module">


//ページ更新時の自分の名前プリセット
    let namae=localStorage.getItem("ラインアプリ名前");
    //console.log(namae);
    $("#uname").val(namae);

  </script>


</body>
</html>
































