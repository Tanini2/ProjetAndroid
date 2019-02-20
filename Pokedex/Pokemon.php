<!DOCTYPE html>
<html>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Pokédex</title>
<link rel="stylesheet" type="text/css" href="./CSS/Pokemon.css"/>
<script type="text/javascript" src="./Javascript/Pokedex.js"></script>
</head>

<body>
<?php
	require 'RequestsPokemon.php';
?>
	<!--Barre de recherche-->
	<form>
	<label for="Recherche">Search a Pokémon:</label>
	<input  id="Recherche" type="text" size="30" onkeyup="showResult(this.value)">
	<div id="livesearch">
	</div></form>
	<!--Lien Précédent-->
	<div id="LienPrecedent">
<?php
	if ($result5 ->num_rows > 0) 
	{
		while($row = $result5->fetch_assoc()) 
		{
			echo '<h2><a id="Precedent" href=./Pokemon.php?NoP='.$Precedent.'>#'.$Precedent.' '.utf8_encode($row["NomPokemon"]).'</a></h2>';
		}
	}
	else
	{
		echo '<h2><a id="Suivant" href=./Pokemon.php?NoP=807>#807 Zeraora</a></h2>';
	}
?>
	</div>
	<!--Lien Suivant-->
	<div id="LienSuivant">
<?php
	if ($result6 ->num_rows > 0) 
	{
		while($row = $result6->fetch_assoc()) 
		{
			echo '<h2><a id="Suivant" href=./Pokemon.php?NoP='.$Suivant.'>#'.$Suivant.' '.utf8_encode($row["NomPokemon"]).'</a></h2>';
		}
	}
	else
	{
		echo '<h2><a id="Suivant" href=./Pokemon.php?NoP=1>#1 Bulbasaur</a></h2>';
	}	
?>
	</div>
	<!--Lien Retour à l'accueil (Lien vers la page index.php)-->
	<div id="RetourAccueil"><h1><a href="./index.php">Pokédex</a></h1></div>
	<!--Requête = Affiche le nom du Pokémon et ses deux types-->
