<?php
function make_thumb($src, $dest, $desired_width) {

	/* read the source image */
	$ext = strtolower(end(explode(".",$src)));
	if($ext == "jpg" || $ext  == "jpeg")
	{
		$source_image = imagecreatefromjpeg($src);
	}
	elseif($ext == "png")
		{
			$source_image = imagecreatefrompng($src);
		}
		else
			{
				$source_image = imagecreatefromgif($src);
			}
	$width = imagesx($source_image);
	$height = imagesy($source_image);
	
	/* find the "desired height" of this thumbnail, relative to the desired width  */
	$desired_height = floor($height * ($desired_width / $width));
	
	/* create a new, "virtual" image */
	$virtual_image = imagecreatetruecolor($desired_width, $desired_height);
	
	/* copy source image at a resized size */
	imagecopyresampled($virtual_image, $source_image, 0, 0, 0, 0, $desired_width, $desired_height, $width, $height);
	
	/* create the physical thumbnail image to its destination */
	imagejpeg($virtual_image, $dest);
}
// call createThumb function and pass to it as parameters the path
// to the directory that contains images, the path to the directory
// in which thumbnails will be placed and the thumbnail's width.
// We are assuming that the path will be a relative path working
// both in the filesystem, and through the web for links



// Функцията изкарва хтмл туториалите .. по размер и вид
function tutorials($sql, $width=270, $height=180, $output='views-author')
{
   $q = mysql_query($sql);
   while($r = mysql_fetch_array($q))
	{
		tutorial($r['image'], $r['title'], $r['views'], $r['author'], $r['id'], $r['votes'], $width, $height, $output);
	}
}



// функцията искарва 1 хтмл  туториал по критерии 
function tutorial($image, $title, $views, $author, $id, $votes, $width=270, $height=180, $output='views-author')
{
$output_html = "";
 
 if($output == "views-author" OR !$output) // ляво - ГЛЕДАНИЯ / дясно - Автора
 {
  $output_html = "
  <span>".$views." гледания</span>
  <span><a href=\"./?p=profile&u=".$author."\">".$author."</a></span>";
 }
 else if($output == "empty-views") // ляво - НИЩO / дясно - ГЛЕДАНИЯ
 {
  $output_html = "
  <span></span>
  <span><a href=\"#\">".$views."</a></span>";
 }
 else if($output == "votes-author") // ляво - ГЛАСА / дясно - АВТОР
 {
  $output_html = "
  <span>".$votes." гласа</span>
  <span><a href=\"./?p=profile&u=".$author."\">".$author."</a></span>";
 }
 
 // Нагласяне на размерите
 $tutorial_s = "";
 $overbar_s = "";
 $title_s = "";
 $stats_s = "";
 
 if($width!=270 AND $height!=180)
 {
   $tutorial_s = "width:".$witdh."px;height:".$height."px;";
   $overbar_s = "style=\"width:".$witdh."px;";
   $title_s = "style=\"width:".($witdh-10)."px;";
   $stats_s = "style=\"width:".($witdh-10)."px;";
 }
?>
				<div class="tutorial"  style="<?php echo $tutorial_s; ?> background-image: url('<?php echo $image; ?>') ">
						<div class="image"></div>
						<div class="overbar" <?php echo $overbar_s; ?>>
							<div class="title" <?php echo $title_s; ?>><a href="./?p=view&id=<?php echo $id;?>"><?php echo $title;?></a></div>
							<div class="stats" <?php echo $stats_s; ?>>
								<?php echo $output_html;?>
							</div>
						</div>
					</div>
<?php
}


function ok($msg)
{
 echo "<div class=\"ok-msg\">$msg</div>";
}

function error($msg)
{
 echo "<div class=\"error-msg\">$msg</div>";
}


function randomid($length=10)
{ 
  $dd = sha1(str_shuffle(str_repeat(time().(time()+time()/2),3)));
	$dd =  substr( $dd, 0, $length);
	return $dd;
}

