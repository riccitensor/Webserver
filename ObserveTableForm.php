<html>
	<head>
		<title> Observeer tafel </title>
		<link href="style.css" type="text/css" rel="stylesheet"/>
	</head>
	
	<body>
		<div class="input">
			<form action="watchTable.php" method="post">
			    <fieldset class="main">
			        <legend>Observeer tafel</legend>                        

			        <fieldset class="nested">
				        <legend>Gegevens</legend>    
				        <ol>
							<li>
								<label for="name">Naam tafel</label>
								<input id="name" name="name" type="text"/>
							</li>
				        </ol>
			        </fieldset>

					<a id="button" href="index.php">Hoofdpagina</a>
			        <div class="buttonsContainer">
		                <input class="button" type="submit" value="Voer in" />
			        </div>
			    </fieldset>
			</form>
		</div>
	</body>
</html>
