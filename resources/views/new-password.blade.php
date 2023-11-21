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
			<form action="{{route('reset-psw.post')}}" method="POST">
				@csrf
                <input type="text" name="token" hidden value="{{$token}}">
				<p>E-mail cím</p>
				<input type="email" name="email" placeholder="Add meg az e-mail címed!" required>
                <p>Új jelszó</p>
				<input type="password" name="password" placeholder="Add meg az új jelszót!" required>
                <p>Új jelszó megerősítése</p>
				<input type="password" name="password_confirmation" placeholder="Erősítsd meg a megadott jelszót!" required>

				<input type="submit" name="" value="Küldés"><br>
				<a href="{{ route('sign-in') }}">Bejelentkezés</a>
				<div class="mt-3 container">
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
			</form>
		</div>
	</body>

	</html>

@endsection
