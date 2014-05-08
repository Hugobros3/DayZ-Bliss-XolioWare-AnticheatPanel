<?php
if(isset($_GET['teleport']) && isset($_POST['to']))
{
$req = "UPDATE survivor SET worldspace = '".$_POST['to']."' WHERE id =".$_GET['teleport'];
$banhim = $xpdo->prepare($req);
$banhim->execute();
?><font color=green>User <?php echo getPlayerNameWithUID($_GET['teleport']); ?> teleported</font><?php
}
?>