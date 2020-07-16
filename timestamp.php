
<?php


header('Access-Control-Allow-Origin: *');  
header("Content-Type: application/json; charset=UTF-8");
date_default_timezone_set("Asia/Singapore");
if (!empty($_SERVER['HTTP_CLIENT_IP']))   
  {
    $ip_address = $_SERVER['HTTP_CLIENT_IP'];
  }
//whether ip is from proxy
elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))  
  {
    $ip_address = $_SERVER['HTTP_X_FORWARDED_FOR'];
  }
//whether ip is from remote address
else
  {
    $ip_address = $_SERVER['REMOTE_ADDR'];
  }
$t=time();
if ($_GET["get"] === "simple"){


//if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
 //   echo 'This is a server using Windows!';
//} else {
  //  echo 'This is a server not using Windows!';
//}
$myObj->time = date("d-m-Y",$t);
$myObj->server = "Asia/Singapore";
$myObj->info["os"] = php_uname();
$myObj->info["ip"] = substr($ip_address, 0, strpos($ip_address, ":"));

echo json_encode($myObj);
} elseif ($_GET["get"] === "full"){
$ar = file_get_contents("http://ip-api.com/json/" . substr($ip_address, 0, strpos($ip_address, ":")) . "?fields=status,message,country,city,timezone,isp,org,query");

//echo var_dump(json_decode($ar, true));
echo str_replace('query','ip',str_replace('}', ',', $ar )) . '"info":"'.php_uname().'","server":{"time":"'.date("d-m-Y",$t).'","location":"Asia/Singapore"}}';
//echo "<br>" . $ip_address;
}
?>

