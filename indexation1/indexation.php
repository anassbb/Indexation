<?php

$var="Bonjour test le monde. L'universit� de paris8, est ouverte toute l'ann�e";
$tab_mots = explode(" ", $var);
foreach ($tab_mots 	as $indice=>$mot)
         echo $indice,":",$mot,"<br>";
		 
?>
