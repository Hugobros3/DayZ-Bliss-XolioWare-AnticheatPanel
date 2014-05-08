<?php
header ("Content-type: image/png"); // 1 : on indique qu'on va envoyer une image PNG

include('../configuration.php');
include('static.php');
include('db.php');
include('playerfunctions.php');

function getPlayerColor($uid,$image)
{
if(isPlayerBanned($uid))
{ return imagecolorallocate($image, 255,0,0); }
if(isPlayerGreenlisted($uid))
{ return imagecolorallocate($image, 0,255,0); }
return imagecolorallocate($image, 0,0,255);
}

if($_GET['reso'] == "normal")
{
	$image = imagecreatefrompng("chernarus.png"); // 2 : on crée une nouvelle image
}
if($_GET['reso'] == "low")
{
	$image = imagecreatefrompng("chernaruslow.png"); // 2 : on crée une nouvelle image
}

//Vehicules

if(!($_GET['show']=="players"))
{
	$req = "SELECT * FROM v_vehicle";// WHERE last_updated > ".$oneminbefore;
	$reqvehicles = $xpdo->prepare($req);
	$reqvehicles->execute();
	while($vehicles = $reqvehicles->fetch())
	{
		list($posX,$posY) = parseWorldSpace($vehicles['worldspace']);
		$name = $vehicles['class_name'];
		if($_GET['reso'] == "normal")
		{
			$posX = $posX/15000.0*1035;
			$posY = (15000-$posY)/14.0;
			imagestring($image, 4, $posX, $posY-20, $name, imagecolorallocate($image, 0,0,0));
			imageRectangle($image, $posX-5, $posY-5,$posX+5,$posY+5, imagecolorallocate($image, 0,0,0));
		}
		if($_GET['reso'] == "low")
		{
			$posX = $posX/30000.0*1035;
			$posY = (15000-$posY)/28.0;
			imagestring($image, 1, $posX-10, $posY-10, $name, imagecolorallocate($image, 0,0,0));
			imageRectangle($image, $posX-2, $posY-2,$posX+2,$posY+2, imagecolorallocate($image, 0,0,0));
		}
			
	}
}

// Players
if(!($_GET['show']=="vehicles"))
{
	$oneminbefore = time()-60;
	$req = "SELECT * FROM survivor WHERE is_dead='0'";// WHERE last_updated > ".$oneminbefore;
	$reqplayers = $xpdo->prepare($req);
	$reqplayers->execute();
	while($players = $reqplayers->fetch())
	{
		if(strtotime($players['last_updated']) > $oneminbefore)
			{
				list($posX,$posY) = parseWorldSpace($players['worldspace']);
				$name = getPlayerNameWithUID($players['unique_id']);
				if($_GET['reso'] == "normal")
				{
					$posX = $posX/15000.0*1035;
					$posY = (15000-$posY)/14.0;
					imagestring($image, 4, $posX, $posY-20, $name, imagecolorallocate($image, 0,0,0));
					imageRectangle($image, $posX-5, $posY-5,$posX+5,$posY+5, getPlayerColor($players['unique_id'],$image));
				}
				if($_GET['reso'] == "low")
				{
					$posX = $posX/30000.0*1035;
					$posY = (15000-$posY)/28.0;
					imagestring($image, 1, $posX-10, $posY-10, $name, imagecolorallocate($image, 0,0,0));
					imageRectangle($image, $posX-2, $posY-2,$posX+2,$posY+2, getPlayerColor($players['unique_id'],$image));
				}
			}
	}
}


//imagestring($image, 4, 35, 15, "Salut les Zéros !", imagecolorallocate($image, 0,0,0));

// 3 : on s'amuse avec notre image (on va apprendre à le faire)
imagepng($image); // 4 : on a fini de faire joujou, on demande à afficher l'image
?>