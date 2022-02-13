<?php
session_start();
ob_start();
require_once "settings.php";
require_once "functions.php";
$p = trim(htmlspecialchars($_GET['p']));
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-type" content="text/html; charset=UTF-8">
	<meta name="description" content="<?php echo $SITE_DESC; ?>"/>
	<meta name="keywords" content="<?php echo $SITE_KEYS; ?>"/>
    <link rel="stylesheet" type="text/css" href="./styles/main.css" />
	<title><?php echo $SITE_TITLE; ?></title>
</head>
<body>

	<div id="wapper">
		<div id="header">
			<a href="./">
				<div id="logo"></div>
			</a>
			<a href="./">
				<div id="banner"></div>
			</a>
			<div class="clear"></div>
		</div>
		<div id="menu">
			<div id="links">
			 <?php include "includes/menu.php";?>
			</div>
			<div id="login-menu">
			<?php include "includes/login.php";?>
			
			</div>
		</div>
		<div id="body-wrapper">
			<?php
			 $url = "./switch/".$p."/index.php";
			 if( file_exists($url) )
			 {
			   include $url;
			 }
			 else
				 {
					include "./switch/index/index.php";
				 }
			?>
		</div>
		<?php
		 if($p == "view")
		 {
		   $get_coms = mysql_query("SELECT * FROM `tutorials-comments` WHERE `video_id`='$VIDEO_ID' ORDER BY `timestamp` DESC");
		   while($r = mysql_fetch_array($get_coms))
		   {
		  ?>
			<div style="margin:10px;background:#eaeaea;padding:5px;">
				<div>
					 <span style="float:left;">от <a href="./?p=profile&=<?php echo $r['username'];?>"><?php echo $r['username'];?></a>:</span>
					 <span style="float:right;">
							<span style='font-size:10px;color:#aeaeae;'>(<?php echo date("d.m.Yг. - H:iч.",$r['timestamp']);?>)</span>
						 <?php echo maketime($r['timestamp']);?>
							
					 </span>
				 <div class='clear'></div>
				 <div style="padding:5px;"><?php echo nl2br($r['comment']);?></div>
				</div>
			</div>
		  <?php
		   }
		 }
		 
	
		?>
		<div id="footer">
			<div id="inner">
				<?php include "includes/footer.php";?>
			</div>
		</div>
	</div>

</body>
</html>