<?php
$me = $_SESSION['user']['username'];
$my_ms = mysql_query("SELECT * FROM `user-pms` WHERE `to-user`='$me' AND `id`='$i'");
$c = mysql_num_rows($my_ms);
$r = mysql_fetch_array($my_ms);

if($c == 1)
{

  mysql_query("DELETE FROM `user-pms` WHERE `to-user`='$me' AND `id`='$i'");
  header("Location: ./?p=options&w=pms");
  exit;
}
else {
  error("Това съобщение не съществува !");
}

