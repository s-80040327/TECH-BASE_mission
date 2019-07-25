<html>
  <head>
    <meta charset="utf-8">
    <title>mission_4-4</title>
  </head>
  <body>
     <?php
        $dsn = 'データベース名';
	$user = 'ユーザ名';
	$password = 'パスワード';
	$pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));

        
	
        //テーブルの中身を確認するコマンドを使って、意図した内容のテーブルが作成されているか確認する。
        $sql ='SHOW CREATE TABLE tbtest';
	$result = $pdo -> query($sql);
	foreach ($result as $row){
		echo $row[1];
	}
	echo "<hr>";
	
     ?>
  </body>
</html>