function is_tutorial($id)
{
 $q = mysql_query("SELECT `id` FROM `tutorials` WHERE `id`='$id'");
 
  if(mysql_num_rows($q) == 1)
  {
   return true;
  }
  else
	 {
	  return false;
	 }
}

function yourubeURLtoEmbedLink($url)
{
 // http://www.youtube.com/watch?v=hkrGEVAbmls
 
 $url = str_replace("watch?v=","embed/", $url);
 return $url;
}

function getVboxId($url)
{
 $id = end(explode("play:", $url));
 return $id;
}

/// Серия от ф-ци за гласуването за уроци .. 

function canIvote($ip,$vid)
{
  $q = mysql_query("SELECT * FROM `vote_ips` WHERE `user_ip`='$ip' AND `video_id`='$vid'");
  $n = mysql_num_rows($q);
  if($n >= 1) // ако има 1 или повече гласа
  {
	return false; // НЕ мога да галсувам
  }
  else // инък .. 
      {
		return true; // мога
	  }
}

function handle_video_voting($vid, $ip,$way,$delay=1) // delay -> 1 day
{
 // 1. Виж дали сам лгасувал
 // 2. Ако вече съм гласувал -> НЕ прави нищо
 // 3. Ако НЕ съм гласувал -> запиши ми ИП-то & ъпдейтни гласовете на клипа
 if( is_tutorial($vid) == true AND ($way == 'up' OR $way == 'down'))
 {
	 $time = (time() + ($delay * 86400));
	  if(canIvote($ip,$vid) == true)
	  {
		mysql_query("INSERT INTO `vote_ips` (`video_id`,`user_ip`,`timestamp`)VALUES('$vid','$ip','$time')");
		 if($way == 'up')
		   {
			mysql_query("UPDATE `tutorials` SET `votes`= `votes`+1, `views` = `views` - 1 WHERE `id`='$vid'");
		   }
	  }
  }
}

function delete_old_video_votes()
{
 $time = time();
 mysql_query("DELETE FROM `votes_ips` WHERE timestamp < $time");
}



