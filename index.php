<?php
//Created by hugobros3 - xoliocraft.org
//Please don't use parts of the code without demanding permission.
session_start();

include('configuration.php');
include('data/static.php');
include('data/db.php');
include('data/inventoryParser.php');
include('data/playerfunctions.php');

//autorefresh code

$autorefresh = 0;

$updatespeed = "15";
if(isset($_GET['updatespeed']))
{
$updatespeed = $_GET['updatespeed'];
}

if(isset($_GET['page']))
{
	switch ($_GET['page']) {
		case "map":
			$autorefresh = 1;
			break;
	}
}

if($updatespeed == 0)
{
	$autorefresh = 0;
}

//end autorefresh

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="data/style.css" />
        <title>Xolio DayZ anticheat Panel</title>
		<?php
		if($autorefresh ==1)
		{
			?>
			<html>
			<head>
			<script type="text/JavaScript">
			<!--
			function timedRefresh(timeoutPeriod) {
				setTimeout("location.reload(true);",timeoutPeriod);
			}
			</script>
			    </head>

    <body onload="JavaScript:timedRefresh(<?php echo 1000*$updatespeed; ?>);">
			<?php
		}
		else
		{
		?>
		    </head>

    <body>
		<?php
		}
		?>

		<div id="logo"><a href="index.php"><img src="data/logo.png" /></a></div>
		<div id=content>
		<?php
		//Check if user is logged in
		if(!(isset($_SESSION['user'])))
		{
			if(!(isset($_POST['user'])))
			{
				include('data/login.php');
			}
			else
			{
				include('data/checklogin.php');
			}
		}
		else
		{ 
		include('data/menu.php');
		?>
		<div id="main"><?php
			include('data/userbar.php');
			if(!isset($_GET['page']))
			{
			include('pages/main.php');
			}
			else
			{
				switch ($_GET['page']) {
					case "ban":
						include('pages/bans.php');
						break;
					case "greenlist":
						include('pages/greenlist.php');
						break;
					case "heal":
						include('pages/heal.php');
						break;
					case "map":
						include('pages/map.php');
						break;
					case "teleport":
						include('pages/teleport.php');
						break;
				}
			}
			?></div><?php
		}
		?>
		</div>
		<div id="foot">
		Xolio DayZ Anticheat Panel version <?php echo $xversion; ?><br/>
		Created by hugobros3, proud owner of <a href="http://xoliocraft.org">xoliocraft.org servers</a>.<br/>
		Please don't use any of my work in another project without asking for permission.</div>
    </body>
</html>
<?php
include('data/updatebans.php');
?>