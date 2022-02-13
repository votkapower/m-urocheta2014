<?php
$me = $_SESSION['user']['username'];
$url =  "./img/users/avatars/".$me."";
$url_file =  "./img/users/avatars/".$me."/default.jpg";
?>
<br/>
<br/>
 <div style="float:left;margin-right:14px;width:250px;height:180px;background:url('<?php echo $url_file ;?>') center;"></div>
	<form method='post' action="" enctype="multipart/form-data">
	 
		 линк до новия аватар: <br/>
		 <input name="avatar" type='file' /> <br/><br/>
		 
		 
		 <button name="pwdo-change">Промени</button>
		 <br />
		 <div class='clear'></div>
		 <?php
		 if(isset($_POST['pwdo-change']))
		 {
		  $img = $_FILES['avatar'];

		  if( !file_exists($url))
		  {
		    mkdir($url, 0755);
		  }
		   if(file_exists($url_file))
		   {
		     @unlink($url_file);
		   }
		      move_uploaded_file($img['tmp_name'], $url."/".$img['name']);
			  @make_thumb($url."/".$img['name'],  $url_file, 250) ;
			  @unlink($url."/".$img['name']);
			
				 mysql_query("UPDATE `users` SET `avatar`='$url_file' WHERE `username`='".$me."'");
				 ok("Готово! Промените ще влязат в сила от следващия път, когато си влезеш в профила :)");
			
		 }
		 ?>
		</form>
