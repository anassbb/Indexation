HTML_ENTITIES: tous les caract�res �ligibles en entit�s HTML.
<?php
//transformation de html en ascii
function entitesHtml_toasci($chaine)
{
	// retourne la table de traduction des entit�s utilis�e en interne par la htmlentities():
	$table_caracts_html = get_html_translation_table(HTML_ENTITIES)  
	// retourne un tableau dont les cl�s sont les valeurs du pr�c�dent $table_caracts_html, et les valeurs sont les cl�s. 
	$tableau_html_caracts =  array_flip ( $table_caracts_html ) 
	 // retourne une chaine de caract�res apr�s avoir remplac� les �l�ments/cl�s par les �l�ments/valeurs  du tableau associatif de
	//paires  $tableau_html_caracts dans la cha�ne $chaine.
	$chaine  =  strtr ($chaine,   $tableau_html_caracts ) 

	retourn $chaine;
}
?>
