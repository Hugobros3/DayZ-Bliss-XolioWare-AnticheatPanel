<?php

function checkInv($inv)
{
$important = "";
//start checks
$important = checkAndAdd($important,"NVGoggles",$inv);
$important = checkAndAdd($important,"M9SD",$inv);
$important = checkAndAdd($important,"AS50",$inv);
$important = checkAndAdd($important,"M4A1_HWS_GL_SD_Camo",$inv);
$important = checkAndAdd($important,"DMR",$inv);
$important = checkAndAdd($important,"SVD",$inv);
$important = checkAndAdd($important,"M107",$inv);
$important = checkAndAdd($important,"DZ_Backpack",$inv);
$important = checkAndAdd($important,"Mk_48_DZ",$inv);
//$important = checkAndAdd($important,"ALICE",$inv);
//end checks
return $important;
}
function checkAndAdd($src,$check,$inv)
{
	if(checkIfContains($inv,$check))
	{
		$src = $src . $check . " ";
	}
	return $src;
}

function checkIfContains($haystack,$needle)
{
$pos = strpos($haystack,$needle);
if($pos === false) {
 return false;
}
else {
 return true;
}



}