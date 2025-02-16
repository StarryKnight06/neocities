<!DOCTYPE HTML>

<html lang="en">
<head>
<title>a php webring</title>
</head>
<body style="width:456px;margin:0 auto">

<h1>a php webring</h1>

<?php
$data = 'applications.txt';
require_once 'write.php';
$site = strtolower($_GET['s']);
$mem = file_get_contents('webring.json');
$mem = json_decode($mem, true);
$mem = array_values($mem);
$me = count($mem); $max = $me - 1;
$rnd = rand(0,$max);
foreach (range(0,$max) as $nr) {if($mem[$nr]['c'] == $site){$me = $nr;}}
$prv = $me; $nxt = $me;
do {$prv = $prv - 1; if($prv < 0){$prv = $max;}} while (($mem[$prv]['state'] == 1)||($mem[$prv]['state'] == 0));
do {$nxt = $nxt + 1; if($nxt > $max){$nxt = 0;}} while (($mem[$nxt]['state'] == 1)||($mem[$nxt]['state'] == 0));
do {$rnd = rand(0,$max);} while (($mem[$rnd]['state'] == 1)||($mem[$rnd]['state'] == 0));
if (isset ($_GET['rnd'])){header('Location:'.$mem[$rnd]['url']);}
elseif (isset ($_GET['prv'])){header('Location:'.$mem[$prv]['url']);}
elseif (isset ($_GET['nxt'])){header('Location:'.$mem[$nxt]['url']);}
?>

Welcome to the webring page!

<hr>

<h2 id="members">list of members</h2>

Here's <a href="webring.json" target="_blank">a list</a> of all <?php echo $max + 1?> members of the webring. If an entry has a <span style="background:#aaa">gray background</span> that means its links aren't in place yet and it's currently being skipped over in the ring; if an entry is <span style="color:#aaa;background:#ddd">light gray</span>, that means it's down and also being skipped.<p>

<?php foreach (range(0,$max) as $nr){
if($mem[$nr]['state'] == 1){$nolinks = 'style="background:#aaa" title="no ringlinks" ';} elseif($mem[$nr]['state'] == 0){$nolinks = 'style="color:#aaa;background:#ddd" title="site down" ';} else {$nolinks = '';}
echo str_pad(($nr + 1),2,"0",STR_PAD_LEFT) .'. <a '.$nolinks.'href="'.($mem[$nr]['url']).'" target="_blank">'.($mem[$nr]['title']).'</a><span style="float:right">'.date('Y-m-d', ($mem[$nr]['date'])).' / '.($mem[$nr]['c']).'</span><br>
';}?>
</div>

<hr>

<h2 id="join">join the webring</h2>

Join by filling in this form and hitting 'send application'.<p>

<form action="thanks.php" method="post" style="text-align:right">
<label>website url: <input type="text" maxlength="100" name="urlpost" size="39"<?php if (isset($_POST['urlpost'])) echo ' value="' . $_POST['urlpost'] . '"'; ?>></label><p>
<label>website name: <input type="text" maxlength="100" name="snamepost" size="39"<?php if (isset($_POST['snamepost'])) echo ' value="' . $_POST['snamepost'] . '"'; ?>></label><p>
<label>3 letter code: <input type="text" pattern="[A-Za-z]{3}" maxlength="3" name="slugpost" size="39"<?php if (isset($_POST['slugpost'])) echo ' value="' . $_POST['slugpost'] . '"'; ?>></label><p>
<label>your name: <input type="text" name="userpost" maxlength="100" size="39"<?php if (isset($_POST['userpost'])) echo ' value="' . $_POST['userpost'] . '"'; ?>></label><p>
<label>email address: <input type="text" maxlength="100" name="mailpost" size="39"<?php if (isset($_POST['mailpost'])) echo ' value="' . $_POST['mailpost'] . '"'; ?>></label><p>
<input type="submit" name="submit" value="send application">
<label style="position:absolute; left:-5000px">don't put anything in this field!<br><input type="text" name="email" style="position:absolute; left:-5000px" size="16"<?php if (isset($_POST['email'])) echo 'value="' . $_POST['email'] . '"'; ?>></label>
</form><p>

<hr>

<h2 id="links">add the links to your page</h2>

Provide your chosen 3 letter code to generate ready-to-use links and widgets:<p>

<?php
$mklinx = '<div style="margin-bottom:30px">
<form style="text-align:center" action="#links" method="post">your 3 letter code: <input pattern="[A-Za-z]{3}" value="'.$_GET['slug'].'" type="text" maxlength="3" name="code" size="3"><p><input type="submit" name="submit" value="show ready-to-use HTML code"></form></div>';

if (($_POST['code']) != '') {$code = strtolower($_POST['code']); echo $mklinx;?>
https://linktothispage.com/?prv&s=<b style="background:#ddd"><?php echo $code;?></b><br>
https://linktothispage.com<br>
https://linktothispage.com/?rnd<br>
https://linktothispage.com/?nxt&s=<b style="background:#ddd"><?php echo $code;?></b><p>
<?php } else echo $mklinx;?>

<div style="font-size:20px; text-align:center">
<a href="https://linktothispage.com/?prv&s=bfc" style="float:left">&lt; prev</a>
<a href="https://linktothispage.com" target="_blank">my php webring</a>
<a class="small" href="https://linktothispage.com/?rnd">(random)</a>
<a href="https://linktothispage.com/?nxt&s=bfc" style="float:right">next &gt;</a>
</div><p>

<?php if (($_POST['code']) != '') {?>
&lt;a href="https://linktothispage.com/?prv&s=<b style="background:#ddd"><?php echo $code;?></b>" style="float:left"&gt;&lt; prev&lt;/a&gt;<br>
&lt;a href="https://linktothispage.com" target="_blank"&gt;my php webring&lt;/a&gt;<br>
&lt;a style="font-size:60%" href="https://linktothispage.com/?rnd"&gt;(random)&lt;/a&gt;<br>
&lt;a href="https://linktothispage.com/?nxt&s=<b style="background:#ddd"><?php echo $code;?></b>" style="float:right"&gt;next &gt;&lt;/a&gt;<p>
<?php } else echo $mklinx;?>

</body>
</html>
