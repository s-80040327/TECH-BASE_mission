<html>
	<head>
	<meta charset="utf-8">
	<title>mission_3-5</title>
	</head>
	<body bgcolor = "#e6e6fa" text = "#191970" >
		<font size = "6" color = "#4b0082" >投稿フォーム～行きたい場所～</font><br><br>
		今行きたい場所についてのコメントと名前、好きなパスワードを入力し、送信ボタンを押してください。<br>
		投稿番号と設定したパスワードを入力することにより、削除や編集も行うことが出来ます。<br><br>
    		<?php
    			$name1 = "";
			$comment1 = "";
			$editnumber1 = "";
			$editcheck = "";
			if(isset($_POST["edit"]) && $_POST["edit"] != "" && $_POST["pass3"] != ""){       //入力して編集ボタンを押したとき
				$filename = "mission_3-5.txt";
              			if(file_exists($filename)){
                     			$array = file($filename);
					if(count($array) != 0){
						$pass3 = "";
                     				foreach ($array as $word){
                       					$info = explode("<>", $word, 6);
							if($word[0] == $_POST["edit"]){
								$pass3 = $info[4];
							}
                       				}
						if($pass3 == ""){
							$editcheck = 3;
						}elseif($pass3 !== $_POST["pass3"]){
							$editcheck = 1;
						}else{	
                     					foreach ($array as $word){
                       						$info = explode("<>", $word, 6);
                       						if($_POST["edit"] == $info[0]){    //編集する投稿番号を一致するものを発見
                           						$name1 =  $info[1];
									$comment1 = $info[2];
									$editnumber1 = $info[0];
           							}
							}
						}
					}else{
						$editcheck = 2;
					}
				}else{
					$editcheck = 2;
				}				
			}
		?>
		<font size = "4" color = "#4b0082">送信用</font><br>
		<form method="POST" action="mission_3-5.php">
        		お名前　　：<input type = "text" name = "name" size = "20" value = "<?php echo $name1; ?>"><br>
        		コメント　：<textarea name="comment" rows = "3" cols = "19"><?php echo $comment1; ?></textarea>
                        　　　　　<input type = "hidden" name = "editnumber" value = "<?php echo $editnumber1; ?>"><br>
			パスワード：<input type = "password" name = "pass1" size = "20">
			<input type="submit" value="送信"><br><br>
    		</form> 
		<font size = "4" color = "#4b0082">削除用</font><br>
		<form method="POST" action="mission_3-5.php">
        		削除番号　：<input type = "text" name = "delete" size = "2"><br>
			パスワード：<input type = "password" name = "pass2" size = "20">
			<input type="submit" value="削除"><br><br>
        	</form> 
		<font size = "4" color = "#4b0082">編集用</font><br>
                <form method="POST" action="mission_3-5.php">
        		編集番号　：<input type = "text" name = "edit" size = "2"><br>
			パスワード：<input type = "password" name = "pass3" size = "20">
			<input type="submit" value="編集"><br><br>
		</form>
		<?php
       
                	if((!isset($_POST["comment"])) && (!isset($_POST["delete"])) && (!isset($_POST["edit"]))){          //最初にページを開いたときの指示
                		echo "入力してください.。<br>";
				$filename = "mission_3-5.txt";        //入力された内容をテキストに追加
                		if(file_exists($filename)){
             				$array = file($filename);               //file():ファイルの中身を配列に読み込む
               				echo "<br>履歴<br>";
               				foreach ($array as $word){
                   				$info = explode("<>", $word, 6);
                   				for ($i = 0; $i <= 3; $i = $i+1){
                        				echo $info[$i]." ";
                   				}
                   				echo "<br>";
               				}
				}else{
					echo "投稿はありません。";
				}
       			}elseif(isset($_POST["editnumber"]) && $_POST["editnumber"]==""){                    //送信ボタンが押されているが、編集ではないとき
          			$name = $_POST["name"];
          			$comment =  $_POST["comment"];
				$pass1 = $_POST["pass1"];
          			$special = "完成！";
             			if($name == "" || $comment == "" || $pass1 == ""){
                			echo "お名前とコメント、パスワードが入力されていません。<br>";
             			}else{
                			if($comment == $special){        //指定した言葉が入力されたときの反応
                   				echo "おめでとう！<br>";
                			}else{
                   				echo $name."様、" .$comment."を受け付けました<br>";
                			}
                			$filename = "mission_3-5.txt";        //入力された内容をテキストに追加
					$number = 1;
                			if(file_exists($filename)){	
						$array = file($filename);
 						if(count($array) != 0){
                     					foreach ($array as $word){
                       						$info = explode("<>", $word, 6);
                       					}
							$number = $info[0] + 1;
                    				}
                			}
                			$fp = fopen($filename, "a"); 
                			$date = date("Y/m/d H:i:s");
                			$all = $number."<>".$name."<>".$comment."<>".$date."<>".$pass1."<>";
               				fwrite($fp, $all."\n");
                			fclose($fp);	
				}
				$filename = "mission_3-5.txt";        //入力された内容をテキストに追加
                		if(file_exists($filename)){
             				$array = file($filename);               //file():ファイルの中身を配列に読み込む
               				echo "<br>履歴<br>";
               				foreach ($array as $word){
                   				$info = explode("<>", $word, 6);
                   				for ($i = 0; $i <= 3; $i = $i+1){
                        				echo $info[$i]." ";
                   				}
                   				echo "<br>";
               				}
				}else{
					echo "投稿はありません。";
				}
       			}elseif(isset($_POST["delete"])){
          			if($_POST["delete"] == "" || $_POST["pass2"] == ""){
              				echo "削除する投稿番号とパスワードが入力されていません。<br>";
				}else{
              				$filename = "mission_3-5.txt";
              				if(file_exists($filename)){
                     				$array = file($filename);
						if(count($array) != 0){
							$pass2 = "";
                     					foreach ($array as $word){
                       						$info = explode("<>", $word, 6);
								if($word[0] == $_POST["delete"]){
									$pass2 = $info[4];
								}
                       					}
							if($pass2 == ""){
								echo "指定した投稿は削除された可能性があります。<br>";
							}elseif($pass2 !== $_POST["pass2"]){
								echo "パスワードが違います。<br>";
							}else{	
								echo "削除されました。<br>";						
                     						unlink("mission_3-5.txt");       //ファイルの削除
                    	 					$filename = "mission_3-5.txt";
                     						$fp = fopen($filename, "a");     //新たなファイル作成
                     						foreach ($array as $word){
                       							$info = explode("<>", $word, 6);  //一行ずつ調べる
                       							if($_POST["delete"] != $info[0]){   //入力した投稿番号以外の場合は記入
                           							fwrite($fp, $word);
                       							}
                     						}
                     						fclose($fp);
              						}
						}else{
							echo "投稿はありません。";
						}
					}
          			}
				$filename = "mission_3-5.txt";        //入力された内容をテキストに追加
                		if(file_exists($filename)){
             				$array = file($filename);               //file():ファイルの中身を配列に読み込む
               				echo "<br>履歴<br>";
               				foreach ($array as $word){
                   				$info = explode("<>", $word, 6);
                   				for ($i = 0; $i <= 3; $i = $i+1){
                        				echo $info[$i]." ";
                   				}
                   				echo "<br>";
               				}
				}else{
					echo "投稿はありません。";
				}
       			}elseif(isset($_POST["comment"])){        //編集が投稿されたとき(編集して元の内容を上に表示したときはこないようにしている)
          			$name = $_POST["name"];
          			$comment =  $_POST["comment"];
				$pass1 = $_POST["pass1"];
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
					$filename = "mission_3-5.txt";
			 		$array = file($filename);
                			unlink("mission_3-5.txt");
                    	 		$filename = "mission_3-5.txt";
                     			$fp = fopen($filename, "a");
                     			foreach ($array as $word){
                       				$info = explode("<>", $word, 6);
                       				if($_POST["editnumber"] != $info[0]){         //編集以外の投稿はそのまま
                           				fwrite($fp, $word);
                       				}else{                                        //編集する投稿は新しくする
							$number = $info[0];
							$date = date("Y/m/d H:i:s");
                					$all = $number."<>".$name."<>".$comment."<>".$date."<>".$pass1."<>";
               						fwrite($fp, $all."\n");
						}
                     			}
                     			fclose($fp);
					echo "編集されました。<br>";
				}
				$filename = "mission_3-5.txt";	
				$array = file($filename);               //file():ファイルの中身を配列に読み込む
                     		echo "<br>履歴<br>";
                    		foreach ($array as $word){              //テキストファイルの中身を表示
                        		$info = explode("<>", $word, 6);
                        		for ($i = 0; $i <= 3; $i = $i+1){
                        			echo $info[$i]." ";
                			}
                        		echo "<br>";
				}
			}elseif($_POST["edit"] == "" || $_POST["pass3"] == ""){
				echo "編集する投稿番号とパスワードが入力されていません。<br>";
				$filename = "mission_3-5.txt";        //入力された内容をテキストに追加
                		if(file_exists($filename)){
             				$array = file($filename);               //file():ファイルの中身を配列に読み込む
					if(count($array) != 0){
               					echo "<br>履歴<br>";
               					foreach ($array as $word){
                   					$info = explode("<>", $word, 6);
                   					for ($i = 0; $i <= 3; $i = $i+1){
                        					echo $info[$i]." ";
                   					}
                   					echo "<br>";
               					}
					}else{
						echo "投稿はありません。<br>";
					}
				}else{
					echo "投稿はありません。<br>";
				}
			}else{
				if($editcheck == 3){
					echo "指定した投稿は削除された可能性があります。<br>";
				}elseif($editcheck == 1){
					echo "パスワードが違います。<br>";
                     		}elseif($editcheck == 2){	
					echo "投稿はありません。<br>";
				}
				if(file_exists($filename)){
             				$array = file($filename);               //file():ファイルの中身を配列に読み込む
					if(count($array) != 0){
						echo "<br>履歴<br>";
               					foreach ($array as $word){
                   					$info = explode("<>", $word, 6);
                   					for ($i = 0; $i <= 3; $i = $i+1){
                       						echo $info[$i]." ";
                  					}
                   					echo "<br>";
						}
               				}
				}
			}
     		?>
  	</body>
</html>