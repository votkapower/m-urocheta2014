<?php
$url = "../switch/".$f;

   @unlink($url."/index.php");
   @rmdir($url);
	report("Админ <b>".$_SESSION['user']['username']."</b> <span style='color:darkred;'>изтри</span> страницата - <b>".$f."</b> ! ");
 

header("Location: ./?p=add-page&w=list");
exit;
