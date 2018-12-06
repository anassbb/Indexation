<?php

$chaine =implode(file("source.txt")," ");
$separateurs=" .',!?;";
$tab_mot =explode_bis($separateurs ,$chaine);
print_tab($tab_mot);

function explode_bis($separateurs,$chaine)
{
$tab =array();
$tok =strtok($chaine,"$separateurs");
if (strlen($tok)>2) $tab[]= $tok;
	while($tok != false)
	{
		
		
		$tok =strtok($separateurs);
		if (strlen($tok)>2)  $tab[]= $tok; 
		
	}
	return $tab;

}
function print_tab($tab)
{
	foreach ($tab 	as $indice=>$mot)
         echo $indice,":",$mot,"<br>";
}



?>