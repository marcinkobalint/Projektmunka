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
   <div class="container">
      @if ($errors->any())
      <div class="col-12">
         @foreach($errors->all() as $error)
         <div class="alert alert-danger">{{$error}}</div>
         @endforeach
      </div>
      @endif
      @if (session()->has('error')) 
      <div class="alert alert-danger">{{session('error')}}</div>
      @endif
      @if (session()->has('success')) 
      <div class="alert alert-success">{{session('success')}}</div>
      @endif
   </div>
	<div class="txt-field">
		<i class="bi bi-book-half"></i>
		<h5>Jelentkezz be!</h5>
		<form action="{{route('sign-in.post')}}" method="POST">
         @csrf
         <p>Neptun-kód:</p>
         <input type="text" name="neptun" placeholder="Add meg a Neptun-kódod!" required>
			<p>Jelszó:</p>
			<input type="password" name="password" placeholder="Add meg a jelszavad!" required>
			<input type="submit" value="Bejelentkezés"><br>
			<a href="{{ route('forgot-psw') }}">Elfelejtetted a jelszavad?</a><br>
			<a href="{{ route('sign-up') }}">Nincs accountod? Regisztrálj itt!</a><br>
		</form>
	</div>
	{{-- <script src="sign-in.js"></script> --}}
</body>

</html>

@endsection