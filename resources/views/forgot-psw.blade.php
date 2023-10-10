@extends('layout')
@section('content')

<html lang="hu">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Forgot password</title>
	<!--Bootstrap icon href-->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
	<link href="{{ asset('css/forgot-psw.css') }}" rel="stylesheet">
</head>

<body>
	<i class="bi bi-mortarboard-fill"></i>
	<h2>Széchenyi Tanár Kereső</h2>
	<div class="txt-field">
		<h5>Elfelejtettem a jelszavam</h5>
		<i class="bi bi-emoji-tear-fill"></i>
		<form>
         @csrf
			<p>Neptun-kód</p>
			<input type="text" name="" placeholder="Add meg a regisztrációs neptun-kódod!" required>
			<p>E-mail cím</p>
			<input type="email" name="" placeholder="Add meg az e-mail címed!" required>
			<input type="submit" name="" value="Küldés"><br>
			<a href="{{ route('sign-in') }}">Bejelentkezés</a>
		</form>
	</div>
</body>

</html>

@endsection