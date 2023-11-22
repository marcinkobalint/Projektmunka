@extends('layout')
@section('title', 'Main')
@section('content')

	<!DOCTYPE html>
	<html lang="hu">

	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Tanárok</title>
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
				<a href="{{ route('about-us') }}">Rólunk</a>
				<a href="{{ route('sign-out') }}">Kijelentkezés</a>
				<i class="bi bi-book-half"></i>
			</div>
		</div>

		<form action="{{ route('main-screen') }}" method="GET">
			<!-- Keresősáv -->
			<div class="container mt-4 custom-search">
				<input class="form-control" type="search" id="search" placeholder="Keresés" aria-label="Search"
					oninput="searchInfo()">
				{{-- <button class="btn-search" type="submit">Keresés</button> --}}
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
						<tr class="informations">
							<td>
								<p class="teacher_name">{{ $teacher->name }} </p>
							</td>
							<td class="subject_names">
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
							<td>
								@if (!empty($teacher->email))
									E-mail: {{ $teacher->email }}<br>
								@endif
								@if (!empty($teacher->phone))
									Telefon: {{ $teacher->phone }}<br>
								@endif
								@if (!empty($teacher->room))
									Iroda: {{ $teacher->room }}<br>
								@endif
								@if (!empty($teacher->webpage))
									Weboldal: {{ $teacher->webpage }}<br>
								@endif
								@if (!empty($teacher->consultation))
									Fogadási idő: {{ $teacher->consultation }}<br>
								@endif
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</form>

		</div>

		<script>
			function searchInfo() {
				let s = document.getElementById('search').value.toLowerCase();
				const informations = document.getElementsByClassName('informations');
				for (let i = 0; i < informations.length; i++) {
					let show = false;
					let teacher_name = informations[i].querySelectorAll('.teacher_name')[0].textContent;
					let subject_names = informations[i].querySelectorAll('.subject_names');
					for (let i = 0; i < subject_names.length; i++) {
						if (teacher_name.toLowerCase().includes(s) || subject_names[i].textContent.toLowerCase().includes(s))
							show = true;
						if (show) break;
					}
					if (show) informations[i].style.display = '';
					else informations[i].style.display = 'none';
				}
			}
		</script>



		<!-- Bootstrap JavaScript és jQuery -->
		<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
		<link rel="stylesheet" href="main-screen.css">

	</body>

	</html>



@endsection
