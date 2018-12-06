HTML_ENTITIES: tous les caractères éligibles en entités HTML.
<?php
//transformation de html en ascii
function entitesHtml_toasci($chaine)
{
	// retourne la table de traduction des entités utilisée en interne par la htmlentities():
	$table_caracts_html = get_html_translation_table(HTML_ENTITIES)  
	// retourne un tableau dont les clés sont les valeurs du précédent $table_caracts_html, et les valeurs sont les clés. 
	$tableau_html_caracts =  array_flip ( $table_caracts_html ) 
	 // retourne une chaine de caractères après avoir remplacé les éléments/clés par les éléments/valeurs  du tableau associatif de
	//paires  $tableau_html_caracts dans la chaîne $chaine.
	$chaine  =  strtr ($chaine,   $tableau_html_caracts ) 

	retourn $chaine;
}
?>
