<div id="logininfo">
<?php
if(isset($_POST['user']) && isset($_POST['pass']))
{
	$logintry = $xpdo->prepare('SELECT * FROM xadmin_users WHERE user LIKE :user AND md5 LIKE :md5');
	try {
		$logintry->execute(array(
		'user'=>$_POST['user'],
		'md5'=>md5($_POST['pass'])
		));
		if($logintry->rowCount() > 0)
		{
		$_SESSION['user'] = $_POST['user'];
		//$_SESSION['id'] = logintry->fetch(PDO::FETCH_OBJ);
		?> You are now logged in ! <br/>
		<a href="index.php">Please click here to get back to main page and continue.</a> <?php
		}
		else
		{
		?> Wrong user/pass ! <br/>
		<a href="index.php">Please click here to get back to main page.</a> <?php
		}
	}
	catch( Exception $e ){
	  echo 'Error executing request : ', $e->getMessage();
	}
}
else
{
echo "ERROR : missing fields !";
}
?>
</div>