<?php 	
require_once 'pass.php';
if (($_POST['truth']) == $pass){
$data = file_get_contents('webring.json');
$data = json_decode($data, true);
$numba = $_POST['numba'];
$data[$numba]['url'] = $_POST['url'];
$data[$numba]['title'] = $_POST['title'];
$data[$numba]['date'] = $_POST['date'];
$data[$numba]['c'] = $_POST['slug'];
$data[$numba]['state'] = $_POST['state'];

$data = json_encode($data);
file_put_contents('webring.json', $data);
header('Location:./');
}else{?>

<!DOCTYPE HTML>

<html lang="en">
<head>
<title>add a site to the webring</title>
</head>
<body style="width:456px;margin:0 auto">

<?php 
$site = strtolower($_GET['s']);
$mem = file_get_contents('webring.json');
$mem = json_decode($mem, true);
$mem = array_values($mem);
$me = count($mem); $max = $me - 1;

foreach (range(0,$max) as $nr){?><div style="font-size:13px;line-height:20px;text-align:right;margin:10px auto;">
<form action="edit.php" method="post">
<div style="display:flex; column-gap:34px; flex-wrap:wrap; width:100%">
<div>url <input type="text" value="<?php echo ($mem[$nr]['url']);?>" size="35" name="url"><br>
title <input type="text" value="<?php echo ($mem[$nr]['title']);?>" size="35" name="title"><br>
date <input type="text" value="<?php echo ($mem[$nr]['date']);?>" size="35" name="date"><br>
slug <input type="text" value="<?php echo ($mem[$nr]['c']);?>" size="35" name="slug"><br>
state <input type="text" value="<?php echo ($mem[$nr]['state']);?>" size="35" name="state"><br>
password <input type="text" maxlength="100" name="truth" size="35"><p>
<input type="submit" name="submit" value="update entry">
</div>
<div style="text-align:left;padding-top:50px; font-size:50px"><input type="hidden" value="<?php echo $nr;?>" size="36" name="numba"><?php echo $nr + 1;?></div>
</div>
</form>
</div>
<hr>
<?php };?></body>
</html>
<?php };?>
