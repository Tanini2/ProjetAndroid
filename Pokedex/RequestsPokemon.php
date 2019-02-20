<?php
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "pokedex";
	$NoP = $_GET["NoP"];
	$Suivant = $NoP + 1;
	$Precedent = $NoP - 1;
	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error)
	{
		die("Connection failed: " . $conn->connect_error);
	} 
	//NoPokemon, NomPokemon, Type1, Type2, NoGeneration
	$sql = "SELECT tblpokemon.NoGeneration,tblpokemon.NoPokemon,tblpokemon.NomPokemon,
			tblType1.NomType AS Type1,tblType2.NomType AS Type2, tblType1.noType AS no1,tblType2.noType AS no2
			FROM tblpokemon,
			(SELECT tblType.noType, tbltype.NomType,tblpokemon.NoPokemon FROM tblpokemon INNER JOIN tbltype ON tbltype.NoType = tblpokemon.Type1) AS tblType1,
			(SELECT tbltype.noType,tbltype.NomType,tblpokemon.NoPokemon FROM tblpokemon LEFT JOIN tbltype2pokemon ON tbltype2pokemon.NoPokemon = tblpokemon.NoPokemon LEFT JOIN tbltype ON tbltype2pokemon.Type2 = tbltype.NoType) AS tblType2 
			WHERE tblpokemon.NoPokemon = tblType1.NoPokemon  AND tblType1.NoPokemon = tblType2.NoPokemon AND tblpokemon.NoPokemon = ".$NoP."
			ORDER BY tblpokemon.NoPokemon  ASC";
	$result = $conn->query($sql);
	//NomPokemonEvolue, TypeEvolution, Description
	$sql = "SELECT tblNomE.NoPokemonE,tblNomE.NomPokemon AS NomE,tblNomE.TypeEvolution, tblNomE.Description
			FROM tblpokemon,
			(SELECT tblevolution.NoPokemonNE,tblevolution.NoPokemonE,tblpokemon.NomPokemon,tblevolution.TypeEvolution,tblevolution.Description FROM tblevolution INNER JOIN tblpokemon ON tblevolution.NoPokemonE = tblpokemon.NoPokemon) AS tblNomE 
			WHERE tblpokemon.NoPokemon = tblNomE.NoPokemonNE AND tblpokemon.NoPokemon =".$NoP;
	$result2 = $conn->query($sql);
	//NoJeu, NomJeu, Pokedex entry, NoGeneration
	$sql = "SELECT tbljeu.NomJeu, tblpokedexentry.PokedexEntry, tbljeu.NoGeneration
			FROM tblpokedexentry
			INNER JOIN tbljeu
			ON tblpokedexentry.NoJeu = tbljeu.NoJeu
			WHERE tblpokedexentry.NoPokemon = ".$NoP;
	$result3 = $conn->query($sql);
	//PierreMegaEvolution, Type1, Type2, NoMegaEvolution
	$sql = "SELECT DISTINCT tblmegaevolution.NoMegaEvolution, Type1M.NomType AS Type1, Type2M.NomType AS Type2, tblmegaevolution.PierreMegaEvolution
			FROM tblmegaevolution,
			(SELECT tbltype.NomType, tblmegaevolution.NoPokemon,tbltype.NoType FROM tblmegaevolution LEFT JOIN tbltype ON tbltype.noType = tblmegaevolution.Type1) AS Type1M,
			(SELECT tbltype.NomType, tblmegaevolution.NoPokemon,tbltype.NoType FROM tblmegaevolution LEFT JOIN tbltype ON tbltype.NoType = tblmegaevolution.Type2) AS Type2M
			WHERE tblmegaevolution.Type1 = Type1M.NoType AND COALESCE(tblmegaevolution.Type2,'None')= COALESCE(Type2M.NoType,'None')
			AND tblmegaevolution.NoPokemon = Type1M.NoPokemon AND tblmegaevolution.NoPokemon = Type2M.NoPokemon AND tblmegaevolution.NoPokemon =".$NoP;
	$result4 = $conn->query($sql);
	//Requête Précédent à partir du $NoP
	$sql = "SELECT tblpokemon.NomPokemon
			FROM tblpokemon
			WHERE tblpokemon.NoPokemon = ".$Precedent;
	$result5 = $conn->query($sql);
	//Requête Suivant à partir du $NoP
	$sql = "SELECT tblpokemon.NomPokemon
			FROM tblpokemon
			WHERE tblpokemon.NoPokemon = ".$Suivant;
	$result6 = $conn->query($sql);
?>