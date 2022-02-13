<?php
 
 $w = trim(htmlspecialchars($_GET['w']));
 
 if( $w == "approve")
 {
   $id = (int)$_GET['i'];
   include "sub/approve.php";
   exit;
 }
 
 
 if( $w == "delete")
 {
   $id = (int)$_GET['i'];
   include "sub/delete.php";
   exit;
 }
 
 
 
 
?>

<h2>Коментари</h2>
<form method='post' action="">
 <input name='word' value="потребител или част от мнение"/><button name='search' type='submit'>Тръси</button>
</form>

<?php
$where = "";
 If(isset($_POST['search']))
 {
   $word = trim(htmlspecialchars($_POST['word']));
   $where = " AND `username` LIKE '%".$word."%' OR `comment` LIKE '%".$word."%'";
 }
 /// ---------------------------
  $i=0;
 $uq = mysql_query("SELECT * FROM `tutorials-comments`  WHERE`new`='true' ".$where."   ORDER BY `timestamp` DESC ");
 while($r = mysql_fetch_array($uq))
 {
  $i++;
  if($i%2==0){$bg = "#FFF";}else{$bg="transparent";}
  
  $t  =  mysql_fetch_array(mysql_query("SELECT `title` FROM `tutorials` WHERE `id`='".$r['video_id']."'"));
  echo "
  <div style='padding:10px;background:".$bg.";'>
	".$i.". от: <a href=\"#\">".$r['username']."</a> &raquo; <a href='../?p=view&id=".$r['video_id']."'>".$t['title']."</a> - ".maketime($r['timestamp'])."
   <Span style='float:right;'>
	<a href=\"./?p=comments&w=delete&i=".$r['id']."\">Изтрий</a>
   </span>
   <div class='clear'></div>
	   <div style='padding:5px;'>
		 ".nl2br($r['comment'])."
	   </div>
  </div>
  
  ";
 }

?>

<br />


<span style='float:right;'>
	<a  href="./?p=comments&w=approve">Маркирай всички като прегледани</a>
</span>
<br />
