<?php

//tokenisation de la chaine en mot 
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

//afficher le tableau avec les indices et valeurs
function print_tab($tab)
{
	foreach ($tab 	as $indice=>$mot)
         echo $indice,":",$mot,"<br>";
}

//extraction des keywords et description des metas html
function get_keywords_description($source_html)
{
	//les  metas keywords +description
	$tab_metas = get_meta_tags($source_html);
	return $tab_metas["keywords"]. " " . $tab_metas["description"];
}

//extraction de title de html 
function get_title($source_html)
{
	$chaine_html = implode(file ($source_html), " ") ;

	$modele ="/<title>(.*)<\/title>/si";

	preg_match($modele,$chaine_html,$titre);

	return $titre[1];

}







?>