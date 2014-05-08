<?php
//Created by hugobros3 - xoliocraft.org
//Please don't use parts of the code without demanding permission.
try
{
$xpdo = new PDO('mysql:host='.$xdb_host.';dbname='.$xdb_database,$xdb_user,$xdb_password);
}
catch(Exception $e)
{
    ?>ERROR : Can't connect to MySQL database. Please check configuration.php !
	<?php
	echo $e;
    exit();
}
?>