<?php
$fichier = fopen('ban.txt','w+');

$reqban = $xpdo->prepare("SELECT * FROM xadmin_banned");
$reqban->execute();
while($banned = $reqban->fetch())
{
fputs($fichier,$banned['uid']."\n");
}
fclose($fichier);
echo "<br/>Banlist updated, ".$reqban->rowCount()." players in it.";
?>