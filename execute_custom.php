<?php
session_start();
?>
<html>
<title>Execute Custom Operation | CBAM REST Client</title>
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
$CUSTOM_OPERATION_NAME='';
$KEY_A='';
$VALUE_A='';
$KEY_B='';
$VALUE_B='';
$KEY_C='';
$VALUE_C='';
$KEY_D='';
$VALUE_D='';
$KEY_E='';
$VALUE_E='';

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
if(isset($_POST['vnf_id'])){
    $VNF_ID=$_POST['vnf_id'];
}
if(isset($_POST['custom_operation_name'])){
    $CUSTOM_OPERATION_NAME=$_POST['custom_operation_name'];
}
if(isset($_POST['key_a'])){
    $KEY_A=$_POST['key_a'];
}
if(isset($_POST['key_b'])){
    $KEY_B=$_POST['key_b'];
}
if(isset($_POST['key_c'])){
    $KEY_C=$_POST['key_c'];
}
if(isset($_POST['key_d'])){
    $KEY_D=$_POST['key_d'];
}
if(isset($_POST['key_e'])){
    $KEY_E=$_POST['key_e'];
}
if(isset($_POST['value_a'])){
    $VALUE_A=$_POST['value_a'];
}
if(isset($_POST['value_b'])){
    $VALUE_B=$_POST['value_b'];
}
if(isset($_POST['value_c'])){
    $VALUE_C=$_POST['value_c'];
}
if(isset($_POST['value_d'])){
    $VALUE_D=$_POST['value_d'];
}
if(isset($_POST['value_e'])){
    $VALUE_E=$_POST['value_e'];
}

echo "<b style='font-size:20px;'><a href='index.php'>Get CBAM Access Token</a></b>&nbsp;&nbsp;<object style='font-size:20px;'><select style='font-size:20px;' onchange='if (this.value) window.location.href=this.value'><option style='font-size:20px;' value='upload_package.php'>Upload VNF Package</option><option style='font-size:20px;' value='create_vnf.php'>Create VNF</option><option style='font-size:20px;' value='modify_extensions.php'>Modify Extensions</option><option style='font-size:20px;' value='instantiate_vnf.php'>Instantiate VNF</option><option style='font-size:20px;' value='scale_vnf.php'>Scale VNF</option><option style='font-size:20px;' value='heal_vnf.php'>Heal VNF</option><option style='font-size:20px;' value='execute_custom.php' selected>Execute Custom Operation</option><option style='font-size:20px;' value='terminate_vnf.php'>Terminate VNF</option><option style='font-size:20px;' value='cancel_operation.php'>Cancel Operation</option><option style='font-size:20px;' value='delete_vnf.php'>Delete VNF</option><option style='font-size:20px;' value='change_package_version.php'>Change Package Version</option><option style='font-size:20px;' value='delete_package.php'>Delete VNF Package</option><option style='font-size:20px;' value='list_packages.php'>List VNF Packages</option></select><br><br>";
echo "<form action='".htmlspecialchars($_SERVER['PHP_SELF'])."' method='post'><input type='text' name='cbam_ip' placeholder='CBAM IP' style='display:inline; 
        position:relative; font-size:16px; padding:3px; border:1px solid #474747;  background-color: #FFF; width:522px;' value='".$CBAM_IP."'></input>";
echo "<br><br><input type='text' name='vnf_id' placeholder='VNF ID' style='display:inline; 
        position:relative; font-size:16px; padding:3px; border:1px solid #474747; background-color: #FFF; width:522px;' value='".$VNF_ID."'></input><br>";
echo "<br><input type='text' name='custom_operation_name' placeholder='Custom Operation Name' style='display:inline; 
        position:relative; font-size:16px; padding:3px; border:1px solid #474747; background-color: #FFF; width:522px;' value='".$CUSTOM_OPERATION_NAME."'></input><br>";
echo "<BR>Additional Parameters:<br><br>";
echo "<input type='text' name='key_a' placeholder='Key' style='display:inline; position:relative; font-size:16px; padding:3px; border:1px solid #474747;  background-color: #FFF; width:257px;' value='".$KEY_A."'></input>&nbsp;<input type='text' name='value_a' placeholder='Value' style='display:inline; position:relative; font-size:16px; padding:3px; border:1px solid #474747;  background-color: #FFF; width:257px;' value='".$VALUE_A."'></input><br><br>";
echo "<input type='text' name='key_b' placeholder='Key' style='display:inline; position:relative; font-size:16px; padding:3px; border:1px solid #474747;  background-color: #FFF; width:257px;' value='".$KEY_B."'></input>&nbsp;<input type='text' name='value_b' placeholder='Value' style='display:inline; position:relative; font-size:16px; padding:3px; border:1px solid #474747;  background-color: #FFF; width:257px;' value='".$VALUE_B."'></input><br><br>";
echo "<input type='text' name='key_c' placeholder='Key' style='display:inline; position:relative; font-size:16px; padding:3px; border:1px solid #474747;  background-color: #FFF; width:257px;' value='".$KEY_C."'></input>&nbsp;<input type='text' name='value_c' placeholder='Value' style='display:inline; position:relative; font-size:16px; padding:3px; border:1px solid #474747;  background-color: #FFF; width:257px;' value='".$VALUE_C."'></input><br><br>";
echo "<input type='text' name='key_d' placeholder='Key' style='display:inline; position:relative; font-size:16px; padding:3px; border:1px solid #474747;  background-color: #FFF; width:257px;' value='".$KEY_D."'></input>&nbsp;<input type='text' name='value_d' placeholder='Value' style='display:inline; position:relative; font-size:16px; padding:3px; border:1px solid #474747;  background-color: #FFF; width:257px;' value='".$VALUE_D."'></input><br><br>";
echo "<input type='text' name='key_e' placeholder='Key' style='display:inline; position:relative; font-size:16px; padding:3px; border:1px solid #474747;  background-color: #FFF; width:257px;' value='".$KEY_E."'></input>&nbsp;<input type='text' name='value_e' placeholder='Value' style='display:inline; position:relative; font-size:16px; padding:3px; border:1px solid #474747;  background-color: #FFF; width:257px;' value='".$VALUE_E."'></input><br><br>";
echo "<input type='text' name='access_token' placeholder='Access Token' style='display:inline; 
        position:relative; font-size:16px; padding:3px; border:1px solid #474747; background-color: #FFF; width:306px;' value='".$ACCESS_TOKEN."'></input>&nbsp;<input type='submit' style='font-size:16px;' value='Execute Custom Operation'></input></form>";


