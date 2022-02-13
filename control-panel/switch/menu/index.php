<?php
 $html = stripcslashes(file_get_contents("../includes/menu.php"));
?>
<h2>Редактиране на Менюто</h2>
<form method='post' action="">
<textarea name='menu-eidt' style='width:700px;height:140px;'><?php echo  $html;?></textarea><button name='editw' type='submit'>Редактирай менюто</button>
</form>
<?php
 If(isset($_POST['editw']))
 {
   $new = trim(stripcslashes(htmlspecialchars_decode($_POST['menu-eidt'])));
   $rsa = @fopen("../includes/menu.php","w+");
   @fwrite($rsa, $new);
   fclose($rsa);
   report("* Админ <b>".$_SESSION['user']['username']."</b> редактира менюто !");
   header("Location: ./");
   exit;
 }
?>
