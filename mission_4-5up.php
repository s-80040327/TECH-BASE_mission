<html>
  <head>
    <meta charset="utf-8">
    <title>mission_4-5</title>
  </head>
  <body>
     <?php
        //データベースへの接続を行う
        $dsn = 'データベース名';
	$user = 'ユーザ名';
	$password = 'パスワード';
	$pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));

	
        //作成したテーブルに、insertを行ってデータを入力する。 
	//bindParamの引数（:nameなど）は4-2でどんな名前のカラムを設定したかで変える必要がある。
	//なお、意図通り入力が出来ているかどうかは4-6にて確認できる。
	$sql = $pdo -> prepare("INSERT INTO tbtest (name, comment) VALUES (:name, :comment)");
	$sql -> bindParam(':name', $name, PDO::PARAM_STR);
	$sql -> bindParam(':comment', $comment, PDO::PARAM_STR);
	$name = '花子';
	$comment = 'おはよう'; //好きな名前、好きな言葉は自分で決めること
	$sql -> execute();
	
     ?>
  </body>
</html>