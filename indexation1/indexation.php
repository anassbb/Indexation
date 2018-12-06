<?php

$var="Bonjour test le monde. L'université de paris8, est ouverte toute l'année";
$tab_mots = explode(" ", $var);
foreach ($tab_mots 	as $indice=>$mot)
         echo $indice,":",$mot,"<br>";
		 
?>
