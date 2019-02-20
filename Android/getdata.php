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
//PREMIÈRE REQUÊTE
$PokemonInfos = array(); 
//Query pour NoGeneration, NoPokemon, NomPokemon, Type1, Type2 et (no1, no2 TRANSFÈRE PAS DANS LE TABLEAU)
$sql = "SELECT tblpokemon.NoGeneration,tblpokemon.NoPokemon,tblpokemon.NomPokemon, tblType1.NomType AS Type1,tblType2.NomType AS Type2, tblType1.noType AS no1,tblType2.noType AS no2
			FROM tblpokemon,
			(SELECT tblType.noType, tbltype.NomType,tblpokemon.NoPokemon FROM tblpokemon INNER JOIN tbltype ON tbltype.NoType = tblpokemon.Type1) AS tblType1,
			(SELECT tbltype.noType,tbltype.NomType,tblpokemon.NoPokemon FROM tblpokemon LEFT JOIN tbltype2pokemon ON tbltype2pokemon.NoPokemon = tblpokemon.NoPokemon LEFT JOIN tbltype ON tbltype2pokemon.Type2 = tbltype.NoType) AS tblType2 
			WHERE tblpokemon.NoPokemon = tblType1.NoPokemon  AND tblType1.NoPokemon = tblType2.NoPokemon
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
//DEUXIÈME REQUÊTE
$Evolution = array();
//Query pour NoPokemonE, NomPokemonE, TypeEvolution et Description
$sql = "SELECT tblNomE.NoPokemonE,tblNomE.NomPokemon AS NomE,tblNomE.TypeEvolution, tblNomE.Description, tblNomE.NoPokemonNE
			FROM tblpokemon,
			(SELECT tblevolution.NoPokemonNE,tblevolution.NoPokemonE,tblpokemon.NomPokemon,tblevolution.TypeEvolution,tblevolution.Description FROM tblevolution INNER JOIN tblpokemon ON tblevolution.NoPokemonE = tblpokemon.NoPokemon) AS tblNomE 
			WHERE tblpokemon.NoPokemon = tblNomE.NoPokemonNE";
$stmt = $conn->query($sql);
if ($stmt->num_rows > 0) {
	while($row = $stmt->fetch_assoc()){
		$temp = [
			'NoPokemonE'=>$row['NoPokemonE'],
			'NomPokemonE'=>utf8_encode($row['NomE']),
			'TypeEvolution'=>utf8_encode($row['TypeEvolution']),
			'Description'=>utf8_encode($row['Description']),
			'NoPokemonNE'=>utf8_encode($row['NoPokemonNE'])
		];
		array_push($Evolution, $temp);
	}
}
echo json_encode($Evolution,JSON_UNESCAPED_UNICODE);
mysqli_free_result($stmt);

//TROISIÈME REQUÊTE
$Entry = array();
//Query pour NomJeu, PokedexEntry et NoGeneration
$sql = "SELECT tbljeu.NomJeu, tblpokedexentry.PokedexEntry, tbljeu.NoGeneration, tblpokedexentry.NoPokemon
			FROM tblpokedexentry
			INNER JOIN tbljeu
			ON tblpokedexentry.NoJeu = tbljeu.NoJeu";
$stmt = $conn->query($sql);
if ($stmt->num_rows > 0) {
	while($row = $stmt->fetch_assoc()){
		$temp = [
			'NomJeu'=>utf8_encode($row['NomJeu']),
			'PokedexEntry'=>utf8_encode($row['PokedexEntry']),
			'NoGeneration'=>$row['NoGeneration'],
			'NoPokemon'=>$row['NoPokemon']
		];
		array_push($Entry, $temp);
	}
}
echo json_encode($Entry,JSON_UNESCAPED_UNICODE);
mysqli_free_result($stmt);

//QUATRIÈME REQUÊTE
$MegaEvolution = array();
//Query pour PierreMegaEvolution, Type1, Type2, NoMegaEvolution, NoGeneration
$sql = "SELECT DISTINCT tblmegaevolution.NoMegaEvolution, Type1M.NomType AS Type1, Type2M.NomType AS Type2, tblmegaevolution.PierreMegaEvolution, tblmegaevolution.NoPokemon
			FROM tblmegaevolution,
			(SELECT tbltype.NomType, tblmegaevolution.NoPokemon,tbltype.NoType FROM tblmegaevolution LEFT JOIN tbltype ON tbltype.noType = tblmegaevolution.Type1) AS Type1M,
			(SELECT tbltype.NomType, tblmegaevolution.NoPokemon,tbltype.NoType FROM tblmegaevolution LEFT JOIN tbltype ON tbltype.NoType = tblmegaevolution.Type2) AS Type2M
			WHERE tblmegaevolution.Type1 = Type1M.NoType AND COALESCE(tblmegaevolution.Type2,'None')= COALESCE(Type2M.NoType,'None')
			AND tblmegaevolution.NoPokemon = Type1M.NoPokemon AND tblmegaevolution.NoPokemon = Type2M.NoPokemon";
$stmt = $conn->query($sql);
if ($stmt->num_rows > 0) {
	while($row = $stmt->fetch_assoc()){
		$temp = [
			'Type1'=>$row['Type1'],
			'Type2'=>$row['Type2'],
			'PierreMegaEvolution'=>utf8_encode($row['PierreMegaEvolution']),
			'NoPokemon'=>$row['NoPokemon']
		];
		array_push($MegaEvolution, $temp);
	}
}
echo json_encode($MegaEvolution,JSON_UNESCAPED_UNICODE);
mysqli_free_result($stmt);
?>