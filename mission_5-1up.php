<html>
	<head>
	<meta charset="utf-8">
	<title>mission_5-1</title>
	</head>
	<body bgcolor = "#e6e6fa" text = "#191970" >
		<font size = "6" color = "#4b0082" >投稿フォーム～行きたい場所～</font><br><br>
		今行きたい場所についてのコメントと名前、好きなパスワードを入力し、送信ボタンを押してください。<br>
		投稿番号と設定したパスワードを入力することにより、削除や編集も行うことが出来ます。<br><br>
    		<?php
			//データベースへの接続を行う
			$dsn = 'データベース';
			$user = 'ユーザ名';
			$password = 'パスワード';
			$pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));

                        $sql = "CREATE TABLE IF NOT EXISTS newtable"
                	." ("
	                . "number INT AUTO_INCREMENT PRIMARY KEY,"
	                . "name char(32),"
	                . "comment TEXT,"
                        . "datetime DATETIME,"
                        . "password char(30)"
	                .");";
	                $stmt = $pdo->query($sql);

                        //mission完了したらコメントアウトして消す
                        //$sql ='SHOW CREATE TABLE newtable';
                  	//$result = $pdo -> query($sql);
	                //foreach ($result as $row){
		        //   echo $row[1];
	                //}
	                //echo "<hr>";
	

	
    			$name1 = "";
			$comment1 = "";
			$editnumber1 = "";
			$editcheck = "";
			if(isset($_POST["edit"]) && $_POST["edit"] != "" && $_POST["pass3"] != ""){       //入力して編集ボタンを押したとき	
				$sql = 'SELECT * FROM newtable';
				$stmt = $pdo->query($sql);
				$results = $stmt->fetchAll();
				if(count($results) != 0){
					$pass3 = "";
                     			foreach ($results as $word){
						if($word['number'] == $_POST["edit"]){
							$pass3 = $word[4];
						}
                       			}
					if($pass3 == ""){
						$editcheck = 3;
					}elseif($pass3 !== $_POST["pass3"]){
						$editcheck = 1;
					}else{	
                    				foreach ($results as $word){
                       					if($_POST["edit"] == $word['number']){    //編集する投稿番号を一致するものを発見
                           					$name1 =  $word['name'];
								$comment1 = $word['comment'];
								$editnumber1 = $word['number'];
           						}
						}
					}	
				}else{
					$editcheck = 2;
				}				
			}
		?>
		<font size = "4" color = "#4b0082">送信用</font><br>
		<form method="POST" action="mission_5-1.php">
        		お名前　　：<input type = "text" name = "name" size = "20" value = "<?php echo $name1; ?>"><br>
        		コメント　：<textarea name="comment" rows = "3" cols = "19"><?php echo $comment1; ?></textarea>
                        　　　　　<input type = "hidden" name = "editnumber" value = "<?php echo $editnumber1; ?>"><br>
			パスワード：<input type = "password" name = "pass1" size = "20">
			<input type="submit" value="送信"><br><br>
    		</form> 
		<font size = "4" color = "#4b0082">削除用</font><br>
		<form method="POST" action="mission_5-1.php">
        		削除番号　：<input type = "text" name = "delete" size = "2"><br>
			パスワード：<input type = "password" name = "pass2" size = "20">
			<input type="submit" value="削除"><br><br>
        	</form> 
		<font size = "4" color = "#4b0082">編集用</font><br>
                <form method="POST" action="mission_5-1.php">
        		編集番号　：<input type = "text" name = "edit" size = "2"><br>
			パスワード：<input type = "password" name = "pass3" size = "20">
			<input type="submit" value="編集"><br><br>
		</form>
		<?php
       			

                	if((!isset($_POST["comment"])) && (!isset($_POST["delete"])) && (!isset($_POST["edit"]))){          //最初にページを開いたときの指示
                		echo "入力してください.。<br>";
				$sql = 'SELECT * FROM newtable';
				$stmt = $pdo->query($sql);
				$results = $stmt->fetchAll();
				if(count($results) != 0){                 //テーブルに入力されている場合
					echo "<br>履歴<br>";
					foreach ($results as $row){
					//$rowの中にはテーブルのカラム名が入る
						echo $row['number'].',';
						echo $row['name'].',';
						echo $row['comment'].',';
						//echo $row['password'].',';            // パスワードがわからなくなったらコメントアウト消す
						echo $row['datetime'].'<br>';
						echo "<hr>";             //水平線を入れるタグ
					}
				}else{
					echo "投稿はありません。";
				}
       			}elseif(isset($_POST["editnumber"]) && $_POST["editnumber"]==""){                    //送信ボタンが押されているが、編集ではないとき
          			$name = $_POST["name"];
          			$comment =  $_POST["comment"];
				$pass1 = $_POST["pass1"];
				$date = date("Y/m/d H:i:s");
          			$special = "完成！";
             			if($name == "" || $comment == "" || $pass1 == ""){
                			echo "お名前とコメント、パスワードが入力されていません。<br>";
             			}else{
                			if($comment == $special){        //指定した言葉が入力されたときの反応
                   				echo "おめでとう！<br>";
                			}else{
                   				echo $name."様、" .$comment."を受け付けました<br>";
                			}
                			$sql = 'SELECT * FROM newtable';
					$stmt = $pdo->query($sql);
					$results = $stmt->fetchAll();
					if(count($results) != 0){
                     				foreach ($results as $word){
                       					$number = $word['number'] + 1;
                       				}
                			}else{
                     				$number = 1;
                			}
					$sql = $pdo -> prepare("INSERT INTO newtable (number, name, comment, datetime, password) VALUES (:number, :name, :comment, :date, :password)");
					$sql -> bindParam(':number', $number, PDO::PARAM_INT);
					$sql -> bindParam(':name', $name, PDO::PARAM_STR);
					$sql -> bindParam(':comment', $comment, PDO::PARAM_STR);
					$sql -> bindParam(':date', $date, PDO::PARAM_STR);
					$sql -> bindParam(':password', $pass1, PDO::PARAM_STR);				
					$sql -> execute();	
				}
				$sql = 'SELECT * FROM newtable';
				$stmt = $pdo->query($sql);
				$results = $stmt->fetchAll();
				if(count($results) != 0){                 //テーブルに入力されている場合
					echo "<br>履歴<br>";
					foreach ($results as $row){
					//$rowの中にはテーブルのカラム名が入る
						echo $row['number'].',';
						echo $row['name'].',';
						echo $row['comment'].',';
						echo $row['datetime'].'<br>';
						echo "<hr>";             //水平線を入れるタグ
					}
				}else{
					echo "投稿はありません。";
				}
       			}elseif(isset($_POST["delete"])){
          			if($_POST["delete"] == "" || $_POST["pass2"] == ""){
              				echo "削除する投稿番号とパスワードが入力されていません。<br>";
				}else{
					$sql = 'SELECT * FROM newtable';
					$stmt = $pdo->query($sql);
					$results = $stmt->fetchAll();
					if(count($results) != 0){
						$pass2 = "";
                     				foreach ($results as $word){
							if($word['number'] == $_POST["delete"]){
								$pass2 = $word['password'];
							}
                       				}
						if($pass2 == ""){
							echo "指定した投稿は削除された可能性があります。<br>";
						}elseif($pass2 !== $_POST["pass2"]){
							echo "パスワードが違います。<br>";
						}else{	
							$number = $_POST["delete"];
                    					$sql = 'delete from newtable where number=:number';
                                        	        $stmt = $pdo -> prepare($sql);
							$stmt -> bindParam(':number', $number, PDO::PARAM_INT);
							$stmt -> execute();
						}	
					}else{
						echo "投稿はありません。";
					}				
				}
              			$sql = 'SELECT * FROM newtable';
				$stmt = $pdo->query($sql);
				$results = $stmt->fetchAll();
				if(count($results) != 0){                 //テーブルに入力されている場合
					echo "<br>履歴<br>";
					foreach ($results as $row){
					//$rowの中にはテーブルのカラム名が入る
						echo $row['number'].',';
						echo $row['name'].',';
						echo $row['comment'].',';
						echo $row['datetime'].'<br>';
						echo "<hr>";             //水平線を入れるタグ
					}
				}else{
					echo "投稿はありません。";
				}	
       			}elseif(isset($_POST["comment"])){        //編集が投稿されたとき(編集して元の内容を上に表示したときはこないようにしている)
          			$number = $_POST["editnumber"];
				$name = $_POST["name"];
          			$comment =  $_POST["comment"];
				$pass1 = $_POST["pass1"];
				$date = date("Y/m/d H:i:s");
          			$special = "完成！";
				$editcheck = 0;
             			if($name == "" || $comment == "" || $pass1 == ""){
                			echo "お名前とコメント、パスワードが入力されていません。<br>";
             			}else{
                			if($comment == $special){        //指定した言葉が入力されたときの反応
                   				echo "おめでとう！<br>";
                			}else{
                   				echo $name."様、" .$comment."を受け付けました<br>";
                			}
					$sql = 'update newtable set name=:name, comment=:comment, datetime=:date, password=:password where number=:number';
					$stmt = $pdo -> prepare($sql);
					$stmt -> bindParam(':number', $number, PDO::PARAM_INT);
					$stmt -> bindParam(':name', $name, PDO::PARAM_STR);
					$stmt -> bindParam(':comment', $comment, PDO::PARAM_STR);
					$stmt -> bindParam(':date', $date, PDO::PARAM_STR);
					$stmt -> bindParam(':password', $pass1, PDO::PARAM_STR);
					$stmt -> execute();
					echo "編集されました。<br>";
				}
				$sql = 'SELECT * FROM newtable';
				$stmt = $pdo->query($sql);
				$results = $stmt->fetchAll();
				if(count($results) != 0){                 //テーブルに入力されている場合
					echo "<br>履歴<br>";
					foreach ($results as $row){
					//$rowの中にはテーブルのカラム名が入る
						echo $row['number'].',';
						echo $row['name'].',';
						echo $row['comment'].',';
						echo $row['datetime'].'<br>';
						echo "<hr>";             //水平線を入れるタグ
					}
				}else{
					echo "投稿はありません。";
				}
			}elseif($_POST["edit"] == "" || $_POST["pass3"] == ""){
				echo "編集する投稿番号とパスワードが入力されていません。<br>";
				$sql = 'SELECT * FROM newtable';
				$stmt = $pdo->query($sql);
				$results = $stmt->fetchAll();
				if(count($results) != 0){                 //テーブルに入力されている場合
					echo "<br>履歴<br>";
					foreach ($results as $row){
					//$rowの中にはテーブルのカラム名が入る
						echo $row['number'].',';
						echo $row['name'].',';
						echo $row['comment'].',';
						echo $row['datetime'].'<br>';
						echo "<hr>";             //水平線を入れるタグ
					}
				}else{
					echo "投稿はありません。";
				}
			}else{
				if($editcheck == 3){
					echo "指定した投稿は削除された可能性があります。<br>";
				}elseif($editcheck == 1){
					echo "パスワードが違います。<br>";
                     		}elseif($editcheck == 2){	
					echo "投稿はありません。<br>";
				}
				$sql = 'SELECT * FROM newtable';
				$stmt = $pdo->query($sql);
				$results = $stmt->fetchAll();
				if(count($results) != 0){                 //テーブルに入力されている場合
					echo "<br>履歴<br>";
					foreach ($results as $row){
					//$rowの中にはテーブルのカラム名が入る
						echo $row['number'].',';
						echo $row['name'].',';
						echo $row['comment'].',';
						echo $row['datetime'].'<br>';
						echo "<hr>";             //水平線を入れるタグ
					}
				}else{
					echo "投稿はありません。";
				}
			}
     		?>
  	</body>
</html>