<?php
	switch($nomPokemon)
	{
		case "Nidoran (F)":
			echo '<section id="Image"><img alt="image '.$nomPokemon.'" src="./images/Pokemon/nidoranf.png"/></section>';
			break;
		case "Nidoran (M)":
			echo '<section id="Image"><img alt="image '.$nomPokemon.'" src="./images/Pokemon/nidoranm.png"/></section>';
			break;
		case "Farfetch'd":
			echo '<section id="Image"><img alt="image '.$nomPokemon.'" src="./images/Pokemon/farfetchd.png"/></section>';
			break;
		case "Mr.Mime":
			echo '<section id="Image"><img alt="image '.$nomPokemon.'" src="./images/Pokemon/mrmime.png"/></section>';
			break;
		case "Ho-Oh":
			echo '<section id="Image"><img alt="image '.$nomPokemon.'" src="./images/Pokemon/hooh.png"/></section>';
			break;
		case "Mime Jr.":
			echo '<section id="Image"><img alt="image '.$nomPokemon.'" src="./images/Pokemon/mimejr.png"/></section>';
			break;
		case "Porygon-Z":
			echo '<section id="Image"><img alt="image '.$nomPokemon.'" src="./images/Pokemon/porygonz.png"/></section>';
			break;
		case "Flabébé":
			echo '<section id="Image"><img alt="image '.$nomPokemon.'" src="./images/Pokemon/flabebe.png"/></section>';
			break;
		case "Type: Null":
			echo '<section id="Image"><img alt="image '.$nomPokemon.'" src="./images/Pokemon/typenull.png"/></section>';
			break;
		case "Jangmo-o":
			echo '<section id="Image"><img alt="image '.$nomPokemon.'" src="./images/Pokemon/jangmoo.png"/></section>';
			break;
		case "Hakamo-o":
			echo '<section id="Image"><img alt="image '.$nomPokemon.'" src="./images/Pokemon/hakamoo.png"/></section>';
			break;
		case "Kommo-o":
			echo '<section id="Image"><img alt="image '.$nomPokemon.'" src="./images/Pokemon/kommoo.png"/></section>';
			break;
		case "Tapu Koko":
			echo '<section id="Image"><img alt="image '.$nomPokemon.'" src="./images/Pokemon/tapukoko.png"/></section>';
			break;
		case "Tapu Lele":
			echo '<section id="Image"><img alt="image '.$nomPokemon.'" src="./images/Pokemon/tapulele.png"/></section>';
			break;
		case "Tapu Bulu":
			echo '<section id="Image"><img alt="image '.$nomPokemon.'" src="./images/Pokemon/tapubulu.png"/></section>';
			break;
		case "Tapu Fini":
			echo '<section id="Image"><img alt="image '.$nomPokemon.'" src="./images/Pokemon/tapufini.png"/></section>';
			break;
		default:
			echo '<section id="Image"><img alt="image '.$nomPokemon.'" src="./images/Pokemon/'.lcfirst($nomPokemon).'.png"/></section>';
			break;
	}
		
?>