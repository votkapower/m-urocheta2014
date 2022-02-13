<?php
 
 $w = trim(htmlspecialchars($_GET['w']));
 
 if( $w == "edit")
 {
   $f = trim($_GET['i']);
   include "sub/edit.php";
   exit;
 }
 
 
 if( $w == "delete")
 {
   $f = trim($_GET['i']);
   include "sub/delete.php";
   exit;
 }
 
 
 
 if( $w == "list")
 {
   $f = trim($_GET['i']);
   include "sub/list.php";
   exit;
 }
 
 
 
$randURL = randomid(6);
?>
<h2>Нова страница</h2>
<form method='post' action="">
 URL: <b>http://my-site.com/?p=<?php echo $randURL; ?></b><br /><br />
 Заглавие:<br />
 <input name='title' value="Заглавие на страницата"/> <br /> <br />
 Съдържание: <br />
 <textarea name='html' style='width:750px; height:300px;'>поддържа php, html & css</textarea><br /><br />
 <button name='add-new' type='submit'>Добави</button>
</form>
<br />
<?php
$where = "";
 If(isset($_POST['add-new']))
 {
   $title = trim(htmlspecialchars($_POST['title']));
   $html = trim($_POST['html']);
   $url = "../switch/".$randURL;
   if( !file_exists($url."/index.php"))
   {
     @mkdir($url, 755);
	 
	 $kd = @fopen($url."/index.php","w+");
	 @fwrite($kd, htmlspecialchars_decode(stripcslashes($html)));
	 fclose($kd);
	 
	 // в менюто -> линк
	 $bn = @fopen("../includes/menu.php","a+");
	 @fwrite($bn, " <a href=\"./?p=".$randURL."\">".$title."</a> ");
	 fclose($bn);
	 
	 report("Админ <b>".$_SESSION['user']['username']."</b> добави нова страница: <a href=\"../?p=".$randURL."\">".$title."</a> !");
	 ok("Страницата успешно добавена !");
   }
  
 }

?>
<br/>

 <a href="./?p=add-page&w=list"><div style='text-align:center; background:#fff;padding:10px;'><b>Списък със страниците</b></div></a>