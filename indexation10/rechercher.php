
<form action="rechercher.php" method="post">

                Recherche
                <input type="text" name="query">
                <input type="submit" name="valider" value="Envoyer">
            
</form>
<?php


 $query = $_POST["query"];

//mise  en bdd les resultat d'indexation
    

    $connexion = mysqli_connect("localhost","root","","tiw");
        
    $sql = "select * from source_mot_occ where mot = '$query' ORDER BY mot DESC  ";

    $resultat = mysqli_query($connexion,$sql);

    echo "Resultat pour $query : <br>";
	
	$nombre = mysqli_num_rows($resultat);
	echo "Les resultats pour ($query) : $nombre <br><br>";
	
	$i=1;
    while ($ligne = mysqli_fetch_row($resultat)) {
		
        echo "$i = .";
        echo $ligne[0], " : ", $ligne[2] ,"<br>";	
		$i++;
    }  
    



mysqli_close($connexion);





?>