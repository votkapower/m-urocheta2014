<?php
$me = $_SESSION['user']['username'];
$GET_USER = trim(htmlspecialchars($_GET['to']));

if($_SESSION['is-logged'] !== true)
{
 error("<b style='color:darkred;'>Някой се опитва да те хакне Като влиза във формата за ЛС без права. (въвежда невалидни потребители)</b>");
  header("Location: ./?p=error");
  exit;
}

$hhe = mysql_query("SELECT * FROM `users` WHERE `username`='$GET_USER'");
$is_valid_user = mysql_num_rows($hhe);
if($is_valid_user != 1)
{
  error("<b style='color:darkred;'>Някой <b>".$me."</b> се опитва да те хакне през формата за ЛС. (въвежда невалидни потребители)</b>");
  header("Location: ./?p=error&r=no-user");
  exit;
}
$r = mysql_fetch_array($hhe);

$polText="Момче";
$textColor = "#206FB5";
if($r['sex'] == '2'){$polText="Момиче"; $textColor = "#B220A8"; }
?>

<div style="font-size:16px;">Профила на <span style='color:<?php echo $textColor;?>'><?php echo $r['username'];?></span> - Изпрашане на <b>Лично Съобщение</b></div>

<div style=" margin:10px;float:left;">
	<img style="display:block;background:#FFF;padding:5px;border:1px solid #CCC;" src="<?php echo $r['avatar'];?>" width='200' height='200' border='0' alt='Снимката на <?php echo $r['username'];?>'/>
	<div>
	 Опции:
		<div style='padding:4px;'><a href="#">+ Изпрати ЛС</a></div>
	</div>
</div>
<div style='float:left;margin-top:10px;width:620px;bordeR:0px solid #ccc'>
	
	<form method='post'>
		Тема: <br />
		<input name='sub'  maxlength='255'/><br /><br />
		Съобщение: <br />
		<textarea name='msg' style='width:600px;height:150px;' ></textarea><br /><br />
		<button type='submit' name='send-msg'>Изпрати съобщението</button> &nbsp; или <a href="./?p=profile&u=<?php echo $r['username'];?>">се върни обратно в профила на <?php echo $r['username'];?></a> .
	</form>

</div>

<div class='clear'></div>
<?php
if(isset($_POST['send-msg']))
{
 $tema = trim(htmlspecialchars(mysql_real_escape_string($_POST['sub'])));
 $msg = trim(htmlspecialchars(mysql_real_escape_string($_POST['msg'])));
 $time = time();
 
  if(strlen($tema) < 5 OR strlen($tema) > 200)
  {
   error("Темата трябва да съдържа меджу 5 и 200 символа !");
  }
  else if($me == $GET_USER)
	  {
	   error("Неможе да си пращаш съобщения САМ !");
	  }
	  else if(strlen($msg) < 5)
		  {
		   error("Темата трябва да съдържа мин. 5 символа !");
		  }
		  else 
			  {
			   report("+ <b>$me</b> изпрати ЛС до <b>$GET_USER</b> ... ");
				mysql_query("INSERT INTO `user-pms` (`tema`,`msg`,`from-user`,`to-user`,`readed`,`timestamp`)
											VALUES('$tema','$msg','$me','$GET_USER','false','$time')");
											echo mysql_error();
				ok("Съобщението ти е изпратено успешно :)");
			  }
}
?>
