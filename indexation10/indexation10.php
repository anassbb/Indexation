<?php

include 'bibliotheque10.inc.php';

$source_html ="source.html";
traitement($source_html);

function traitement($source_html)
{   
	//1 : traitement de head 
	//séparateur tokenisation
	$separateurs=" \".',«’!?;:&-=+@#{}[]()0123456789";
	
	//récuperation de keywords et descriptif
	$keywords_description = get_keywords_description($source_html);

	
	//récuperation de titre
	$titre = strtolower(get_title($source_html));
	
	//unification des chaines à traiter 
	$texte_head =$keywords_description .  " " . $titre;
	
	//transformation du html en ascii
	$texte_head= entitesHtml_toasci($texte_head);
	
	//tokenisation des données head
	$tab_mots_occurrences = explode_bis($texte_head,$separateurs); 
	//print_r($tab_mots_occurrences);
	//passage occurrences vers poids
	$tab_mots_poids_body = array_count_values($tab_mots_occurrences);	
	//print_r($tab_mots_poids_body);
	$coefficient = 1.5;
	$tab_mots_poids_head = occurrences2poids($tab_mots_poids_body,$coefficient);
	//print_r($tab_mots_poids_head);
	

	//2 :traitement de body
	
	$texte_body = strtolower(get_body($source_html));
	//transformation du html en ascii
	$texte_body= entitesHtml_toasci($texte_body);

	//tokenisation des données head
	$tab_mots = explode_bis( $texte_body,$separateurs); 
	
	
	
	// liste de mots avec leurs nombres d'occurrences.
	$tab_mots_poids_body = array_count_values($tab_mots);
	//print_r($tab_mots_poids_body);
	
	$tab_mot_poids = fusion_deux_tableaux ($tab_mots_poids_head,$tab_mots_poids_body );
	//$tab_mots_poids_head = occurrences2poids($tab_mots_occurrences,$coefficient);
	Print_r($tab_mot_poids);


	insertionBd($tab_mot_poids,$source_html);
	
}


?>
