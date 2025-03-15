<?php
session_start();
?>
<html>
<title>CBAM REST Client</title>
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
$CBAM_IP='';
$CLIENT_ID='';
$CLIENT_SECRET='';

if (isset($_SESSION["client_id"])) {
  $CLIENT_ID=$_SESSION["client_id"];
}
if (isset($_SESSION["client_secret"])) {
  $CLIENT_SECRET=$_SESSION["client_secret"];
}
if (isset($_SESSION["cbam_ip"])) {
  $CBAM_IP=$_SESSION["cbam_ip"];
}

if(isset($_POST['cbam_ip'])){
    $CBAM_IP=$_POST['cbam_ip'];
}
if(isset($_POST['client_id'])){
    $CLIENT_ID=$_POST['client_id'];
}
if(isset($_POST['client_secret'])){
    $CLIENT_SECRET=$_POST['client_secret'];
}

echo "<b style='font-size:20px;'><a href='index.php'>Get CBAM Access Token</a></b>&nbsp;&nbsp;<object style='font-size:20px;'><select style='font-size:20px;' onchange='if (this.value) window.location.href=this.value'><option style='font-size:20px;' value='upload_package.php' selected>Upload VNF Package</option><option style='font-size:20px;' value='create_vnf.php'>Create VNF</option><option style='font-size:20px;' value='modify_extensions.php'>Modify Extensions</option><option style='font-size:20px;' value='instantiate_vnf.php'>Instantiate VNF</option><option style='font-size:20px;' value='scale_vnf.php'>Scale VNF</option><option style='font-size:20px;' value='heal_vnf.php'>Heal VNF</option><option style='font-size:20px;' value='execute_custom.php'>Execute Custom Operation</option><option style='font-size:20px;' value='terminate_vnf.php'>Terminate VNF</option><option style='font-size:20px;' value='cancel_operation.php'>Cancel Operation</option><option style='font-size:20px;' value='delete_vnf.php'>Delete VNF</option><option style='font-size:20px;' value='change_package_version.php'>Change Package Version</option><option style='font-size:20px;' value='delete_package.php'>Delete VNF Package</option><option style='font-size:20px;' value='list_packages.php'>List VNF Packages</option></select><br><br>";
echo "<form action='".htmlspecialchars($_SERVER['PHP_SELF'])."' method='post'><input type='text' name='cbam_ip' placeholder='CBAM IP' style='display:inline; 
        position:relative; padding:3px; border:1px solid #474747; font-size:16px; background-color: #FFF; width:536px;' value='".$CBAM_IP."'></input><br><br>";
echo "<input type='text' name='client_id' placeholder='Client ID' style='display:inline; 
        position:relative; font-size:16px; padding:3px; border:1px solid #474747;  background-color: #FFF; width:536px;' value='".$CLIENT_ID."'></input><br><br>";

echo "<input type='text' name='client_secret' placeholder='Client Secret' style='display:inline; 
        position:relative; font-size:16px; padding:3px; border:1px solid #474747;  background-color: #FFF; width:400px;' value='".$CLIENT_SECRET."'></input>&nbsp;<input type='submit' style='font-size:16px;' value='Generate Token'></input></form>";


if(!empty($_POST['cbam_ip']) && !empty($_POST['client_id']) && !empty($_POST['client_secret'])){
$ch = curl_init();
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_URL, "https://$CBAM_IP/auth/realms/cbam/protocol/openid-connect/token");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, "grant_type=client_credentials&client_id=$CLIENT_ID&client_secret=$CLIENT_SECRET");
curl_setopt($ch, CURLOPT_POST, 1);

$headers = array();
$headers[] = "Content-Type: application/x-www-form-urlencoded";
$headers[] = "Nokia-VNFM-API-Version: 3.3";
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

$result = curl_exec($ch);
$json = json_decode($result, true);
$access_token = $json['access_token'];
if (curl_errno($ch)) {
    $access_token = curl_error($ch);
}

curl_close ($ch);



echo "<textarea rows='20' cols='115' style='display:inline; position:relative; padding:3px; font-size:17px; border:1px solid #474747; background-color: #FFF; width:536px;' placeholder='Response (Access Token)'>$access_token</textarea><br>";
$_SESSION["access_token"] = $access_token;
$_SESSION["cbam_ip"] = $CBAM_IP;
$_SESSION["client_id"] = $CLIENT_ID;
$_SESSION["client_secret"] = $CLIENT_SECRET;
}

else {

echo "<textarea rows='20' cols='115' style='display:inline; position:relative; padding:3px; font-size:17px; border:1px solid #474747; background-color: #FFF; width:536px;' placeholder='Response (Access Token)'></textarea><br>";
}
?>
</body>
</html>