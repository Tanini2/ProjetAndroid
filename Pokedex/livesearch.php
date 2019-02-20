<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pokedex";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error)
{
	die("Connection failed: " . $conn->connect_error);
}
//get the q parameter from URL
$q=utf8_decode($_GET["q"]);

//Requête pour trouver les noms de Pokémons contenant $q
$sql = 'SELECT NoPokemon, NomPokemon
		FROM tblpokemon
		WHERE NomPokemon LIKE "%'.$q.'%";';
$result = $conn->query($sql);
if ($result->num_rows > 0) 
{
	$hint = "";
		while($row = $result->fetch_assoc())
		{
			$noPokemon = $row["NoPokemon"];
			$hint = $hint.'<a href=./Pokemon.php?NoP='.$noPokemon.'>'.utf8_encode($row["NomPokemon"]).'<br />';
		}
}
else
{
	$hint ="No suggestion";
}

// Set output to "no suggestion" if no hint was found
// or to the correct values
if ($hint=="") {
  $response="no suggestion";
} else {
  $response=$hint;
}

//output the response
echo $response;
?>