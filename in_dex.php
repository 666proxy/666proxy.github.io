
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
$ipshow = substr($ip_address, 0, strpos($ip_address, ":"));
$user_agent = $_SERVER['HTTP_USER_AGENT'];
function getOS() { 

    global $user_agent;

    $os_platform  = "Unknown OS Platform";

    $os_array     = array(
                          '/windows nt 10/i'      =>  'Windows 10',
                          '/windows nt 6.3/i'     =>  'Windows 8.1',
                          '/windows nt 6.2/i'     =>  'Windows 8',
                          '/windows nt 6.1/i'     =>  'Windows 7',
                          '/windows nt 6.0/i'     =>  'Windows Vista',
                          '/windows nt 5.2/i'     =>  'Windows Server 2003/XP x64',
                          '/windows nt 5.1/i'     =>  'Windows XP',
                          '/windows xp/i'         =>  'Windows XP',
                          '/windows nt 5.0/i'     =>  'Windows 2000',
                          '/windows me/i'         =>  'Windows ME',
                          '/win98/i'              =>  'Windows 98',
                          '/win95/i'              =>  'Windows 95',
                          '/win16/i'              =>  'Windows 3.11',
                          '/macintosh|mac os x/i' =>  'Mac OS X',
                          '/mac_powerpc/i'        =>  'Mac OS 9',
                          '/linux/i'              =>  'Linux',
                          '/ubuntu/i'             =>  'Ubuntu',
                          '/iphone/i'             =>  'iPhone',
                          '/ipod/i'               =>  'iPod',
                          '/ipad/i'               =>  'iPad',
                          '/android/i'            =>  'Android',
                          '/blackberry/i'         =>  'BlackBerry',
                          '/webos/i'              =>  'Mobile'
                    );

    foreach ($os_array as $regex => $value)
        if (preg_match($regex, $user_agent))
            $os_platform = $value;

    return $os_platform;
}

function getBrowser() {

    global $user_agent;

    $browser        = "Unknown Browser";

    $browser_array = array(
                            '/msie/i'      => 'Internet Explorer',
                            '/firefox/i'   => 'Firefox',
                            '/safari/i'    => 'Safari',
                            '/chrome/i'    => 'Chrome',
                            '/edge/i'      => 'Edge',
                            '/opera/i'     => 'Opera',
                            '/netscape/i'  => 'Netscape',
                            '/maxthon/i'   => 'Maxthon',
                            '/konqueror/i' => 'Konqueror',
                            '/mobile/i'    => 'Handheld Browser'
                     );

    foreach ($browser_array as $regex => $value)
        if (preg_match($regex, $user_agent))
            $browser = $value;

    return $browser;
}

if ($_GET["get"] === "simple"){


//if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
 //   echo 'This is a server using Windows!';
//} else {
  //  echo 'This is a server not using Windows!';
//}

$myObj->time = "17-02-2020";//date("d-m-Y",$t);
$myObj->server = "Asia/Singapore";
$myObj->info["os"] = php_uname();
$myObj->info["ip"] = substr($ip_address, 0, strpos($ip_address, ":"));

echo json_encode($myObj);
} elseif ($_GET["get"] === "full"){
$ar = file_get_contents("http://ip-api.com/json/" . substr($ip_address, 0, strpos($ip_address, ":")) . "?fields=status,message,country,city,timezone,isp,org,query");
$user_os        = getOS();
$user_browser   = getBrowser();
//echo var_dump(json_decode($ar, true));
echo str_replace('query','ip',str_replace('}', ',', $ar )) . '"score":"'. ((strlen($ipshow)-2)*(strlen($ipshow)-4)).'", "os":"'.$user_os.'",  "browser":"'.$user_browser.'", "info":"'.php_uname().'","server":{"time":"12-08-2020","location":"Asia/Singapore"}}';
//echo "<br>" . $ip_address;
}
?>

