<html>
  <head>
    <meta charset="utf-8">
    <title>mission_4-3</title>
  </head>
  <body>
     <?php
        //データベースへの接続を行う
        $dsn = 'データベース名';
	$user = 'ユーザ名';
	$password = 'パスワード';
	$pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));

        
	
        //テーブル一覧を表示するコマンドを使って作成が出来たか確認する。
        $sql ='SHOW TABLES';
	$result = $pdo -> query($sql);
	foreach ($result as $row){
		echo $row[0];
		echo '<br>';
	}
	echo "<hr>";
	


     ?>
  </body>
</html>