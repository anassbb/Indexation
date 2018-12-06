<?php


 $query = $_POST["query"];

//mise  en bdd les resultat d'indexation
    

    $connexion = mysqli_connect("localhost","root","","tiw");
        
    $sql = "select * from source_mot_occ where mot = '$query'";

    $resultat = mysqli_query($connexion,$sql);

    echo "Resultat pour $query : <br>";

    while ($ligne = mysqli_fetch_row($resultat)) {
        
        echo $ligne[0], " : ", $ligne[2] ,"<br>";	
    }  
    



mysqli_close($connexion);





?>