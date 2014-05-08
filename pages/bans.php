<?php
if(isset($_GET['ban']))
{
$req = "INSERT INTO xadmin_banned ( id, uid ) VALUES ( NULL, ".$_GET['ban'].") ";
$banhim = $xpdo->prepare($req);
$banhim->execute();
?><font color=red>User <?php echo getPlayerNameWithUID($_GET['ban']); ?> banned.</font><?php
}
if(isset($_GET['unban']))
{
$req = "DELETE FROM xadmin_banned WHERE uid=".$_GET['unban']."";
$banhim = $xpdo->prepare($req);
$banhim->execute();
?><font color=green>User <?php echo getPlayerNameWithUID($_GET['unban']); ?> unbanned.</font><?php
}
?>

<h3>Banned users list</h3>
<table>
<?php
//Listing alive characters and giving their name and access to quick functions ( ie ban )
$reqban = $xpdo->prepare("SELECT * FROM xadmin_banned ORDER BY uid DESC");
$reqban->execute();
while($banned = $reqban->fetch())
{
$reqname = $xpdo->prepare("SELECT * FROM profile WHERE unique_id = " . $banned['uid']);
$reqname->execute();
$reqans = $reqname->fetch()
?><tr>
<td><?php echo $reqans['name']; ?> </td>
<td><?php echo $banned['uid']; ?> </td>
	<td><a href="index.php?page=ban&unban=<?php echo $banned['uid']; ?>"> Unban player </a> </td>
</tr>
<?php
}
?>
</table>