function maketime($datefrom,$dateto=-1)
{
// Defaults and assume if 0 is passed in that
// its an error rather than the epoch

if($datefrom<=0) { return "Преди мноого време"; }
if($dateto==-1) { $dateto = time(); }

// Calculate the difference in seconds betweeen
// the two timestamps

$difference = $dateto - $datefrom;

// If difference is less than 60 seconds,
// seconds is a good interval of choice

if($difference < 60)
{
$interval = "s";
}

// If difference is between 60 seconds and
// 60 minutes, minutes is a good interval
elseif($difference >= 60 && $difference<60*60)
{
$interval = "n";
}

// If difference is between 1 hour and 24 hours
// hours is a good interval
elseif($difference >= 60*60 && $difference<60*60*24)
{
$interval = "h";
}

// If difference is between 1 day and 7 days
// days is a good interval
elseif($difference >= 60*60*24 && $difference<60*60*24*7)
{
$interval = "d";
}

// If difference is between 1 week and 30 days
// weeks is a good interval
elseif($difference >= 60*60*24*7 && $difference <
60*60*24*30)
{
$interval = "ww";
}

// If difference is between 30 days and 365 days
// months is a good interval, again, the same thing
// applies, if the 29th February happens to exist
// between your 2 dates, the function will return
// the 'incorrect' value for a day
elseif($difference >= 60*60*24*30 && $difference <
60*60*24*365)
{
$interval = "m";
}

// If difference is greater than or equal to 365
// days, return year. This will be incorrect if
// for example, you call the function on the 28th April
// 2008 passing in 29th April 2007. It will return
// 1 year ago when in actual fact (yawn!) not quite
// a year has gone by
elseif($difference >= 60*60*24*365)
{
$interval = "y";
}

// Based on the interval, determine the
// number of units between the two dates
// From this point on, you would be hard
// pushed telling the difference between
// this function and DateDiff. If the $datediff
// returned is 1, be sure to return the singular
// of the unit, e.g. 'day' rather 'days'

switch($interval)
{
case "m":
$months_difference = floor($difference / 60 / 60 / 24 /
29);
while (mktime(date("H", $datefrom), date("i", $datefrom),
date("s", $datefrom), date("n", $datefrom)+($months_difference),
date("j", $dateto), date("Y", $datefrom)) < $dateto)
{
$months_difference++;
}
$datediff = $months_difference;

// We need this in here because it is possible
// to have an 'm' interval and a months
// difference of 12 because we are using 29 days
// in a month

if($datediff==12)
{
$datediff--;
}

$res = ($datediff==1) ? "преди $datediff месец"  :  "преди $datediff 
месеца";
break;

case "y":
$datediff = floor($difference / 60 / 60 / 24 / 365);
$res = ($datediff==1) ? " преди $datediff год." : "преди  $datediff год.";
break;

case "d":
$datediff = floor($difference / 60 / 60 / 24);
$res = ($datediff==1) ? "преди $datediff ден " : "преди  $datediff 
дни";
break;

case "ww":
$datediff = floor($difference / 60 / 60 / 24 / 7);
$res = ($datediff==1) ? "преди $datediff седмица" : "преди $datediff
 седмици";
break;

case "h":
$datediff = floor($difference / 60 / 60);
$res = ($datediff==1) ? "преди  $datediff час " : " преди $datediff часа";
break;

case "n":
$datediff = floor($difference / 60);
$res = ($datediff==1) ? "преди $datediff мин. " :
"преди  $datediff мин.";
break;

case "s":
$datediff = $difference;
$res = ($datediff==1) ? "преди $datediff сек." :
"преди  $datediff сек.";
break;
}
return $res;
}



function v_url($url,$ret='video'){
 $url = str_replace("http://vbox7.com/play:", "", $url);
 $url = str_replace("http://www.vbox7.com/play:", "", $url);
 $c = curl_init('http://www.vbox7.com/play/magare.do');
 $vid = $url;
 $p = array(
  CURLOPT_HEADER => false,
     CURLOPT_RETURNTRANSFER => true,
     CURLOPT_POST => true,
     CURLOPT_POSTFIELDS => 'onLoad=[type Function]&vid=' . $vid
 );
 curl_setopt_array($c, $p);
 $return = curl_exec($c);
 curl_close($c);

 $return = preg_replace('/&videoFile=(.*)&/', '$1', $return);
 
 $rr = explode("&jpg_addr=", $return);
 if($ret == 'video' OR !$ret)
 {
  return $rr[0];
 }
 else
	 { 
	 return $ret[1];
	 }

}


function yt_image($url)
{
 $id = end(explode("watch?v=",$url));
 return "http://i3.ytimg.com/vi/$id/mqdefault.jpg";
}




function emptydir($dir)
{
 $handle = opendir($dir);
 while($file = readdir($handle))
 {
 
 // echo $file. "<br/>";
   @unlink($file);
 }
 
}


function report($text)
{
 $l = @fopen("./control-panel/report.txt","a+");
 @fwrite($l, "\n".$text."\n\nIP: ".$_SERVER['REMOTE_ADDR']." - ".date("d.m.Y - в H:i")."ч.\n \n---------------------------------------------------------------------- \n");
 @fclose($l);
}

function sendpm($tema, $from ,$to, $msg){
			$time = time();
			$z =	mysql_query("INSERT INTO `user-pms` (`tema`,`msg`,`from-user`,`to-user`,`readed`,`timestamp`)
											VALUES('$tema','$msg','$from','$to','false','$time')") or die(mysql_error());
		if($z)
		{
			return true;
		}
		else
		  {
		   return false;
		  }
}