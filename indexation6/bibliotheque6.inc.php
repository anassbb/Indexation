<?php
	// notepad.pw/tiw
	$source_html = "source.html";

	// Affichage du retour de la fonction
	echo get_body($source_html);

	// Extraction du body en texte
    function get_body($source_html)
	{	
		$chaine_html=implode(file ($source_html),"");

		$modele_balises_scripts = '/<script[^>]*?>.*?<\/script>/is'; 

		$html_sans_script = preg_replace($modele_balises_scripts, '', $chaine_html) ;

		$modele='/<body[^>]*>(.*)<\/body>/si';

		$chaine_texte_body = preg_match($modele, $html_sans_script, $body);

		// Supprime les balise HTML, PHP, javascript ....
		$chaine_texte_body = strip_tags($body[1]);

		return $chaine_texte_body;
	}

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

?>