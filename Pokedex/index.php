<!DOCTYPE html>
<html>

<head>
<meta charset="utf-8">
<title>Pokédex</title>
<link rel="stylesheet" type="text/css" href="./CSS/Accueil.css"/>
<script type="text/javascript" src="./Javascript/Pokedex.js"></script>
</head>


<body>
	<form>
	<label for="Recherche">Search a Pokémon:</label>
	<input  id="Recherche" type="text" size="30" onkeyup="showResult(this.value)"/>
	<div id="livesearch"></div>
	</form>
	<header>
		<h1>Welcome to the Pokédex!</h1>
	</header>
	<div id="Container">
		<section id="ListNoPokemon">
			<table>
				<tr>
					<th colspan="3">List of Pokémon by No.Pokémon</th>
				</tr>
				<tr>
					<th>Generation</th>
					<th>No. Pokémon</th>
					<th>Pokémon Name</th>
				</tr>
		<?php
		$servername = "localhost";
		$username = "root";
		$password = "";
		$dbname = "pokedex";

		// Create connection
		$conn = new mysqli($servername, $username, $password, $dbname);
		// Check connection
		if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
		} 

		$sql = "SELECT noGeneration, noPokemon, NomPokemon, Type1 FROM tblpokemon ORDER BY noGeneration, noPokemon;";
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
		// output data of each row
		while($row = $result->fetch_assoc()) {
			
			switch($row["Type1"])
			{
				case 1:
					$Name="Fire";
					break;
				case 2:
					$Name="Water";
					break;
				case 3:
					$Name="Grass";
					break;
				case 4:
					$Name="Poison";
					break;
				case 5:
					$Name="Ground";
					break;
				case 6:
					$Name="Steel";
					break;
				case 7:
					$Name="Flying";
					break;
				case 8:
					$Name="Normal";
					break;
				case 9:
					$Name="Fighting";
					break;
				case 10:
					$Name="Electric";
					break;
				case 11:
					$Name="Psychic";
					break;
				case 12:
					$Name="Rock";
					break;
				case 13:
					$Name="Ice";
					break;
				case 14:
					$Name="Bug";
					break;
				case 15:
					$Name="Dragon";
					break;
				case 16:
					$Name="Ghost";
					break;
				case 17:
					$Name="Dark";
					break;
				case 18:
					$Name="Fairy";
					break;
				case NULL:
					$Name2="None";
					break;
				default:
					echo"PROBLEM!!!";
					break;
			}
			echo "<tr>";
			echo "<td class=".$Name.">".$row["noGeneration"]."</td>";
			echo "<td class=".$Name.">".$row["noPokemon"]."</td>";
			$noPokemon = $row["noPokemon"];
			echo "<td class=".$Name."><a href=./Pokemon.php?NoP=".$noPokemon.">".utf8_encode($row["NomPokemon"])."</a></td>";
			echo "</tr>";
		}
		} else {
		echo "0 results";
		}
		?>
			</table>
		</section>
		<section id="Legend">
			<table>
				<tr>
					<th>Legend</th>
				</tr>
				<tr>
					<td class="Fire">Fire</td>
				</tr>
				<tr>
					<td class="Water">Water</td>
				</tr>
				<tr>
					<td class="Grass">Grass</td>
				</tr>
				<tr>
					<td class="Poison">Poison</td>
				</tr>
				<tr>
					<td class="Ground">Ground</td>
				</tr>
				<tr>
					<td class="Steel">Steel</td>
				</tr>
				<tr>
					<td class="Flying">Flying</td>
				</tr>
				<tr>
					<td class="Normal">Normal</td>
				</tr>
				<tr>
					<td class="Fighting">Fighting</td>
				</tr>
				<tr>
					<td class="Electric">Electric</td>
				</tr>
				<tr>
					<td class="Psychic">Psychic</td>
				</tr>
				<tr>
					<td class="Rock">Rock</td>
				</tr>
				<tr>
					<td class="Ice">Ice</td>
				</tr>
				<tr>
					<td class="Bug">Bug</td>
				</tr>
				<tr>
					<td class="Dragon">Dragon</td>
				</tr>
				<tr>
					<td class="Ghost">Ghost</td>
				</tr>
				<tr>
					<td class="Dark">Dark</td>
				</tr>
				<tr>
					<td class="Fairy">Fairy</td>
				</tr>
			</table>
		</section>
		<section id="ListPokemonName">
			
			<table>
				<tr>
					<th colspan="3">List of Pokémon by Pokémon Name</th>
				</tr>
				<tr>
					<th>Generation</th>
					<th>No. Pokémon</th>
					<th>Pokémon Name</th>
				</tr>
		<?php

		$sql = "SELECT noGeneration, noPokemon, NomPokemon, Type1 FROM tblpokemon ORDER BY NomPokemon;";
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
		// output data of each row
		while($row = $result->fetch_assoc()) {
			switch($row["Type1"])
			{
				case 1:
					$Name="Fire";
					break;
				case 2:
					$Name="Water";
					break;
				case 3:
					$Name="Grass";
					break;
				case 4:
					$Name="Poison";
					break;
				case 5:
					$Name="Ground";
					break;
				case 6:
					$Name="Steel";
					break;
				case 7:
					$Name="Flying";
					break;
				case 8:
					$Name="Normal";
					break;
				case 9:
					$Name="Fighting";
					break;
				case 10:
					$Name="Electric";
					break;
				case 11:
					$Name="Psychic";
					break;
				case 12:
					$Name="Rock";
					break;
				case 13:
					$Name="Ice";
					break;
				case 14:
					$Name="Bug";
					break;
				case 15:
					$Name="Dragon";
					break;
				case 16:
					$Name="Ghost";
					break;
				case 17:
					$Name="Dark";
					break;
				case 18:
					$Name="Fairy";
					break;
				default:
					echo"PROBLEM!!!";
					break;
			}
			echo "<tr>";
			echo "<td class=".$Name.">".$row["noGeneration"]."</td>";
			echo "<td class=".$Name.">".$row["noPokemon"]."</td>";
			$noPokemon = $row["noPokemon"];
			echo "<td class=".$Name."><a href=./Pokemon.php?NoP=".$noPokemon.">".utf8_encode($row["NomPokemon"])."</a></td>";
			echo "</tr>";
		}
		} else {
		echo "Error";
		}
		$conn->close();
		?>
			</table>
		</section>
	</div>

</body>
</html>
