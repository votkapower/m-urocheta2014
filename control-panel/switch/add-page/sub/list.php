<?php
 /// ---------------------------
  $i=0;
 $dir = "../switch";
 $handle = opendir($dir);
 while($file = readdir($handle))
 {
 
  if( strlen($file) > 3)
  { 
	  $i++;
	  if($i%2==0){$bg = "#FFF";}else{$bg="transparent";}
	  
	 
	  echo "
	  <div style='padding:10px;background:".$bg.";'>
		".$i.". <a href=\"../?p=".$file."\">".$file."</a>
	   <Span style='float:right;'>
		<a href=\"./?p=add-page&w=edit&i=".$file."\">Редактирай</a>
		 /
		<a href=\"./?p=add-page&w=delete&i=".$file."\">Изтрий</a>
	   </span>
	  </div>
	  
	  ";
  }
 }
