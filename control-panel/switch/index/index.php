<?php
 $w = trim(htmlspecialchars($_GET['w']));
 if($w == "empty")
 {
  include "sub/empty.php";
  exit;
 }
?>
<span style='float:right;'>
	(най-новото е <b>най-отгоре</b>) <a href="./?p=index&w=empty">Изчисти</a>
</span>
Последни дейности от потребителите ни в сайта: 
<div class='clear'></div>
<div style="padding:10px;font-size:15px;border:1px solid #CCC;background:#fafafa;height:500px;overflow-y:scroll;">
<?php
 $file = "./report.txt";
 if(file_exists($file))
 {
	$text = file_get_contents($file);
	$text_arr = array_reverse(explode("----------------------------------------------------------------------",$text));
	foreach($text_arr as $line)
	{
		echo nl2br($line);
		echo "----------------------------------------------------------------------";
	}
	
 }
 else
    {
	  echo "Няма скорошни действия !";
	}
 
?>
</div>
<b>* на 15-20 дена, го чисти за да не се трупа излишна информация. </b>