if(!empty($_POST['cbam_ip']) && !empty($_POST['access_token']) && !empty($_POST['vnf_id']) && !empty($_POST['custom_operation_name'])){

$ACCESS_TOKEN=$_POST['access_token'];
$VNF_ID=$_POST['vnf_id'];
$CBAM_IP=$_POST['cbam_ip'];
$CUSTOM_OPERATION_NAME=$_POST['custom_operation_name'];

$ch = curl_init();
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_URL, "https://$CBAM_IP/vnfm/lcm/v3/vnfs/$VNF_ID/custom/$CUSTOM_OPERATION_NAME");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
if(empty($_POST['key_a']) && empty($_POST['key_b']) && empty($_POST['key_c']) && empty($_POST['key_d']) && empty($_POST['key_e'])){
curl_setopt($ch, CURLOPT_POSTFIELDS, "{}");
}
elseif(!empty($_POST['key_a']) && empty($_POST['key_b']) && empty($_POST['key_c']) && empty($_POST['key_d']) && empty($_POST['key_e'])){
curl_setopt($ch, CURLOPT_POSTFIELDS, "{\"additionalParams\":{\"$KEY_A\": \"$VALUE_A\"}}");
}
elseif(!empty($_POST['key_a']) && !empty($_POST['key_b']) && empty($_POST['key_c']) && empty($_POST['key_d']) && empty($_POST['key_e'])){
curl_setopt($ch, CURLOPT_POSTFIELDS, "{\"additionalParams\":{\"$KEY_A\": \"$VALUE_A\", \"$KEY_B\": \"$VALUE_B\"}}");
}
elseif(!empty($_POST['key_a']) && !empty($_POST['key_b']) && !empty($_POST['key_c']) && empty($_POST['key_d']) && empty($_POST['key_e'])){
curl_setopt($ch, CURLOPT_POSTFIELDS, "{\"additionalParams\":{\"$KEY_A\": \"$VALUE_A\", \"$KEY_B\": \"$VALUE_B\", \"$KEY_C\": \"$VALUE_C\"}}");
}
elseif(!empty($_POST['key_a']) && !empty($_POST['key_b']) && !empty($_POST['key_c']) && !empty($_POST['key_d']) && empty($_POST['key_e'])){
curl_setopt($ch, CURLOPT_POSTFIELDS, "{\"additionalParams\":{\"$KEY_A\": \"$VALUE_A\", \"$KEY_B\": \"$VALUE_B\", \"$KEY_C\": \"$VALUE_C\", \"$KEY_D\": \"$VALUE_D\"}}");
}
else {
curl_setopt($ch, CURLOPT_POSTFIELDS, "{\"additionalParams\":{\"$KEY_A\": \"$VALUE_A\", \"$KEY_B\": \"$VALUE_B\", \"$KEY_C\": \"$VALUE_C\", \"$KEY_D\": \"$VALUE_D\", \"$KEY_E\": \"$VALUE_E\"}}");
}
curl_setopt($ch, CURLOPT_POST, 1);

$headers = array();
$headers[] = "Content-Type: application/json; charset=UTF-8";
$headers[] = "Authorization: bearer $ACCESS_TOKEN";
$headers[] = "Nokia-VNFM-API-Version: 3.3";
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

$result = curl_exec($ch);
if (curl_errno($ch)) {
    $result = curl_error($ch);
}
curl_close ($ch);


echo "<textarea rows='14' cols='115' style='display:inline; position:relative; padding:3px; font-size:17px; border:1px solid #474747; background-color: #FFF; width:522px;' placeholder='Response (Content)'>$result</textarea><br><BR>";
}

else {

echo "<textarea rows='14' cols='115' style='display:inline; position:relative; padding:3px; font-size:17px; border:1px solid #474747; background-color: #FFF; width:522px;' placeholder='Response (Content)'></textarea><br><BR>";
}

?>
</body>
</html>