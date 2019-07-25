<html>
  <head>
    <meta charset="utf-8">
    <title>mission_4-6</title>
  </head>
  <body>
     <?php
        //データベースへの接続を行う
        $dsn = 'データベース名';
	$user = 'ユーザ名';
	$password = 'パスワード';
	$pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));


        //入力したデータをselectによって表示する
	//$rowの添字（[ ]内）は4-2でどんな名前のカラムを設定したかで変える必要がある。
	$sql = 'SELECT * FROM tbtest';
	$stmt = $pdo->query($sql);
	$results = $stmt->fetchAll();
	foreach ($results as $row){
		//$rowの中にはテーブルのカラム名が入る
		echo $row['id'].',';
		echo $row['name'].',';
		echo $row['comment'].'<br>';
	echo "<hr>";
	}


	/*
	$result = $pdo->query($sql);を利用する方法もありますが、変数の値を直接SQL文に埋め込むのはとても危険！
	やめましょう。
	詳しく知りたい人はSQLインジェクションで検索を！*/

	
     ?>
  </body>
</html>