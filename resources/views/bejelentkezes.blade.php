<html lang="hu">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- <link rel="stylesheet" href="bejelentkezespanel.css"> -->
	<style>
		body {
			margin: 0;
			padding: 0;
			width: 100%;
			background-color: rgba(0, 0, 0, 0);

			/*háttérkép formázása*/
			background-image: url('https://img.freepik.com/premium-vector/female-presentation-school-presentation-oneline-drawing_718518-5853.jpg?w=2000');
			background-repeat: no-repeat;
			background-attachment: fixed;
			background-position: -400px -50px;
		}


		.login-panel {
			/*bejelentkezési panel formázása*/
			width: 320px;
			height: 420px;
			background: white;
			color: black;
			top: 55%;
			left: 53%;
			position: absolute;
			transform: translate(-50%, -50%);
			box-sizing: border-box;
		}

		h1 {
			margin: 0;
			padding: 0 0 20px;
			text-align: center;
			font-size: 30px;
		}

		/*bejelentkezés panel szövege (családnév, keresztnév, jelszó)*/
		.login-panel p {
			margin: 0;
			padding: 0;
			font-weight: bold;
		}

		.login-panel input {
			width: 100%;
			margin-bottom: 10px;
		}

		/*családnév, keresztnév és jelszó sáv szerkesztése*/
		.login-panel input[type="text"],
		input[type="password"] {
			border: none;
			border-bottom: 1px solid black;
			height: 40px;
			background: transparent;
			outline: none;
			color: black;
			font-size: 16px;
		}

		/*bejelentkezés gomb szerkesztése*/
		.login-panel input[type="submit"] {
			height: 30px;
			background: black;
			color: white;
			font-size: 20px;
			border-radius: 20px;
			border: none;
			outline: none;
		}



		/* bejelentkezés gomb vibrálása*/
		.login-panel input[type="submit"]:hover {
			cursor: pointer;
			background: green;
			color: white;
		}

		.help-button {
			background-color: black;
			color: white;
			border: none;
			border-radius: 50%;
			/* Kör alakú gomb kialakítása */
			width: 60px;
			height: 60px;
			font-size: 18px;
			cursor: pointer;
			bottom: 10px;
			right: 10px;
			position: fixed;
		}

		.help-content {
			display: none;
			background-color: white;
			border: 1px solid grey;
			border-radius: 5px;
			padding: 20px;
			margin-top: 20px;
		}

		#closeButton {
			background-color: red;
			color: white;
			border: none;
			border-radius: 5px;
			padding: 10px 20px;
			font-size: 14px;
			cursor: pointer;
		}

		#closeButton:hover {
			background-color: red;
		}
	</style>
	<title>Bejelentkezési Panel</title>
</head>

<body>
	<div class="login-panel">
		<h1>Széchenyi tanár kereső</h1>
		<form>
			<!--családnév-->
			<p>Családnév</p>
			<input type="text" name="Családnév" placeholder="Add meg a családneved">

			<!--keresztnév-->
			<p>Keresztnév</p>
			<input type="text" name="Keresztnév" placeholder="Add meg a keresztneved">

			<!--jelszó-->
			<p>Jelszó</p>
			<input type="password" name="jelszó" placeholder="Add meg a jelszavad">

			<input type="submit" name="Kész" value="Bejelentkezés">

		</form>
	</div>
</body>
<div class="help">
	<button class="help-button" id="helpButton">Súgó</button>
	<div class="help-content" id="helpContent">
		<p>fasfsfsfsafas</p>
		<button class="close-button" id="closeButton">Bezárás</button>
	</div>
</div>
<!-- <script src="bejelentkezes.js"></script> -->
<script>
	//súgó gomb

	// Első lépés: Az elemek kiválasztása az azonosítójuk alapján
	const helpButton = document.getElementById('helpButton');
	const helpContent = document.getElementById('helpContent');
	const closeButton = document.getElementById('closeButton');

	// súgó gombra kattintás
	helpButton.addEventListener('click', () => {
		helpContent.style.display = 'block';
	});

	// bezárás gommbra kattintás
	closeButton.addEventListener('click', () => {
		helpContent.style.display = 'none';
	});
</script>

</html>