<?php
	if ($result->num_rows > 0) 
	{
?>
	<div id="Pokemon">
	<section id="InfoPokemon">
	<!--Faire la couleur des background pour le type 1-->
<?php
		$compteur = 0;
		while($row = $result->fetch_assoc()) 
		{
			$compteur = $compteur + 1;
			$nomPokemon = utf8_encode($row["NomPokemon"]);
			switch($row["no1"])
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
			//Faire la couleur des backgrounds pour le type 2
			switch($row["no2"])
			{
				case 1:
					$Name2="Fire";
					break;
				case 2:
					$Name2="Water";
					break;
				case 3:
					$Name2="Grass";
					break;
				case 4:
					$Name2="Poison";
					break;
				case 5:
					$Name2="Ground";
					break;
				case 6:
					$Name2="Steel";
					break;
				case 7:
					$Name2="Flying";
					break;
				case 8:
					$Name2="Normal";
					break;
				case 9:
					$Name2="Fighting";
					break;
				case 10:
					$Name2="Electric";
					break;
				case 11:
					$Name2="Psychic";
					break;
				case 12:
					$Name2="Rock";
					break;
				case 13:
					$Name2="Ice";
					break;
				case 14:
					$Name2="Bug";
					break;
				case 15:
					$Name2="Dragon";
					break;
				case 16:
					$Name2="Ghost";
					break;
				case 17:
					$Name2="Dark";
					break;
				case 18:
					$Name2="Fairy";
					break;
				case NULL:
					$Name2="None";
					break;
				default:
					echo"PROBLEM!!!";
					break;
			}
			//Affiche Nom du Pokémon met la variable des switchs dans des classes pour faire la couleur du background en CSS
			if($compteur == 1)
			{
				echo "<h1 class=".$Name.">#".$NoP." ".utf8_encode($row["NomPokemon"])."</h1>";
			}
			echo "<h2 class=".$Name.">".$row["Type1"]."</h2>";
			//Affiche le type2 s'il y en a un sinon affiche "None"
			if($row["Type2"] !== NULL)
			{
				echo '<h2 class="'.$Name2.'" style="margin-right:5%">'.$row["Type2"].'</h2>';
			}
		}
?>
		</section>
		<!--Section pour l'image. Puisqu'il n'y a pas d'images d'inclus pour l'instant, affiche une image "Coming Soon". Les images auront cette dimension plus tard.-->
<?php
		require 'SwitchImage.php';
	}
	//Requête 2 = Nom du Pokémon évolué (avec lien pour aller sur la page de ce Pokémon à l'aide d'une variable dans l'URL), Type d'évolution, Description
	if ($result2->num_rows > 0) 
	{
		echo '<section id="EvolutionPokemon"><h2 class='.$Name.'>Évolution</h2>';
		echo "<table class=".$Name."><tr><th class=".$Name2.">Nom du Pokémon</th><th class=".$Name2.">Type d'évolution</th><th class=".$Name2.">Description</th></tr>";
		while($row = $result2->fetch_assoc()) 
		{
			$noPokemon = $row["NoPokemonE"];
			echo "<tr><td><a href=./Pokemon.php?NoP=".$noPokemon.">".utf8_encode($row["NomE"])."</td><td>".$row["TypeEvolution"]."</td><td>".$row["Description"]."</td></tr>";
		}
		echo "</table></section>";
	}
	//Requête 4 = Nom de la Pierre, Type 1 et Type 2
	if ($result4->num_rows > 0) 
	{
		echo '<section id="MegaEvolution"><h2 class='.$Name.'>Méga-Évolution</h2>';
		echo "<table class=".$Name."><tr><th class=".$Name2.">Nom de la pierre</th><th class=".$Name2.">Type1</th><th class=".$Name2.">Type2</th></tr>";
		while($row = $result4->fetch_assoc()) 
		{
			echo "<tr><td>".utf8_encode($row["PierreMegaEvolution"])."</td><td>".$row["Type1"]."</td>";
			//Affiche le type2 s'il y en a un, sinon affiche "None"
			if ($row["Type2"] != null)
			{
				echo '<td>'.$row["Type2"].'</td></tr>';
			}
			else
			{
				echo '<td>None</td></tr>';
			}
		}
		echo "</table></section>";
	}
	//Requête 3 = Affiche le jeu et la PokédexEntry. Fait un titre pour chaque changement de génération à l'aide d'une variable
	if ($result3->num_rows > 0) 
	{
		//En commençant la variable à zéro, on s'assure que le premier enregistrement va le mettre à un, donc va afficher "Generation 1" dès le premier enregistrement
		$Generation = 0;
		echo '<section id="PokedexEntry"><h2 class='.$Name.'>Pokédex Entries</h2>';
		echo '<table id="TableEntry" class='.$Name.'><tr><th class='.$Name2.'>Jeu</th><th class='.$Name2.'>Pokedex entry</th></tr>';
		while($row = $result3->fetch_assoc()) 
		{
			//À chaque premier jeu d'une nouvelle génération, un <th> va apparaître avec le numéro de la génération
			if ($Generation != $row["NoGeneration"])
			{
				$Generation = $row["NoGeneration"];
				echo '<tr><th class='.$Name2.' colspan="3">Generation '.$Generation.'</th></tr>';
			}
			echo "<tr><td>".$row["NomJeu"]."</td><td>".utf8_encode($row["PokedexEntry"])."</td></tr>";
		}
		echo "</table></section>";
	}
	//Affiche que les Pokédex Entries vont arriver plus tard, s'il n'y en a pas
	else
	{
		echo '<section id="PokedexEntry"><h2 class='.$Name.'>Pokédex Entries</h2>';
		echo '<h3>Entries coming soon!</h3>';
	}
?>
	</div>
</body>
</html>