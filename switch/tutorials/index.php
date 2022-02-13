<h2>Уроци</h2>
<div style=' margin-bottom:20px'>
<?php
 if(isset($_POST['do-search']))
 {
   $word = trim(htmlspecialchars($_POST['search']));
 ?>
<div style='float:left;padding:7px;'>
Тръсене за: <b><?php echo $word;?></b>
</div>
<?php
}
 ?>
    <span style='float:right;'>
		<form method='post' action=''>
			<input type='text' name="search">
			<button type='submit' name='do-search'>Търси</button>
		</form>
	</span>
	<div class="clear"></div>
</div>


		<div class="clear"></div>
			
			<?php
			 $where = "";
			 if(isset($_POST['do-search']))
			 {
			   $word = trim(htmlspecialchars($_POST['search']));
			   $where = " AND `title` LIKE '%".$word."%' OR `desc` LIKE '%".$word."%'";
			 }
			 $allq = "SELECT * FROM `tutorials` WHERE `show`='true' ".$where." ORDER BY `timestamp` DESC";
			 if(mysql_num_rows(mysql_query($allq)) == 0)
			 {
			   error("Няма уроци .. ");
			 }
			 tutorials($allq);
			?>

			<div class="clear"></div>