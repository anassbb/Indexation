<form action="rechercher.php" method="post">

	Recherche
	<input type="text" name="query">
	<input type="submit" name="valider" value="Envoyer">

</form>

<?php 

	$query = $_POST["query"];

	$connexion = mysqli_connect("localhost","root","","tiw");
		
	$sql = "select * from source_mot_poid where mot = '$query' order by poid desc";

	$resultat = mysqli_query($connexion,$sql);
	$nombre= mysqli_num_rows($resultat);
	
	echo "Resultat pour $query : <br>";
	
	$i = 1;
	while ($ligne = mysqli_fetch_row($resultat)) {
	 	
	 	echo $ligne[0], " : ", $ligne[2] ,"<br>";	
	 } 

?>