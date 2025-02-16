<!DOCTYPE HTML>

<html lang="en">
<head>
<title>a php webring</title>
</head>
<body style="width:456px;margin:0 auto">
<h1><?php
$data = 'applications.txt'; require_once 'write.php'; if ($error !== false){echo 'application failed';} else {echo 'application successful';}?></h1>

<?php
if ($error !== false){echo $error;}
else {?>
Your application for the webring has been received in good order!
<?php };?><p>

<div style="text-align:center; font-size:20px"><a href="./<?php if($error !== false){echo '#join';} else {if($slug !== ""){echo '?slug='.$slug;} echo '#links';}?>">← go back to the ring page</a></div>

</body>
</html>
