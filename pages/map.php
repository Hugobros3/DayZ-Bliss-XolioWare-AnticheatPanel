<?php
$securityMap = 1;
$size = "normal";
if(isset($_GET['reso']))
{
$size = $_GET['reso'];
}

$show = "players";
if(isset($_GET['show']))
{
$show = $_GET['show'];
}

?>
Map resolution : 
<a href="index.php?page=map&reso=normal&updatespeed=<?php echo $updatespeed; ?>&show=<?php echo $show;?>">Normal</a> |
<a href="index.php?page=map&reso=low&updatespeed=<?php echo $updatespeed; ?>&show=<?php echo $show;?>">Low</a>
<br/>
Refresh speed : 
<a href="index.php?page=map&reso=<?php echo $size; ?>&updatespeed=15&show=<?php echo $show;?>">15s</a> |
<a href="index.php?page=map&reso=<?php echo $size; ?>&updatespeed=5&show=<?php echo $show;?>">5s</a> |
<a href="index.php?page=map&reso=<?php echo $size; ?>&updatespeed=0&show=<?php echo $show;?>">none</a>
<br/>
Show : 
<a href="index.php?page=map&reso=<?php echo $size; ?>&updatespeed=<?php echo $updatespeed; ?>&show=players">Players</a> |
<a href="index.php?page=map&reso=<?php echo $size; ?>&updatespeed=<?php echo $updatespeed; ?>&show=vehicles">Vehicles</a> |
<a href="index.php?page=map&reso=<?php echo $size; ?>&updatespeed=<?php echo $updatespeed; ?>&show=both">Both</a>
<br/>
<img src="data/genmap.php?reso=<?php echo $size; ?>&show=<?php echo $show; ?>">