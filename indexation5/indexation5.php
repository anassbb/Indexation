<?php

//inclusion de fonctions prédefinies
include 'bibliotheque5.inc.php';

//séparateur tokenisation
$separateurs=" .',!?;";

//fichier html à traiter
$source_html = "source.html";

//récuperation de keywords et descriptif
$keywords_description = get_keywords_description($source_html);

//récuperation de titre
$titre = get_title($source_html);

//unification des chaines à traiter 
$texte_head =$keywords_description .  " " . $titre;

//tokenisation des données head
$tab_mots_occurence = explode_bis($separateurs,$texte_head); 

//affichage des resultats de traitement
print_tab($tab_mots_occurence);



?>