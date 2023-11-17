@extends('layout')
@section('title', 'Main')
@section('content')

	<!DOCTYPE html>
	<html lang="hu">

	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<!-- Bootstrap CSS -->
		{{-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> --}}
		<!--Bootstrap icon href-->
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
		<link href="{{ asset('css/main-screen.css') }}" rel="stylesheet">

	</head>

	<body>
		<!-- Sidebar -->
		<div class="container-fluid">
			<div class="col-1.2 sidebar">
				<a href="#">Rólunk</a>
				<a href="{{ route('sign-out') }}">Kijelentkezés</a>
				<i class="bi bi-book-half"></i>
			</div>
		</div>

		<form action="{{ route('main-screen') }}" method="GET">
			<!-- Keresősáv -->
			<div class="container mt-4 custom-search">
				<input class="form-control" type="search" placeholder="Keresés" aria-label="Search">
				<button class="btn-search" type="submit">Keresés</button>
			</div>

			<table>
				<thead>
					<tr>
						<th>Név</th>
						<th>Tanított tantárgy</th>
						<th>Elérhetőségek</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($teachers as $teacher)
						<tr>
							<td>{{ $teacher->name }}</td>
							<td>
								@foreach ($teachers_subjects as $teacher_subject)
									@if ($teacher->id == $teacher_subject->teacher_id)
										@foreach ($subjects as $subject)
											@if ($subject->id == $teacher_subject->subject_id)
												{{ $subject->name }} <br>
											@endif
										@endforeach
									@endif
								@endforeach
							</td>
							<td>e-mail: {{ $teacher->email }}<br>telefon: {{ $teacher->phone }}<br>Iroda: {{ $teacher->room }}<br>Fogadási
								idő: csütörtök 16:40-17:40</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</form>

		</div>



		<!-- Bootstrap JavaScript és jQuery -->
		<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
		<link rel="stylesheet" href="main-screen.css">

	</body>

	</html>

@endsection
