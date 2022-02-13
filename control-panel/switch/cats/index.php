<?php
 
 $w = trim(htmlspecialchars($_GET['w']));
 
 if( $w == "edit")
 {
   $id = (int)$_GET['i'];
   include "sub/edit.php";
   exit;
 }
 
 
 if( $w == "delete")
 {
   $id = (int)$_GET['i'];
   include "sub/delete.php";
   exit;
 }
 
 
 
 
?>
<h2>Категории</h2>
<form method='post' action="">
 Добави: <input name='word' value="Име на категорията"/><button name='add-new' type='submit'>Добави</button>
</form>
<?php
$where = "";
 If(isset($_POST['add-new']))
 {
   $word = trim(htmlspecialchars($_POST['word']));
   mysql_query("INSERT INTO `cats` (`id`,`name`)VALUES(NULL, '$word')") or die(mysql_error());
   header("Location: ./?p=cats");
   exit;
 }
 /// ---------------------------
  $i=0;
 $uq = mysql_query("SELECT * FROM `cats` ".$where."  ORDER BY `id` DESC ");
 while($r = mysql_fetch_array($uq))
 {
  $i++;
  if($i%2==0){$bg = "#FFF";}else{$bg="transparent";}
  

  echo "
  <div style='padding:10px;background:".$bg.";'>
	".$i.". ".$r['name']."
   <Span style='float:right;'>
	<a href=\"./?p=cats&w=edit&i=".$r['id']."\">Редактирай</a>
	 /
	<a href=\"./?p=cats&w=delete&i=".$r['id']."\">Изтрий</a>
   </span>
  </div>
  
  ";
 }

?>
