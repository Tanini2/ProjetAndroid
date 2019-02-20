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
$MegaEvolution = array();
//Query pour PierreMegaEvolution, Type1, Type2, NoMegaEvolution, NoGeneration
$sql = "SELECT DISTINCT tblmegaevolution.NoMegaEvolution, Type1M.NomType AS Type1, Type2M.NomType AS Type2, tblmegaevolution.PierreMegaEvolution, tblmegaevolution.NoPokemon
			FROM tblmegaevolution,
			(SELECT tbltype.NomType, tblmegaevolution.NoPokemon,tbltype.NoType FROM tblmegaevolution LEFT JOIN tbltype ON tbltype.noType = tblmegaevolution.Type1) AS Type1M,
			(SELECT tbltype.NomType, tblmegaevolution.NoPokemon,tbltype.NoType FROM tblmegaevolution LEFT JOIN tbltype ON tbltype.NoType = tblmegaevolution.Type2) AS Type2M
			WHERE tblmegaevolution.Type1 = Type1M.NoType AND COALESCE(tblmegaevolution.Type2,'None')= COALESCE(Type2M.NoType,'None')
			AND tblmegaevolution.NoPokemon = Type1M.NoPokemon AND tblmegaevolution.NoPokemon = Type2M.NoPokemon AND tblmegaevolution.NoPokemon = " .$_GET['noPokemon'];
$stmt = $conn->query($sql);
if ($stmt->num_rows > 0) {
	while($row = $stmt->fetch_assoc()){
		$temp = [
			'Type1'=>$row['Type1'],
			'Type2'=>$row['Type2'],
			'PierreMegaEvolution'=>utf8_encode($row['PierreMegaEvolution'])
		];
		array_push($MegaEvolution, $temp);
	}
}
echo json_encode($MegaEvolution,JSON_UNESCAPED_UNICODE);
mysqli_free_result($stmt);
?>