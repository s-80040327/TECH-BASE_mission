<html>
  <head>
    <meta charset="utf-8">
    <title>mission_4-1</title>
  </head>
  <body>
     <?php
        $dsn = '�f�[�^�x�[�X��';
	$user = '���[�U��';
	$password = '�p�X���[�h';
	$pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));

        $sql = "CREATE TABLE IF NOT EXISTS tbtest"
	." ("
	. "id INT AUTO_INCREMENT PRIMARY KEY,"
	. "name char(32),"
	. "comment TEXT"
	.");";
	$stmt = $pdo->query($sql);
	
      

     ?>
  </body>
</html>