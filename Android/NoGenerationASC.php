<?php
//Informations du serveur
$servername = "localhost";
$username = "cegepjon_1337589";
$password = "Hiver2019";
$database = "cegepjon_1337589";
//Créer un objet connection
$conn = new mysqli($servername, $username, $password, $database);
//Si une erreur, ferme la connexion
if ($conn->connect_error) 
{
    die("Connection failed: " . $conn->connect_error);
}
//REQUÊTE
$PokemonInfos = array(); 
//Query pour NoGeneration, NoPokemon, NomPokemon
$sql = "SELECT tblpokemon.NoGeneration,tblpokemon.NoPokemon,tblpokemon.NomPokemon
		FROM tblpokemon
		ORDER BY tblpokemon.NoGeneration, tblpokemon.NoPokemon  ASC";
//Prépare la query
$stmt = $conn->query($sql);
//"Bind" les résultats aux variables
if ($stmt->num_rows > 0) {
	//Passe à travers tous les résultats
	while($row = $stmt->fetch_assoc()){
		//On met les données dans un tableau temporaire
		$temp = [
			'NoGeneration'=>$row['NoGeneration'],
			'NoPokemon'=>$row['NoPokemon'],
			'NomPokemon'=>utf8_encode($row['NomPokemon'])
		];
		//On transfert le tableau temporaire dans le tableau permanent
		array_push($PokemonInfos, $temp);
	}
}
//On affiche en JSON 
echo json_encode($PokemonInfos,JSON_UNESCAPED_UNICODE);
mysqli_free_result($stmt);
?>