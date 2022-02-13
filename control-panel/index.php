<?php
session_start();
ob_start();

require_once "../settings.php";
require_once "../functions.php";
if($_SESSION['user']['rank'] != 'admin')
{
 
 report("<b style='color:darkred;'>Някой ".$_SESSION['user']['username']." се опитва да влезе в админ панела БЕЗ да има права !</b>");
 header("Location: ../");
 exit;
}


$p = trim(htmlspecialchars($_GET['p']));
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-type" content="text/html; charset=UTF-8">
    <link rel="stylesheet" type="text/css" href="../styles/main.css" />
	<title><?php echo $SITE_TITLE; ?></title>
</head>
<body>

	<div id="wapper">
<h2 style='color:#FFF;'>Админ панел</h2>
		<div id="body-wrapper">
		
			<?php
			    include "menu.php";
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
		
		<div id="footer">
			<div id="inner">
				<?php include "../includes/footer.php";?>
			</div>
		</div>
	</div>

</body>
</html>