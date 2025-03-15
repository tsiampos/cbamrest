<html>
<title>Modify Extension | CBAM REST Client</title>
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
session_start();
?>
<?php
error_reporting(0);
$ACCESS_TOKEN='';
$EXTENSION_VALUE='';
$EXTENSION_NAME='';
$VNF_DESCRIPTION='';
$MODIFYINFO_URL='';

$SESSION_EXTNAME_STORE='';
$SESSION_EXTVALUE_STORE='';
$SESSION_MODIFYINFOURL_STORE='';
$SESSION_TOKEN_STORE='';
if (isset($_SESSION["modifyinfo_url"])) {
  $SESSION_MODIFYINFOURL_STORE=$_SESSION["modifyinfo_url"];
}
if (isset($_SESSION["extension_name"])) {
  $SESSION_EXTNAME_STORE=$_SESSION["extension_name"];
}
if (isset($_SESSION["extension_value"])) {
  $SESSION_EXTVALUE_STORE=$_SESSION["extension_value"];
}
if (isset($_SESSION["access_token"])) {
  $SESSION_TOKEN_STORE=$_SESSION["access_token"];
}


if(isset($_POST['extension_value'])){
    $EXTENSION_VALUE=$_POST['extension_value'];
}
if(isset($_POST['access_token'])){
    $ACCESS_TOKEN=$_POST['access_token'];
}
if(isset($_POST['extension_name'])){
    $EXTENSION_NAME=$_POST['extension_name'];
}
if(isset($_POST['modifyinfo_url'])){
    $MODIFYINFO_URL=$_POST['modifyinfo_url'];
}

echo "<object style='font-size:20px;'><a href='index.php' style='text-decoration:none;'>Obtain CBAM Access Token</a></object>&nbsp;&nbsp;|&nbsp;&nbsp;<object style='font-size:20px;'><a style='text-decoration:none;' href='upload_package.php'>Upload VNF Package</a></object>&nbsp;&nbsp;|&nbsp;&nbsp;<object style='font-size:20px;'><a style='text-decoration:none;' href='create_vnf.php'>Create VNF</a></object>&nbsp;&nbsp;|&nbsp;&nbsp;<b style='font-size:20px;'><a style='text-decoration:underline;' href='modify_extension.php'>Modify Extension</a></b>&nbsp;&nbsp;|&nbsp;&nbsp;<object style='font-size:20px;'><a style='text-decoration:none;' href='instantiate_vnf.php'>Instantiate VNF</a></object>&nbsp;&nbsp;|&nbsp;&nbsp;<object style='font-size:20px;'><a style='text-decoration:none;' href='scale_vnf.php'>Scale VNF</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a style='text-decoration:none;' href='heal_machine.php'>Heal Machine</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href='terminate_vnf.php' style='text-decoration:none;'>Terminate VNF</a></object>&nbsp;&nbsp;|&nbsp;&nbsp;<object style='font-size:20px;'><a style='text-decoration:none;' href='delete_vnf.php'>Delete VNF</a>&nbsp;|&nbsp;&nbsp;<a style='text-decoration:none;' href='delete_package.php'>Delete VNF Package</a></object><br><br>";
echo "<form action='".htmlspecialchars($_SERVER['PHP_SELF'])."' method='post'>";
echo "<input type='text' name='extension_name' placeholder='Extension Name' style='display:inline; 
        position:relative; padding:3px; border:1px solid #474747; font-size:16px; background-color: #FFF; width:52%;' value='".$SESSION_EXTNAME_STORE."'></input><br><br>";
echo "<input type='text' name='extension_value' placeholder='Extension Value' style='display:inline; 
        position:relative; padding:3px; border:1px solid #474747; font-size:16px; background-color: #FFF; width:52%;' value='".$SESSION_EXTVALUE_STORE."'></input><br><br>";
echo "<input type='text' name='modifyinfo_url' placeholder='ModifyInfo URL' style='display:inline; 
        position:relative; padding:3px; border:1px solid #474747; font-size:16px; background-color: #FFF; width:52%;' value='".$SESSION_MODIFYINFOURL_STORE."'></input><br><br>";
echo "<input type='text' name='access_token' placeholder='Access Token' style='display:inline; 
        position:relative; padding:3px; border:1px solid #474747; font-size:16px; background-color: #FFF; width:45.5%;' value='".$SESSION_TOKEN_STORE."'></input>&nbsp;<input type='submit' style='font-size:16px;' value='Modify Extension'></input></form>";

if(!empty($_POST['modifyinfo_url']) && !empty($_POST['access_token']) && !empty($_POST['extension_name']) && !empty($_POST['extension_value'])){

$ACCESS_TOKEN=$_POST['access_token'];
$EXTENSION_NAME=$_POST['extension_name'];
$EXTENSION_VALUE=$_POST['extension_value'];
$MODIFYINFO_URL=$_POST['modifyinfo_url'];

$ch = curl_init();
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_URL, "$MODIFYINFO_URL");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, "{\"extensions\": [{\"name\":\"$EXTENSION_NAME\", \"value\":\"$EXTENSION_VALUE\"}]}");
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PATCH");


$headers = array();
$headers[] = "Content-Type: application/json; charset=UTF-8";
$headers[] = "Authorization: bearer $ACCESS_TOKEN";
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

$result = curl_exec($ch);
if (curl_errno($ch)) {
    $result = curl_error($ch);
}
curl_close ($ch);
echo "<textarea rows='15' cols='115' style='display:inline; 
        position:relative; padding:3px; border:1px solid #474747; font-size:17px; background-color: #FFF; width:62%;' placeholder='Response (Content)'>$result</textarea><br><br>";
$_SESSION["extension_name"] = $EXTENSION_NAME;
$_SESSION["extension_value"] = $EXTENSION_VALUE;
$_SESSION["modifyinfo_url"] = $MODIFYINFO_URL;
}

else {

echo "<textarea rows='15' cols='115' style='display:inline; 
        position:relative; padding:3px; border:1px solid #474747; font-size:17px; background-color: #FFF; width:62%;' placeholder='Response (Content)'></textarea><br><br>";
}


?>
</body>
</html>