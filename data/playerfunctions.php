<?php
function getPlayerNameWithUID($uid)
{
	global $xpdo;
	$uidreq = "SELECT * FROM profile WHERE unique_id = " . $uid;
	$uidreqinst = $xpdo->prepare($uidreq);
	$uidreqinst->execute();
	$uidreqans = $uidreqinst->fetch();
	return $uidreqans['name'];

}
function isPlayerBanned($uid)
{
global $xpdo;
$uidreq = "SELECT * FROM xadmin_banned WHERE uid = " . $uid;
$uidreqinst = $xpdo->prepare($uidreq);
$uidreqinst->execute();
if($uidreqinst->rowCount() > 0){
	return true;}
else{
	return false;}
}
function isPlayerGreenlisted($uid)
{
global $xpdo;
$uidreq = "SELECT * FROM xadmin_greenlist WHERE uid = " . $uid;
$uidreqinst = $xpdo->prepare($uidreq);
$uidreqinst->execute();
if($uidreqinst->rowCount() > 0){
	return true;}
else{
	return false;}
}
function parseWorldSpace($worldspace)
{

	$posX = "445";
	$posY = "78";
	$nbsep = 0;
	$var = "";
	//echo $worldspace."-";
	for($i = 0; $i < strlen($worldspace);$i++)
	{
		//echo(substr($worldspace,$i,1));
		if(substr($worldspace,$i,1) == "[" || substr($worldspace,$i,1) == ",")
		{ 
			//echo "slash";
			if($nbsep == 3)
			{
				$posX = $var;
			}
			if($nbsep == 4)
			{
				$posY = $var;
			}
			$var = "";
			$nbsep++;
		}
		else
		{
			//echo "(".substr($worldspace,$i,1).")";
			$var = $var.substr($worldspace,$i,1);
		}
	}
	return array($posX,$posY);
}
function toWorldSpace($posX,$posY,$rot)
{
$ws = "[".$rot.",[".$posX.", ".$posY.", 0]]";
return $ws;
}
?>