@extends('layout')
@section('title', 'Sign-up')
@section('content')

	<html lang="hu">

	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Sign up</title>

		<!--Bootstrap icon href-->
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
		<link href="{{ asset('css/sign-up.css') }}" rel="stylesheet">
	</head>

	<body>
		<i class="bi bi-mortarboard-fill"></i>
		<h2>Széchenyi Tanár Kereső</h2>
		<div class="container">
			@if ($errors->any())
				<div class="col-12">
					@foreach ($errors->all() as $error)
						<div class="alert alert-danger">{{ $error }}</div>
					@endforeach
				</div>
			@endif
			@if (session()->has('error'))
				<div class="alert alert-danger">{{ session('error') }}</div>
			@endif
			@if (session()->has('success'))
				<div class="alert alert-success">{{ session('success') }}</div>
			@endif
		</div>
		<form action="{{ route('sign-up.post') }}" method="POST">
			<div class="txt-field">
				<h5>Regisztrációs adatlap</h5>
				@csrf
				<p>Felhasználónév</p>
				<input type="text" name="username" placeholder="Add meg a felhasználóneved!" required>
				<p>Jelszó</p>
				<input type="password" name="password" placeholder="Add meg a jelszavad!" required>
				<p>E-mail cím</p>
				<input type="email" name="email" placeholder="Add meg az e-mail címed!" required>
				<p>Neptun-kód</p>
				<input type="text" name="neptun" placeholder="Add meg a neptun-kódod!" required>
				{{-- <button type="submit" class="btn btn-secondary">Regisztrálás</button> --}}
				<input type="submit" name="" value="Regisztrálás"><br>
				<i class="bi bi-emoji-grin-fill"></i>
				<a href="{{ route('sign-in') }}">Be szeretnék jelentkezni!</a><br>
		</form>
		</div>
	</body>

	</html>

@endsection
