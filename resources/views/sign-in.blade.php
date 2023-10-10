@extends('layout')
@section('content')

<html lang="hu">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Sign in</title>
	<!--Bootstrap icon href-->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
	<link href="{{ asset('css/sign-in.css') }}" rel="stylesheet">
</head>

<body>
	<i class="bi bi-mortarboard-fill"></i>
	<h2>Széchenyi Tanár Kereső</h2>
	<div class="txt-field">
		<i class="bi bi-book-half"></i>
		<h5>Jelentkezz be!</h5>
		<form>
         @csrf
			<p>Felhasználónév:</p>
			<input type="text" name="" placeholder="Add meg a felhasználóneved!" required>
			<p>Jelszó:</p>
			<input type="password" name="signinname" placeholder="Add meg a jelszavad!" required>
			<input type="submit" name="password" value="Bejelentkezés"><br>
			<a href="{{ route('forgot-psw') }}">Elfelejtetted a jelszavad?</a><br>
			<a href="{{ route('sign-up') }}">Nincs accountod? Regisztrálj itt!</a><br>
		</form>
	</div>
	{{-- <script src="sign-in.js"></script> --}}
</body>

</html>

@endsection