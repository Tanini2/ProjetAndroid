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
$Entry = array();
//Query pour NomJeu, PokedexEntry et NoGeneration
$sql = "SELECT tbljeu.NomJeu, tblpokedexentry.PokedexEntry, tbljeu.NoGeneration, tblpokedexentry.NoPokemon
			FROM tblpokedexentry
			INNER JOIN tbljeu
			ON tblpokedexentry.NoJeu = tbljeu.NoJeu
			WHERE NoPokemon = " .$_GET['noPokemon'];
$stmt = $conn->query($sql);
if ($stmt->num_rows > 0) {
	while($row = $stmt->fetch_assoc()){
		$temp = [
			'NomJeu'=>utf8_encode($row['NomJeu']),
			'PokedexEntry'=>utf8_encode($row['PokedexEntry']),
			'NoGeneration'=>$row['NoGeneration']
		];
		array_push($Entry, $temp);
	}
}
echo json_encode($Entry,JSON_UNESCAPED_UNICODE);
mysqli_free_result($stmt);
?>