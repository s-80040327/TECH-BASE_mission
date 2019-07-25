<html>
  <head>
    <meta charset="utf-8">
    <title>mission_4-1</title>
  </head>
  <body>
     <?php
        $dsn = 'データベース名';
	$user = 'ユーザ名';
	$password = 'パスワード';
	$pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));

       
      

     ?>
  </body>
</html>