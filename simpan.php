<?php
include "koneksi.php"; //panggil file koneksi.php yang telah dibuat

$nama=$_POST['nama'];
$alamat=$_POST['alamat'];
$koordinat=$_POST['koordinat'];
$verifikasi=$_POST['verifikasi'];
$dt = date('Y-m-d H:i:s');


// get ip
$ip = getenv('HTTP_CLIENT_IP')?:
getenv('HTTP_X_FORWARDED_FOR')?:
getenv('HTTP_X_FORWARDED')?:
getenv('HTTP_FORWARDED_FOR')?:
getenv('HTTP_FORWARDED')?:
getenv('REMOTE_ADDR');


function ExactBrowserName(){
	$ExactBrowserNameUA=$_SERVER['HTTP_USER_AGENT'];

	if (strpos(strtolower($ExactBrowserNameUA), "safari/") and strpos(strtolower($ExactBrowserNameUA), "opr/")) {
	    // OPERA
	    $ExactBrowserNameBR="Opera";
	} elseIf (strpos(strtolower($ExactBrowserNameUA), "safari/") and strpos(strtolower($ExactBrowserNameUA), "chrome/")) {
	    // CHROME
	    $ExactBrowserNameBR="Chrome";
	} elseIf (strpos(strtolower($ExactBrowserNameUA), "msie")) {
	    // INTERNET EXPLORER
	    $ExactBrowserNameBR="Internet Explorer";
	} elseIf (strpos(strtolower($ExactBrowserNameUA), "firefox/")) {
	    // FIREFOX
	    $ExactBrowserNameBR="Firefox";
	} elseIf (strpos(strtolower($ExactBrowserNameUA), "safari/") and strpos(strtolower($ExactBrowserNameUA), "opr/")==false and strpos(strtolower($ExactBrowserNameUA), "chrome/")==false) {
	    // SAFARI
	    $ExactBrowserNameBR="Safari";
	} else {
	    // OUT OF DATA
	    $ExactBrowserNameBR="OUT OF DATA";
	};

	return $ExactBrowserNameBR;
};


//get browser
$browser = ExactBrowserName();

function detect(){
	//Detect special conditions devices
	$iPod    = stripos($_SERVER['HTTP_USER_AGENT'],"iPod");
	$iPhone  = stripos($_SERVER['HTTP_USER_AGENT'],"iPhone");
	$iPad    = stripos($_SERVER['HTTP_USER_AGENT'],"iPad");
	$Android = stripos($_SERVER['HTTP_USER_AGENT'],"Android");
	$webOS   = stripos($_SERVER['HTTP_USER_AGENT'],"webOS");

	//do something with this information
	if( $iPod || $iPhone ){
		$device = 'iPhone';
	    //browser reported as an iPhone/iPod touch -- do something here
	}else if($iPad){
		$device = 'iPad';
	    //browser reported as an iPad -- do something here
	}else if($Android){
		$device = 'Android';
	    //browser reported as an Android device -- do something here
	}else if($webOS){
		$device = 'webOS';
	    //browser reported as a webOS device -- do something here
	} else {
		$device = 'PC';
	}
	return $device;
};

$os = detect();


$sql="INSERT INTO tb_skripsi (waktu, ip, browser, device, nama, alamat, koordinat, verifikasi) VALUES ('$dt', '$ip', '$browser', '$os', '$nama', '$alamat', '$koordinat', '$verifikasi')";

if ($conn->query($sql) === TRUE) {
// echo "New record created successfully";

};

$conn->close();

function Redirect($url, $permanent = false)
{
    if (headers_sent() === false)
    {
        header('Location: ' . $url, true, ($permanent === true) ? 301 : 302);
    }

    exit();
}
$alamat_clean = str_replace(" ","+",$alamat);
// echo "alamat $alamat_clean";
$situs='https://docs.google.com/forms/d/e/1FAIpQLSfwNz_GhdHbPShGO5i8zIWQ9qMkLvlZmuMGF51uPBqcsv7EeA/viewform?usp=pp_url&entry.519266668='. $alamat_clean;
// echo "$situs";
if ($verifikasi === "Ya"){
	Redirect($situs, false);
}
?>

