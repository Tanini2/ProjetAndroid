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
$Evolution = array();
//Query pour NoPokemonE, NomPokemonE, TypeEvolution et Description
$sql = "SELECT tblNomE.NoPokemonE,tblNomE.NomPokemon AS NomE,tblNomE.TypeEvolution, tblNomE.Description, tblNomE.NoPokemonNE
			FROM tblpokemon,
			(SELECT tblevolution.NoPokemonNE,tblevolution.NoPokemonE,tblpokemon.NomPokemon,tblevolution.TypeEvolution,tblevolution.Description FROM tblevolution INNER JOIN tblpokemon ON tblevolution.NoPokemonE = tblpokemon.NoPokemon) AS tblNomE 
			WHERE tblpokemon.NoPokemon = tblNomE.NoPokemonNE AND tblpokemon.NoPokemon = " .$_GET['noPokemon'];
$stmt = $conn->query($sql);
if ($stmt->num_rows > 0) {
	while($row = $stmt->fetch_assoc()){
		$temp = [
			'NoPokemonE'=>$row['NoPokemonE'],
			'NomPokemonE'=>utf8_encode($row['NomE']),
			'TypeEvolution'=>utf8_encode($row['TypeEvolution']),
			'Description'=>utf8_encode($row['Description'])
		];
		array_push($Evolution, $temp);
	}
}
echo json_encode($Evolution,JSON_UNESCAPED_UNICODE);
mysqli_free_result($stmt);
?>