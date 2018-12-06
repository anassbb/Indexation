<?php
// notepad.pw/tiw
	include 'bibliotheque7.inc.php';

	//séparateur tokenisation
	$separateurs=" \".',«’!?;:&-=+@#{}[]()0123456789";

	$source_html = "source.html";

    // Affichage du retour de la fonction
	$texte_body = get_body($source_html);

	//tokenisation des données head
	$tab_mots = explode_bis($separateurs , $texte_body); 

	// liste de mots avec leurs nombres d'occurrences.
	$tab_mots_occurrences = array_count_values($tab_mots);

	//affichage des resultats de traitement
	//print_tab($tab_mots_occurrences);
	

	//mise  en bdd les resultat d'indexation
	$connection = mysqli_connect("localhost","root","","TIW");

foreach($tab_mots_occurrences as $mot => $occurence)
{


    $sql = "insert into source_mot_occ(source,mot,occurence) 
    values('$source_html','$mot',$occurence)";

    $test = mysqli_query($connection,$sql);
    if ($test)
    {
        echo $sql,"<br>"; 
    }
    else{
        echo "Erreur $sql <br>" ;
    }

}

mysqli_close($connection);

    ?>