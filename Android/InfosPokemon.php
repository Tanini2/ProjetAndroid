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
//Query pour NoGeneration, NoPokemon, NomPokemon, Type1, Type2 et (no1, no2 TRANSFÈRE PAS DANS LE TABLEAU)
$sql = "SELECT tblpokemon.NoGeneration,tblpokemon.NoPokemon,tblpokemon.NomPokemon, tblType1.NomType AS Type1,tblType2.NomType AS Type2, tblType1.noType AS no1,tblType2.noType AS no2
			FROM tblpokemon,
			(SELECT tblType.noType, tbltype.NomType,tblpokemon.NoPokemon FROM tblpokemon INNER JOIN tbltype ON tbltype.NoType = tblpokemon.Type1) AS tblType1,
			(SELECT tbltype.noType,tbltype.NomType,tblpokemon.NoPokemon FROM tblpokemon LEFT JOIN tbltype2pokemon ON tbltype2pokemon.NoPokemon = tblpokemon.NoPokemon LEFT JOIN tbltype ON tbltype2pokemon.Type2 = tbltype.NoType) AS tblType2 
			WHERE tblpokemon.NoPokemon = tblType1.NoPokemon  AND tblType1.NoPokemon = tblType2.NoPokemon AND tblpokemon.NoPokemon = ".$_GET['noPokemon']."
			ORDER BY tblpokemon.NoPokemon  ASC";
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
			'NomPokemon'=>utf8_encode($row['NomPokemon']),
			'Type1'=>$row['Type1'],
			'Type2'=>$row['Type2']
		];
		//On transfert le tableau temporaire dans le tableau permanent
		array_push($PokemonInfos, $temp);
	}
}
//On affiche en JSON 
echo json_encode($PokemonInfos,JSON_UNESCAPED_UNICODE);
mysqli_free_result($stmt);
?>