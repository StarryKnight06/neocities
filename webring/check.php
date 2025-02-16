<?php 	
require_once 'pass.php';
if (($_POST['truth']) == $pass){
$data = file_get_contents('webring.json');
$arr = json_decode($data);

$newdata = array('url' => $_POST['url'], 'title' => $_POST['title'], 'date' => $_POST['date'], 'c' => $_POST['slug'], 'state' => $_POST['state']);
$newdata = str_replace("\\","",$newdata);
$arr[] = $newdata;
$arr = json_encode($arr);
$arr = str_replace('"0"','0',$arr);
$arr = str_replace('"1"','1',$arr);
$arr = str_replace('"2"','2',$arr);
$arr = str_replace("},","},\n",$arr);
$arr = str_replace(",",",\n",$arr);
file_put_contents('webring.json', $arr);

header('Location:./');

}else{?>

<!DOCTYPE HTML>

<html lang="en">
<head>
<title>add a site to the webring</title>
</head>
<body style="width:456px;margin:0 auto">

<div style="font-size:13px;line-height:20px;text-align:right;margin:50px auto;width:300px">
<form action="check.php" method="post">
url <input type="text" value="<?php echo $_GET['url'];?>" size="30" name="url"><p>
title <input type="text" value="<?php echo $_GET['title'];?>" size="30" name="title"><p>
date <input type="text" value="<?php echo $_GET['date'];?>" size="30" name="date"><p>
slug <input type="text" value="<?php echo $_GET['slug'];?>" size="30" name="slug"><p>
links &nbsp;&nbsp;&nbsp;<input type="radio" name="state" value="2"> yes &nbsp;&nbsp;&nbsp; <input type="radio" name="state" value="1"> no<p>
password <input type="text" maxlength="100" name="truth" size="30"><p>
<input type="submit" name="submit" value="activate the device">
</form>
</div>

</body>
</html>

<?php };?>
