<?php

$error = false;
$time = time();
$user =  $_POST['userpost'];
$url = $_POST['urlpost'];
$sname = $_POST['snamepost'];
$mail = $_POST['mailpost'];
$slug = strtolower($_POST['slugpost']);
$headers = 'From: ' . $mail . "\r\n" . 'Reply-To: ' . $mail . "\r\n";

$mem = file_get_contents('webring.json');
$mem = json_decode($mem, true);
$mem = array_values($mem);
$me = count($mem); $max = $me - 1;
$slugmatch = 0;
foreach (range(0,$max) as $nr){if ($mem[$nr]['c'] == $slug){$slugmatch = 1;}}

if (!empty($_POST['userpost']) && !empty($_POST['urlpost']) && !empty($_POST['snamepost']) && !empty($_POST['mailpost']) && !empty($_POST['slugpost']) && empty($_POST['email']) && ($slugmatch == 0)) {
$line = "name: " . $user . "\nemail: " . $mail .  "\n,\n{\n\"url\": \"" . $url . "\",\n\"title\": \"" . $sname . "\",\n\"date\": \"" . $time . "\",\n\"c\": \"" . $slug . "\"\n}\n\n";
$mailline = $line.'click link to add to ring:

https://linktowebring.com/check.php?url='.str_replace(' ','%20',$url).'&title='.str_replace(' ','%20',$sname).'&date='.$time.'&slug='.$slug;

// uncomment and adapt the line below to get an email with an addlink every time someone applies
// mail('your@email.net', 'webring application', $mailline, $headers);

$file = fopen($data, 'a');
  if (!fwrite($file, $line)) {
   $error = 'I could not submit this application, not sure what went wrong.<p>';
}
fclose($file);
unset($_POST);
} elseif (!empty($_POST['userpost']) && !empty($_POST['urlpost']) && !empty($_POST['snamepost']) && !empty($_POST['mailpost']) && !empty($_POST['slugpost']) && empty($_POST['email']) && ($slugmatch == 1)){$error = 'It looks to me like your 3 letter code is already taken.<p>';
} else {
$error = 'It looks to me like you did not fill in one of the fields - all fields are required for this form to work, except the one that\'s labeled \'do not put anything in this field!\'<p>';
}
?>
