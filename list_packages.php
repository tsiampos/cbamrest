<?php
session_start();
?>
<html>
<title>List VNF Packages | CBAM REST Client</title>
<link rel="shortcut icon" href="https://networks.nokia.com/sites/all/themes/alu_responsive/favicon.ico" type="image/vnd.microsoft.icon">
<link href="layout.css" rel="stylesheet" />
<head>
<meta charset="utf-8">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="robots" content="noindex, nofollow">

<style>
body{
  margin-left:10px; 
  margin-right:10px;
  font-family: Tahoma;
 
background-color:#F7F7F7;
overflow-x: hidden;
 }
a:hover {
    background-color: lightgreen;
    text-decoration: underline;
}
</style>
</head>
<body>
<div id="head"><h1>CBAM</h1><a href="index.php"><center><img src="pw6pWh1497554045.png" height='25' width='410' alt="logo" /></center></a></div><br>
<?php
error_reporting(0);
$ACCESS_TOKEN='';
$CBAM_IP='';
$VNF_ID='';

if (isset($_SESSION["cbam_ip"])) {
  $CBAM_IP=$_SESSION["cbam_ip"];
}
if (isset($_SESSION["access_token"])) {
  $ACCESS_TOKEN=$_SESSION["access_token"];
}

if(isset($_POST['cbam_ip'])){
    $CBAM_IP=$_POST['cbam_ip'];
}
if(isset($_POST['access_token'])){
    $ACCESS_TOKEN=$_POST['access_token'];
}

echo "<b style='font-size:20px;'><a href='index.php'>Get CBAM Access Token</a></b>&nbsp;&nbsp;<object style='font-size:20px;'><select style='font-size:20px;' onchange='if (this.value) window.location.href=this.value'><option style='font-size:20px;' value='upload_package.php'>Upload VNF Package</option><option style='font-size:20px;' value='create_vnf.php'>Create VNF</option><option style='font-size:20px;' value='modify_extensions.php'>Modify Extensions</option><option style='font-size:20px;' value='instantiate_vnf.php'>Instantiate VNF</option><option style='font-size:20px;' value='scale_vnf.php'>Scale VNF</option><option style='font-size:20px;' value='heal_vnf.php'>Heal VNF</option><option style='font-size:20px;' value='execute_custom.php'>Execute Custom Operation</option><option style='font-size:20px;' value='terminate_vnf.php'>Terminate VNF</option><option style='font-size:20px;' value='cancel_operation.php'>Cancel Operation</option><option style='font-size:20px;' value='delete_vnf.php'>Delete VNF</option><option style='font-size:20px;' value='change_package_version.php'>Change Package Version</option><option style='font-size:20px;' value='delete_package.php'>Delete VNF Package</option><option style='font-size:20px;' value='list_packages.php' selected>List VNF Packages</option></select><br><br>";
echo "<form action='".htmlspecialchars($_SERVER['PHP_SELF'])."' method='post'><input type='text' name='cbam_ip' placeholder='CBAM IP' style='display:inline; 
        position:relative; padding:3px; border:1px solid #474747; font-size:16px; background-color: #FFF; width:536px;' value='".$CBAM_IP."'></input><br><br>";
echo "<input type='text' name='access_token' placeholder='Access Token' style='display:inline; 
        position:relative; font-size:16px; padding:3px; border:1px solid #474747;  background-color: #FFF; width:378px;' value='".$ACCESS_TOKEN."'></input>&nbsp;<input type='submit' style='font-size:16px;' value='List VNF Packages'></input></form>";


if(!empty($_POST['cbam_ip']) && !empty($_POST['access_token'])){
$ACCESS_TOKEN=$_POST['access_token'];
$CBAM_IP=$_POST['cbam_ip'];

$REQUEST_TYPE="GET";
$ch = curl_init();


curl_setopt_array($ch, array(
  CURLOPT_SSL_VERIFYHOST => 0,
  CURLOPT_SSL_VERIFYPEER => 0,
  CURLOPT_URL => "https://$CBAM_IP/api/catalog/adapter/vnfpackages",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_HTTPHEADER => array(
    "authorization: Bearer $ACCESS_TOKEN",
    "Nokia-VNFM-API-Version: 3.3",
    "cache-control: no-cache",
    "content-type: application/json",
  ),
));



$result = curl_exec($ch);
if (curl_errno($ch)) {
    $result = curl_error($ch);
}
curl_close ($ch);



echo "<textarea rows='22' cols='115' style='display:inline; position:relative; padding:3px; font-size:17px; border:1px solid #474747; background-color: #FFF; width:536px;' placeholder='Response (Content)'>$result</textarea><br><BR>";
}

else {

echo "<textarea rows='22' cols='115' style='display:inline; position:relative; padding:3px; font-size:17px; border:1px solid #474747; background-color: #FFF; width:536px;' placeholder='Response (Content)'></textarea><br><BR>";
}

?>
</body>
</html>