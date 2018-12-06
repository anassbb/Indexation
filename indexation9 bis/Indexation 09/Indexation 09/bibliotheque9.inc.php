<?php

global $tab_mots_vides;

//tokenisation de la chaine en mot 
function explode_bis($separateurs,$chaine)
{
$tab =array();
$tok =strtok($chaine,"$separateurs");
if (strlen(trim($tok))>2) $tab[]= $tok;
	while($tok != false)
	{		
		$tok =strtok($separateurs);
		if (strlen(trim($tok))>2 && !in_array(trim($tok),$tab_mots_vides)  $tab[]= $tok; 		
	}
	return $tab;
}

//afficher le tableau avec les indices et valeurs
function print_tab($tab)
{
	foreach ($tab 	as $indice=>$mot)
         echo $indice," :  ",$mot,"<br>";
}

//extraction des keywords et description des metas html
function get_keywords_description($source_html)
{
	//les  metas keywords +description
	$chaine_metas = "";
	$tab_metas = get_meta_tags($source_html);
	if(isset($tab_metas["keywords"])) $chaine_metas .= $tab_metas["keywords"];
	if(isset($tab_metas["description"])) $chaine_metas .= " ". $tab_metas["description"];

	return strtolower($chaine_metas);
}

//extraction de title de html 
function get_title($source_html)
{
	$chaine_html = implode(file ($source_html), " ") ;

	$modele ="/<title>(.*)<\/title>/si";

	if (preg_match($modele,$chaine_html,$titre))	return strtolower($titre[1]);
	else return "";
}

//extraction de body de html en texte 
function get_body($source_html){
	$chaine_html = implode(file ($source_html), " ") ;

	$modele_body ="/<body[^>]*>(.*)<\/body>/is";
	$modele_balises_scripts = '/<script[^>]*?>.*?<\/script>/is';

	//Remplacer les scripts par des vides dans HTML
	$html_sans_script = preg_replace($modele_balises_scripts, '', $chaine_html);
	
	//Récuperer le body sans script
	preg_match($modele_body,$html_sans_script,$body);
		
	$chaine_text = strtolower(strip_tags($body[1])) ;
	
	return $chaine_text;

}

	// Mise en bdd des resultats de l'indexation 
	function insertion_BDD($source_html, $tab_mots_poids){

	$connexion = mysqli_connect("localhost","root","","tiw");
	foreach ($tab_mots_poids as $mot => $poid) {

		$sql = " insert into source_mot_poid(source,mot,poid) values ('$source_html','$mot',$poid) ";

		$test = mysqli_query($connexion,$sql); 
		if ($test) {
			echo $sql,"<br>";
		}
		else{
			echo "Erreur $sql <br>";
		}
		
	}

	mysqli_close($connexion);
}

//Augmenter le coefficient des occirences
function occurences2poids ($tab, $coefficient){
	foreach ($tab as $key => $value) {
		$tab[$key] *= $coefficient;
	}
	return $tab;
}

// Fusionner deux tableaux 
function fusion_deux_tableaux ($tab_mots_occurrences_head, $tab_mots_occurrences_body){	
	foreach ($tab_mots_occurrences_head as $mot_head => $occ_head){
		if (array_key_exists("$mot_head", $tab_mots_occurrences_body))
			$tab_mots_occurrences_body ["$mot_head"] += $occ_head;
		else
			$tab_mots_occurrences_body += [ "$mot_head" => $occ_head];
	}
return $tab_mots_occurrences_body;
}

//traduction des caractéres html en ascii
function entitiesHTML2ASCII($chaine)
{
    //HTML_ENTITIES: tous les caractères éligibles en entités HTML.

    // retourne la table de traduction des entités utilisée en interne par la htmlentities():
    $table_caracts_html = get_html_translation_table(HTML_ENTITIES); 

    // retourne un tableau dont les clés sont les valeurs du précédent $table_caracts_html, et les valeurs sont les clés. 
    $tableau_html_caracts =  array_flip($table_caracts_html);

    // retourne une chaine de caractères après avoir remplacé les éléments/clés par les éléments/valeurs  du tableau associatif de paires  $tableau_html_caracts dans la chaîne $chaine.
    $chaine  =  strtr ($chaine,$tableau_html_caracts); 

    return $chaine;
}

//elever les mots vides de la table des mots récupérés
function enlever_mots_vides($tab_mot_occurrence){
$tab_mots_vides = file("mots_vides.txt");

$tab_test=array();
foreach ($tab_mots_vides  as $key => $value) {
	array_push($tab_test,trim($value));
}
$tab_mots_vides = array_flip($tab_test);

foreach ($tab_mot_occurrence as $mot => $occ){
	if (array_key_exists("$mot", $tab_mots_vides)){
		unset($tab_mot_occurrence["$mot"]);
	}
}
return $tab_mot_occurrence;
}


//Indexer un fichier html
function indexer($source_html){
	
	//séparateur tokenisation
	$separateurs = " ,.():!?»«\t\"\n\r\'-+/*%{}[]#0123456789";


//Traitement du Head

		//récuperation de titre
		$title = get_title($source_html);
		
		//extraction des keywords et description des metas html
		$key_desc = get_keywords_description($source_html);
		
		$text_head = $title." ".$key_desc;

		//traduction des entités html en ascii
	    $chaine_head = entitiesHTML2ASCII($text_head);

		//tokenisation de la chaine en mot 
		$tab_title_metas = explode_bis($separateurs,$chaine_head);
		$tab_head_mot_occurrence = array_count_values($tab_title_metas);

		//Appliquer le coefficient
		$coefficient = 1.5;
		$tab_head = occurences2poids ($tab_head_mot_occurrence, $coefficient);


//Traitement du body

		//extraction de body de html en texte 
		$text_body = get_body($source_html);

		//traduction des entités html en ascii
	    $chaine_body = entitiesHTML2ASCII($text_body);

		//tokenisation de la chaine en mot 
		$tab_body = explode_bis($separateurs,$chaine_body);
		$tab_body_mot_occ = array_count_values($tab_body);


//Fusion des tables du Head et Body
$tab_mots_poids = fusion_deux_tableaux ($tab_head, $tab_body_mot_occ);

//enlever les mots vides
$tab_mots_poids_final = enlever_mots_vides($tab_mots_poids);

// Mise en bdd des resultats de l'indexation 
insertion_BDD($source_html, $tab_mots_poids_final);

}

?>