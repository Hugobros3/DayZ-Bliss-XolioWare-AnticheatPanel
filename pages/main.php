<h2>DayZ server summary</h2>
<?php
function countTable($name)
{
	//echo "$name";
	global $xpdo;
	$query = 'SELECT * FROM ' . $name;
	$xreq = $xpdo->prepare($query);
	$xreq->execute();
	//echo $xreq->rowCount();
	return $xreq->rowCount();
	
}
function countAliveSurvivors()
{
	global $xpdo;
	$xreq = $xpdo->prepare("SELECT * FROM survivor WHERE is_dead = 0");
	$xreq->execute();
	return $xreq->rowCount();
}
//echo countTable("profile");
?>
<h3>Stats</h3>
There is <?php echo countTable("profile"); ?> user profiles on this server, who can find <?php echo countTable("vehicle"); ?> types of vehicules in <?php echo countTable("world_vehicle"); ?> spots and loot <?php echo countTable("instance_building"); ?> custom buildings.<br/>
Currently, <?php echo countAlivesurvivors() ?> survivors can travel arround with <?php echo countTable("instance_vehicle"); ?> vehicules and find <?php echo countTable("instance_deployable"); ?> tents, tank traps and other objects.
<h3>Player list</h3>
<table>
<td>Name : </td>
<td>UID : </td>
<td>Position : </td>
<td>Inventory : </td>
<td>Backpack : </td>
<td>Actions : </td>
<?php
//Listing alive characters and giving their name and access to quick functions ( ie ban )
$requsers = $xpdo->prepare("SELECT * FROM survivor WHERE is_dead = 0");
$requsers->execute();
while($player = $requsers->fetch())
{
	if(isPlayerBanned($player['unique_id']))
	{
		?><tr class="banned"><?php
	}
	else
	{
		if(isPlayerGreenlisted($player['unique_id']))
		{
			?><tr class="greenlist"><?php
		}
		else
		{
		?><tr><?php
		}
	}
	?>
	<td><?php echo getPlayerNameWithUID($player['unique_id']); ?> </td>
	<td><?php echo $player['unique_id']; ?> </td>
	<td><?php echo $player['worldspace']; ?> </td>
	<td><?php echo(checkInv($player['inventory'])); ?></td>
	<td><?php echo(checkInv($player['backpack'])); ?></td>
	<td><a href="index.php?page=ban&ban=<?php echo $player['unique_id']; ?>"> Ban player </a></td>
	<td><a href="index.php?page=greenlist&green=<?php echo $player['unique_id']; ?>"> Greenlist player </a></td>
	<td><a href="index.php?page=heal&heal=<?php echo $player['id']; ?>"> Heal player </a></td>
	<td><form method="post" action="index.php?page=teleport&teleport=<?php echo $player['id']; ?>""><input type="text" name="to" id="to" /><input type="submit" value="Teleport" /></form></td>
	</tr>
	<?php
}
?>
</table>