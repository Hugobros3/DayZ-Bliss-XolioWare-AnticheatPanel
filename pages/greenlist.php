<?php
if(isset($_GET['green']))
{
$req = "INSERT INTO xadmin_greenlist ( id, uid ) VALUES ( NULL, ".$_GET['green'].") ";
$greenlisthim = $xpdo->prepare($req);
$greenlisthim->execute();
?><font color=green>User <?php echo getPlayerNameWithUID($_GET['green']); ?> greenlistned.</font><?php
}
if(isset($_GET['ungreen']))
{
$req = "DELETE FROM xadmin_greenlist WHERE uid=".$_GET['ungreen']."";
$greenlisthim = $xpdo->prepare($req);
$greenlisthim->execute();
?><font color=red>User <?php echo getPlayerNameWithUID($_GET['ungreen']); ?> ungreenlistned.</font><?php
}
?>

<h3>greenlistned users list</h3>
<table>
<?php
//Listing alive characters and giving their name and access to quick functions ( ie greenlist )
$reqgreenlist = $xpdo->prepare("SELECT * FROM xadmin_greenlist ORDER BY uid DESC");
$reqgreenlist->execute();
while($greenlistned = $reqgreenlist->fetch())
{
$reqname = $xpdo->prepare("SELECT * FROM profile WHERE unique_id = " . $greenlistned['uid']);
$reqname->execute();
$reqans = $reqname->fetch()
?><tr>
<td><?php echo $reqans['name']; ?> </td>
<td><?php echo $greenlistned['uid']; ?> </td>
	<td><a href="index.php?page=greenlist&ungreen=<?php echo $greenlistned['uid']; ?>"> Ungreenlist player </a> </td>
</tr>
<?php
}
?>
</table>
