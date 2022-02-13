<?php
 
 $w = trim(htmlspecialchars($_GET['w']));
 
 if( $w == "edit")
 {
   $id = (int)$_GET['i'];

   include "sub/edit.php";
   exit;
 }
 
 
 if( $w == "approve")
 {
   $id = (int)$_GET['i'];
      $au = trim(htmlspecialchars($_GET['au']));
   
    	$msg = mysql_real_escape_string("
						Здравей,
						
						 Админ <b>".$_SESSION['user']['username']."</b> ти удобри урока и вече всички могат да го гледат, коментират и харесват. 
						 
						 Линк до урока:  <a href='./?p=view&id=".$id."'>натисни тук</a>.
						  
						 * това е системно съобщение - моля, не отговаряйте.
						 
						 Поздрави,
						  от Екипа на сайта.
						");
						sendpm("Урока ти е уробрен !", "system" ,$au, $msg);
				  
   
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
<h2>Уроци</h2>
<form method='post' action="">
 <input name='word' value="Заглавие"/><button name='serach' type='submit'>Търси</button>
</form>
<?php
$where = "";
 If(isset($_POST['serach']))
 {
   $word = trim(htmlspecialchars($_POST['word']));
   $where = " WHERE `title` LIKE '%".$word."%' OR `desc` LIKE '%".$word ."%'";
 }
 /// ---------------------------
  $i=0;
  
 $uq = mysql_query("SELECT * FROM `tutorials` ".$where."  ORDER BY `timestamp` DESC ");
 while($r = mysql_fetch_array($uq))
 {
  $i++;
  if($i%2==0){$bg = "#FFF";}else{$bg="transparent";}
  if($r['show']=='false'){ $extaurl="<a style='color:green;' href=\"./?p=tutorials&w=approve&i=".$r['id']."&au=".$r['author']."\">Уробри</a> / "; $show="- <span style='color:darkred;font-size:10px;'>чака уробрение</span>"; }else{ $show="";$extaurl=""; }
 
  echo "
  <div style='padding:10px;background:".$bg.";'>
	".$i.". <a href=\"../?p=view&id=".$r['id']."\">".$r['title']."</a>  ".$show." 
   <Span style='float:right;'>
    ".$extaurl."
	<a href=\"./?p=tutorials&w=edit&i=".$r['id']."&au=".$r['author']."\">Редактирай</a>
	 /
	<a href=\"./?p=tutorials&w=delete&i=".$r['id']."\">Изтрий</a>
   </span>
  </div>
  
  ";
 }

?>
