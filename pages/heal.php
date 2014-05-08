<?php
if(isset($_GET['heal']))
{
$req = "UPDATE survivor SET medical = '[false,false,false,false,false,false,false,12000,[],[0,0],0,[15.87,19.553]]', is_dead='0' WHERE id =".$_GET['heal'];
$banhim = $xpdo->prepare($req);
$banhim->execute();
?><font color=green>User <?php echo getPlayerNameWithUID($_GET['heal']); ?> healed.</font><?php
}
?>