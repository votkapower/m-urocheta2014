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
<h2>Потребители</h2>
<form method='post' action="">
 <input name='username' value="Потребител или имейл"/><button name='serach' type='submit'>Търси</button>
</form>
<?php
$where = "";
 If(isset($_POST['serach']))
 {
   $u = trim(htmlspecialchars($_POST['username']));
   $where = " WHERE `username` LIKE '%".$u."%' OR `email` LIKE '%".$u."%'";
 }
 /// ---------------------------
  $i=0;
 $uq = mysql_query("SELECT * FROM `users` ".$where."  ORDER BY `timestamp` DESC ");
 while($r = mysql_fetch_array($uq))
 {
  $i++;
  if($i%2==0){$bg = "#FFF";}else{$bg="transparent";}
  if($r['rank']=='admin'){ $rank="<span style='color:darkred;font-size:10px;'>админ &reg;</span>"; }
  else {  $rank="<span style='font-size:10px;'>потребител</span>";  }
 
  echo "
  <div style='padding:10px;background:".$bg.";'>
	".$i.". <a href=\"#\">".$r['username']."</a> - ".$rank." 
   <Span style='float:right;'>
	<a href=\"./?p=users&w=edit&i=".$r['id']."\">Редактирай</a>
	 /
	<a href=\"./?p=users&w=delete&i=".$r['id']."\">Изтрий</a>
   </span>
  </div>
  
  ";
 }

?>
