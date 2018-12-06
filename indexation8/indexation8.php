<?php

$source ="source.html";
traitement($source);

function traitement($source)
{


	//1 : traitement de head 


	//2 :traitement de body

	$coefficient = 1.5;
	$tab_head=occurences2_poids($tab_head,$coefficient);
	$tab_mot_poids = fusion_deux_tableaux ($tab_head,$tab_body);

	print_r($tab_mot_poids);
}

function  fusion_deux_tableaux ($tab_head,$tab_body)
{
foreach($tab_head as $mot => $occurence) {

    if (array_key_exists($mot, $tab_body)) $tab_body[$mot] += $occurence;
    
    else  $tab_body[$mot] = $occurence;
    
   
}

return $tab_body;
}
  //  print_r($tabbody);

function occurences2_poids($tab,$coefficient){
    foreach($tab as $key => $value)
    {
        $tab[$key] *= $coefficient;
    }
    return $tab;
}

?>
